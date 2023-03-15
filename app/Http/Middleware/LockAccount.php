<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Closure;
use App\Models\Config;


class LockAccount {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if(Config::where('key', 'lock_status')->value('value') == 1){
            //dd(1);
            return redirect()->route('lock');
        }else{
            return $next($request);
        }
       
    }

}