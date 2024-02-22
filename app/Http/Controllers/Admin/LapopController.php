<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lapop;
use App\Models\Site;
use Carbon\Carbon;

class LapopController extends Controller
{
    //function for view page
    public function index(){
     return view('admin/planning-master-files/la-pop/add-new');
    }
    
    //function for submit new record
    public function submit_new_record(Request $request){
		//validation rule
        request()->validate([
            'pop_id' => 'required', 'string', 'max:255',
        ]);
        $pop_id = $request['pop_id'];
        $area = $request['area'];
        $pop_type = $request['pop_type'];
        $isp_plan_date = null;
        if($request['isp_plan_date']){
            $isp_plan_date = Carbon::parse($request['isp_plan_date']);
        }
        $area_name = $request['area_name'];
        $sumission_permission = null;
        if($request['sumission_permission']){
            $sumission_permission = Carbon::parse($request['sumission_permission']);
        }
         $date_approved_from_permission = null;
        if($request['date_approved_from_permission']){
            $date_approved_from_permission = Carbon::parse($request['date_approved_from_permission']);
        }
        $pop_name = $request['pop_name'];
        $boq_release_date = null;
        if($request['boq_release_date']){
            $boq_release_date = Carbon::parse($request['boq_release_date']);
        }
        $pop_address = $request['pop_address'];
        $comments  = $request['comments'];
        $lat = $request['lat'];
        $pop_status = $request['pop_status'];
        $long = $request['long'];
        $land_lord_name = $request['land_lord_name'];
        $planning_progress_status = $request['planning_progress_status'];
        $land_lord_contact = $request['land_lord_contact'];
        $isp_capacity_planner = $request['isp_capacity_planner'];
         $survey_date = null;
        if($request['survey_date']){
            $survey_date = Carbon::parse($request['survey_date']);
        }
        
        //check pop id is exist or not
        $user = Lapop::where('pop_id', '=', $pop_id)->first();
        if($user){
        return back()->with('unsuccess','pop id is already existed!');
        }else {
        $insert_la_pop_file_record =  Lapop::create([
            'pop_id' => $pop_id,
            'area' => $area,
            'isp_plan_date' => $isp_plan_date,
            'area_name' => $area_name,
            'sumission_permission' => $sumission_permission,
            'pop_type' => $pop_type,
            'date_approved_from_permission' => $date_approved_from_permission,
            'pop_name' => $pop_name,
            'boq_release_date' => $boq_release_date,
            'pop_address' => $pop_address,
            'comments' => $comments,
            'lat' => $lat,
            'pop_status' => $pop_status,
            'long' => $long,
            'land_lord_name' => $land_lord_name,
            'planning_progress_status' => $planning_progress_status,
            'land_lord_contact' => $land_lord_contact,
            'isp_capacity_planner' => $isp_capacity_planner,
            'survey_date' => $survey_date,
            ]);
            
            if($insert_la_pop_file_record){
                      return back()->with('success','la pop Added Successfully');
            } else {
            return back()->with('unsuccess','Opps Something wrong!');
            }
    }
    }
    
    //Function for show all la_pop list
    public function show_all_list(){
        $all_records  = Site::orderBy('site_name', 'ASC')->where('site_type', 'site_a')->paginate(50);
        //echo "<pre>"; print_r($all_records); echo "</pre>";exit;
         return view('admin/planning-master-files/la-pop/all-list',compact('all_records'));
    }
    
    //Function for show all la_pop list
    public function single_record($pop_id){
        $all_records  = Lapop::where('pop_id',$pop_id)->get()->toArray();
        //echo "<pre>"; print_r($all_records); echo "</pre>";exit;
        return view('admin/planning-master-files/la-pop/single-record',compact('all_records'));
    }
    
    //function for update record
    public function update_record(Request $request, $pop_id){
         //echo "<pre>"; print_r($pop_id); echo "</pre>";exit;
        //get data
        $area = $request['area'];
        $pop_type = $request['pop_type'];
        $isp_plan_date = null;
        if($request['isp_plan_date']){
            $isp_plan_date = Carbon::parse($request['isp_plan_date']);
        }
        $area_name = $request['area_name'];
        $sumission_permission = null;
        if($request['sumission_permission']){
            $sumission_permission = Carbon::parse($request['sumission_permission']);
        }
         $date_approved_from_permission = null;
        if($request['date_approved_from_permission']){
            $date_approved_from_permission = Carbon::parse($request['date_approved_from_permission']);
        }
        $pop_name = $request['pop_name'];
        $boq_release_date = null;
        if($request['boq_release_date']){
            $boq_release_date = Carbon::parse($request['boq_release_date']);
        }
        $pop_address = $request['pop_address'];
        $comments  = $request['comments'];
        $lat = $request['lat'];
        $pop_status = $request['pop_status'];
        $long = $request['long'];
        $land_lord_name = $request['land_lord_name'];
        $planning_progress_status = $request['planning_progress_status'];
        $land_lord_contact = $request['land_lord_contact'];
        $isp_capacity_planner = $request['isp_capacity_planner'];
         $survey_date = null;
        if($request['survey_date']){
            $survey_date = Carbon::parse($request['survey_date']);
        } 
        
        $update_record = Lapop::where('pop_id' , $pop_id)->update([
            'area' => $area,
            'isp_plan_date' => $isp_plan_date,
            'area_name' => $area_name,
            'sumission_permission' => $sumission_permission,
            'pop_type' => $pop_type,
            'date_approved_from_permission' => $date_approved_from_permission,
            'pop_name' => $pop_name,
            'boq_release_date' => $boq_release_date,
            'pop_address' => $pop_address,
            'comments' => $comments,
            'lat' => $lat,
            'pop_status' => $pop_status,
            'long' => $long,
            'land_lord_name' => $land_lord_name,
            'planning_progress_status' => $planning_progress_status,
            'land_lord_contact' => $land_lord_contact,
            'isp_capacity_planner' => $isp_capacity_planner,
            'survey_date' => $survey_date,
            ]);
            if($update_record){
                      return back()->with('success','la pop updated Successfully');
            } else {
            return back()->with('unsuccess','Opps Something wrong!');
            }
        
    }
}
