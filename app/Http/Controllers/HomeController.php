<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WebsiteStatus;

class HomeController extends Controller
{
    public function __construct()
    {
        config(['app.timezone' => 'SAST']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Check user type
        if(Auth::user()->user_type == 'Super_Admin' || Auth::user()->user_type == "Admin"){
            //Website Status
            $website_status = WebsiteStatus::where('id', 1)->first();
            if(Auth::user()->user_type == "Admin" AND $website_status->site_status == "Down") {
                return redirect('comming-soon');
            } else {
                return redirect('admin/sale/dashboard'); 
            }
        } elseif(Auth::user()->user_type == "Customer"){
            return redirect('/admin/customer/detail'); 
        } else {
            return view('home');
        }
    }
}
