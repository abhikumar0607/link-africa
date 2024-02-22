<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\PlanningMasterFile;
use App\Models\DepartmentComment;
use App\Models\SiteStatus;
use App\Models\AddPermissionStatus;
use App\Models\AddWayleavesStatus;
use App\Models\Resources;
use Carbon\Carbon;
use Helper;

class PermissionMasterFileController extends Controller
{
    //Function for show index view file
    public function index(){
        $all_records = PermissionMasterFile::orderBy('id', 'DESC')->paginate(50);
        $view =  view('admin/permission-master-files/all-list', compact('all_records'));
        return $view;
    }
    
    
    //Function for show single record view file
    public function single_record($id){
        $record  =  PermissionMasterFile::where('id', $id)->get()->toArray();
           $view =  view('admin/permission-master-files/single-record',compact('record'));
           return $view;
    }

    //function for search records
    public function search_records(Request $request){
        //Get Request
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $keyword = $request->get('keyword'); 
        $region = $request->get('region'); 
        if(!empty($request->get('keyword'))) {
            $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','planning_record')->paginate(50);
        }     
       if(!empty($request->get('region'))){
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','planning_record')->paginate(50);
       }
       if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','planning_record')->paginate(50);
       }

        $view =  view('admin/permission-master-files/search-list', compact('all_records'));
        return $view;
    }
	  //function for search records
    public function search_wayleaves_records(Request $request){
        //Get Request
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $keyword = $request->get('keyword');       
        $region = $request->get('region'); 
        if(!empty($request->get('keyword'))) {
            $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','planning_record')->paginate(50);
        }     
       if(!empty($request->get('region'))){
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','planning_record')->paginate(50);
       }
       if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','planning_record')->paginate(50);
       }
       $view =  view('admin/permission-master-files/search-wayleaves-status', compact('all_records'));
        return $view;
    }
		  //function for search records
    public function search_department_records(Request $request){
        //Get Request
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $keyword = $request->get('keyword');       
        $region = $request->get('region'); 
        if(!empty($request->get('keyword'))) {
            $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','planning_record')->paginate(50);
        }     
       if(!empty($request->get('region'))){
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','planning_record')->paginate(50);
       }
       if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','planning_record')->paginate(50);
       }
        $view =  view('admin/permission-master-files/search-department-comment', compact('all_records'));
        return $view;
    }
      
    //function for update new record
    public function update_new_record(Request $request, $id){
		//validation rule
        request()->validate([
            'service_id' => 'required', 'string', 'max:255',
        ]);
        
        $permissions_status = $request['permissions_status'];
        $site_a_lla_submitted = null;
        if($request['site_a_lla_submitted']){
        $site_a_lla_submitted = Carbon::parse($request['site_a_lla_submitted']);
        }
        $site_a_lla_estimated = null;
        if($request['site_a_lla_estimated']){
        $site_a_lla_estimated = Carbon::parse($request['site_a_lla_estimated']);
        }
        $site_a_lla_received = null;
        if($request['site_a_lla_received']){
            $site_a_lla_received = Carbon::parse($request['site_a_lla_received']);
        }
        $site_b_lla_submitted = null;
        if($request['site_a_lla_submitted']){
        $site_b_lla_submitted = Carbon::parse($request['site_b_lla_submitted']);
        }

        // $site_b_lla_submitted = null;
        // if($request['site_b_lla_submitted']){
        // $site_b_lla_submitted = Carbon::parse($request['site_b_lla_submitted']);
        // }
        $site_b_lla_estimated = null;
        if($request['site_b_lla_estimated']){
        $site_b_lla_estimated = Carbon::parse($request['site_b_lla_estimated']);
        }
        $site_b_lla_received = null;
        if($request['site_b_lla_received']){
        $site_b_lla_received = Carbon::parse($request['site_b_lla_received']);
        }
        $wayleaves_submitted = null;
        if($request['wayleaves_submitted']){
        $wayleaves_submitted = Carbon::parse($request['wayleaves_submitted']);
        }
        $wayleaves_estimated = null;
        if($request['wayleaves_estimated']){
        $wayleaves_estimated = Carbon::parse($request['wayleaves_estimated']);
        }
        $wayleaves_received = null;
        if($request['wayleaves_received']){
        $wayleaves_received = Carbon::parse($request['wayleaves_received']);
        }
        $wayleaves_status = $request['wayleaves_status'];
        $resource = $request['resource'];
        $wl_planned_submitted_date = null;
        if($request['wl_planned_submitted_date']){
        $wl_planned_submitted_date = Carbon::parse($request['wl_planned_submitted_date']);
        }
        $province = $request['province'];
        $isp_a_b_status = $request['isp_a_b_status'];
        $existing_wl_ref_no = $request['existing_wl_ref_no'];
        $exepected_wl_received_date = null;
        if($request['exepected_wl_received_date']){
        $exepected_wl_received_date = Carbon::parse($request['exepected_wl_received_date']);
        }
        $total_number_of_responses_oustanding = $request['total_number_of_responses_oustanding'];
        $final_wl_submission_date = null;
        if($request['final_wl_submission_date']){
        $final_wl_submission_date = Carbon::parse($request['final_wl_submission_date']);
        }
        $wl_expiry_date = null;
        if($request['wl_expiry_date']){
        $wl_expiry_date = Carbon::parse($request['wl_expiry_date']);
        }
        $wl_osp_status = $request['wl_osp_status'];
        $stormwater_rou_date_submitted = null;
        if($request['stormwater_rou_date_submitted']){
        $stormwater_rou_date_submitted = Carbon::parse($request['stormwater_rou_date_submitted']);
        }
        $stormwater_rou_date_received = null;
        if($request['stormwater_rou_date_received']){
        $stormwater_rou_date_received = Carbon::parse($request['stormwater_rou_date_received']);
        }
        $stormwater_rou_lead_time = $request['stormwater_rou_lead_time'];
        $sewer_rou_date_submitted = null;
        if($request['sewer_rou_date_submitted']){
        $sewer_rou_date_submitted = Carbon::parse($request['sewer_rou_date_submitted']);
        }
        $sewer_rou_date_received = null;
        if($request['sewer_rou_date_received']){
        $sewer_rou_date_received = Carbon::parse($request['sewer_rou_date_received']);
        }
        $date_po_order_rx = null;
        if($request['date_po_order_rx']){
        $date_po_order_rx = Carbon::parse($request['date_po_order_rx']);
        }
        $sewer_rou_lead_time = $request['sewer_rou_lead_time'];
        $telkom_date_submitted = null;
        if($request['telkom_date_submitted']){
        $telkom_date_submitted = Carbon::parse($request['telkom_date_submitted']);
        }
        $telkom_date_received = null;
        if($request['telkom_date_received']){
        $telkom_date_received = Carbon::parse($request['telkom_date_received']);
        }
        $telkom_lead_time = $request['telkom_lead_time'];
        $sasol_date_submitted = null;
        if($request['sasol_date_submitted']){
        $sasol_date_submitted = Carbon::parse($request['sasol_date_submitted']);
        }
        $sasol_date_received = null;
        if($request['sasol_date_received']){
        $sasol_date_received = Carbon::parse($request['sasol_date_received']);
        }
        $sasol_lead_time = $request['sasol_lead_time'];
        $transnet_date_submitted = null;
        if($request['transnet_date_submitted']){
        $transnet_date_submitted = Carbon::parse($request['transnet_date_submitted']);
        }
        $transnet_date_received = null;
        if($request['transnet_date_received']){
        $transnet_date_received = Carbon::parse($request['transnet_date_received']);
        }
        $transnet_lead_time = $request['transnet_lead_time'];
        $neotel_date_submitted = null;
        if($request['neotel_date_submitted']){
        $neotel_date_submitted = Carbon::parse($request['neotel_date_submitted']);
        }
        $neotel_date_received = null;
        if($request['neotel_date_received']){
        $neotel_date_received = Carbon::parse($request['neotel_date_received']);
        }
        $neotel_lead_time = $request['neotel_lead_time'];
        $dfa_date_submitted = null;
        if($request['dfa_date_submitted']){
        $dfa_date_submitted = Carbon::parse($request['dfa_date_submitted']);
        }
        $dfa_date_received = null;
        if($request['dfa_date_received']){
        $dfa_date_received = Carbon::parse($request['dfa_date_received']);
        }
        $dfa_lead_time = $request['dfa_lead_time'];
        $mtn_date_submitted = null;
        if($request['mtn_date_submitted']){
        $mtn_date_submitted = Carbon::parse($request['mtn_date_submitted']);
        }
        $mtn_date_received = null;
        if($request['mtn_date_received']){
        $mtn_date_received = Carbon::parse($request['mtn_date_received']);
        }
        $mtn_lead_time = $request['mtn_lead_time'];
        $sanral_date_submitted = null;
        if($request['sanral_date_submitted']){
        $sanral_date_submitted = Carbon::parse($request['sanral_date_submitted']);
        }
        $sanral_date_received = null;
        if($request['sanral_date_received']){
        $sanral_date_received = Carbon::parse($request['sanral_date_received']);
        }
        $sanral_lead_time = $request['sanral_lead_time'];
        $dept_of_transport_date_submitted = null;
        if($request['dept_of_transport_date_submitted']){
        $dept_of_transport_date_submitted = Carbon::parse($request['dept_of_transport_date_submitted']);
        }
        $dept_of_transport_date_received = null;
        if($request['dept_of_transport_date_received']){
        $dept_of_transport_date_received = Carbon::parse($request['dept_of_transport_date_received']);
        }
        $dept_of_transport_lead_time = $request['dept_of_transport_lead_time'];
        $water_sanitation_date_submitted = null;
        if($request['water_sanitation_date_submitted']){
        $water_sanitation_date_submitted = Carbon::parse($request['water_sanitation_date_submitted']);
        }
        $water_sanitation_date_received = null;
        if($request['water_sanitation_date_received']){
        $water_sanitation_date_received = Carbon::parse($request['water_sanitation_date_received']);
        }
        $water_sanitation_lead_time = $request['water_sanitation_lead_time'];
        $ethekwini_transport_date_submitted = null;
        if($request['ethekwini_transport_date_submitted']){
        $ethekwini_transport_date_submitted = Carbon::parse($request['ethekwini_transport_date_submitted']);
        }
        $ethekwini_transport_date_received = null;
        if($request['ethekwini_transport_date_received']){
        $ethekwini_transport_date_received = Carbon::parse($request['ethekwini_transport_date_received']);
        }
        $ethekwini_transport_lead_time = $request['ethekwini_transport_lead_time'];
        $roads_date_submitted = null;
        if($request['roads_date_submitted']){
        $roads_date_submitted = Carbon::parse($request['roads_date_submitted']);
        }
        $roads_date_received = null;
        if($request['roads_date_received']){
        $roads_date_received = Carbon::parse($request['roads_date_received']);
        }
        $roads_lead_time = $request['roads_lead_time'];
        $electricity_date_submitted = null;
        if($request['electricity_date_submitted']){
        $electricity_date_submitted = Carbon::parse($request['electricity_date_submitted']);
        }
        $electricity_date_received = null;
        if($request['electricity_date_received']){
        $electricity_date_received = Carbon::parse($request['electricity_date_received']);
        }
        $electricity_lead_time = $request['electricity_lead_time'];
        $coastal_stormwater_catchment_date_submitted = null;
        if($request['coastal_stormwater_catchment_date_submitted']){
        $coastal_stormwater_catchment_date_submitted = Carbon::parse($request['coastal_stormwater_catchment_date_submitted']);
        }
        $coastal_stormwater_catchment_date_received = null;
        if($request['coastal_stormwater_catchment_date_received']){
        $coastal_stormwater_catchment_date_received = Carbon::parse($request['coastal_stormwater_catchment_date_received']);
        }
        $coastal_stormwater_catchment_lead_time = $request['coastal_stormwater_catchment_lead_time'];
        $development_planning_date_submitted = null;
        if($request['development_planning_date_submitted']){
        $development_planning_date_submitted = Carbon::parse($request['development_planning_date_submitted']);
        }
        $development_planning_date_received = null;
        if($request['development_planning_date_received']){
        $development_planning_date_received = Carbon::parse($request['development_planning_date_received']);
        }
        $development_planning_lead_time = $request['development_planning_lead_time'];
        $traffic_signals_date_submitted = null;
        if($request['traffic_signals_date_submitted']){
        $traffic_signals_date_submitted = Carbon::parse($request['traffic_signals_date_submitted']);
        }
        $traffic_signals_date_received = null;
        if($request['traffic_signals_date_received']){
        $traffic_signals_date_received = Carbon::parse($request['traffic_signals_date_received']);
        }
        $traffic_signals_lead_time = $request['traffic_signals_lead_time'];
        $enviromental_management_date_submitted = null;
        if($request['enviromental_management_date_submitted']){
        $enviromental_management_date_submitted = Carbon::parse($request['enviromental_management_date_submitted']);
        }
        $enviromental_management_date_received = null;
        if($request['enviromental_management_date_received']){
        $enviromental_management_date_received = Carbon::parse($request['enviromental_management_date_received']);
        }
        $enviromental_management_lead_time = $request['enviromental_management_lead_time'];
        $transportation_planning_date_submitted = null;
        if($request['transportation_planning_date_submitted']){
        $transportation_planning_date_submitted = Carbon::parse($request['transportation_planning_date_submitted']);
        }
        $transportation_planning_date_received = null;
        if($request['transportation_planning_date_received']){
        $transportation_planning_date_received = Carbon::parse($request['transportation_planning_date_received']);
        }
        $transportation_planning_lead_time = $request['transportation_planning_lead_time'];
        $technical_services_date_submitted = null;
        if($request['technical_services_date_submitted']){
         $technical_services_date_submitted = Carbon::parse($request['technical_services_date_submitted']);
        }
         $technical_services_date_received = null;
        if($request['technical_services_date_received']){
         $technical_services_date_received = Carbon::parse($request['technical_services_date_received']);
        }
        $technical_services_lead_time = $request['technical_services_lead_time'];
        $sembcorp_siza_water_date_submitted = null;
        if($request['sembcorp_siza_water_date_submitted']){
          $sembcorp_siza_water_date_submitted = Carbon::parse($request['sembcorp_siza_water_date_submitted']);
        }
         $sembcorp_siza_water_date_received = null;
        if($request['sembcorp_siza_water_date_received']){
         $sembcorp_siza_water_date_received = Carbon::parse($request['sembcorp_siza_water_date_received']);
        }
        $sembcorp_siza_water_lead_time = $request['sembcorp_siza_water_lead_time'];
        $legal_services_date_submitted = null;
        if($request['legal_services_date_submitted']){
         $legal_services_date_submitted = Carbon::parse($request['legal_services_date_submitted']);
        }
         $legal_services_date_received = null;
        if($request['legal_services_date_received']){
         $legal_services_date_received = Carbon::parse($request['legal_services_date_received']);
        }
        $legal_services_lead_time = $request['legal_services_lead_time'];
         $eskom_date_submitted = null;
        if($request['eskom_date_submitted']){
         $eskom_date_submitted = Carbon::parse($request['eskom_date_submitted']);
        }
         $eskom_date_received = null;
        if($request['eskom_date_received']){
         $eskom_date_received = Carbon::parse($request['eskom_date_received']);
        }
        $eskom_lead_time = $request['eskom_lead_time'];
        $parks_date_submitted = null;
        if($request['parks_date_submitted']){
         $parks_date_submitted = Carbon::parse($request['parks_date_submitted']);
        }
        $parks_date_received = null;
        if($request['parks_date_received']){
         $parks_date_received = Carbon::parse($request['parks_date_received']);
        }
        $parks_date_received = null;
        if($request['parks_date_received']){
         $parks_date_received = Carbon::parse($request['parks_date_received']);
        }
        $parks_lead_time = $request['parks_lead_time'];
        $site_owner = $request['site_owner'];
        $external_la_wl_num = $request['external_la_wl_num'];
        $permissions_comments = $request['permissions_comments'];
        $mat = $request['mat'];
        $osp_status_permissions = $request['osp_status_permissions'];
        
        //update Query
        $update_master_file_record = PermissionMasterFile::Where('id', $id)->update([
                                'permissions_status' => $permissions_status,
                                'site_a_lla_submitted' => $site_a_lla_submitted,
                                'site_a_lla_estimated' => $site_a_lla_estimated,
                                'site_a_lla_received' => $site_a_lla_received,
                                'site_b_lla_submitted' => $site_b_lla_submitted,
                                'site_b_lla_estimated' => $site_b_lla_estimated,
                                'site_b_lla_received' => $site_b_lla_received,
                                'wayleaves_submitted' => $wayleaves_submitted,
                                'wayleaves_estimated' => $wayleaves_estimated,
                                'wayleaves_received' => $wayleaves_received,
                                'wayleaves_status' => $wayleaves_status,
                                'resource' => $resource,
                                'wl_planned_submitted_date' => $wl_planned_submitted_date,
                                'province' => $province,
                                'osp_status_permissions' => $osp_status_permissions,
                                'isp_a_b_status' => $isp_a_b_status,
                                'existing_wl_ref_no' => $existing_wl_ref_no,
                                'exepected_wl_received_date' => $exepected_wl_received_date,
                                'total_number_of_responses_oustanding' => $total_number_of_responses_oustanding,
                                'final_wl_submission_date' => $final_wl_submission_date,
                                'wl_expiry_date' => $wl_expiry_date,
                                'wl_osp_status' => $wl_osp_status,
                                'stormwater_rou_date_submitted' => $stormwater_rou_date_submitted,
                                'stormwater_rou_date_received' => $stormwater_rou_date_received,
                                'stormwater_rou_lead_time' => $stormwater_rou_lead_time,
                                'sewer_rou_date_submitted' => $sewer_rou_date_submitted,
                                'sewer_rou_date_received' => $sewer_rou_date_received,
                                'sewer_rou_lead_time' => $sewer_rou_lead_time,
                                'telkom_date_submitted' => $telkom_date_submitted,
                                'telkom_date_received' => $telkom_date_received,
                                'telkom_lead_time' => $telkom_lead_time,
                                'sasol_date_submitted' => $sasol_date_submitted,
                                'sasol_date_received' => $sasol_date_received,
                                'sasol_lead_time' => $sasol_lead_time,
                                'transnet_date_submitted' => $transnet_date_submitted,
                                'transnet_date_received' => $transnet_date_received,
                                'transnet_lead_time' => $transnet_lead_time,
                                'neotel_date_submitted' => $neotel_date_submitted,
                                'neotel_date_received' => $neotel_date_received,
                                'neotel_lead_time' => $neotel_lead_time,
                                'dfa_date_submitted' => $dfa_date_submitted,
                                'dfa_date_received' => $dfa_date_received,
                                'dfa_lead_time' => $dfa_lead_time,
                                'mtn_date_submitted' => $mtn_date_submitted,
                                'mtn_date_received' => $mtn_date_received,
                                'mtn_lead_time' => $mtn_lead_time,
                                'sanral_date_submitted' => $sanral_date_submitted,
                                'sanral_date_received' => $sanral_date_received,
                                'sanral_lead_time' => $sanral_lead_time,
                                'dept_of_transport_date_submitted' => $dept_of_transport_date_submitted,
                                'dept_of_transport_date_received' => $dept_of_transport_date_received,
                                'dept_of_transport_lead_time' => $dept_of_transport_lead_time,
                                'water_sanitation_date_submitted' => $water_sanitation_date_submitted,
                                'water_sanitation_date_received' => $water_sanitation_date_received,
                                'water_sanitation_lead_time' => $water_sanitation_lead_time,
                                'ethekwini_transport_date_submitted' => $ethekwini_transport_date_submitted,
                                'ethekwini_transport_date_received' => $ethekwini_transport_date_received,
                                'ethekwini_transport_lead_time' => $ethekwini_transport_lead_time,
                                'roads_date_submitted' => $roads_date_submitted,
                                'roads_date_received' => $roads_date_received,
                                'roads_lead_time' => $roads_lead_time,
                                'electricity_date_submitted' => $electricity_date_submitted,
                                'electricity_date_received' => $electricity_date_received,
                                'electricity_lead_time' => $electricity_lead_time,
                                'coastal_stormwater_catchment_date_submitted' => $coastal_stormwater_catchment_date_submitted,
                                'coastal_stormwater_catchment_date_received' => $coastal_stormwater_catchment_date_received,
                                'coastal_stormwater_catchment_lead_time' => $coastal_stormwater_catchment_lead_time,
                                'development_planning_date_submitted' => $development_planning_date_submitted,
                                'development_planning_date_received' => $development_planning_date_received,
                                'development_planning_lead_time' => $development_planning_lead_time,
                                'traffic_signals_date_submitted' => $traffic_signals_date_submitted,
                                'traffic_signals_date_received' => $traffic_signals_date_received,
                                'traffic_signals_lead_time' => $traffic_signals_lead_time,
                                'enviromental_management_date_submitted' => $enviromental_management_date_submitted,
                                'enviromental_management_date_received' => $enviromental_management_date_received,
                                'water_sanitation_date_submitted' => $water_sanitation_date_submitted,
                                'enviromental_management_lead_time' => $enviromental_management_lead_time,
                                'transportation_planning_date_submitted' => $transportation_planning_date_submitted,
                                'transportation_planning_date_received' => $transportation_planning_date_received,
                                'transportation_planning_lead_time' => $transportation_planning_lead_time,
                                'technical_services_date_submitted' => $technical_services_date_submitted,
                                'technical_services_date_received' => $technical_services_date_received,
                                'technical_services_lead_time' => $technical_services_lead_time,
                                'sembcorp_siza_water_date_submitted' => $sembcorp_siza_water_date_submitted,
                                'sembcorp_siza_water_date_received' => $sembcorp_siza_water_date_received,
                                'sembcorp_siza_water_lead_time' => $sembcorp_siza_water_lead_time,
                                'legal_services_date_submitted' => $legal_services_date_submitted,
                                'legal_services_date_received' => $legal_services_date_received,
                                'legal_services_lead_time' => $legal_services_lead_time,
                                'eskom_date_submitted' => $eskom_date_submitted,
                                'eskom_date_received' => $eskom_date_received,
                                'eskom_lead_time' => $eskom_lead_time,
                                'parks_date_submitted' => $parks_date_submitted,
                                'parks_date_received' => $parks_date_received,
                                'parks_lead_time' => $parks_lead_time,
                                'site_owner' => $site_owner,
                                'external_la_wl_num' => $external_la_wl_num,
                                'permissions_comments' => $permissions_comments,
                                'mat' => $mat,
                            ]);
        //Check if data is updated or not
        if($update_master_file_record){
            return back()->with('success','Record Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for permission status page
    public function permission_status_page(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->orderby('id','DESC')->with('site_master_record','planning_record')->paginate(50);   
        $view =  view('admin/permission-master-files/permission-status-page', compact('all_records'));
        return $view;
    }
    
    //function for permission project status page
    public function permission_project_page(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->orderby('id','DESC')->with('site_master_record','planning_record')->paginate(50);      
        $view =  view('admin/permission-master-files/project-status-page', compact('all_records'));
        return $view;
    }
    
    //function for site a page
    public function permission_site_a_page(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->orderby('id','DESC')->with('site_master_record','planning_record','build_record')->paginate(50);
         $view =  view('admin/permission-master-files/site-a-page', compact('all_records'));
        return $view;
    }
    
     //function for site b page
    public function permission_site_b_page(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->orderby('id','DESC')->with('site_master_record','planning_record','build_record')->paginate(50);
         $view =  view('admin/permission-master-files/site-b-page', compact('all_records'));
        return $view;
    }
    
       //function for wayleaves_status
    public function permission_wayleaves_status(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->orderby('id','DESC')->with('site_master_record','planning_record','build_record')->paginate(50);
         $view =  view('admin/permission-master-files/wayleaves-status-page', compact('all_records'));
        return $view;
    }
    
         //function for department_comments page
    public function permission_department_comments(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->orderby('id','DESC')->with('site_master_record','planning_record','build_record','department_comments')->paginate(50);
        $view =  view('admin/permission-master-files/department_comments', compact('all_records'));
        return $view;
    }
    
        //function for project comments page
    public function permission_project_comments(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PermissionMasterFile::whereIn('region',$is_login_region)->whereNoTIn('permissions_status',['G) Pending CTS'])->orderby('id','DESC')->with('site_master_record','planning_record','build_record','department_comments')->paginate(50);
        $view =  view('admin/permission-master-files/project-comments', compact('all_records'));
        return $view;
    }

         //function for permission status single page
         public function permission_status_single_record($id){
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $all_site_status = SiteStatus::orderBy('site_status')->get();
			$all_permission_status = AddPermissionStatus::orderBy('permission_status')->get();
			$all_wayleaves_status = AddWayleavesStatus::orderBy('wayleaves_status')->get();
			$all_resources = Resources::orderBy('resources')->get();
            $record = PermissionMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','planning_record','build_record','department_comments','landlord_record','attachment_record')->get()->toArray();
            $site_a_lla_submitted = $record[0]['site_a_lla_submitted'] ?? '';
            $site_a_lla_estimatedd = $record[0]['site_a_lla_estimated'] ?? '';
            $site_a_lla_received = $record[0]['site_a_lla_received'] ?? '';
            $site_b_lla_submitted = $record[0]['site_b_lla_submitted'] ?? '';
            $site_b_lla_received = $record[0]['site_b_lla_received'] ?? '';
            //call function for site_a_lla_estimated
            $site_a_lla_estimated = $this->calculate_site_a_lla_estimated($site_a_lla_submitted);
            //call function for site_b_lla_estimated
            $site_b_lla_estimated = $this->calculate_site_b_lla_estimated($site_b_lla_submitted);
            //call function for overdue a
            $overdue_dateB = $this->calculate_overdue_date_b($site_b_lla_submitted,$site_b_lla_received,$site_b_lla_estimated);
            $overdue_date = $this->calculate_overdue_date($site_a_lla_submitted,$site_a_lla_received,$site_a_lla_estimated);
             //call function for lla duration
            $lla_duration_date = $this->calculate_lla_duration_date($site_a_lla_submitted,$site_a_lla_received);
            $llb_duration_date = $this->calculate_llb_duration_date($site_b_lla_submitted,$site_b_lla_received);
            $view =  view('admin/permission-master-files/permission-status-single',compact('record','site_a_lla_estimated','site_b_lla_estimated','overdue_date','overdue_dateB','lla_duration_date','llb_duration_date','all_site_status','all_permission_status','all_wayleaves_status','all_resources'));
            return $view;
        }
        
         //function for permission site a single page
         public function permission_site_a_single_record($id){
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
			$all_site_status = SiteStatus::orderBy('site_status')->get();
			$all_permission_status = AddPermissionStatus::orderBy('permission_status')->get();
			$all_wayleaves_status = AddWayleavesStatus::orderBy('wayleaves_status')->get();
			$all_resources = Resources::orderBy('resources')->get();
            $record = PermissionMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','planning_record','build_record','department_comments','landlord_record')->get()->toArray();
            $site_a_lla_submitted = $record[0]['site_a_lla_submitted'] ?? '';
            $site_a_lla_estimatedd = $record[0]['site_a_lla_estimated'] ?? '';
            $site_a_lla_received = $record[0]['site_a_lla_received'] ?? '';
            $site_b_lla_submitted = $record[0]['site_b_lla_submitted'] ?? '';
            $site_b_lla_received = $record[0]['site_b_lla_received'] ?? '';
            //call function for site_a_lla_estimated
            $site_a_lla_estimated = $this->calculate_site_a_lla_estimated($site_a_lla_submitted);
            //call function for site_b_lla_estimated
            $site_b_lla_estimated = $this->calculate_site_b_lla_estimated($site_b_lla_submitted);
            //call function for overdue a
            $overdue_dateB = $this->calculate_overdue_date_b($site_b_lla_submitted,$site_b_lla_received,$site_b_lla_estimated);
            $overdue_date = $this->calculate_overdue_date($site_a_lla_submitted,$site_a_lla_received,$site_a_lla_estimated);
             //call function for lla duration
            $lla_duration_date = $this->calculate_lla_duration_date($site_a_lla_submitted,$site_a_lla_received);
            $llb_duration_date = $this->calculate_llb_duration_date($site_b_lla_submitted,$site_b_lla_received);
            $view =  view('admin/permission-master-files/permission-site-a-single',compact('record','site_a_lla_estimated','site_b_lla_estimated','overdue_date','overdue_dateB','lla_duration_date','llb_duration_date','all_site_status','all_permission_status','all_wayleaves_status','all_resources'));
            return $view;
        }
          //function for permission site b single page
          public function permission_site_b_single_record($id){
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
			$all_site_status = SiteStatus::orderBy('site_status')->get();
			$all_permission_status = AddPermissionStatus::orderBy('permission_status')->get();
			$all_wayleaves_status = AddWayleavesStatus::orderBy('wayleaves_status')->get();
			$all_resources = Resources::orderBy('resources')->get();
            $record = PermissionMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','planning_record','build_record','department_comments','landlord_record')->get()->toArray();
            $site_a_lla_submitted = $record[0]['site_a_lla_submitted'] ?? '';
            $site_a_lla_estimatedd = $record[0]['site_a_lla_estimated'] ?? '';
            $site_a_lla_received = $record[0]['site_a_lla_received'] ?? '';
            $site_b_lla_submitted = $record[0]['site_b_lla_submitted'] ?? '';
            $site_b_lla_received = $record[0]['site_b_lla_received'] ?? '';
            //call function for site_a_lla_estimated
            $site_a_lla_estimated = $this->calculate_site_a_lla_estimated($site_a_lla_submitted);
            //call function for site_b_lla_estimated
            $site_b_lla_estimated = $this->calculate_site_b_lla_estimated($site_b_lla_submitted);
            //call function for overdue a
            $overdue_dateB = $this->calculate_overdue_date_b($site_b_lla_submitted,$site_b_lla_received,$site_b_lla_estimated);
            $overdue_date = $this->calculate_overdue_date($site_a_lla_submitted,$site_a_lla_received,$site_a_lla_estimated);
             //call function for lla duration
            $lla_duration_date = $this->calculate_lla_duration_date($site_a_lla_submitted,$site_a_lla_received);
            $llb_duration_date = $this->calculate_llb_duration_date($site_b_lla_submitted,$site_b_lla_received);
            $view =  view('admin/permission-master-files/permission-site-b-single',compact('record','site_a_lla_estimated','site_b_lla_estimated','overdue_date','overdue_dateB','lla_duration_date','llb_duration_date','all_site_status','all_permission_status','all_wayleaves_status','all_resources'));
            return $view;
        }
           //unction for permission site b single page
    public function permission_wayleaves_status_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
		$all_resources = Resources::orderBy('resources')->get();
        $record = PermissionMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','planning_record','build_record','department_comments')->get()->toArray();
        // get data
        $planning_wp2_wl_submission = $record[0]['planning_record']['planning_wp2_wl_submission'] ?? '';
        $stormwater_rou_date_submitted = $record[0]['stormwater_rou_date_submitted'] ?? ''; 
        $stormwater_rou_lead_time = $record[0]['stormwater_rou_lead_time'] ?? ''; 

        $sewer_rou_date_submitted = $record[0]['sewer_rou_date_submitted'] ?? '';
        $sewer_rou_lead_time = $record[0]['sewer_rou_lead_time'] ?? '';

        $telkom_date_submitted = $record[0]['telkom_date_submitted'] ?? '';
        $telkom_lead_time = $record[0]['telkom_lead_time'] ?? '';

        $sasol_date_submitted = $record[0]['sasol_date_submitted'] ?? '';
        $sasol_lead_time = $record[0]['sasol_lead_time'] ?? '';

        $transnet_date_submitted = $record[0]['transnet_date_submitted'] ?? '';
        $transnet_lead_time = $record[0]['transnet_lead_time'] ?? '';

        $neotel_date_submitted = $record[0]['neotel_date_submitted'] ?? '';
        $neotel_lead_time = $record[0]['neotel_lead_time'] ?? '';

        $roads_date_submitted = $record[0]['roads_date_submitted'] ?? '';
        $roads_lead_time = $record[0]['roads_lead_time'] ?? '';

        $dfa_date_submitted = $record[0]['dfa_date_submitted'] ?? '';
        $dfa_lead_time = $record[0]['dfa_lead_time'] ?? '';

        $mtn_date_submitted = $record[0]['mtn_date_submitted'] ?? '';
        $mtn_lead_time = $record[0]['mtn_lead_time'] ?? '';

        $sanral_date_submitted = $record[0]['sanral_date_submitted'] ?? '';
        $sanral_lead_time = $record[0]['sanral_lead_time'] ?? '';

        $dept_of_transport_date_submitted = $record[0]['dept_of_transport_date_submitted'] ?? '';
        $dept_of_transport_lead_time = $record[0]['dept_of_transport_lead_time'] ?? '';

        $water_sanitation_date_submitted = $record[0]['water_sanitation_date_submitted'] ?? '';
        $water_sanitation_lead_time = $record[0]['water_sanitation_lead_time'] ?? '';
        
        $ethekwini_transport_date_submitted = $record[0]['ethekwini_transport_date_submitted'] ?? '';
        $ethekwini_transport_lead_time = $record[0]['ethekwini_transport_lead_time'] ?? '';

        $electricity_date_submitted = $record[0]['electricity_date_submitted'] ?? '';
        $electricity_lead_time = $record[0]['electricity_lead_time'] ?? '';
        
        $parks_date_submitted = $record[0]['parks_date_submitted'] ?? '';
        $parks_lead_time = $record[0]['parks_lead_time'] ?? '';

        $coastal_stormwater_catchment_date_submitted = $record[0]['coastal_stormwater_catchment_date_submitted'] ?? '';
        $coastal_stormwater_catchment_lead_time = $record[0]['coastal_stormwater_catchment_lead_time'] ?? '';

        $development_planning_date_submitted = $record[0]['development_planning_date_submitted'] ?? '';
        $development_planning_lead_time = $record[0]['development_planning_lead_time'] ?? '';

        $traffic_signals_date_submitted = $record[0]['traffic_signals_date_submitted'] ?? '';
        $traffic_signals_lead_time = $record[0]['traffic_signals_lead_time'] ?? '';

        $enviromental_management_date_submitted = $record[0]['enviromental_management_date_submitted'] ?? '';
        $enviromental_management_lead_time = $record[0]['enviromental_management_lead_time'] ?? '';

        $transportation_planning_date_submitted = $record[0]['transportation_planning_date_submitted'] ?? '';
        $transportation_planning_lead_time = $record[0]['transportation_planning_lead_time'] ?? '';
        
        $technical_services_date_submitted = $record[0]['technical_services_date_submitted'] ?? '';
        $technical_services_lead_time = $record[0]['technical_services_lead_time'] ?? '';
        
        $sembcorp_siza_water_date_submitted = $record[0]['sembcorp_siza_water_date_submitted'] ?? '';
        $sembcorp_siza_water_lead_time = $record[0]['sembcorp_siza_water_lead_time'] ?? '';
        
        $legal_services_date_submitted = $record[0]['legal_services_date_submitted'] ?? '';
        $legal_services_lead_time = $record[0]['legal_services_lead_time'] ?? '';
        
        $eskom_date_submitted = $record[0]['eskom_date_submitted'] ?? '';
        $eskom_lead_time = $record[0]['eskom_lead_time'] ?? '';

        //call the function
        $eskom_date_submitted = $this->calculate_eskom_date_submitted($eskom_date_submitted, $eskom_lead_time);

        $legal_services_date_submitted = $this->calculate_legal_services_date_submitted($legal_services_date_submitted, $legal_services_lead_time);

        $sembcorp_siza_water_date_submitted = $this->calculate_sembcorp_siza_water_date_submitted($sembcorp_siza_water_date_submitted, $sembcorp_siza_water_lead_time);

        $technical_services_date_submitted = $this->calculate_technical_services_date_submitted($technical_services_date_submitted, $technical_services_lead_time);

        $transportation_planning_date_submitted = $this->calculate_transportation_planning_date_submitted($transportation_planning_date_submitted, $transportation_planning_lead_time);

        $enviromental_management_date_submitted = $this->calculate_enviromental_management_date_submitted($enviromental_management_date_submitted, $enviromental_management_lead_time);

        $traffic_signals_date_submitted = $this->calculate_traffic_signals_date_submitted($traffic_signals_date_submitted, $traffic_signals_lead_time);
        $development_planning_date_submitted = $this->calculate_development_planning_date_submitted($development_planning_date_submitted, $development_planning_lead_time);
        $coastal_stormwater_catchment_date_submitted = $this->calculate_coastal_stormwater_catchment_date_submitted($coastal_stormwater_catchment_date_submitted, $coastal_stormwater_catchment_lead_time);
        $parks_date_submitted = $this->calculate_parks_date_submitted($parks_date_submitted, $parks_lead_time);
        $electricity_date_submitted = $this->calculate_electricity_date_submitted($electricity_date_submitted, $electricity_lead_time);
        $ethekwini_transport_date_submitted = $this->calculate_ethekwini_transport_date_submitted($ethekwini_transport_date_submitted, $ethekwini_transport_lead_time);
        $wayleaves_recived_date = $this->calculate_wayleaves_recived_date($planning_wp2_wl_submission);
        
        //call function
        $stormwater_rou_date_estimated = $this->calculate_stormwater_rou_date_submitted($stormwater_rou_date_submitted,$stormwater_rou_lead_time);
        $sewer_rou_date_estimate = $this->calculate_sewer_rou_date_submitted($sewer_rou_date_submitted,$sewer_rou_lead_time);
        $telkom_date_estimate = $this->calculate_telkom_date_submitted($telkom_date_submitted,$telkom_lead_time);
        $sasol_date_estimate = $this->calculate_sasol_date_submitted($sasol_date_submitted,$sasol_lead_time);
        $transnet_date_estimate = $this->calculate_transnet_date_submitted($transnet_date_submitted,$transnet_lead_time);
        $neotel_date_estimate = $this->calculate_neotel_date_submitted($neotel_date_submitted,$neotel_lead_time);
        $roads_date_estimate = $this->calculate_roads_date_submitted($roads_date_submitted,$roads_lead_time);
        $dfa_date_estimate = $this->calculate_dfa_date_submitted($dfa_date_submitted,$dfa_lead_time);
        $mtn_date_estimate = $this->calculate_mtn_date_submitted($mtn_date_submitted,$mtn_lead_time);
        $sanral_date_estimate = $this->calculate_sanral_date_submitted($sanral_date_submitted,$sanral_lead_time);
        $dept_of_transport_estimate = $this->calculate_dept_of_transport_date_submitted($dept_of_transport_date_submitted,$dept_of_transport_lead_time);
        $water_sanitation_date_estimate = $this->calculate_water_sanitation_date_submitted($water_sanitation_date_submitted,$water_sanitation_lead_time);
        $total_number_of_responses_oustanding = $this->calculate_total_number_of_responses_oustanding($record);

        $view =  view('admin/permission-master-files/permission-wayleaves-status-single',compact('record','wayleaves_recived_date','stormwater_rou_date_estimated','sewer_rou_date_estimate','telkom_date_estimate','sasol_date_estimate','transnet_date_estimate','neotel_date_estimate','roads_date_estimate','dfa_date_estimate','mtn_date_estimate','sanral_date_estimate','dept_of_transport_estimate','water_sanitation_date_estimate','ethekwini_transport_date_submitted','electricity_date_submitted','parks_date_submitted','coastal_stormwater_catchment_date_submitted','development_planning_date_submitted','traffic_signals_date_submitted','enviromental_management_date_submitted','transportation_planning_date_submitted','technical_services_date_submitted','sembcorp_siza_water_date_submitted','legal_services_date_submitted','eskom_date_submitted','total_number_of_responses_oustanding','all_resources'));
        return $view;
    }
        //unction for permission site b single page
        public function permission_department_comment_single($id){
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $record = PermissionMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','planning_record','build_record','department_comments')->get()->toArray();
            $view =  view('admin/permission-master-files/permission-department-comment-single',compact('record'));
            return $view;
        }
    
         //function for update wayleaves status
 public function update_wayleaves_single_permission(Request $request, $id){
      
     //echo "yes";exit;
    $wayleaves_received = null;
    if( $request['wayleaves_received']){
    $wayleaves_received = Carbon::parse($request['wayleaves_received']);
    }
    $wayleaves_submitted = null;
    if( $request['wayleaves_submitted']){
    $wayleaves_submitted = Carbon::parse($request['wayleaves_submitted']);
    } 
    $wl_expiry_date = null;
    if( $request['wl_expiry_date']){
    $wl_expiry_date = Carbon::parse($request['wl_expiry_date']);
    } 
    
    $sewer_rou_date_submitted = null;
    if( $request['sewer_rou_date_submitted']){
    $sewer_rou_date_submitted = Carbon::parse($request['sewer_rou_date_submitted']);
    } 
    
    $telkom_date_submitted = null;
    if( $request['telkom_date_submitted']){
    $telkom_date_submitted = Carbon::parse($request['telkom_date_submitted']);
    } 
    
    $sasol_date_submitted = null;
    if( $request['sasol_date_submitted']){
    $sasol_date_submitted = Carbon::parse($request['sasol_date_submitted']);
    } 
    
    $transnet_date_submitted = null;
    if( $request['transnet_date_submitted']){
    $transnet_date_submitted = Carbon::parse($request['transnet_date_submitted']);
    } 
    
    $neotel_date_submitted = null;
    if( $request['neotel_date_submitted']){
    $neotel_date_submitted = Carbon::parse($request['neotel_date_submitted']);
    } 
    
    $dfa_date_submitted = null;
    if( $request['dfa_date_submitted']){
    $dfa_date_submitted = Carbon::parse($request['dfa_date_submitted']);
    } 
    
    $mtn_date_submitted = null;
    if( $request['mtn_date_submitted']){
    $mtn_date_submitted = Carbon::parse($request['mtn_date_submitted']);
    } 
    
    $sanral_date_submitted = null;
    if( $request['sanral_date_submitted']){
    $sanral_date_submitted = Carbon::parse($request['sanral_date_submitted']);
    } 
    
    $dept_of_transport_date_submitted = null;
    if( $request['dept_of_transport_date_submitted']){
    $dept_of_transport_date_submitted = Carbon::parse($request['dept_of_transport_date_submitted']);
    } 
    
    $water_sanitation_date_submitted = null;
    if( $request['water_sanitation_date_submitted']){
    $water_sanitation_date_submitted = Carbon::parse($request['water_sanitation_date_submitted']);
    } 
    
    $stormwater_rou_date_submitted = null;
    if( $request['stormwater_rou_date_submitted']){
    $stormwater_rou_date_submitted = Carbon::parse($request['stormwater_rou_date_submitted']);
    } 
    
    $roads_date_submitted = null;
    if( $request['roads_date_submitted']){
    $roads_date_submitted = Carbon::parse($request['roads_date_submitted']);
    }
    
    $stormwater_rou_date_received = null;
    if( $request['stormwater_rou_date_received']){
    $stormwater_rou_date_received = Carbon::parse($request['stormwater_rou_date_received']);
    }
    
    $sewer_rou_date_received = null;
    if( $request['sewer_rou_date_received']){
    $sewer_rou_date_received = Carbon::parse($request['sewer_rou_date_received']);
    }
    
    $telkom_date_received = null;
    if( $request['telkom_date_received']){
    $telkom_date_received = Carbon::parse($request['telkom_date_received']);
    }
    
    $sasol_date_received = null;
    if( $request['sasol_date_received']){
    $sasol_date_received = Carbon::parse($request['sasol_date_received']);
    }
    
    $transnet_date_received = null;
    if( $request['transnet_date_received']){
    $transnet_date_received = Carbon::parse($request['transnet_date_received']);
    }
    
    $neotel_date_received = null;
    if( $request['neotel_date_received']){
    $neotel_date_received = Carbon::parse($request['neotel_date_received']);
    }
    
    $roads_date_received = null;
    if( $request['roads_date_received']){
    $roads_date_received = Carbon::parse($request['roads_date_received']);
    }
    
    $dfa_date_received = null;
    if( $request['dfa_date_received']){
    $dfa_date_received = Carbon::parse($request['dfa_date_received']);
    }
    
    $mtn_date_received = null;
    if( $request['mtn_date_received']){
    $mtn_date_received = Carbon::parse($request['mtn_date_received']);
    }
    
    $sanral_date_received = null;
    if( $request['sanral_date_received']){
    $sanral_date_received = Carbon::parse($request['sanral_date_received']);
    }
    
    $dept_of_transport_date_received = null;
    if( $request['dept_of_transport_date_received']){
    $dept_of_transport_date_received = Carbon::parse($request['dept_of_transport_date_received']);
    }
    
    $water_sanitation_date_received = null;
    if( $request['water_sanitation_date_received']){
    $water_sanitation_date_received = Carbon::parse($request['water_sanitation_date_received']);
    }
    
    $ethekwini_transport_date_submitted = null;
    if( $request['ethekwini_transport_date_submitted']){
    $ethekwini_transport_date_submitted = Carbon::parse($request['ethekwini_transport_date_submitted']);
    }
    $ethekwini_transport_date_received = null;
    if( $request['ethekwini_transport_date_received']){
    $ethekwini_transport_date_received = Carbon::parse($request['ethekwini_transport_date_received']);
    }
    $electricity_date_received = null;
    if( $request['electricity_date_received']){
    $electricity_date_received = Carbon::parse($request['electricity_date_received']);
    }
    $electricity_date_submitted = null;
    if( $request['electricity_date_submitted']){
    $electricity_date_submitted = Carbon::parse($request['electricity_date_submitted']);
    }
    $parks_date_submitted = null;
    if( $request['parks_date_submitted']){
    $parks_date_submitted = Carbon::parse($request['parks_date_submitted']);
    }
    
    $parks_date_submitted = null;
    if( $request['parks_date_submitted']){
    $parks_date_submitted = Carbon::parse($request['parks_date_submitted']);
    }
    $parks_date_received = null;
    if( $request['parks_date_received']){
    $parks_date_received = Carbon::parse($request['parks_date_received']);
    }
    $coastal_stormwater_catchment_date_submitted = null;
    if( $request['coastal_stormwater_catchment_date_submitted']){
    $coastal_stormwater_catchment_date_submitted = Carbon::parse($request['coastal_stormwater_catchment_date_submitted']);
    }
    $coastal_stormwater_catchment_date_submitted = null;
    if( $request['coastal_stormwater_catchment_date_submitted']){
    $coastal_stormwater_catchment_date_submitted = Carbon::parse($request['coastal_stormwater_catchment_date_submitted']);
    }
    $coastal_stormwater_catchment_date_received = null;
    if( $request['coastal_stormwater_catchment_date_received']){
    $coastal_stormwater_catchment_date_received = Carbon::parse($request['coastal_stormwater_catchment_date_received']);
    }
    $development_planning_date_submitted = null;
    if( $request['development_planning_date_submitted']){
    $development_planning_date_submitted = Carbon::parse($request['development_planning_date_submitted']);
    }
    $development_planning_date_received = null;
    if( $request['development_planning_date_received']){
    $development_planning_date_received = Carbon::parse($request['development_planning_date_received']);
    }
    $traffic_signals_date_submitted = null;
    if( $request['traffic_signals_date_submitted']){
    $traffic_signals_date_submitted = Carbon::parse($request['traffic_signals_date_submitted']);
    }
    $traffic_signals_date_received = null;
    if( $request['traffic_signals_date_received']){
    $traffic_signals_date_received = Carbon::parse($request['traffic_signals_date_submitted']);
    }
    $enviromental_management_date_submitted = null;
    if( $request['enviromental_management_date_submitted']){
    $enviromental_management_date_submitted = Carbon::parse($request['enviromental_management_date_submitted']);
    }
    $enviromental_management_date_received = null;
    if( $request['enviromental_management_date_received']){
    $enviromental_management_date_received = Carbon::parse($request['enviromental_management_date_received']);
    }
    $transportation_planning_date_submitted = null;
    if( $request['transportation_planning_date_submitted']){
    $transportation_planning_date_submitted = Carbon::parse($request['transportation_planning_date_submitted']);
    }
    $transportation_planning_date_received = null;
    if( $request['transportation_planning_date_received']){
    $transportation_planning_date_received = Carbon::parse($request['transportation_planning_date_received']);
    }
    $technical_services_date_submitted = null;
    if( $request['technical_services_date_submitted']){
    $technical_services_date_submitted = Carbon::parse($request['technical_services_date_submitted']);
    }
    $technical_services_date_received = null;
    if( $request['technical_services_date_received']){
    $technical_services_date_received = Carbon::parse($request['technical_services_date_received']);
    }
    $sembcorp_siza_water_date_submitted = null;
    if( $request['sembcorp_siza_water_date_submitted']){
    $sembcorp_siza_water_date_submitted = Carbon::parse($request['sembcorp_siza_water_date_submitted']);
    }
    $sembcorp_siza_water_date_received = null;
    if( $request['sembcorp_siza_water_date_received']){
    $sembcorp_siza_water_date_received = Carbon::parse($request['sembcorp_siza_water_date_received']);
    }
    $legal_services_date_submitted = null;
    if( $request['legal_services_date_submitted']){
    $legal_services_date_submitted = Carbon::parse($request['legal_services_date_submitted']);
    }
    $legal_services_date_received = null;
    if( $request['legal_services_date_received']){
    $legal_services_date_received = Carbon::parse($request['legal_services_date_received']);
    }
    $eskom_date_submitted = null;
    if( $request['eskom_date_submitted']){
    $eskom_date_submitted = Carbon::parse($request['eskom_date_submitted']);
    }
    $eskom_date_received = null;
    if( $request['eskom_date_received']){
    $eskom_date_received = Carbon::parse($request['eskom_date_received']);
    }
    $circuit_id = $request['service_id'];
    
    $update_planning_master_file_record = PermissionMasterFile::Where('circuit_id', $id)->update([
                            'eskom_date_received' => $eskom_date_received,  
                            'eskom_lead_time' => $request['eskom_lead_time'],  
                            'eskom_date_submitted' => $eskom_date_submitted,  
                            'legal_services_date_received' => $legal_services_date_received,  
                            'legal_services_lead_time' => $request['legal_services_lead_time'],  
                            'legal_services_date_submitted' => $legal_services_date_submitted,  
                            'sembcorp_siza_water_date_received' => $sembcorp_siza_water_date_received,  
                            'sembcorp_siza_water_lead_time' => $request['sembcorp_siza_water_lead_time'],  
                            'sembcorp_siza_water_date_submitted' => $sembcorp_siza_water_date_submitted,  
                            'technical_services_lead_time' => $request['technical_services_lead_time'],
                            'technical_services_date_received' => $technical_services_date_received,  
                            'technical_services_date_submitted' => $technical_services_date_submitted,  
                            'transportation_planning_date_received' => $transportation_planning_date_received,  
                            'transportation_planning_lead_time' => $request['transportation_planning_lead_time'],
                            'transportation_planning_date_submitted' => $transportation_planning_date_submitted,
                            'enviromental_management_date_received' => $enviromental_management_date_received,   
                            'enviromental_management_lead_time' => $request['enviromental_management_lead_time'],
                            'enviromental_management_date_submitted' => $enviromental_management_date_submitted,   
                            'traffic_signals_date_received' => $traffic_signals_date_received,  
                            'traffic_signals_lead_time' => $request['traffic_signals_lead_time'],  
                            'traffic_signals_date_submitted' => $traffic_signals_date_submitted,  
                            'development_planning_date_received' => $development_planning_date_received,  
                            'development_planning_lead_time' => $request['development_planning_lead_time'],   
                            'development_planning_date_submitted' => $development_planning_date_submitted,   
                            'coastal_stormwater_catchment_date_received' => $coastal_stormwater_catchment_date_received, 
                            'coastal_stormwater_catchment_lead_time' => $request['coastal_stormwater_catchment_lead_time'],
                            'coastal_stormwater_catchment_date_submitted' => $coastal_stormwater_catchment_date_submitted,
                            'parks_date_submitted' => $parks_date_submitted,
                            'parks_lead_time' => $request['parks_lead_time'],
                            'parks_date_received' => $parks_date_received,
                            'electricity_date_submitted' => $electricity_date_submitted,
                            'electricity_lead_time' => $request['electricity_lead_time'],
                            'electricity_date_received' => $electricity_date_received,
                            'ethekwini_transport_date_received' => $ethekwini_transport_date_received,
                            'ethekwini_transport_lead_time' => $request['ethekwini_transport_lead_time'],
                            'ethekwini_transport_date_submitted' => $ethekwini_transport_date_submitted,
                            'sewer_rou_date_submitted' => $sewer_rou_date_submitted,
                            'stormwater_rou_date_submitted' => $stormwater_rou_date_submitted,
                            'telkom_date_submitted' => $telkom_date_submitted,
                            'sasol_date_submitted' => $sasol_date_submitted,
                            'transnet_date_submitted' => $transnet_date_submitted,
                            'neotel_date_submitted' => $neotel_date_submitted,
                            'roads_date_submitted' => $roads_date_submitted,
                            'dfa_date_submitted' => $dfa_date_submitted,
                            'mtn_date_submitted' => $mtn_date_submitted,
                            'sanral_date_submitted' => $sanral_date_submitted,
                            'dept_of_transport_date_submitted' => $dept_of_transport_date_submitted,
                            'water_sanitation_date_submitted' => $water_sanitation_date_submitted, 
                            'stormwater_rou_lead_time' => $request['stormwater_rou_lead_time'],
                            'sewer_rou_lead_time' => $request['sewer_rou_lead_time'],
                            'telkom_lead_time' => $request['telkom_lead_time'],
                            'sasol_lead_time' => $request['sasol_lead_time'],
                            'transnet_lead_time' => $request['transnet_lead_time'],
                            'neotel_lead_time' => $request['neotel_lead_time'],
                            'roads_lead_time' => $request['roads_lead_time'],
                            'dfa_lead_time' => $request['dfa_lead_time'],
                            'mtn_lead_time' => $request['mtn_lead_time'],
                            'sanral_lead_time' => $request['sanral_lead_time'],
                            'dept_of_transport_lead_time' => $request['dept_of_transport_lead_time'],
                            'water_sanitation_lead_time' => $request['water_sanitation_lead_time'],
                            'stormwater_rou_date_received' => $stormwater_rou_date_received,
                            'sewer_rou_date_received' => $sewer_rou_date_received,
                            'telkom_date_received' => $telkom_date_received,
                            'sasol_date_received' => $sasol_date_received,
                            'transnet_date_received' => $transnet_date_received,
                            'neotel_date_received' => $neotel_date_received,
                            'roads_date_received' => $roads_date_received,
                            'dfa_date_received' => $dfa_date_received,
                            'mtn_date_received' => $mtn_date_received,
                            'sanral_date_received' => $sanral_date_received,
                            'dept_of_transport_date_received' => $dept_of_transport_date_received,
                            'water_sanitation_date_received' => $water_sanitation_date_received,
                            'wayleaves_received' =>  $wayleaves_received, 
                            'wayleaves_submitted' =>  $wayleaves_submitted,
                            'wl_expiry_date' =>  $wl_expiry_date,
                            'existing_wl_ref_no' => $request['existing_wl_ref_no'],
                            'external_la_wl_num' => $request['external_la_wl_num'], 
                            'resource' => $request['resource'], 
                        ]);

                        if($update_planning_master_file_record){
                             //Call Manage History Helper 
                             $fieldsStr = '';
                             $valuesStr = '';              
                            $module_type = "Permission";
                            $page_name = url()->previous();
                            Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
                            return back()->with('success','Record Updated Successfully');
                        } else {
                            return back()->with('unsuccess','Opps Something wrong!');
                        }
                    }
          //function for update new record
          public function update_permission_status(Request $request, $circuit_id){  
            $planning_status = $request['planning_status']; 
           // echo $planning_status;exit; 
            $project_status = $request['project_status'];  
            $permissions_status = $request['permissions_status']; 
            $landlord_approval_status = $request['landlord_approval_status'];   
            //update Query
            $update_master_file_record = PermissionMasterFile::Where('circuit_id', $circuit_id)->update([
               'permissions_status' => $permissions_status  ]);
            //Check if data is updated or not
            
            //check project status
                if($update_master_file_record){
            //check project status
                if( $permissions_status == 'B) Received from Planning' AND $landlord_approval_status == 'E) Approved'){
                   $new_project_status = 'F) Permissions';
                } elseif($permissions_status == 'C) Work In Progress' AND $landlord_approval_status == 'E) Approved'){
                    $new_project_status = 'F) Permissions';
                } elseif($permissions_status == 'E) Approved' AND $planning_status == 'F) WP2 Compilation'){
                    $new_project_status = 'D) In-Planning';
                } elseif($permissions_status == 'F) Not Required' AND $planning_status == 'F) WP2 Compilation'){
                    $new_project_status = 'D) In-Planning';
                }  else {
                    $new_project_status = $project_status;
                }

                //check sales status
                $sales_status = 'A) New Sales';
                if($permissions_status == 'J) Data Fix'){
                    $sales_status = 'F) Data Fix';
                } 
                   $update_record = SiteMasterFile::where('circuit_id',$circuit_id)->update([
                  'project_status' => $new_project_status,
                  'sales_status' => $sales_status,
                ]);
                  //call another function
                  $this->update_all_single_permission($request,$circuit_id);
                   //Call Manage History Helper            
                   $fieldsStr = '';
                   $valuesStr = '';              
                   $module_type = "Permission";
                   $page_name = url()->previous();
                   Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
                    return back()->with('success','Record Updated Successfully');
                } else {
                    return back()->with('unsuccess','Opps Something wrong!');
                }
        }
        
        // common function for update permission single page
        public function update_all_single_permission($request,$circuit_id){
        
        $planning_record = [
                              'site_a_status' => $request['site_a_status'],
                              'site_b_status' => $request['site_b_status'],
                              'comment' => $request['Comment'],
                           ];
          //Get request for permission records
          $site_a_lla_submitted = null;
          if( $request['site_a_lla_submitted']){
          $site_a_lla_submitted = Carbon::parse($request['site_a_lla_submitted']);
          }
          $site_a_lla_received = null;
          if( $request['site_a_lla_received']){
          $site_a_lla_received = Carbon::parse($request['site_a_lla_received']);
          }
          $site_b_lla_submitted = null;
          if( $request['site_b_lla_submitted']){
          $site_b_lla_submitted = Carbon::parse($request['site_b_lla_submitted']);
          }
          $site_b_lla_received = null;
          if( $request['site_b_lla_received']){
          $site_b_lla_received = Carbon::parse($request['site_b_lla_received']);
          }
         
          $permission_record = [
                                  'site_a_lla_submitted' =>   $site_a_lla_submitted,
                                  'site_a_lla_received' =>  $site_a_lla_received,  
                                  'site_b_lla_submitted' => $site_b_lla_submitted, 
                                  'site_b_lla_received' =>  $site_b_lla_received,
                                  'wayleaves_status' => $request['wayleaves_status'],
                                  'resource' => $request['resource'], 
                                  'permissions_status' => $request['permissions_status'], 
                             
                               ]; 
    
          //Update permission
          $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update($planning_record);
          $update_permission_master_file_record = PermissionMasterFile::Where('circuit_id', $circuit_id)->update($permission_record);
          //$update_department_record = DepartmentComment::updateOrCreate(['circuit_id'=> $circuit_id,'service_id' => $circuit_id],$department_comment);             
 }

                
                 
            //function to 
            public function calculate_site_a_lla_estimated($site_a_lla_submitted){
                $site_a_lla_submittedd = Carbon::parse($site_a_lla_submitted);
                //$site_a_lla_submitted = "";
                if($site_a_lla_submitted){
                    $site_a_lla_estimated = $site_a_lla_submittedd->addDays(30)->format('m/d/Y');
                }else{
                    $site_a_lla_estimated = "";
                }
                return $site_a_lla_estimated;
            }
            //function to calculate_lla_duration_date for a
            public function calculate_wayleaves_recived_date($planning_wp2_wl_submission){

                if($planning_wp2_wl_submission){
                    $planning_wp2_wl_submissionn = Carbon::parse($planning_wp2_wl_submission);
                    $exepected_wl_received_date = $planning_wp2_wl_submissionn->addDays(35)->format('m/d/Y');
                } else {
                    $exepected_wl_received_date = "";
                }
                return $exepected_wl_received_date;

            }
             //function to 
             public function calculate_site_b_lla_estimated($site_b_lla_submitted){
                $site_b_lla_submittedd = Carbon::parse($site_b_lla_submitted);
                $site_b_lla_estimated = "";
                if($site_b_lla_submitted){
                    $site_b_lla_estimated = $site_b_lla_submittedd->addDays(30)->format('m/d/Y');
                }else{
                    $site_b_lla_estimated = "";
                }
                return $site_b_lla_estimated;
            }

    //function to calculate_overdue_date for a 
    public function calculate_overdue_date($site_a_lla_submitted,$site_a_lla_received,$site_a_lla_estimated){
        //Request
        $lla_submitted = $site_a_lla_submitted;
        $lla_estimated = $site_a_lla_estimated;
        $lla_received = $site_a_lla_received;
        $site_a_lla_estimatedd = $site_a_lla_estimated;

        $lla_submitted_new = Carbon::parse($lla_submitted)->format('m/d/Y');
        $lla_estimated_new = Carbon::parse($lla_estimated)->format('m/d/Y');
        $lla_received_new = Carbon::parse($lla_received)->format('m/d/Y');
        $new_current_date = Carbon::now()->format('m/d/Y');
        if($lla_estimated_new > $new_current_date){
           return "";
        } 

        //Check site_a_lla_estimatedd data is exit or not
        $site_a_lla_estimated = null;
        if($site_a_lla_estimatedd){
            $site_a_lla_estimated = Carbon::parse($site_a_lla_estimatedd);
        }

        //Check id data is exit or not
        $site_a_lla_received_new = null;
        if($site_a_lla_received){
            $site_a_lla_received_new = Carbon::parse($site_a_lla_received);
        }
        
        //Check id data is exit or not
        //$site_a_lla_submittedd = '';
        if($site_a_lla_submitted){
            $site_a_lla_submittedd = Carbon::parse($site_a_lla_submitted)->format('d');
        } else {
            return $overdue = ''; 
        }
                                
        //Check if lla_received is null or not
        $current_date = Carbon::now();
        if(is_null($site_a_lla_received_new) AND $current_date >  $site_a_lla_estimated){
            $overdue = $current_date->subDay($site_a_lla_submittedd)->format('d');  
            return $overdue;
        } else {
            return $overdue = null; 
        } 
    }

    //function to calculate_overdue_date_b
    public function calculate_overdue_date_b($site_b_lla_submitted,$site_b_lla_received,$site_b_lla_estimated){ 
        //echo $site_b_lla_estimated;
            //Request
        $llb_submitted = $site_b_lla_submitted;
        $llb_estimated = $site_b_lla_estimated;
        $llb_received = $site_b_lla_received;
        //$site_a_lla_estimatedd = $site_b_lla_estimated;

        $llb_submitted_new = Carbon::parse($llb_submitted)->format('m/d/Y');
        $llb_estimated_new = Carbon::parse($llb_estimated)->format('m/d/Y');
        $llb_received_new = Carbon::parse($llb_received)->format('m/d/Y');
        $new_current_date = Carbon::now()->format('m/d/Y');
        if($llb_estimated_new > $new_current_date){
            return ""; 
        } 
        //Check site_a_lla_estimatedd data is exit or not
        $site_b_lla_estimatedd = null;
        if($site_b_lla_estimated){
            $site_b_lla_estimatedd = Carbon::parse($site_b_lla_estimated);
        }

        //Check id data is exit or not
        $site_b_lla_received_new = null;
        if($site_b_lla_received){
            $site_b_lla_received_new = Carbon::parse($site_b_lla_received);
        }
        
        //Check id data is exit or not
        if($site_b_lla_submitted){
            $site_b_lla_submittedd = Carbon::parse($site_b_lla_submitted)->format('d');
        } else {
            return ""; 
        }
        //Check if lla_received is null or not
        $current_date = Carbon::now();
        
        if(is_null($site_b_lla_received_new) AND $current_date >  $site_b_lla_estimatedd){
            $overdueB = $current_date->subDay($site_b_lla_submittedd)->format('d');
            return $overdueB;
            } else {
            return $overdue = null; 
        } 
    }

    //function to calculate_lla_duration_date for a
    public function calculate_lla_duration_date($site_a_lla_submitted,$site_a_lla_received){
        $site_a_lla_receivedd = Carbon::parse($site_a_lla_received);
         
        //check
        
        //Check id data is exit or not
        $lla_duration = '';
        if($site_a_lla_submitted){
            $site_a_lla_submittedd = Carbon::parse($site_a_lla_submitted)->format('d');
        } else {
            return $lla_duration;
        }

        //current date
        $current_date = Carbon::now();
        if($site_a_lla_received = '' && $current_date >= $site_a_lla_submittedd ){
            $lla_duration = $current_date->subDay($site_a_lla_submittedd)->format('d');
        } else {
            $lla_duration = $site_a_lla_receivedd->subDay($site_a_lla_submittedd)->format('d');
        }
        return $lla_duration;
    }
                
                 //function to calculate_lla_duration_date for b
            public function calculate_llb_duration_date($site_b_lla_submitted,$site_b_lla_received){
                    //$site_b_lla_submitted = Carbon::parse($site_b_lla_submitted)->format('d');
                     $site_b_lla_receivedd = Carbon::parse($site_b_lla_received);

                     //Check id data is exit or not
                        $llb_duration = '';
                        if($site_b_lla_submitted){
                            $site_b_lla_submittedd = Carbon::parse($site_b_lla_submitted)->format('d');
                        } else {
                            return $llb_duration;
                        }
                    $current_date = Carbon::now();
                    
                     if($site_b_lla_received == ''){
                        $llb_duration = $current_date->subDay($site_b_lla_submittedd)->format('d');
                    } else {
                        $llb_duration = $site_b_lla_receivedd->subDay($site_b_lla_submittedd)->format('d');
                    }
                    return $llb_duration;
                }
               
                   //function to calculate_stormwater_rou_date_submitted
             public function calculate_stormwater_rou_date_submitted($stormwater_rou_date_submitted,$stormwater_rou_lead_time){
                $stormwater_rou_date_submitted = Carbon::parse($stormwater_rou_date_submitted);
                //$site_a_lla_submitted = "";
                if($stormwater_rou_date_submitted){
                    $stormwater_rou_date_estimated = $stormwater_rou_date_submitted->addDays($stormwater_rou_lead_time)->format('m/d/Y');
                }else{
                    $stormwater_rou_date_estimated = "";
                }
                return $stormwater_rou_date_estimated;
            }

//working  
                //function to calculate_eskom_date_submitted
             public function calculate_eskom_date_submitted($eskom_date_submitted,$eskom_lead_time){
                $eskom_date_submitted = Carbon::parse($eskom_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($eskom_date_submitted){
                    $eskom_date_submitted = $eskom_date_submitted->addDays($eskom_lead_time)->format('m/d/Y');
                   }else{
                    $eskom_date_submitted = "";
                }
                return $eskom_date_submitted;
            }
                 //function to calculate_legal_services_date_submitted
             public function calculate_legal_services_date_submitted($legal_services_date_submitted,$legal_services_lead_time){
                $legal_services_date_submitted = Carbon::parse($legal_services_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($legal_services_date_submitted){
                    $legal_services_date_submitted = $legal_services_date_submitted->addDays($legal_services_lead_time)->format('m/d/Y');
                   }else{
                    $legal_services_date_submitted = "";
                }
                return $legal_services_date_submitted;
            }
                //function to calculate_sembcorp_siza_water_date_submitted
             public function calculate_sembcorp_siza_water_date_submitted($sembcorp_siza_water_date_submitted,$sembcorp_siza_water_lead_time){
                $sembcorp_siza_water_date_submitted = Carbon::parse($sembcorp_siza_water_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($sembcorp_siza_water_date_submitted){
                    $sembcorp_siza_water_date_submitted = $sembcorp_siza_water_date_submitted->addDays($sembcorp_siza_water_lead_time)->format('m/d/Y');
                   }else{
                    $sembcorp_siza_water_date_submitted = "";
                }
                return $sembcorp_siza_water_date_submitted;
            }
                
                //function to calculate_technical_services_date_submitted
             public function calculate_technical_services_date_submitted($technical_services_date_submitted,$technical_services_lead_time){
                $technical_services_date_submitted = Carbon::parse($technical_services_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($technical_services_date_submitted){
                    $technical_services_date_submitted = $technical_services_date_submitted->addDays($technical_services_lead_time)->format('m/d/Y');
                   }else{
                    $technical_services_date_submitted = "";
                }
                return $technical_services_date_submitted;
            }
                //function to calculate_transportation_planning_date_submitted
             public function calculate_transportation_planning_date_submitted($transportation_planning_date_submitted,$transportation_planning_lead_time){
                $transportation_planning_date_submitted = Carbon::parse($transportation_planning_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($transportation_planning_date_submitted){
                    $transportation_planning_date_submitted = $transportation_planning_date_submitted->addDays($transportation_planning_lead_time)->format('m/d/Y');
                   }else{
                    $transportation_planning_date_submitted = "";
                }
                return $transportation_planning_date_submitted;
            }

                //function to calculate_enviromental_management_date_submitted
             public function calculate_enviromental_management_date_submitted($enviromental_management_date_submitted,$enviromental_management_lead_time){
                $enviromental_management_date_submitted = Carbon::parse($enviromental_management_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($enviromental_management_date_submitted){
                    $enviromental_management_date_submitted = $enviromental_management_date_submitted->addDays($enviromental_management_lead_time)->format('m/d/Y');
                   }else{
                    $enviromental_management_date_submitted = "";
                }
                return $enviromental_management_date_submitted;
            }
                 //function to calculate_traffic_signals_date_submitted
             public function calculate_traffic_signals_date_submitted($traffic_signals_date_submitted,$traffic_signals_lead_time){
                $traffic_signals_date_submitted = Carbon::parse($traffic_signals_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($traffic_signals_date_submitted){
                    $traffic_signals_date_submitted = $traffic_signals_date_submitted->addDays($traffic_signals_lead_time)->format('m/d/Y');
                   }else{
                    $traffic_signals_date_submitted = "";
                }
                return $traffic_signals_date_submitted;
            }

                //function to calculate_development_planning_date_submitted
             public function calculate_development_planning_date_submitted($development_planning_date_submitted,$development_planning_lead_time){
                $development_planning_date_submitted = Carbon::parse($development_planning_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($development_planning_date_submitted){
                    $development_planning_date_submitted = $development_planning_date_submitted->addDays($development_planning_lead_time)->format('m/d/Y');
                   }else{
                    $development_planning_date_submitted = "";
                }
                return $development_planning_date_submitted;
            }

                //function to calculate_coastal_stormwater_catchment_date_submitted
             public function calculate_coastal_stormwater_catchment_date_submitted($coastal_stormwater_catchment_date_submitted,$coastal_stormwater_catchment_lead_time){
                $coastal_stormwater_catchment_date_submitted = Carbon::parse($coastal_stormwater_catchment_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($coastal_stormwater_catchment_date_submitted){
                    $coastal_stormwater_catchment_date_submitted = $coastal_stormwater_catchment_date_submitted->addDays($coastal_stormwater_catchment_lead_time)->format('m/d/Y');
                   }else{
                    $coastal_stormwater_catchment_date_submitted = "";
                }
                return $coastal_stormwater_catchment_date_submitted;
            }
                  //function to calculate_parks_date_submitted
             public function calculate_parks_date_submitted($parks_date_submitted,$parks_lead_time){
                $parks_date_submitted = Carbon::parse($parks_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($parks_date_submitted){
                    $parks_date_submitted = $parks_date_submitted->addDays($parks_lead_time)->format('m/d/Y');
                   }else{
                    $parks_date_submitted = "";
                }
                return $parks_date_submitted;
            }

                //function to calculate_electricity_date_submitted
             public function calculate_electricity_date_submitted($electricity_date_submitted,$electricity_lead_time){
                $electricity_date_submitted = Carbon::parse($electricity_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($electricity_date_submitted){
                    $electricity_date_submitted = $electricity_date_submitted->addDays($electricity_lead_time)->format('m/d/Y');
                   }else{
                    $electricity_date_submitted = "";
                }
                return $electricity_date_submitted;
            }
                 //function to calculate_ethekwini_transport_date_submitted
             public function calculate_ethekwini_transport_date_submitted($ethekwini_transport_date_submitted,$ethekwini_transport_lead_time){
                $ethekwini_transport_date_submitted = Carbon::parse($ethekwini_transport_date_submitted);
                
                //$site_a_lla_submitted = "";
                if($ethekwini_transport_date_submitted){
                    $ethekwini_transport_date_submitted = $ethekwini_transport_date_submitted->addDays($ethekwini_transport_lead_time)->format('m/d/Y');
                    //echo $ethekwini_transport_date_submitted; exit;  
                }else{
                    $ethekwini_transport_date_submitted = "";
                }
                return $ethekwini_transport_date_submitted;
            }


                //function to calculate_sewer_rou_date_submitted
                public function calculate_sewer_rou_date_submitted($sewer_rou_date_submitted,$sewer_rou_lead_time){
                    $sewer_rou_date_submitted = Carbon::parse($sewer_rou_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($sewer_rou_date_submitted){
                        $sewer_rou_date_estimated = $sewer_rou_date_submitted->addDays($sewer_rou_lead_time)->format('m/d/Y');
                    }else{
                        $sewer_rou_date_estimated = "";
                    }
                    return $sewer_rou_date_estimated;
                }

                   //function to telkom_date_submitted
                   public function calculate_telkom_date_submitted($telkom_date_submitted,$telkom_lead_time){
                    $telkom_date_submitted = Carbon::parse($telkom_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($telkom_date_submitted){
                        $telkom_date_date_estimated = $telkom_date_submitted->addDays($telkom_lead_time)->format('m/d/Y');
                    }else{
                        $telkom_date_date_estimated = "";
                    }
                    return $telkom_date_date_estimated;
                }

                 //function to sasol_date_submitted
                 public function calculate_sasol_date_submitted($sasol_date_submitted,$sasol_lead_time){
                    $sasol_date_submitted = Carbon::parse($sasol_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($sasol_date_submitted){
                        $sasol_date_estimated = $sasol_date_submitted->addDays($sasol_lead_time)->format('m/d/Y');
                    }else{
                        $sasol_date_estimated = "";
                    }
                    return $sasol_date_estimated;
                }

                 //function to transnet_date_estimated
                 public function calculate_transnet_date_submitted($transnet_date_submitted,$transnet_lead_time){
                    $transnet_date_submitted = Carbon::parse($transnet_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($transnet_date_submitted){
                        $transnet_date_estimated = $transnet_date_submitted->addDays($transnet_lead_time)->format('m/d/Y');
                    }else{
                        $transnet_date_estimated = "";
                    }
                    return $transnet_date_estimated;
                }

                  //function to neotel_date_submitted
                  public function calculate_neotel_date_submitted($neotel_date_submitted,$neotel_lead_time){
                    $neotel_date_submitted = Carbon::parse($neotel_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($neotel_date_submitted){
                        $neotel_date_estimated = $neotel_date_submitted->addDays($neotel_lead_time)->format('m/d/Y');
                    }else{
                        $neotel_date_estimated = "";
                    }
                    return $neotel_date_estimated;
                }

                 //function to roads_date_submitted
                 public function calculate_roads_date_submitted($roads_date_submitted,$roads_lead_time){
                    $roads_date_submitted = Carbon::parse($roads_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($roads_date_submitted){
                        $roads_date_estimated = $roads_date_submitted->addDays($roads_lead_time)->format('m/d/Y');
                    }else{
                        $roads_date_estimated = "";
                    }
                    return $roads_date_estimated;
                }

                  //function to dfa_date_submitted
                  public function calculate_dfa_date_submitted($dfa_date_submitted,$dfa_lead_time){
                    $dfa_date_submitted = Carbon::parse($dfa_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($dfa_date_submitted){
                        $dfa_date_estimated = $dfa_date_submitted->addDays($dfa_lead_time)->format('m/d/Y');
                    }else{
                        $dfa_date_estimated = "";
                    }
                    return $dfa_date_estimated;
                }

                  //function to dfa_date_submitted
                  public function calculate_mtn_date_submitted($mtn_date_submitted,$mtn_lead_time){
                    $mtn_date_submitted = Carbon::parse($mtn_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($mtn_date_submitted){
                        $mtn_date_estimated = $mtn_date_submitted->addDays($mtn_lead_time)->format('m/d/Y');
                    }else{
                        $mtn_date_estimated = "";
                    }
                    return $mtn_date_estimated;
                }

                   //function to sanral_date_submitted
                   public function calculate_sanral_date_submitted($sanral_date_submitted,$sanral_lead_time){
                    $sanral_date_submitted = Carbon::parse($sanral_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($sanral_date_submitted){
                        $sanral_date_estimated = $sanral_date_submitted->addDays($sanral_lead_time)->format('m/d/Y');
                    }else{
                        $sanral_date_estimated = "";
                    }
                    return $sanral_date_estimated;
                }

                   //function to dept_of_transport_date_estimated
                   public function calculate_dept_of_transport_date_submitted($dept_of_transport_date_submitted,$dept_of_transport_lead_time){
                    $dept_of_transport_date_submitted = Carbon::parse($dept_of_transport_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($dept_of_transport_date_submitted){
                        $dept_of_transport_date_estimated = $dept_of_transport_date_submitted->addDays($dept_of_transport_lead_time)->format('m/d/Y');
                    }else{
                        $dept_of_transport_date_estimated = "";
                    }
                    return $dept_of_transport_date_estimated;
                }
                   //function to dept_of_transport_date_estimated
                   public function calculate_water_sanitation_date_submitted($water_sanitation_date_submitted,$water_sanitation_lead_time){
                    $water_sanitation_date_submitted = Carbon::parse($water_sanitation_date_submitted);
                    //$site_a_lla_submitted = "";
                    if($water_sanitation_date_submitted){
                        $water_sanitation_date_estimated = $water_sanitation_date_submitted->addDays($water_sanitation_lead_time)->format('m/d/Y');
                    }else{
                        $water_sanitation_date_estimated = "";
                    }
                    return $water_sanitation_date_estimated;
                }

    //function for Cal TOTAL NUMBER OF Responese Oustanding
    public function calculate_total_number_of_responses_oustanding($record){
        //Check with some cal
        $total_number_of_oustanding = 0;
        if(count($record) >= 1){
            //stormwater Rou Dept.
            if($record[0]['stormwater_rou_date_submitted'] AND empty($record[0]['stormwater_rou_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Sewer Rou Dept.
            if($record[0]['sewer_rou_date_submitted'] AND empty($record[0]['sewer_rou_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Telkom Dept.
            if($record[0]['telkom_date_submitted'] AND empty($record[0]['telkom_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Sasol Dept.
            if($record[0]['sasol_date_submitted'] AND empty($record[0]['sasol_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Transnet Dept.
            if($record[0]['transnet_date_submitted'] AND empty($record[0]['transnet_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Neotel Dept.
            if($record[0]['neotel_date_submitted'] AND empty($record[0]['neotel_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Roads Dept.
            if($record[0]['roads_date_submitted'] AND empty($record[0]['roads_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //DFA Dept.
            if($record[0]['dfa_date_submitted'] AND empty($record[0]['dfa_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //MTN Dept.
            if($record[0]['mtn_date_submitted'] AND empty($record[0]['mtn_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Sanral Dept.
            if($record[0]['sanral_date_submitted'] AND empty($record[0]['sanral_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Dept of Transport Dept.
            if($record[0]['dept_of_transport_date_submitted'] AND empty($record[0]['dept_of_transport_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Water Sanitization Dept.
            if($record[0]['water_sanitation_date_submitted'] AND empty($record[0]['water_sanitation_date_received'])){
                $total_number_of_oustanding += 1;
            }


            //Ethekwin Transport Dept.
            if($record[0]['ethekwini_transport_date_submitted'] AND empty($record[0]['ethekwini_transport_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Electricity Dept.
            if($record[0]['electricity_date_submitted'] AND empty($record[0]['electricity_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Parks Dept.
            if($record[0]['parks_date_submitted'] AND empty($record[0]['parks_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Coastal Stormwater Catchment.
            if($record[0]['coastal_stormwater_catchment_date_submitted'] AND empty($record[0]['coastal_stormwater_catchment_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Development Planning Dept.
            if($record[0]['development_planning_date_submitted'] AND empty($record[0]['development_planning_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Traffic Signals Dept.
            if($record[0]['traffic_signals_date_submitted'] AND empty($record[0]['traffic_signals_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Environmental Management Dept.
            if($record[0]['enviromental_management_date_submitted'] AND empty($record[0]['enviromental_management_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Transporation Planning Dept.
            if($record[0]['transportation_planning_date_submitted'] AND empty($record[0]['transportation_planning_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Technical Services Dept.
            if($record[0]['technical_services_date_submitted'] AND empty($record[0]['technical_services_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Sembcorp Siza Water Dept.
            if($record[0]['sembcorp_siza_water_date_submitted'] AND empty($record[0]['sembcorp_siza_water_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Legal Services Dept.
            if($record[0]['legal_services_date_submitted'] AND empty($record[0]['legal_services_date_received'])){
                $total_number_of_oustanding += 1;
            }

            //Eskom Dept.
            if($record[0]['eskom_date_submitted'] AND empty($record[0]['eskom_date_received'])){
                $total_number_of_oustanding += 1;
            }
        } 
        return  $total_number_of_oustanding;
    }
}