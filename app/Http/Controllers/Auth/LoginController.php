<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\AppSettings;
use App\Models\CompanySettings;
use App\Models\BusinessSettings;
use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Artisan;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        
        $app_settings = AppSettings::count();
        $login_image = CompanySettings::value('login_image');
        if ($app_settings == '') {
            return redirect()->to('step1');
        } else {
            DB::table('configs')
                ->where('key', 'lastActivityTime')
                ->update(array('value' => now()));
            DB::table('configs')
                ->where('key', 'lock_status')
                ->update(array('value' => '0'));
            return view('auth.login');
        }
       
    }
}
