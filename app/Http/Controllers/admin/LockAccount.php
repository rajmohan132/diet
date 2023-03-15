<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\AppSettings;
use DB;


class LockAccount extends Controller
{
    public function lock()
    {

        $email = auth::user()->email;
        return view('auth.lock', compact('email'));
    }

    public function unlock(Request $request)
    {
        $user = auth::user();
        if (Hash::check($request['password'], $user->password)) {
            //dd('aaa');
            DB::table('configs')
                ->where('key', 'lastActivityTime')
                ->update(array('value' => now()));
            DB::table('configs')
                ->where('key', 'lock_status')
                ->update(array('value' => '0'));
            return redirect('/');
        } else {
             //dd('aaa');
            return redirect()->back();
        }
    }

    public function lock_logout()
    {
        // dd("hg");
        DB::table('configs')
            ->where('key', 'lastActivityTime')
            ->update(array('value' => now()));
        DB::table('configs')
            ->where('key', 'lock_status')
            ->update(array('value' => '0'));
        return redirect()->route('logout');
    }

    public function lock_site(Request $request)
    {
        $lock_time = AppSettings::value('lock_time')+1;
        $lock_time = now()->addMinutes($lock_time);
        DB::table('configs')
            ->where('key', 'lastActivityTime')
            ->update(array('value' => $lock_time));
        DB::table('configs')
            ->where('key', 'lock_status')
            ->update(array('value' => '1'));
        return redirect()->route('dashboard');
    }

    public function purchase_key(Request $request){
        return view('auth.purchase_key');
    }

    public function purchase_key_store(Request $request)
    {
        $app_settings = AppSettings::first();
        $app_settings->purchase_key    = $request->purchase_key;
        $app_settings->save();

        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "PURCHASE_KEY" . '=' . env("PURCHASE_KEY"),
                "PURCHASE_KEY" . '=' . $request->purchase_key,
                file_get_contents($path)
            ));
        }

        return redirect()->route('dashboard');
    }
}
