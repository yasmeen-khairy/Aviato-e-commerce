<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\signupRequest;
use App\Models\category;
use App\Models\product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Closure;


use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (Auth::user() &&  Auth::user()->role != 'admin') {
            return redirect('/index');
     }

     return $next($request);
    }
}
