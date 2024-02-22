<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\SiteMasterFile;
use App\Models\ServiceType;
use App\Models\Customer;
use App\Models\DepartmentComment;
use Helper;



class CommentFormController extends Controller
{
    //Function for show department view file
    public function department_Comments(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->orderBy('id','DESC')->with('department_comment','planning_record','permission_record','build_record')->paginate(50);
      // echo "<pre>";  print_r($all_records); echo "</pre>";exit;
        $view =  view('admin/departments-comments/all-list', compact('all_records'));
        return $view;
    }
    //Function for show single record view file
    public function single_record($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record = SiteMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('department_comment','planning_record','permission_record','build_record')->get()->toArray(); 
        //echo "<pre>";  print_r($record); echo "</pre>";exit;
        $view =  view('admin/departments-comments/single-record', compact('record'));
        return $view;
    }
    
     //function for submit new record
    public function submit_new_record(Request $request){
         
		  //echo "<pre>";  print_r($request['planning_comment']); echo "</pre>";exit;
        $create_update_department_comment = DepartmentComment::UpdateOrCreate(
            [
                'service_id' => $request['service_id'],    
                'circuit_id' => $request['circuit_id']
            ],
            [
                'service_id' => $request['service_id'],    
                'circuit_id' => $request['circuit_id'],
                'planning_comment' => $request['planning_comment'],
                'build_comment' => $request['build_comment'],
                'permission_comment' => $request['permission_comment'],
                'service_delivery_comment' => $request['service_delivery_comment']
           ]);
		    //echo "<pre>";  print_r($create_update_department_comment); echo "</pre>";exit;
                     //Check if data is updated or not
        if($create_update_department_comment){
            //Call Manage History Helper
            $module_type = "Department Comment";
            $page_name = url()->previous();
            Helper::submit_history_helper($request,$module_type,$page_name);
            return back()->with('success','Comment form Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
      }
}