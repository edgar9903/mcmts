<?php

namespace App\Http\Middleware;

use App\Usergroup;
use Closure;
use Session;

class IsUser
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
        $usergroup = Usergroup::where('usergroup','user')->first();
        if (Session::get('userData') && Session::get('userData')->usergroup ==$usergroup->id) {
            return $next($request);
        }

        return redirect('/');
    }
}
