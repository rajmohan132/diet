<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Config;
use App\Models\User;
use App\Models\AppSettings;
use DB;
use Illuminate\Routing\Route;
use Illuminate\Contracts\Auth\Guard;


class SessionTimeout
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $status = false;
        $url = request()->segment(count(request()->segments()));
        if ($url == 'login' || $url == 'register' || $url == 'step3' || $url == 'db_migrate') {
            $status = true;
        }

        if (!$status) {
            if (now()->diffInMinutes(Config::where('key', 'lastActivityTime')->value('value')) >= AppSettings::value('lock_time')) {
                DB::table('configs')
                    ->where('key', 'lock_status')
                    ->update(array('value' => '1'));
                return $next($request);
            }
            DB::table('configs')
                ->where('key', 'lastActivityTime')
                ->update(array('value' => now()));
            DB::table('configs')
                ->where('key', 'lock_status')
                ->update(array('value' => '0'));
            return $next($request);
        } else {
            return $next($request);
        }
    }
}
