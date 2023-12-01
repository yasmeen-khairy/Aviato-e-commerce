<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\user_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class haveOrders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
        $orders = user_product::where('user_id' , $user->id)->first();
        if($orders)
        {
            return $next($request);
        }
        return redirect('/index');
        
        
        
    }
}
