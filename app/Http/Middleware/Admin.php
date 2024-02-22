<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\WebsiteStatus;

class Admin
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user->user_type == "Super_Admin" || $user->user_type == "Admin"){
            //Website Status
            $website_status = WebsiteStatus::where('id', 1)->first();
            if($user->user_type == "Admin" AND $website_status->site_status == "Down") {
                return redirect('comming-soon');
            }
            return $next($request);
        } else {
             return redirect('/home');
        } 
        //return $next($request);
    }
}
