<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\SiteMasterFile;
use App\Models\BuildMasterFile;
use App\Models\Site;
use Illuminate\Http\Request;

class LayerController extends Controller
{

    //all listing
    public function all_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->orderBy('id','DESC')->with('planning_record','build_record')->paginate(50);
        $view =  view('admin/service-delivery-status/layer/all-list', compact('all_records'));
        return $view;
    }
    // single layer form
    public function single_layer_form($id){   
        $region = Auth::user()->regions;
        $is_login_region = explode(",",$region);
        $record  =  SiteMasterFile::whereIn('region',$is_login_region)->where('circuit_id', $id)->with('planning_record','build_record','attachment_record')->get()->toArray();
        $all_site_a_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_a')->Where('module_type','sale')->orderBy('id', 'DESC')->get();
        $all_site_b_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_b')->Where('module_type','sale')->orderBy('id', 'DESC')->get();
        $view =  view('admin/service-delivery-status/layer/single-layer',compact('record','all_site_a_lists','all_site_b_lists'));
        return $view;
   }

   
    //function for submit layer
    public function submit_layer(Request $request , $circuit_id){
        $layer_status = $request['layer_status'];
        $TOC_Part_1_Receive_from_Implementation = $request['TOC_Part_1_Receive_from_Implementation'];
        $configuration_done = $request['configuration_done'];
        $TOC_part_2_released = $request['TOC_part_2_released'];
        $termination_request_received = $request['termination_request_received'];
        $configuration_received = $request['configuration_received'];
        $layer_comment = $request['layer_comment'];
        $site_a = $request['site_a'];
        $site_b = $request['site_b'];

        //update_query
        $update_master_file_record = SiteMasterFile::Where('circuit_id', $circuit_id)->update([
            'termination_request_received' => $termination_request_received,
            'configuration_received' => $configuration_received,
            'layer_comment' => $layer_comment,
            'site_b' => $site_b,
            'site_a' => $site_a,
        ]);
        
        if($update_master_file_record){
        $update_build_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
            "layer_status" => $layer_status,
            "TOC_Part_1_Receive_from_Implementation" => $TOC_Part_1_Receive_from_Implementation,
            "configuration_done" => $configuration_done,
            "TOC_part_2_released" => $TOC_part_2_released,
        ]); 
        
        if($update_build_file_record){
            return back()->with('success','Record Updated Successfully');	
            } else {
                return back()->with('unsuccess','Opps Something wrong!');	
            }
        } else {                  
        return back()->with('unsuccess','Opps Something wrong!');    
        }
    }

    //finction for serach
    public function search_layer_records(Request $request){
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->whereNoTIn('project_status',['V) Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->orderBy('id','DESC')->with('planning_record','build_record')->paginate(50);
        $view =  view('admin/service-delivery-status/layer/all-list', compact('all_records'));
        return $view;
     }
}
