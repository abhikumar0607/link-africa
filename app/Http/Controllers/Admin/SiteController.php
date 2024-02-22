<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Site;
use App\Models\Lapop;

class SiteController extends Controller
{
    //Function for show index view file
    public function index(){
        $site_a_records  =  Site::orderBy('site_name', 'ASC')->where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::orderBy('site_name', 'ASC')->where('site_type', 'site_b')->get()->toArray(); 
        $la_pops  =  Lapop::get()->toArray();
        $view =  view('admin/site/add-new',compact('site_a_records','site_b_records','la_pops'));
        return $view;
    }
    
    //function for submit new record
    public function submit_site(Request $request){
		//validation rule
        request()->validate([
            'site_name' => 'required', 'string', 'max:255',
        ]);
        $site_name = $request['site_name'];
        $contact_name = $request['contact_name'];
        $physical_address = $request['physical_address'];
        $gps_co_ordinates = $request['gps_co_ordinates'];
        $gps_co_ordinates2 = $request['gps_co_ordinates2'];
        $work_number = $request['work_number'];
        $mobile_number = $request['mobile_number'];
        $email_address = $request['email_address'];
        $landlord_name = $request['landlord_name'];
        $managing_agent = $request['managing_agent'];
        $landlord_contact_number = $request['landlord_contact_number'];

        //Check if site already exits
        $isSiteExits = Site::where('site_name', $site_name)->where('site_type', 'site_a')->count();
        if($isSiteExits >= 1){
            return back()->with('site_a_unsuccess','Site Name is already exits! Please try again');
        } else {
            //Insert query
            $is_insert =  Site::create([
                'site_name' => $site_name,
                'contact_name' => $contact_name,
                'physical_address' => $physical_address,
                'gps_co_ordinates' => $gps_co_ordinates,
                'gps_co_ordinates2' => $gps_co_ordinates2,
                'work_number' => $work_number,
                'mobile_number' => $mobile_number,
                'email_address' => $email_address,
                'landlord_name' => $landlord_name,
                'managing_agent' => $managing_agent,
                'landlord_contact_number' => $landlord_contact_number,
                'site_type' => 'site_a',
                'module_type' => 'sale',
            
            ]);
            //Check if data is inserted or not
            if($is_insert){
                return back()->with('site_a_success','Site A Added Successfully');
            } else {
                return back()->with('site_a_unsuccess','Opps Something wrong!');
            }
        }
    }

    //function for submit new record
    public function submit_site_b(Request $request){
		//validation rule
        request()->validate([
            'b_site_name' => 'required', 'string', 'max:255',
        ]);
        $site_name = $request['b_site_name'];
        $contact_name = $request['b_contact_name'];
        $physical_address = $request['b_physical_address'];
        $gps_co_ordinates = $request['b_gps_co_ordinates'];
        $gps_co_ordinates2 = $request['b_gps_co_ordinates2'];
        $work_number = $request['b_work_number'];
        $mobile_number = $request['b_mobile_number'];
        $email_address = $request['b_email_address'];
        $landlord_name = $request['b_landlord_name'];
        $managing_agent = $request['b_managing_agent'];
        $landlord_contact_number = $request['b_landlord_contact_number'];
        
        //Check if site already exits
        $isSiteExits = Site::where('site_name', $site_name)->where('site_type', 'site_b')->count();
        if($isSiteExits >= 1){
            return back()->with('unsuccess','Site Name is already exits! Please try again');
        } else {
        
            //Insert query
            $is_insert =  Site::create([
                'site_name' => $site_name,
                'contact_name' => $contact_name,
                'physical_address' => $physical_address,
                'gps_co_ordinates' => $gps_co_ordinates,
                'gps_co_ordinates2' => $gps_co_ordinates2,
                'work_number' => $work_number,
                'mobile_number' => $mobile_number,
                'email_address' => $email_address,
                'landlord_name' => $landlord_name,
                'managing_agent' => $managing_agent,
                'landlord_contact_number' => $landlord_contact_number,
                'site_type' => 'site_b',
                'module_type' => 'sale',

            
            ]);
            //Check if data is inserted or not
            if($is_insert){
                return back()->with('success','Site B Added Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            }
        }

    }

    //Function for show site address list site a
    public function address_list_a(Request $request){
        //Get Request
        $site_name = $request->site_name;  
        $address_list = Site::where('site_name', $site_name)->Where('site_type','site_a')->Where('module_type','sale')->get()->ToArray();
        
        //check if result is exit or not
        $json_address_list = null;
        if(count($address_list) >= 1){
            $json_address_list = json_encode($address_list[0]);
        }
        echo $json_address_list;
    }
    
    //Function for show site address list site b
    public function address_list_b(Request $request){
        //Get Request
        $site_name = $request->site_name;  
        $address_list = Site::where('site_name', $site_name)->Where('site_type','site_b')->Where('module_type','sale')->get()->ToArray();
        
        //check if result is exit or not
        $json_address_list = null;
        if(count($address_list) >= 1){
            $json_address_list = json_encode($address_list[0]);
        }
        echo $json_address_list;
    }

    //function for show address list site a
    public function view_site_edit($id){
        $site_a_name  =  Site::orderBy('site_name', 'ASC')->where('site_type', 'site_a')->get()->toArray();
        $site_b_name  =  Site::orderBy('site_name', 'ASC')->where('site_type', 'site_b')->get()->toArray();
        $site_a_records  =  Site::orderBy('site_name', 'ASC')->where('id',$id)->where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::orderBy('site_name', 'ASC')->where('id',$id)->where('site_type', 'site_b')->get()->toArray(); 
        $view =  view('admin/site/edit-site',compact('site_a_records','site_b_records','site_a_name','site_b_name'));
        return $view;
    }

    //FUNCTION FOR LISTING SITE RECORDS
    public function all_site_listing(){
        $site_a_records  =  Site::orderBy('site_name', 'ASC')->where('site_type', 'site_a')->get();
        $site_b_records  =  Site::orderBy('site_name', 'ASC')->where('site_type', 'site_b')->get(); 
        $view =  view('admin/site/all-site-list',compact('site_a_records','site_b_records'));
        return $view;

    }
    //function for update site a
    public function update_site_a(Request $request){

        $id = $request['site_a_id'];
        $site_name = $request['site_name'];
        $contact_name = $request['contact_name'];
        $physical_address = $request['physical_address'];
        $gps_co_ordinates = $request['gps_co_ordinates'];
        $gps_co_ordinates2 = $request['gps_co_ordinates2'];
        $work_number = $request['work_number'];
        $mobile_number = $request['mobile_number'];
        $email_address = $request['email_address'];
        $landlord_name = $request['landlord_name'];
        $managing_agent = $request['managing_agent'];
        $landlord_contact_number = $request['landlord_contact_number'];

            //Insert query
            $is_insert =  Site::where('id',$id)->update([
                'site_name' => $site_name,
                'contact_name' => $contact_name,
                'physical_address' => $physical_address,
                'gps_co_ordinates' => $gps_co_ordinates,
                'gps_co_ordinates2' => $gps_co_ordinates2,
                'work_number' => $work_number,
                'mobile_number' => $mobile_number,
                'email_address' => $email_address,
                'landlord_name' => $landlord_name,
                'managing_agent' => $managing_agent,
                'landlord_contact_number' => $landlord_contact_number,            
            ]);
            //Check if data is inserted or not
            if($is_insert){
                return redirect()->route('site.edit.page',$id)->with('site_a_success','Site A Updated Successfully');
            } else {
                return back()->with('site_a_unsuccess','Opps Something wrong!');
            }
        }
    //function for submit new record
    public function update_site_b(Request $request){

        $id = $request['b_site_id'];
        $site_name = $request['b_site_name'];
        $contact_name = $request['b_contact_name'];
        $physical_address = $request['b_physical_address'];
        $gps_co_ordinates = $request['b_gps_co_ordinates'];
        $gps_co_ordinates2 = $request['b_gps_co_ordinates2'];
        $work_number = $request['b_work_number'];
        $mobile_number = $request['b_mobile_number'];
        $email_address = $request['b_email_address'];
        $landlord_name = $request['b_landlord_name'];
        $managing_agent = $request['b_managing_agent'];
        $landlord_contact_number = $request['b_landlord_contact_number'];
        
        
            //Insert query
            $is_insert =  Site::where('id',$id)->update([
                'site_name' => $site_name,
                'contact_name' => $contact_name,
                'physical_address' => $physical_address,
                'gps_co_ordinates' => $gps_co_ordinates,
                'gps_co_ordinates2' => $gps_co_ordinates2,
                'work_number' => $work_number,
                'mobile_number' => $mobile_number,
                'email_address' => $email_address,
                'landlord_name' => $landlord_name,
                'managing_agent' => $managing_agent,
                'landlord_contact_number' => $landlord_contact_number,
            ]);
            //Check if data is inserted or not
            if($is_insert){
                return redirect()->route('site.edit.page',$id)->with('success','Site B Updated Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            }
        }

    }
