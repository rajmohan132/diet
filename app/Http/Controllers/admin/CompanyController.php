<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Model\CountrySettings;
use App\Model\CompanytSettings;
use Illuminate\Http\Request;
use App\Models\CompanySettings;
use App\Models\Country;

class CompanyController extends Controller
{
    public function index()
    {

        return view('company_settings');
    }

    public function company_settings()
    {
        $countries = Country::all();
        $company_settings = CompanySettings::first();
        // dd($company_settings);
        $zones_array = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return view('company_settings', compact('zones_array', 'company_settings', 'countries'));
    }

    public function add_company_settings(Request $request)
    {
        // dd($request);
        
        // dd($request->all());
        if (!empty($request->hasFile('company_logo'))) {
            $company_logo = 'company_logo' . '_' . time() . '.' . $request->company_logo->extension();
            $request->company_logo->move(public_path() . '/company_details', $company_logo);
        }

        if (!empty($request->hasFile('fav_icon'))) {
            $fav_icon = 'fav_icon' . '_' . time() . '.' . $request->fav_icon->extension();
            $request->fav_icon->move(public_path() . '/company_details', $fav_icon);
        }

        if (!empty($request->hasFile('login_image'))) {
            $login_image = 'login_image' . '_' . time() . '.' . $request->login_image->extension();
            $request->login_image->move(public_path() . '/company_details', $login_image);
        }

        

        $company_settings = CompanySettings::updateOrCreate(
            ['id' => $request->id],
            ['company_name' => $request->company_name, 
            'company_logo' => $company_logo, 
            'phone_number' => $request->phone_number, 
            'company_email' => $request->company_email, 
            'company_address' => $request->company_address, 
            'time_zone' => $request->time_zone, 
            'date_format' => $request->date_format, 
            'footer' => $request->footer, 
            'fav_icon' =>$fav_icon, 
            'country'=>$request->country,
            'login_image' => $login_image,
            'colour' =>$request->primary
            ]
        );
        $output = array(
            'error'     =>  '',
            'success'   =>  'success'
        );
        echo json_encode($output);
    }
}
