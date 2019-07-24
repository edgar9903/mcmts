<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Usergroup;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $usergroup = Usergroup::where('usergroup','admin')->first();

        if (Session::get('userData') && Session::get('userData')->usergroup == $usergroup->id) {
            return $next($request);
        }

        return redirect('/');
    }
}
