<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\WebsiteStatus;
use Carbon\Carbon;

class CommingSoonController extends Controller
{
    //Function for enable comming soon
    public function enable_comming_soon(){
        $user_id = Auth::id();

        //Update Query
        $isUpdated = WebsiteStatus::Where('id', 1)->update(['user_id' => $user_id, 'site_status' => 'Down']);

        //Check if update or not
        if($isUpdated){
            return back()->with('success','Website Is Under Maintenance Now');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //Function for disable comming soon
    public function disable_comming_soon(){
        $user_id = Auth::id();

        //Update Query
        $isUpdated = WebsiteStatus::Where('id', 1)->update(['user_id' => $user_id, 'site_status' => 'Up']);

        //Check if update or not
        if($isUpdated){
            return back()->with('success','Website Is Live Now');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
}
