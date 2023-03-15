<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\DB;
use App\Models\BusinessSettings;
use Validator;
use Artisan;

class SettingController extends Controller
{
   public function emptyDatabase()
    {
        if (!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        $tables = DB::select('SHOW TABLES');
        $str = 'Tables_in_' . env('DB_DATABASE');
        foreach ($tables as $table) {
            if ($table->$str != 'users'  && $table->$str != 'migrations' && $table->$str != 'oauth_access_tokens' && $table->$str != 'oauth_auth_codes' && $table->$str != 'oauth_clients' && $table->$str != 'oauth_personal_access_clients' && $table->$str != 'oauth_refresh_tokens' && $table->$str != 'password_resets' && $table->$str != 'personal_access_tokens') {
                DB::table($table->$str)->truncate();
            }
        }
        return redirect()->back()->with('message', 'Database cleared successfully');
    }

    public function backup()
    {
        if (!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        // Database configuration
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database_name = env('DB_DATABASE');


        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");



        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {


            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            $sqlScript .= "\n\n" . $row[1] . ";\n\n";


            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);

            $columnCount = mysqli_num_fields($result);


            for ($i = 0; $i < $columnCount; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\n";
        }

        if (!empty($sqlScript)) {

            $backup_file_name = public_path() . '/' . $database_name . '_backup_' . time() . '.sql';

            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler);

            $zip = new ZipArchive();
            $zipFileName = $database_name . '_backup_' . time() . '.zip';
            $zip->open(public_path() . '/' . $zipFileName, ZipArchive::CREATE);
            $zip->addFile($backup_file_name, $database_name . '_backup_' . time() . '.sql');
            $zip->close();
        }
        return redirect($zipFileName);
    }

    public function business_settings()
    {
        $app_settings = AppSettings::first();
        $zones_array = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return view('business_settings', compact('app_settings', 'zones_array'));
    }

    public function business_settings_update(Request $request)
    {
        //dd($request);
        $validation = Validator::make($request->all(), [
            'app_name' => 'required',
            'site_logo' => 'required',
            'timezone' => 'required',
            'date_format' => 'required',
            'footer_content' => 'required',
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } elseif (!env('USER_VERIFIED')) {
            $error_array = 'User Not Verified';
        } else {
            $business_settings = BusinessSettings::first();
            $business_settings->app_name = $request->app_name;
            $business_settings->timezone = $request->timezone;
            $business_settings->date_format = $request->date_format;
            $business_settings->footer_content = $request->footer_content;
            if ($business_settings->site_logo) {
                $ext = pathinfo($business_settings->site_logo->getClientOriginalName(), PATHINFO_EXTENSION);
                $logoName = date("Ymdhis") . '.' . $ext;
                $business_settings->site_logo->move('public/logo', $logoName);
                $business_settings->site_logo = $logoName;
            }
            $business_settings->save();

            $success_output = 'Data has been updated';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function app_settings_update(Request $request)
    {
       // dd($request);
        $app_settings = AppSettings::find($request->id);
        $app_settings->app_name = $request->app_name;
        $app_settings->software_version = $request->software_version;
        $app_settings->app_debug = $request->app_debug;
        $app_settings->app_mode = $request->app_mode;
        $app_settings->app_url = $request->app_url;
        $app_settings->lock_time = $request->lock_time;
        $app_settings->save();
        $output = array(
            'error'     =>  '',
            'success'   =>  'success'
        );


        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                "SOFTWARE_VERSION" . '=' . env("SOFTWARE_VERSION"),
                "SOFTWARE_VERSION" . '=' . $request->software_version,
                file_get_contents($path)
            ));

            file_put_contents($path, str_replace(
                "APP_DEBUG" . '=' . env("APP_DEBUG"),
                "APP_DEBUG" . '=' . $request->app_debug,
                file_get_contents($path)

            ));

            file_put_contents($path, str_replace(
                "APP_MODE" . '=' . env("APP_MODE"),
                "APP_MODE" . '=' . $request->app_mode,
                file_get_contents($path)

            ));

            file_put_contents($path, str_replace(
                "auth_key" . '=' . env("auth_key"),
                "auth_key" . '=' . $request->auth_key,
                file_get_contents($path)

            ));

        }

        echo json_encode($output);
    }



    public function clearCache(Request $request)
    {
       
        if (!env('APP_DEMO', false)) {
          
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            
        } 
        return redirect()->back();
    }

}
