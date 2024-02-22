<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanningMasterFile;
use App\Models\SiteMasterFile;
use App\Models\SiteSurveyStatus;
use App\Models\PermissionMasterFile;
use App\Models\BuildMasterFile;
use App\Models\DepartmentComment;
use App\Models\Lapop;
use App\Models\PlanningMaterial;
use App\Models\PlanningMaterialIspA;
use App\Models\PlanningMaterialIspB;
use App\Models\PlanningMaterialOsp;
use App\Models\Site;
use App\Models\ProjectType;
use App\Models\NetworkType;
use App\Models\RateMbitS;
use App\Models\PlanningStatus;
use App\Models\OspStatusPlanning;
use App\Models\SiteStatus;
use App\Models\Description;
use App\Models\OSPPLanners;
use App\Models\IspPLanners;
use App\Models\Surveyors;
use App\Models\AddSiteSurveyStatus;
use App\Models\AddLandlordStatus;
use App\Models\PlanningAttachment;
use Carbon\Carbon;
use Helper;
use App\Mail\o2capMail;
use Illuminate\Support\Facades\Mail;

class PlanningMasterFileController extends Controller
{
    //Function for show index view file
    public function index(){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->paginate(50);
        $view =  view('admin/planning-master-files/all-list', compact('all_records'));
        return $view;
    }
    
    //Function for show single record view file
    public function single_record($id){
        $record  =  PlanningMasterFile::where('id', $id)->get()->toArray();
        $view =  view('admin/planning-master-files/single-record',compact('record'));
        return $view;
    }
    
    //function for update new record
    public function update_record(Request $request, $id){
        //echo "yes";exit;
		//validation rule
        request()->validate([
            'service_id' => 'required', 'string', 'max:255',
        ]);
        
        $rx_in_planning = null;
        if($request['rx_in_planning']){
            $rx_in_planning = Carbon::parse($request['rx_in_planning']);
       }
        $planning_status = $request['planning_status'];
        
        $planned_wp2_released_date = null;
        if($request['planned_wp2_released_date']){
            $planned_wp2_released_date = Carbon::parse($request['planned_wp2_released_date']);
       }
        $revised_planned_wp2_date = null;
        if($request['revised_planned_wp2_date']){
            $revised_planned_wp2_date = Carbon::parse($request['revised_planned_wp2_date']);
        }
        
        $wp2_approval_requested = null;
        if($request['wp2_approval_requested']){
            $wp2_approval_requested = Carbon::parse($request['wp2_approval_requested']);
        }
        
        $wp2_approval_received = null;
        if($request['wp2_approval_received']){
            $wp2_approval_received = Carbon::parse($request['wp2_approval_received']);
        }
        
        $isp_a_wp2_approval_received = null;
        if($request['isp_a_wp2_approval_received']){
            $isp_a_wp2_approval_received = Carbon::parse($request['isp_a_wp2_approval_received']);
        }
        
        $isp_a_wp2_approval_requested = null;
        if($request['isp_a_wp2_approval_requested']){
            $isp_a_wp2_approval_requested = Carbon::parse($request['isp_a_wp2_approval_requested']);
        }
        
        $isp_b_wp2_approval_received = null;
        if($request['isp_b_wp2_approval_received']){
            $isp_b_wp2_approval_received = Carbon::parse($request['isp_b_wp2_approval_received']);
        }
        
        $isp_b_wp2_approval_requested = null;
        if($request['isp_b_wp2_approval_requested']){
            $isp_b_wp2_approval_requested = Carbon::parse($request['isp_b_wp2_approval_requested']);
        }
        
        $planning_wp2_wl_submission = null;
        if($request['planning_wp2_wl_submission']){
            $planning_wp2_wl_submission = Carbon::parse($request['planning_wp2_wl_submission']);
        }
        $osp_planners = $request['osp_planners'];
        $isp_planners = $request['isp_planners'];
        $surveyors = $request['surveyors'];
        $isp_distance = $request['isp_distance'];
        $osp_planners2 = $request['osp_planners2'];
        $isp_planners2 = $request['isp_planners2'];
        $surveyors2 = $request['surveyors2'];
        $site_a_id = $request['site_a_id'];
        $site_a_status = $request['site_a_status'];
        
         $site_a_survey_date = null;
        if($request['site_a_survey_date']){
            $site_a_survey_date = Carbon::parse($request['site_a_survey_date']);
        }
        
         $site_a_isp_submission = null;
        if($request['site_a_isp_submission']){
            $site_a_isp_submission = Carbon::parse($request['site_a_isp_submission']);
        }
        
        $site_b_survey_date = null;
        if($request['site_b_survey_date']){
            $site_b_survey_date = Carbon::parse($request['site_b_survey_date']);
        }
        
        $site_a_isp_submission = null;
        if($request['site_a_isp_submission']){
            $site_a_isp_submission = Carbon::parse($request['site_a_isp_submission']);
        }
        
         $site_b_isp_submission = null;
        if($request['site_b_isp_submission']){
            $site_b_isp_submission = Carbon::parse($request['site_b_isp_submission']);
        }
        $site_a_comment = $request['site_a_comment'];
        $site_b_id = $request['site_b_id'];
        $site_b_status = $request['site_b_status'];
        $site_b_comment = $request['site_b_comment'];
        $comment = $request['comment'];
        $cost_pm = $request['cost_pm'];
        $province = $request['province'];
        $labour_cost_osp = $request['labour_cost_osp'];
        $material_cost_osp = $request['material_cost_osp'];
        $total_boq_value_osp = $request['total_boq_value_osp'];
        $labour_cost_vo_osp = $request['labour_cost_vo_osp'];
        $material_cost_vo_osp = $request['material_cost_vo_osp'];
        $total_boq_value_vo_osp = $request['total_boq_value_vo_osp'];
        $labour_cost_vo_isp_a = $request['labour_cost_vo_isp_a'];
        $material_cost_vo_isp_a = $request['material_cost_vo_isp_a'];
        $total_boq_value_vo_isp_a = $request['total_boq_value_vo_isp_a'];
        $labour_cost_vo_isp_b = $request['labour_cost_vo_isp_b'];
        $material_cost_vo_isp_b = $request['material_cost_vo_isp_b'];
        $total_boq_value_vo_isp_b = $request['total_boq_value_vo_isp_b'];
        $total_project_cost = $request['total_project_cost'];
        $osp_status_panning = $request['osp_status_panning'];
        $osp_distance_trench = $request['osp_distance_trench'];
        $osp_distance_3rd_party_ducts = $request['osp_distance_3rd_party_ducts'];
        $osp_la_existing_duct = $request['osp_la_existing_duct'];
        $osp_la_existing_network = $request['osp_la_existing_network'];
        $osp_distance_focus = $request['osp_distance_focus'];
        $osp_in_buildin_conduits = $request['osp_in_buildin_conduits'];
        $ops_total_distance = $request['ops_total_distance'];
        $isp_a_distance_trench = $request['isp_a_distance_trench'];
        $isp_a_distance_3rd_party_ducts = $request['isp_a_distance_3rd_party_ducts'];
        $isp_a_la_existing_duct = $request['isp_a_la_existing_duct'];
        $isp_a_la_existing_network = $request['isp_a_la_existing_network'];
        $isp_a_distance_focus = $request['isp_a_distance_focus'];
        $isp_a_in_buildin_conduits = $request['isp_a_in_buildin_conduits'];
        $isp_a_total_distance = $request['isp_a_total_distance'];
        $isp_b_distance_trench = $request['isp_b_distance_trench'];
        $isp_b_distance_3rd_party_ducts = $request['isp_b_distance_3rd_party_ducts'];
        $isp_b_la_existing_duct = $request['isp_b_la_existing_duct'];
        $isp_b_la_existing_network = $request['isp_b_la_existing_network'];
        $isp_b_distance_focus = $request['isp_b_distance_focus'];
        $isp_b_in_buildin_conduits = $request['isp_b_in_buildin_conduits'];
        $isp_b_total_distance = $request['isp_b_total_distance'];
        $labour_cost_isp_a = $request['labour_cost_isp_a'];
        $material_cost_isp_a = $request['material_cost_isp_a'];
        $total_boq_value_isp_a = $request['total_boq_value_isp_a'];
        $labour_cost_isp_b = $request['labour_cost_isp_b'];
        $material_cost_isp_b = $request['material_cost_isp_b'];
        $total_boq_value_isp_b = $request['total_boq_value_isp_b'];
        $link_dependency = $request['link_dependency'];
        $mat = $request['mat'];
       
        
        //update Query
        $update_master_file_record = PlanningMasterFile::Where('id', $id)->update([
                                'planning_status' => $planning_status,
                                'revised_planned_wp2_date' => $revised_planned_wp2_date,
                                'planned_wp2_released_date' => $planned_wp2_released_date,
                                'rx_in_planning' => $rx_in_planning,
                                'planning_wp2_wl_submission' => $planning_wp2_wl_submission,
                                'wp2_approval_requested' => $wp2_approval_requested,
                                'wp2_approval_received' => $wp2_approval_received,
                                'isp_a_wp2_approval_received' => $isp_a_wp2_approval_received,
                                'isp_a_wp2_approval_requested' => $isp_a_wp2_approval_requested,
                                'isp_b_wp2_approval_received' => $isp_b_wp2_approval_received,
                                'isp_b_wp2_approval_requested' => $isp_b_wp2_approval_requested,
                                'osp_planners' => $osp_planners,
                                'isp_planners' => $isp_planners,
                                'surveyors' => $surveyors,
                                'isp_distance' => $isp_distance,
                                'osp_planners2' => $osp_planners2,
                                'isp_planners2' => $isp_planners2,
                                'surveyors2' => $surveyors2,
                                'site_a_id' => $site_a_id,
                                'site_a_status' => $site_a_status,
                                'site_a_survey_date' => $site_a_survey_date,
                                'site_a_isp_submission' => $site_a_isp_submission,
                                'site_a_comment' => $site_a_comment,
                                'site_b_id' => $site_b_id,
                                'site_b_status' => $site_b_status,
                                'site_b_survey_date' => $site_b_survey_date ,
                                'site_b_isp_submission' => $site_b_isp_submission,
                                'site_b_comment' => $site_b_comment,
                                'comment' => $comment,
                                'cost_pm' => $cost_pm,
                                'province' => $province,
                                'labour_cost_osp' => $labour_cost_osp,
                                'material_cost_osp' => $material_cost_osp,
                                'total_boq_value_osp' => $total_boq_value_osp,
                                'labour_cost_vo_osp' => $labour_cost_vo_osp,
                                'material_cost_vo_osp' => $material_cost_vo_osp,
                                'total_boq_value_vo_osp' => $total_boq_value_vo_osp,
                                'labour_cost_vo_isp_a' => $labour_cost_vo_isp_a,
                                'material_cost_vo_isp_a' => $material_cost_vo_isp_a,
                                'total_boq_value_vo_isp_a' => $total_boq_value_vo_isp_a,
                                'labour_cost_vo_isp_b' => $labour_cost_vo_isp_b,
                                'material_cost_vo_isp_b' => $material_cost_vo_isp_b,
                                'total_boq_value_vo_isp_b' => $total_boq_value_vo_isp_b,
                                'total_project_cost' => $total_project_cost,
                                'osp_status_panning' => $osp_status_panning,
                                'osp_distance_trench' => $osp_distance_trench,
                                'osp_distance_3rd_party_ducts' => $osp_distance_3rd_party_ducts,
                                'osp_la_existing_duct' => $osp_la_existing_duct,
                                'osp_la_existing_network' => $osp_la_existing_network,
                                'osp_distance_focus' => $osp_distance_focus,
                                'osp_in_buildin_conduits' => $osp_in_buildin_conduits,
                                'ops_total_distance' => $ops_total_distance,
                                'isp_a_distance_trench' => $isp_a_distance_trench,
                                'isp_a_distance_3rd_party_ducts' => $isp_a_distance_3rd_party_ducts,
                                'isp_a_la_existing_duct' => $isp_a_la_existing_duct,
                                'isp_a_la_existing_network' => $isp_a_la_existing_network,
                                'isp_a_distance_focus' => $isp_a_distance_focus,
                                'isp_a_in_buildin_conduits' => $isp_a_in_buildin_conduits,
                                'isp_a_total_distance' => $isp_a_total_distance,
                                'isp_b_distance_trench' => $isp_b_distance_trench,
                                'isp_b_distance_3rd_party_ducts' => $isp_b_distance_3rd_party_ducts,
                                'isp_b_la_existing_duct' => $isp_b_la_existing_duct,
                                'isp_b_la_existing_network' => $isp_b_la_existing_network,
                                'isp_b_distance_focus' => $isp_b_distance_focus,
                                'isp_b_in_buildin_conduits' => $isp_b_in_buildin_conduits,
                                'isp_b_total_distance' => $isp_b_total_distance,
                                'labour_cost_isp_a' => $labour_cost_isp_a,
                                'material_cost_isp_a' => $material_cost_isp_a,
                                'total_boq_value_isp_a' => $total_boq_value_isp_a,
                                'labour_cost_isp_b' => $labour_cost_isp_b,
                                'material_cost_isp_b' => $material_cost_isp_b,
                                'total_boq_value_isp_b' => $total_boq_value_isp_b,
                                'link_dependency' => $link_dependency,
                                'mat' => $mat,
                            ]);
        //Check if data is updated or not
        if($update_master_file_record){ 
      
            return back()->with('success','Record Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
    
        //function for search records
    public function search_records(Request $request){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        //Get Request
        $keyword = $request->get('keyword'); 
        $region = $request->get('region'); 
        if(!empty($request->get('keyword'))){
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
        }
        if(!empty($request->get('region'))){
            $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
        }
        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->paginate(50);
        }
        $view =  view('admin/planning-master-files/search-list', compact('all_records'));
        return $view;
    }
	 //function for search records
    public function search_total_project_records(Request $request){
            //Get Request
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $keyword = $request->get('keyword');  
            $region = $request->get('region');          
            if(!empty($request->get('keyword'))){
                $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->orWhere('planning_status', 'like', '%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
                }
                if(!empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
                }
                if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
            }
            $view =  view('admin/planning-master-files/search-total-project-cost', compact('all_records'));
            return $view;
    }
	 //function for search records
    public function search_material_isp_a_records(Request $request){
            //Get Request
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $keyword = $request->get('keyword');           
            $region = $request->get('region');          
            if(!empty($request->get('keyword'))){
                $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->orWhere('planning_status', 'like', '%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
                }
                if(!empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
                }
                if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
            }
            $view =  view('admin/planning-master-files/search-material-isp-a', compact('all_records'));
            return $view;
    }
	 //function for search records
    public function search_material_isp_b_records(Request $request){
            //Get Request
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $keyword = $request->get('keyword');            
            $region = $request->get('region');          
            if(!empty($request->get('keyword'))){
                $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->orWhere('planning_status', 'like', '%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
                }
                if(!empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
                }
                if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
            }
            $view =  view('admin/planning-master-files/search-material-isp-b', compact('all_records'));
            return $view;
    }
		 //function for search records
    public function search_material_osp_records(Request $request){
            //Get Request
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $keyword = $request->get('keyword');            
            $region = $request->get('region');          
            if(!empty($request->get('keyword'))){
                $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->orWhere('planning_status', 'like', '%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
                }
                if(!empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
                }
                if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
            }
            $view =  view('admin/planning-master-files/search-material-osp', compact('all_records'));
            return $view;
    }
			 //function for search records
    public function search_site_survey_records(Request $request){
            //Get Request
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $keyword = $request->get('keyword');         
            $region = $request->get('region');          
            if(!empty($request->get('keyword'))){
                $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->orWhere('planning_status', 'like', '%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
                }
                if(!empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
                }
                if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
            }
            $view =  view('admin/planning-master-files/search-site-survey', compact('all_records'));
            return $view;
    }
	 //function for search records
    public function search_landlord_records(Request $request){
            //Get Request
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $keyword = $request->get('keyword');       
            $region = $request->get('region');          
            if(!empty($request->get('keyword'))){
                $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->orWhere('planning_status', 'like', '%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
                }
                if(!empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
                }
                if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
            }
            $view =  view('admin/planning-master-files/search-landlord', compact('all_records'));
            return $view;
    }
	 //function for search records
    public function search_department_comments(Request $request){
            //Get Request
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
            $keyword = $request->get('keyword');        
            $region = $request->get('region');          
            if(!empty($request->get('keyword'))){
                $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('service_id','like','%'.$keyword.'%')->orWhere('planning_status', 'like', '%'.$keyword.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
                }
                if(!empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->where('region','like','%'.$region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);  
                }
                if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
                    $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->with('permission_record','site_master_record','build_record')->paginate(50);
            }
            $view =  view('admin/planning-master-files/search-department-comment', compact('all_records'));
            return $view;
    }
	 //function for search records
    public function search_la_pop(Request $request){
            //Get Request
            $keyword = $request->get('keyword');            
            $all_records = Lapop::where('pop_id','like','%'.$keyword.'%')->whereNoTIn('planning_status',['Pending CTS'])->orWhere('area', 'like', '%'.$keyword.'%')->paginate(50);
            $view =  view('admin/planning-master-files/la-pop/search-la-pop', compact('all_records'));
            return $view;
    }
    
     //Function for show project status all list file
    public function project_status_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
        $view =  view('admin/planning-master-files/project-status-page', compact('all_records',));
        return $view;
    }
    
    //Function for planning status list
    public function planning_status_list(){
     $region = Auth::user()->regions;   
     $is_login_region = explode(",",$region);
     $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
     $view =  view('admin/planning-master-files/planning-status-page', compact('all_records'));
     return $view;
    }
    
    //Function for planning status list
    public function planning_date_list(){
    $region = Auth::user()->regions;   
     $is_login_region = explode(",",$region);
     $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
     $view =  view('admin/planning-master-files/planning-date-page', compact('all_records'));
     return $view;
    }
    
     //Function for planning resources list
     public function planning_resources_list(){
    $region = Auth::user()->regions;   
     $is_login_region = explode(",",$region);
     $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
     $view =  view('admin/planning-master-files/planning-resources-page', compact('all_records'));
     return $view;
    }
    
     //Function for planning isp a list
     public function planning_isp_a_list(){
     $region = Auth::user()->regions;   
     $is_login_region = explode(",",$region);
     $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
     $view =  view('admin/planning-master-files/planning-isp-a-page', compact('all_records'));
     return $view;
    }
    
     //Function for planning isp b list
     public function planning_isp_b_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
        $view =  view('admin/planning-master-files/planning-isp-b-page', compact('all_records'));
        return $view;
    }
    
     //Function for planning total cost project list
     public function planning_total_project_cost_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
        $view =  view('admin/planning-master-files/planning-total-project-cost-page', compact('all_records'));
        return $view;
    }
    
      //Function for planning material service isp a
     public function planning_material_service_isp_a_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
        $view =  view('admin/planning-master-files/planning-material-service-isp-a', compact('all_records'));
        return $view;
    }
    
       //Function for planning material service isp b
     public function planning_material_service_isp_b_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
        $view =  view('admin/planning-master-files/planning-material-service-isp-b', compact('all_records'));
        return $view;
    }
    
       //Function for planning material service osp b
     public function planning_material_service_osp_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
        $view =  view('admin/planning-master-files/planning-material-service-osp', compact('all_records'));
        return $view;
    }
    
      //Function for planning department comment 
     public function planning_department_comment_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record','department_record')->paginate(50);
        $view =  view('admin/planning-master-files/planning-department-comments', compact('all_records'));
        return $view;
    }

    //Funtion for planning status single record
    public function planning_status_single_record(){ 
        $view = view('admin/planning-master-files/project-status-single');
        return $view;
    }

     //Funtion for site survey record
     public function site_survey_record($circuit_id){ 
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
		$all_site_survey_status = AddSiteSurveyStatus::orderBy('site_survey_status')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
        $record = PlanningMasterFile::whereIn('region',$is_login_region)->where('circuit_id', $circuit_id)->with('permission_record','site_master_record','build_record','department_record','landlord_record','site_survey_record')->get()->toArray();
        $site_a_lla_submitted = $record[0]['permission_record']['site_a_lla_submitted'] ?? '';
        $site_a_lla_estimatedd = $record[0]['permission_record']['site_a_lla_estimated'] ?? '';
        $site_a_lla_received = $record[0]['permission_record']['site_a_lla_received'] ?? '';
        $site_b_lla_estimated = $record[0]['permission_record']['site_b_lla_estimated'] ?? '';
        $site_b_lla_submitted = $record[0]['permission_record']['site_b_lla_submitted'] ?? '';
        $site_b_lla_received = $record[0]['permission_record']['site_b_lla_received'] ?? '';       
        $site_a_lla_estimated = $this->calculate_site_a_lla_estimated($site_a_lla_submitted);
        //call function for site_b_lla_estimated
        $site_b_lla_estimated = $this->calculate_site_b_lla_estimated($site_b_lla_submitted);
        //call function for overdue a
        $overdue_dateB = $this->calculate_overdue_date_b($site_b_lla_submitted,$site_b_lla_received,$site_b_lla_estimated);
        $overdue_date = $this->calculate_overdue_date($site_a_lla_submitted,$site_a_lla_received,$site_a_lla_estimated);
         //call function for lla duration
        $lla_duration_date = $this->calculate_lla_duration_date($site_a_lla_submitted,$site_a_lla_received);
        $llb_duration_date = $this->calculate_llb_duration_date($site_b_lla_submitted,$site_b_lla_received);

        $view = view('admin/planning-master-files/site-survey-record',compact('record','site_a_lla_estimated','site_b_lla_estimated','overdue_date','overdue_dateB','lla_duration_date','llb_duration_date','all_site_survey_status','all_site_status'));
        return $view;
    }

      //Function for site survey all list 
      public function site_survey_all_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record','department_record')->paginate(50); 
        $view =  view('admin/planning-master-files/site-survey-all-list', compact('all_records'));
        return $view;
       }
             

      //Function for landlord approval all list 
      public function landlord_approval_all_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record','department_record')->paginate(50);
        $view =  view('admin/planning-master-files/landlord-approval-all-list', compact('all_records'));
        return $view;
       }

    //Funtion for landlord approval record
     public function landlord_approval_record($id){ 
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
		$all_site_status = SiteStatus::orderBy('site_status')->get();
		$all_landlord_status = AddLandlordStatus::orderBy('landlord_status')->get();
        $record = PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','department_record','landlord_record')->get()->toArray();
        $site_a_lla_submitted = $record[0]['permission_record']['site_a_lla_submitted'] ?? '';
        $site_a_lla_estimatedd = $record[0]['permission_record']['site_a_lla_estimated'] ?? '';
        $site_a_lla_received = $record[0]['permission_record']['site_a_lla_received'] ?? '';
        $site_b_lla_estimated = $record[0]['permission_record']['site_b_lla_estimated'] ?? '';
        $site_b_lla_submitted = $record[0]['permission_record']['site_b_lla_submitted'] ?? '';
        $site_b_lla_received = $record[0]['permission_record']['site_b_lla_received'] ?? '';
        
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
        $view = view('admin/planning-master-files/landlord-approval-record',compact('record','site_a_lla_estimated','site_b_lla_estimated','overdue_date','overdue_dateB','lla_duration_date','llb_duration_date','all_site_status','all_landlord_status'));
        return $view;
    }
        //function to calculate_site_a_lla_estimated
        public function calculate_site_a_lla_estimated($site_a_lla_submitted){
        $site_a_lla_submittedd = Carbon::parse($site_a_lla_submitted);
        if($site_a_lla_submitted){
            $site_a_lla_estimated = $site_a_lla_submittedd->addDays(30)->format('m/d/Y');
        }else{
            $site_a_lla_estimated = "";
        }
        return $site_a_lla_estimated;
    }
    //function to calculate_lla_duration_date for a
    public function calculate_wayleaves_recived_date($planning_wp2_wl_submission){
        $planning_wp2_wl_submissionn = Carbon::parse($planning_wp2_wl_submission);
        if($planning_wp2_wl_submissionn){
            $exepected_wl_received_date = $planning_wp2_wl_submissionn->addDays(35)->format('m/d/Y');
        }else{
            $exepected_wl_received_date = "";
        }
        return $exepected_wl_received_date;

    }
        //function to calculate_site_b_lla_estimated
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

    //function to calculate_lla_duration_date for a
    public function calculate_lla_duration_date($site_a_lla_submitted,$site_a_lla_received){
        $site_a_lla_receivedd = Carbon::parse($site_a_lla_received);
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

    //function for single planning project status
    public function planning_project_status_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('circuit_id', $id)->with('permission_record','site_master_record','build_record','landlord_record','site_survey_record','attachment_record')->get()->toArray();
        $site_a_records  =  Site::orderby('site_name')->where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::orderby('site_name')->where('site_type', 'site_b')->get()->toArray(); 
        $la_records  =  Lapop::all()->toArray();
		$all_project_type = ProjectType::orderBy('project_type')->get();
		$all_network_type = NetworkType::orderBy('network_type')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_planning_status = PlanningStatus::orderBy('planning_status')->get();
		$all_osp_planning_status = OspStatusPlanning::orderBy('osp_status_planning')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
		$all_descriptions = Description::orderby('description')->orderBy('id', 'DESC')->get();
		$all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();
		$all_isp_planners = IspPLanners::orderBy('isp_planners')->get();
		$all_surveyors = Surveyors::orderBy('surveyors')->get();
        // call calculate_rx_planning_date function
        $project_type = $record[0]['site_master_record']['type'] ?? '';
        $rx_in_planning_date = $record[0]['datenew'] ?? '';
        $newe_rx_planning_date = $this->calculate_rx_planning_date($project_type,$rx_in_planning_date);   

         // get data
        $planning_wp2_wl_submissionn = $record[0]['planning_wp2_wl_submission'] ?? '';
       
        if($planning_wp2_wl_submissionn){
            $planning_wp2_wl_submission = Carbon::parse($planning_wp2_wl_submissionn);
            $exepected_wl_received_date = $planning_wp2_wl_submission->addDays(35)->format('m/d/Y');
        } else {
            $exepected_wl_received_date = "";
        }
  

        $view =  view('admin/planning-master-files/project-status-single',compact('exepected_wl_received_date','record','la_records','newe_rx_planning_date','site_a_records','site_b_records','all_project_type','all_network_type','all_rate_mbit_s','all_planning_status','all_osp_planning_status','all_site_status','all_descriptions','all_osp_planners','all_isp_planners','all_surveyors'));
        return $view; 
    }

    //function for single planning  status
    public function planning_status_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','landlord_record','site_survey_record')->get()->toArray();
        $la_records  =  Lapop::all()->toArray();
		$all_project_type = ProjectType::orderBy('project_type')->get();
		$all_network_type = NetworkType::orderBy('network_type')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_planning_status = PlanningStatus::orderBy('planning_status')->get();
		$all_osp_planning_status = OspStatusPlanning::orderBy('osp_status_planning')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
		$all_descriptions = Description::orderBy('id', 'DESC')->get();
		$all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();
		$all_isp_planners = IspPLanners::orderBy('isp_planners')->get();
		$all_surveyors = Surveyors::orderBy('surveyors')->get();
        $site_a_records  =  Site::where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::where('site_type', 'site_b')->get()->toArray(); 
        // call calculate_rx_planning_date function
        $project_type = $record[0]['site_master_record']['type'] ?? '';
        $rx_in_planning_date = $record[0]['datenew'] ?? '';
        $newe_rx_planning_date = $this->calculate_rx_planning_date($project_type,$rx_in_planning_date);
        $view =  view('admin/planning-master-files/planning-status-single',compact('record','la_records','newe_rx_planning_date','site_a_records','site_b_records','all_project_type','all_network_type','all_rate_mbit_s','all_planning_status','all_osp_planning_status','all_site_status','all_descriptions','all_osp_planners','all_isp_planners','all_surveyors'));
        return $view; 
    }

    //function for single planning  dates
    public function planning_dates_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','landlord_record','site_survey_record')->get()->toArray();
        $la_records  =  Lapop::all()->toArray();
		$all_project_type = ProjectType::orderBy('project_type')->get();
		$all_network_type = NetworkType::orderBy('network_type')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_planning_status = PlanningStatus::orderBy('planning_status')->get();
		$all_osp_planning_status = OspStatusPlanning::orderBy('osp_status_planning')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
		$all_descriptions = Description::orderBy('id', 'DESC')->get();
		$all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();
		$all_isp_planners = IspPLanners::orderBy('isp_planners')->get();
		$all_surveyors = Surveyors::orderBy('surveyors')->get();
        $site_a_records  =  Site::where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::where('site_type', 'site_b')->get()->toArray(); 
        // call calculate_rx_planning_date function
        $project_type = $record[0]['site_master_record']['type'] ?? '';
        $rx_in_planning_date = $record[0]['datenew'] ?? '';
        $newe_rx_planning_date = $this->calculate_rx_planning_date($project_type,$rx_in_planning_date);
        $view =  view('admin/planning-master-files/planning-date-single',compact('record','la_records','newe_rx_planning_date','site_a_records','site_b_records','all_project_type','all_network_type','all_rate_mbit_s','all_planning_status','all_osp_planning_status','all_site_status','all_descriptions','all_osp_planners','all_isp_planners','all_surveyors'));
        return $view; 
    }

     //function for single planning  resources
     public function planning_resource_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','landlord_record','site_survey_record')->get()->toArray();
        $la_records  =  Lapop::all()->toArray();
		$all_project_type = ProjectType::orderBy('project_type')->get();
		$all_network_type = NetworkType::orderBy('network_type')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_planning_status = PlanningStatus::orderBy('planning_status')->get();
		$all_osp_planning_status = OspStatusPlanning::orderBy('osp_status_planning')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
		$all_descriptions = Description::orderBy('id', 'DESC')->get();
		$all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();
		$all_isp_planners = IspPLanners::orderBy('isp_planners')->get();
		$all_surveyors = Surveyors::orderBy('surveyors')->get();
        $site_a_records  =  Site::where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::where('site_type', 'site_b')->get()->toArray(); 
        // call calculate_rx_planning_date function
        $project_type = $record[0]['site_master_record']['type'] ?? '';
        $rx_in_planning_date = $record[0]['datenew'] ?? '';
        $newe_rx_planning_date = $this->calculate_rx_planning_date($project_type,$rx_in_planning_date);
        $view =  view('admin/planning-master-files/planning-resources-single',compact('record','la_records','newe_rx_planning_date','site_a_records','site_b_records','all_project_type','all_network_type','all_rate_mbit_s','all_planning_status','all_osp_planning_status','all_site_status','all_descriptions','all_osp_planners','all_isp_planners','all_surveyors'));
        return $view; 
    }

       //function for single planning  isp a
       public function planning_isp_a_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','landlord_record','site_survey_record')->get()->toArray();
        $la_records  =  Lapop::all()->toArray();
		$all_project_type = ProjectType::orderBy('project_type')->get();
		$all_network_type = NetworkType::orderBy('network_type')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_planning_status = PlanningStatus::orderBy('planning_status')->get();
		$all_osp_planning_status = OspStatusPlanning::orderBy('osp_status_planning')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
		$all_descriptions = Description::orderBy('id', 'DESC')->get();
		$all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();
		$all_isp_planners = IspPLanners::orderBy('isp_planners')->get();
		$all_surveyors = Surveyors::orderBy('surveyors')->get();
        $site_a_records  =  Site::where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::where('site_type', 'site_b')->get()->toArray(); 
        // call calculate_rx_planning_date function
        $project_type = $record[0]['site_master_record']['type'] ?? '';
        $rx_in_planning_date = $record[0]['datenew'] ?? '';
        $newe_rx_planning_date = $this->calculate_rx_planning_date($project_type,$rx_in_planning_date);
        $view =  view('admin/planning-master-files/planning-isp-a-single',compact('record','la_records','newe_rx_planning_date','site_a_records','site_b_records','all_project_type','all_network_type','all_rate_mbit_s','all_planning_status','all_osp_planning_status','all_site_status','all_descriptions','all_osp_planners','all_isp_planners','all_surveyors'));
        return $view; 
    }
    
     //function for single planning  isp b
     public function planning_isp_b_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','landlord_record','site_survey_record')->get()->toArray();
        $la_records  =  Lapop::all()->toArray();
		$all_project_type = ProjectType::orderBy('project_type')->get();
		$all_network_type = NetworkType::orderBy('network_type')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_planning_status = PlanningStatus::orderBy('planning_status')->get();
		$all_osp_planning_status = OspStatusPlanning::orderBy('osp_status_planning')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
		$all_descriptions = Description::orderBy('id', 'DESC')->get();
		$all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();
		$all_isp_planners = IspPLanners::orderBy('isp_planners')->get();
		$all_surveyors = Surveyors::orderBy('surveyors')->get();
        $site_a_records  =  Site::where('site_type', 'site_a')->get()->toArray();
        $site_b_records  =  Site::where('site_type', 'site_b')->get()->toArray(); 
        // call calculate_rx_planning_date function
        $project_type = $record[0]['site_master_record']['type'] ?? '';
        $rx_in_planning_date = $record[0]['datenew'] ?? '';
        $newe_rx_planning_date = $this->calculate_rx_planning_date($project_type,$rx_in_planning_date);
        $view =  view('admin/planning-master-files/planning-isp-b-single',compact('record','la_records','newe_rx_planning_date','site_a_records','site_b_records','all_project_type','all_network_type','all_rate_mbit_s','all_planning_status','all_osp_planning_status','all_site_status','all_descriptions','all_osp_planners','all_isp_planners','all_surveyors'));
        return $view; 
    }

     //function for single planning total project cost
     public function planning_total_project_cost_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
		$all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record')->get()->toArray();
        $view =  view('admin/planning-master-files/planning-total-project-cost-single',compact('record','all_osp_planners'));
        return $view; 
    }

    //function for single planning material service isp a single
    public function planning_material_service_isp_a_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $planning_materials  =  PlanningMaterial::get()->toArray();
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','planning_isp_a_records')->get()->toArray();
        $view =  view('admin/planning-master-files/planning-material-service-isp-a-single',compact('record','planning_materials'));
        return $view; 
    }

    //function for single planning material prices add new
    public function planning_material_service_isp_a_add_new(Request $request){
        $planning_materials  =  PlanningMaterial::get()->toArray(); 
        
        //Check material page type
        if($request->material_page_type == 'isp_a'){?>
            <tr class="material_price_list">
                <td><?php echo $request->servive_id; ?></td>
                <td>
                    <select class="form-control material_stock_code" name="isp_a_material_stock_code[]">
                        <option value="" selected="">Please Select</option>
                        <?php foreach($planning_materials as $planning_material){ ?>
                            <option value="<?php echo $planning_material['stock_code']; ?>"><?php echo $planning_material['stock_code'].' || '.$planning_material['description']; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="text" name="isp_a_material_a_quantity[]" value="1" class="form-control material_quantity"></td>
                <td>
                    <input type="text" name="isp_a_material_list_price[]" value="" class="form-control material_list_price  block-field">
                </td>
                <td><input type="text" name="isp_a_material_extended_price[]" value="" class="form-control material_extended_price  block-field"></td>
            </tr>
        <?php } elseif($request->material_page_type == 'isp_b'){ ?>
            <tr class="material_price_list">
                <td><?php echo $request->servive_id; ?></td>
                <td>
                    <select class="form-control material_stock_code" name="isp_b_material_stock_code[]">
                        <option value="" selected="">Please Select</option>
                        <?php foreach($planning_materials as $planning_material){ ?>
                            <option value="<?php echo $planning_material['stock_code']; ?>"><?php echo $planning_material['stock_code'].' || '.$planning_material['description']; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="text" name="isp_b_material_b_quantity[]" value="1" class="form-control material_quantity"></td>
                <td>
                    <input type="text" name="isp_b_material_list_price[]" value="" class="form-control material_list_price  block-field">
                </td>
                <td><input type="text" name="isp_b_material_extended_price[]" value="" class="form-control material_extended_price  block-field"></td>
            </tr>
        <?php } elseif($request->material_page_type == 'osp'){ ?>
            <tr class="material_price_list">
            <td><?php echo $request->servive_id; ?></td>
            <td>
                <select class="form-control material_stock_code" name="osp_material_stock_code[]">
                    <option value="" selected="">Please Select</option>
                    <?php foreach($planning_materials as $planning_material){ ?>
                        <option value="<?php echo $planning_material['stock_code']; ?>"><?php echo $planning_material['stock_code'].' || '.$planning_material['description']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input type="text" name="osp_material_quantity[]" value="1" class="form-control material_quantity"></td>
            <td>
                <input type="text" name="osp_material_list_price[]" value="" class="form-control material_list_price  block-field">
            </td>
            <td><input type="text" name="osp_material_extended_price[]" value="" class="form-control material_extended_price  block-field"></td>
        </tr>
        <?php } else {
            echo "Page type not matched";
        }
    }

    //function for show planning material price
    public function planning_material_price(Request $request){
        $planning_material_price =  PlanningMaterial::Where('stock_code',$request->material_stock_code)->first();
        $material_price = $planning_material_price->list_price ?? 'R ';

        //price Cal R 6,017.00
        
        $new_list_price = str_replace('R ', '', $material_price);
        $new_list_price2 = str_replace(',', '', $new_list_price);
        $quantity = 1;
        if($request->has('material_quantity')) {
            $quantity = $request->material_quantity;
        } 
        $cal_list_price = $new_list_price2*$quantity;
        $new_cal_list_price = number_format($cal_list_price,2,'.', ',');
        $material_extended_price = "R ".$new_cal_list_price;

        //check if result is exit or not
        $json_material_price_list = null;
        if($planning_material_price){
            $price_data = ['material_price' => $material_price, 'material_extended_price' => $material_extended_price];
            $json_material_price_list = json_encode($price_data);
        }
        echo $json_material_price_list;
    }

    //function for single planning material service isp b single
    public function planning_material_service_isp_b_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $planning_materials  =  PlanningMaterial::get()->toArray();
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','planning_isp_b_records')->get()->toArray();
        $view =  view('admin/planning-master-files/planning-material-service-isp-b-single',compact('record','planning_materials'));
        return $view; 
    }

    //function for single planning material service osp single
    public function planning_material_service_osp_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $planning_materials  =  PlanningMaterial::get()->toArray();
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','planning_osp_records')->get()->toArray();
        $view =  view('admin/planning-master-files/planning-material-service-osp-single',compact('record','planning_materials'));
        return $view; 
    }

    //function for single planning department comment single
    public function planning_department_comment_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $record  =  PlanningMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('permission_record','site_master_record','build_record','department_record')->get()->toArray();
        $view =  view('admin/planning-master-files/planning-department-comments-single',compact('record'));
        return $view; 
    }

        //function for update new record
        public function update_planning_status(Request $request, $circuit_id){  
            $planning_status = $request['planning_status'];  
            $project_status = $request['project_status']; 
            $landlord_approval_status = $request['landlord_approval_status'];
            $site_survey_status = $request['site_survey_status']; 
            $permissions_status = $request['permissions_status'];
            //echo $planning_status;exit;
            $osp_status_panning = $request['osp_status_panning']; 
            $client_name  = $request['client_name'];
            $view_name_site_b = $request['view_name_site_b'];
            $is_email_sent = $request['is_email_sent'];
            $regions = $request['region'];
            //update Query
            $update_master_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update([
            'planning_status' => $planning_status, 'osp_status_panning' => $osp_status_panning ]);
            //Check if data is updated or not
             if($update_master_file_record){
                 
            
            //check project status
			   if($planning_status == 'B) WP1 Stage'){
                    $new_project_status = 'B) New In-Planning';
			    } elseif($planning_status == 'I) WP2 Planning Complete'){
                    $new_project_status = 'I) New In-Build';
                }  elseif($site_survey_status == 'C) Schedule Site Survey' AND $planning_status == 'B) WP1 Stage'){
                    $new_project_status = 'C) In-Survey';
                } elseif($planning_status == 'D) WP2 Stage'  AND  $site_survey_status == 'E) Site Survey Completed'){
                    $new_project_status = 'D) In-Planning';
                }  elseif($site_survey_status == 'F) Not Required' AND $planning_status == 'D) WP2 Stage'){
                    $new_project_status = 'D) In-Planning';  
                }  elseif($planning_status == 'E) Submit for Landlord Approval'  AND  $landlord_approval_status == 'C) Submit for Landlord Approval'){
                    $new_project_status = 'E) Landlord-Approval';
                }  elseif($permissions_status == 'E) Approved' AND $planning_status == 'H) Financial Approval Requested'){
                    $new_project_status = 'H) Financial Approval';
                }  elseif($permissions_status == 'F) Not Required' AND $planning_status == 'H) Financial Approval Requested'){
                    $new_project_status = 'H) Financial Approval';
                }  elseif($permissions_status == 'E) Approved' AND $planning_status == 'F) WP2 Compilation'){
                    $new_project_status = 'D) In-Planning';
                }  elseif($permissions_status == 'F) Not Required' AND $planning_status == 'F) WP2 Compilation'){
                    $new_project_status = 'D) In-Planning';
                }   else {
                    $new_project_status = $project_status;
                }

                //check sales status
                $sales_status = 'A) New Sales';
                if($planning_status == 'Q) Data Fix'){
                    $sales_status = 'F) Data Fix';
                } 
				 //echo $new_project_status;exit;
                $update_record = SiteMasterFile::where('circuit_id',$circuit_id)->update([
                    'project_status' => $new_project_status,
                    'sales_status' => $sales_status,
               ]);

                //send email
                if($new_project_status == 'H) Financial Approval' AND $is_email_sent == 'no'){

                    $details = [
                        'title' => 'Approval',
                        'items' => [
                            'Circuit ID' => $circuit_id,
                            'ISP Name' => $client_name,
                            'Site B Name' => $view_name_site_b,
                        ],
                        'link' => 'https://www.o2cap.co.za/admin/single-financial/' .$circuit_id. '',
                        'type' => 'for aprroval',
                    ];
                
                    //check regions
                    if($regions == 'Northern Region'){
                        $mail = 'rmgp@linkafrica.co.za';
                    } elseif($regions == 'Eastern Region'){
                        $mail = 'rmkzn@linkafrica.co.za';
                    } elseif($regions == 'Western Region'){
                        $mail = 'rmwc@linkafrica.co.za';
                    }
                        Mail::to($mail)->send(new o2capMail($details));
                        $update_email_field = PlanningMasterFile::Where('circuit_id', $circuit_id)->update([
                                                                        "is_email_sent" => 'yes',
                                                                        "financial_approved_date" => Carbon::now()->format('Y-m-d'),
                        ]);  
                        
                        $update = BuildMasterFile::where('circuit_id', $circuit_id)->update([
                                                 "financial_status" => 'B) Submitted for Financial Approval',
                        ]);

                } 
                //send email if  planning status I) WP2 Planning Complete
                if($planning_status == 'I) WP2 Planning Complete'){

                    $details = [
                        'title' => 'Approval',
                        'items' => [
                            'Circuit ID' => $circuit_id,
                            'ISP Name' => $client_name,
                            'Site B Name' => $view_name_site_b,
                        ],
                        'link' => 'https://www.o2cap.co.za/admin/build/build-status-single/' .$circuit_id. '',
                        'type' => 'for Project Released',
                    ];
                
                    //check regions
                    if($regions == 'Northern Region'){
                        $mail = 'bldgp@linkafrica.co.za';
                    } elseif($regions == 'Eastern Region'){
                        $mail = 'bldkzn@linkafrica.co.za';
                    } elseif($regions == 'Western Region'){
                        $mail = 'bldwc@linkafrica.co.za';
                    }
                    //$mail = 'Rakesh@linkafrica.co.za';
                    Mail::to($mail)->send(new o2capMail($details));
                }
                //end email code
                    //Call Common function for planning
                    $this->update_all_single_planning($request,$circuit_id);
                    //Call Common function for update planning materials
                    $this->update_planning_materials($request,$circuit_id);
                    //Call Manage History Helper 
                    $fieldsStr = '';
                    $valuesStr = '';           
                    $module_type = "Planning";
                    $page_name = url()->previous();
                    Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
                    return back()->with('success','Record Updated Successfully');
                } else {
                    return back()->with('unsuccess','Opps Something wrong!');
                }
		}

       
        // common function for update planning single page
        public function update_all_single_planning($request,$circuit_id){
                $site_master_record = [
                                     'type' => $request['type'],
                                     'feasibility_ref_nr' => $request['feasibility_ref_nr'],
                                     'network_types' => $request['network_types'],
                                     'site_a' => $request['site_a'],     
                                     'contact_name_site_a' => $request['contact_name_site_a'],
                                     'physical_address_site_a' => $request['physical_address_site_a'],
                                     'gps_co_ordinates_site_a_x' => $request['gps_co_ordinates_site_a_x'],
                                     'gps_co_ordinates_site_a_y' => $request['gps_co_ordinates_site_a_y'],
                                     'work_number_site_a' => $request['work_number_site_a'],
                                     'mobile_number_site_a' => $request['mobile_number_site_a'],
                                     'email_address_site_a' => $request['email_address_site_a'],
                                     'site_b' => $request['site_b'],          
                                     'contact_name_site_b' => $request['contact_name_site_b'],
                                     'physical_address_site_b' => $request['physical_address_site_b'],
                                     'gps_co_ordinates_site_b_x' => $request['gps_co_ordinates_site_b_x'],
                                     'gps_co_ordinates_site_b_y' => $request['gps_co_ordinates_site_b_y'],
                                     'work_number_site_b' => $request['work_number_site_b'],
                                     'mobile_number_site_b' => $request['mobile_number_site_b'],
                                     'email_address_site_b' => $request['email_address_site_b'],
                                     'description' => $request['description'],
                                     'core_network_colocation_facilities' => $request['core_network_colocation_facilities'],
                                     'rack_space_18u' => $request['rack_space_18u'],
                                     'rack_space_9u_core_access_active' => $request['rack_space_9u_core_access_active'],
                                     'rack_space_9u_core_access_passive' => $request['rack_space_9u_core_access_passive'],
                                     'rack_space_1u_passive' => $request['rack_space_1u_passive'],
                                     'crossconnect' => $request['crossconnect'],
                                     'technical_hands' => $request['technical_hands'],
                                     'sla' => $request['sla'],
                                     'sla_premium' => $request['sla_premium'],
                                     'rate_mbit_s' => $request['rate_mbit_s'],
                                     'strands' => $request['strands'],
                                ];
         //Get request for planning records        
          $site_a_survey_date = null;
          if( $request['site_a_survey_date']){
          $site_a_survey_date = Carbon::parse($request['site_a_survey_date']);
          }
          $site_a_isp_submission = null;
          if( $request['site_a_isp_submission']){
          $site_a_isp_submission = Carbon::parse($request['site_a_isp_submission']);
          }
          $isp_a_wp2_approval_received = null;
          if( $request['isp_a_wp2_approval_received']){
          $isp_a_wp2_approval_received = Carbon::parse($request['isp_a_wp2_approval_received']);
          }
          $isp_a_wp2_approval_requested = null;
          if( $request['isp_a_wp2_approval_requested']){
          $isp_a_wp2_approval_requested = Carbon::parse($request['isp_a_wp2_approval_requested']);
          }

          $planning_wp2_wl_submission = null;
          if( $request['planning_wp2_wl_submission']){
          $planning_wp2_wl_submission = Carbon::parse($request['planning_wp2_wl_submission']);
          }

          $revised_planned_wp2_date = null;
          if( $request['revised_planned_wp2_date']){
          $revised_planned_wp2_date = Carbon::parse($request['revised_planned_wp2_date']);
          }

          $wp2_approval_requested = null;
          if( $request['wp2_approval_requested']){
          $wp2_approval_requested = Carbon::parse($request['wp2_approval_requested']);
          }

          $wp2_approval_received = null;
          if( $request['wp2_approval_received']){
          $wp2_approval_received = Carbon::parse($request['wp2_approval_received']);
          }

          $site_b_survey_date = null;
          if( $request['site_b_survey_date']){
          $site_b_survey_date = Carbon::parse($request['site_b_survey_date']);
          }

          $site_b_isp_submission = null;
          if( $request['site_b_isp_submission']){
          $site_b_isp_submission = Carbon::parse($request['site_b_isp_submission']);
          }
          $isp_b_wp2_approval_received = null;
          if( $request['isp_b_wp2_approval_received']){
          $isp_b_wp2_approval_received = Carbon::parse($request['isp_b_wp2_approval_received']);
          }
          $isp_b_wp2_approval_requested = null;
          if( $request['isp_b_wp2_approval_requested']){
          $isp_b_wp2_approval_requested = Carbon::parse($request['isp_b_wp2_approval_requested']);
          }

          $rx_in_planning = null;
          if( $request['rx_in_planning']){
          $rx_in_planning = Carbon::parse($request['rx_in_planning']);
          }

          $planning_record = [
                                     //'planning_status' => $request['planning_status'],
                                     'rx_in_planning' => $rx_in_planning,
                                     'site_a_status' => $request['site_a_status'],
                                     'site_b_status' => $request['site_b_status'],
                                     'link_dependency' => $request['link_dependency'],
                                     'site_a_survey_date' => $site_a_survey_date,
                                     'site_a_isp_submission' => $site_a_isp_submission,
                                     'isp_a_wp2_approval_received' => $isp_a_wp2_approval_received,
                                     'isp_a_wp2_approval_requested' => $isp_a_wp2_approval_requested,
                                     'planning_wp2_wl_submission' => $planning_wp2_wl_submission,
                                     'revised_planned_wp2_date' => $revised_planned_wp2_date,
                                     'wp2_approval_requested' => $wp2_approval_requested,
                                     'wp2_approval_received' => $wp2_approval_received,
                                     'site_b_survey_date' => $site_b_survey_date,
                                     'site_b_isp_submission' => $site_b_isp_submission,
                                     'isp_b_wp2_approval_received' => $isp_b_wp2_approval_received,
                                     'isp_b_wp2_approval_requested' => $isp_b_wp2_approval_requested,
                                     'osp_planners' => $request['osp_planners'],
                                     'isp_planners' => $request['isp_planners'],
                                     'surveyors' => $request['surveyors'],  
                                     'comment' => $request['Comment'],                      
          ];

            //Get request for build records
            $build_record =    [
                                     'osp_asbuild_received' => $request['osp_asbuild_received'],
                                     'isp_asbuild_received' => $request['isp_asbuild_received'],
                               ]; 
             
            //Get request for permission records
            $wayleaves_submitted = null;
            if( $request['wayleaves_submitted']){
            $wayleaves_submitted = Carbon::parse($request['wayleaves_submitted']);
            }  
            $wayleaves_received = null;
            if( $request['wayleaves_received']){
            $wayleaves_received = Carbon::parse($request['wayleaves_received']);
            }
            $permission_record = [
                                    'wayleaves_submitted' =>  $wayleaves_submitted,
                                    'wayleaves_estimated' =>  $request['wayleaves_estimated'],
                                    'wayleaves_received' =>  $wayleaves_received,
                                    'wayleaves_status' => $request['wayleaves_status'],
                                 ];
           
            //Update Planing
            $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update($planning_record);
            $update_site_master_file_record = SiteMasterFile::Where('circuit_id', $circuit_id)->update($site_master_record);
            $update_build_master_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update($build_record);
            $update_permission_master_file_record = PermissionMasterFile::Where('circuit_id', $circuit_id)->update($permission_record);

        }
       
        //function for update planning total cost
        public function update_total_project_cost_data(Request $request, $id){
          
            $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $id)->update([

            'site_a_id' => $request['site_a_id'],
            'site_b_id' => $request['site_b_id'],
            'osp_planners' => $request['osp_planners'],
            'labour_cost_vo_isp_a' => $request['labour_cost_vo_isp_a'],
            'material_cost_vo_isp_a' => $request['material_cost_vo_isp_a'],
            'total_boq_value_vo_isp_a' => $request['total_boq_value_vo_isp_a'],
            'osp_status_panning' => $request['osp_status_panning'],
            'labour_cost_isp_b' => $request['labour_cost_isp_b'],
            'material_cost_isp_b' => $request['material_cost_isp_b'],
            'total_boq_value_isp_b' => $request['total_boq_value_isp_b'],
            'labour_cost_vo_osp' => $request['labour_cost_vo_osp'],
            'material_cost_vo_osp' => $request['material_cost_vo_osp'],
            'total_boq_value_vo_osp' => $request['total_boq_value_vo_osp'],
            'labour_cost_vo_isp_b' => $request['labour_cost_vo_isp_b'],
            'material_cost_vo_isp_b' => $request['material_cost_vo_isp_b'],
            'total_boq_value_vo_isp_b' => $request['total_boq_value_vo_isp_b'],
            'labour_cost_isp_a' => $request['labour_cost_isp_a'],
            'material_cost_isp_a' => $request['material_cost_isp_a'],
            'isp_a_distance_trench' => $request['isp_a_distance_trench'],
            'isp_a_la_existing_duct' => $request['isp_a_la_existing_duct'],
            'isp_a_distance_focus' => $request['isp_a_distance_focus'],
            'isp_a_distance_3rd_party_ducts' => $request['isp_a_distance_3rd_party_ducts'],
            'isp_a_la_existing_network' => $request['isp_a_la_existing_network'],
            'isp_a_in_buildin_conduits' => $request['isp_a_in_buildin_conduits'],
            'labour_cost_isp_b' => $request['labour_cost_isp_b'],
            'material_cost_isp_b' => $request['material_cost_isp_b'],
            'isp_b_distance_trench' => $request['isp_b_distance_trench'],
            'isp_b_la_existing_duct' => $request['isp_b_la_existing_duct'],
            'isp_b_distance_focus' => $request['isp_b_distance_focus'],
            'isp_b_distance_3rd_party_ducts' => $request['isp_b_distance_3rd_party_ducts'],
            'isp_b_la_existing_network' => $request['isp_b_la_existing_network'],
            'isp_b_in_buildin_conduits' => $request['isp_b_in_buildin_conduits'],
            'isp_b_total_distance' => $request['isp_b_total_distance'],
            'labour_cost_osp' => $request['labour_cost_osp'],
            'material_cost_osp' => $request['material_cost_osp'],
            'osp_distance_trench' => $request['osp_distance_trench'],
            'osp_la_existing_duct' => $request['osp_la_existing_duct'],
            'osp_distance_focus' => $request['osp_distance_focus'],
            'osp_distance_3rd_party_ducts' => $request['osp_distance_3rd_party_ducts'],
            'osp_la_existing_network' => $request['osp_la_existing_network'],
            'osp_in_buildin_conduits' => $request['osp_in_buildin_conduits'],
            'ops_total_distance' => $request['ops_total_distance'],
            'total_boq_value_isp_a' => $request['total_boq_value_isp_a'],
            'labour_cost_osp' => $request['labour_cost_osp'],
            'material_cost_osp' => $request['material_cost_osp'],
            'total_boq_value_osp' => $request['total_boq_value_osp'],
            'isp_a_total_distance' => $request['isp_a_total_distance'],   
            ]);

        

        if($update_planning_master_file_record){  
             //Call Manage History Helper
             $fieldsStr = '';
            $valuesStr = '';           
            $module_type = "Planning";
            $page_name = url()->previous();
            Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
            return back()->with('success','Record Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }

        }


        //update material isp a
        public function update_material_isp_a(Request $request, $id){
          
            $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $id)->update([
                'labour_cost_isp_a' => $request['labour_cost_isp_a'],
                'material_cost_isp_a' => $request['material_cost_isp_a'],
                'total_boq_value_isp_a' => $request['total_boq_value_isp_a'],
                'labour_cost_vo_isp_a' => $request['labour_cost_vo_isp_a'],
                'material_cost_vo_isp_a' => $request['material_cost_vo_isp_a'],
                'total_boq_value_vo_isp_a' => $request['total_boq_value_vo_isp_a'],
                'isp_a_distance_trench' => $request['isp_a_distance_trench'],
                'isp_a_la_existing_duct' => $request['isp_a_la_existing_duct'],
                'isp_a_distance_focus' => $request['isp_a_distance_focus'],
                'isp_a_distance_3rd_party_ducts' => $request['isp_a_distance_3rd_party_ducts'],
                'isp_a_la_existing_network' => $request['isp_a_la_existing_network'],
                'isp_a_in_buildin_conduits' => $request['isp_a_in_buildin_conduits'],
                'isp_a_total_distance' => $request['isp_a_total_distance'],
            ]);
            if($update_planning_master_file_record){  
                //Call Common function for update planning materials
                $this->update_planning_materials($request,$id);
                //Call Manage History Helper
                $fieldsStr = '';
                $valuesStr = '';  
                $module_type = "Material Isp A";
                $page_name = url()->previous();
                Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
                return back()->with('success','Record Updated Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            }
    
            }

             //update material isp b
        public function update_material_isp_b(Request $request, $id){
          
            $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $id)->update([
                'labour_cost_isp_b' => $request['labour_cost_isp_b'],
                'material_cost_isp_b' => $request['material_cost_isp_b'],
                'total_boq_value_isp_b' => $request['total_boq_value_isp_b'],
                'labour_cost_vo_isp_b' => $request['labour_cost_vo_isp_b'],
                'material_cost_vo_isp_b' => $request['material_cost_vo_isp_b'],
                'total_boq_value_vo_isp_b' => $request['total_boq_value_vo_isp_b'],
                'isp_b_distance_trench' => $request['isp_b_distance_trench'],
                'isp_b_la_existing_duct' => $request['isp_b_la_existing_duct'],
                'isp_b_distance_focus' => $request['isp_b_distance_focus'],
                'isp_b_distance_3rd_party_ducts' => $request['isp_b_distance_3rd_party_ducts'],
                'isp_b_la_existing_network' => $request['isp_b_la_existing_network'],
                'isp_b_in_buildin_conduits' => $request['isp_b_in_buildin_conduits'],
                'isp_b_total_distance' => $request['isp_b_total_distance'],
            ]);
            if($update_planning_master_file_record){ 
                //Call Common function for update planning materials
                $this->update_planning_materials($request,$id); 
                //Call Manage History Helper
                $fieldsStr = '';
                $valuesStr = '';  
                $module_type = "Material Isp B";
                $page_name = url()->previous();
                Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
                return back()->with('success','Record Updated Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            }
    
            }

                  //update material isp b
        public function update_material_osp(Request $request, $id){
          
            $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $id)->update([
                'labour_cost_osp' => $request['labour_cost_osp'],
                'material_cost_osp' => $request['material_cost_osp'],
                'total_boq_value_osp' => $request['total_boq_value_osp'],
                'labour_cost_vo_osp' => $request['labour_cost_vo_osp'],
                'material_cost_vo_osp' => $request['material_cost_vo_osp'],
                'total_boq_value_vo_osp' => $request['total_boq_value_vo_osp'],
                'osp_distance_trench' => $request['osp_distance_trench'],
                'osp_la_existing_duct' => $request['osp_la_existing_duct'],
                'osp_distance_focus' => $request['osp_distance_focus'],
                'osp_distance_3rd_party_ducts' => $request['osp_distance_3rd_party_ducts'],
                'osp_la_existing_network' => $request['osp_la_existing_network'],
                'osp_in_buildin_conduits' => $request['osp_in_buildin_conduits'],
                'ops_total_distance' => $request['ops_total_distance'],
            ]);
            if($update_planning_master_file_record){  
                //Call Common function for update planning materials
                $this->update_planning_materials($request,$id); 
                //Call Manage History Helper
                $module_type = "Material OSP";
                $fieldsStr = '';
                $valuesStr = ''; 
                $page_name = url()->previous();
                Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
                return back()->with('success','Record Updated Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            }
    
            }
        //Function for update planning materials
        public function update_planning_materials($request,$circuit_id)
        {
            //Check if isp_a is exit
            if ($request->has('isp_a_material_stock_code')) {
                $isp_a_material_stock_code = $request->isp_a_material_stock_code;
                foreach($isp_a_material_stock_code as $key => $stock_code){
                    $isp_a_material_stock_code_new = $request->isp_a_material_stock_code[$key];
                    $isp_a_material_a_quantity = $request->isp_a_material_a_quantity[$key];
                    $isp_a_material_list_price = $request->isp_a_material_list_price[$key];
                    //update Isp A
                    PlanningMaterialIspA::updateOrCreate([
                                                        'circuit_id'=> $circuit_id, 
                                                        'stock_code'=> $isp_a_material_stock_code_new],
                                                        [
                                                            'service_id' => $circuit_id,
                                                            'circuit_id' => $circuit_id,
                                                            'stock_code' => $isp_a_material_stock_code_new,
                                                            'quantity' => $isp_a_material_a_quantity,
                                                            'isp_a_build_type' => 'ISP_A'
                                                        ]
                                                    );
                    
                    
                }
            }

            //Check if isp_b is exit
            if ($request->has('isp_b_material_stock_code')) {
                $isp_b_material_stock_code = $request->isp_b_material_stock_code;
                foreach($isp_b_material_stock_code as $key => $stock_code){
                    $isp_b_material_stock_code_new = $request->isp_b_material_stock_code[$key];
                    $isp_b_material_b_quantity = $request->isp_b_material_b_quantity[$key];
                    $isp_b_material_list_price = $request->isp_b_material_list_price[$key];
                    //update Isp B
                    PlanningMaterialIspB::updateOrCreate([
                                                        'circuit_id'=> $circuit_id, 
                                                        'stock_code'=> $isp_b_material_stock_code_new],
                                                        [
                                                            'service_id' => $circuit_id,
                                                            'circuit_id' => $circuit_id,
                                                            'stock_code' => $isp_b_material_stock_code_new,
                                                            'quantity' => $isp_b_material_b_quantity,
                                                            'isp_a_build_type' => 'ISP_B'
                                                        ]
                                                    );
                    
                    
                }
            }

            //Check if osp is exit
            if ($request->has('osp_material_stock_code')) {
                $osp_material_stock_code = $request->osp_material_stock_code;
                foreach($osp_material_stock_code as $key => $stock_code){
                    $osp_material_stock_code_new = $request->osp_material_stock_code[$key];
                    $osp_material_quantity = $request->osp_material_quantity[$key];
                    $osp_material_list_price = $request->osp_material_list_price[$key];
                    //update Osp
                    PlanningMaterialOsp::updateOrCreate([
                                                        'circuit_id'=> $circuit_id, 
                                                        'stock_code'=> $osp_material_stock_code_new],
                                                        [
                                                            'service_id' => $circuit_id,
                                                            'circuit_id' => $circuit_id,
                                                            'stock_code' => $osp_material_stock_code_new,
                                                            'quantity' => $osp_material_quantity,
                                                            'osp_build_type' => 'OSP'
                                                        ]
                                                    );
                    
                    
                }
            }
        }

        //function to calculate rx planning xdate
        public function calculate_rx_planning_date($project_type,$rx_in_planning_date)
        {
            $rx_in_planning = Carbon::parse($rx_in_planning_date);
            $planned_wp2_released_date = "";
            if($project_type == "Equipment And Splicing"){
                $planned_wp2_released_date = $rx_in_planning->addDays(10)->format('m/d/Y');
            }elseif($project_type == "OSP ISP With No Wayleaves"){
                $planned_wp2_released_date = $rx_in_planning->addDays(40)->format('m/d/Y'); 
            }elseif($project_type == "OSP ISP With Wayleaves FTTB"){
                $planned_wp2_released_date = $rx_in_planning->addDays(49)->format('m/d/Y'); 
            }elseif($project_type == "OSP ISP With Wayleaves FTTS"){
                $planned_wp2_released_date = $rx_in_planning->addDays(49)->format('m/d/Y');
            }elseif($project_type == "OSP ISP With Wayleaves Other"){
                $planned_wp2_released_date = $rx_in_planning->addDays(49)->format('m/d/Y');
            }elseif($project_type == "NET4"){
                $planned_wp2_released_date = $rx_in_planning->addDays(4)->format('m/d/Y');
            }elseif($project_type == "NET6"){
                $planned_wp2_released_date = $rx_in_planning->addDays(40)->format('m/d/Y');
            }elseif($project_type == "Managed Ports"){
                $planned_wp2_released_date = $rx_in_planning->addDays(4)->format('m/d/Y');
            }elseif($project_type == "Upgrade or Downgrade"){
                $planned_wp2_released_date = $rx_in_planning->addDays(4)->format('m/d/Y');
            }elseif($project_type == "NET2"){
                $planned_wp2_released_date = $rx_in_planning->addDays(10)->format('m/d/Y');
            }elseif($project_type == "NET3.2"){
                $planned_wp2_released_date = $rx_in_planning->addDays(10)->format('m/d/Y');
            }elseif($project_type == "FTTH Orders"){
                $planned_wp2_released_date = $rx_in_planning->addDays(2)->format('m/d/Y');
            }elseif($project_type == "ISP NET1"){
                $planned_wp2_released_date = $rx_in_planning->addDays(10)->format('m/d/Y');
            }
            return $planned_wp2_released_date;
        }
}
