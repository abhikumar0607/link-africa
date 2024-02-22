<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuildMasterFile;
use App\Models\SiteMasterFile;
use App\Models\PlanningMasterFile;
use App\Models\DepartmentComment;
use App\Models\PermissionMasterFile;
use App\Models\PlanningMaterial;
use App\Models\PlanningMaterialIspA;
use App\Models\PlanningMaterialIspB;
use App\Models\PlanningMaterialOsp;
use App\Models\BuildStatus;
use App\Models\BuildOSPStatus;
use App\Models\SiteStatus;
use App\Models\OSPPLanners;
use App\Models\Attachment;
use App\Models\Sd_Status;
use App\Models\Year;
use App\Models\Week;
use App\Models\AddComment;
use App\Models\ResourceTeam;
use Carbon\Carbon;
use Helper;
use App\Mail\o2capMail;
use Illuminate\Support\Facades\Mail;

class BuildMasterFileController extends Controller
{
    //Function for show index view file
    public function index(){
        $all_records = BuildMasterFile::orderBy('id', 'DESC')->paginate(50);
        $view =  view('admin/build-master-files/all-list', compact('all_records'));
        return $view;
    }
    
    
    //Function for show single record view file
    public function single_record($id){
        $record = BuildMasterFile::where('id', $id)->get()->toArray();
        //echo "<pre>"; print_r($record); echo "</pre>";exit;
        $view =  view('admin/build-master-files/single-record',compact('record'));
        return $view;
    }

    //function for search records
    public function search_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        $view =  view('admin/build-master-files/search-list', compact('all_records'));
        return $view;
    }
	//function for search records
    public function search_project_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        $view =  view('admin/build-master-files/search-project-cost', compact('all_records'));
        return $view;
    }
	//function for search records
    public function search_material_isp_a_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        $view =  view('admin/build-master-files/search-material-isp-a', compact('all_records'));
        return $view;
    }
	//function for search records
    public function search_material_isp_b_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        $view =  view('admin/build-master-files/search-material-isp-b', compact('all_records'));
        return $view;
    }
	//function for search records
    public function search_material_osp_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        $view =  view('admin/build-master-files/search-material-osp', compact('all_records'));
        return $view;
    }
		//function for search records
    public function search_department_comment_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        }
        $view =  view('admin/build-master-files/search-department-comment', compact('all_records'));
        return $view;
    }
    
    //function for update new record
    public function update_new_record(Request $request, $id){
		//validation rule
        request()->validate([
            'service_id' => 'required', 'string', 'max:255',
        ]);
        
        $build_status = $request['build_status'];
        $build_duration = $request['build_duration'];
        $planned_start_date = null;
        if($request['planned_start_date']){
        $planned_start_date = Carbon::parse($request['planned_start_date']);
        }
        $revised_build_start_date = null;
        if($request['revised_build_start_date']){
        $revised_build_start_date = Carbon::parse($request['revised_build_start_date']);
        }
        $revised_build_co_date = null;
        if($request['revised_build_start_date']){
        $revised_build_co_date = Carbon::parse($request['revised_build_co_date']);
        }
        $actual_build_completion_date = null;
        if($request['actual_build_completion_date']){
        $actual_build_completion_date = Carbon::parse($request['actual_build_completion_date']);
        }
        $isp_contractor = $request['isp_contractor'];
        $osp_contractor = $request['osp_contractor'];
        $project_leader = $request['project_leader'];
        $build_completion = $request['build_completion'];
      
        $toc_submitted = null;
        if($request['toc_submitted']){
        $toc_submitted = Carbon::parse($request['toc_submitted']);
        }
        $toc_submitted = null;
        if($request['toc_submitted']){
        $toc_submitted = Carbon::parse($request['toc_submitted']);
        }
        $toc_received = null;
        if($request['toc_received']){
        $toc_received = Carbon::parse($request['toc_received']);
        }
        $otoc = $request['otoc'];
        $potoc = $request['potoc'];
        $comments = $request['comments'];
        $po_requested = null;
        if($request['po_requested']){
        $po_requested = Carbon::parse($request['po_requested']);
        }
        
        $po_received = null;
        if($request['po_received']){
        $po_received = Carbon::parse($request['po_received']);
        }
        
        $isp_a_project_leader = $request['isp_a_project_leader'];
        $isp_a_civil_contractor = $request['isp_a_civil_contractor'];
        $isp_a_jetting_contractor = $request['isp_a_jetting_contractor'];
        $isp_a_re_instatement_contractor = $request['isp_a_re_instatement_contractor'];
        $isp_a_drilling_contractor = $request['isp_a_drilling_contractor'];
        $isp_a_floating_contractor = $request['isp_a_floating_contractor'];
        $isp_a_focus_contractor = $request['isp_a_focus_contractor'];
        $isp_b_project_leader = $request['isp_b_project_leader'];
        $isp_b_civil_contractor = $request['isp_b_civil_contractor'];
        $isp_b_jetting_contractor = $request['isp_b_jetting_contractor'];
        $isp_b_re_instatement_contractor = $request['isp_b_re_instatement_contractor'];
        $isp_b_drilling_contractor = $request['isp_b_drilling_contractor'];
        $isp_b_floating_contractor = $request['isp_b_floating_contractor'];
        $isp_b_focus_contractor = $request['isp_b_focus_contractor'];
        $osp_project_leader = $request['osp_project_leader'];
        $osp_civil_contractor = $request['osp_civil_contractor'];
        $osp_jetting_contractor = $request['osp_jetting_contractor'];
        $osp_re_instatement_contractor = $request['osp_re_instatement_contractor'];
        $osp_drilling_contractor = $request['osp_drilling_contractor'];
        $osp_focus_contractor = $request['osp_focus_contractor'];
        $splicing_team = $request['splicing_team'];
        $name = $request['name'];
        //$province = $request['province'];
        $province= null;
        if($request['province']){
        $province = Carbon::parse($request['province']);
        }
        $build_planned_completion_dates= null;
        if($request['build_planned_completion_dates']){
        $build_planned_completion_dates = Carbon::parse($request['build_planned_completion_dates']);
        }
        
        $osp_asbuild_submission= null;
        if($request['osp_asbuild_submission']){
        $osp_asbuild_submission = Carbon::parse($request['osp_asbuild_submission']);
        }
        
        $isp_asbuild_submission= null;
        if($request['isp_asbuild_submission']){
        $isp_asbuild_submission = Carbon::parse($request['isp_asbuild_submission']);
        }
        
        $osp_asbuild_received= null;
        if($request['osp_asbuild_received']){
        $osp_asbuild_received = Carbon::parse($request['osp_asbuild_received']);
        }
        
        
        $isp_asbuild_received= null;
        if($request['isp_asbuild_received']){
        $isp_asbuild_received = Carbon::parse($request['isp_asbuild_received']);
        }
        
        $vo_submitted= null;
        if($request['vo_submitted']){
        $vo_submitted = Carbon::parse($request['vo_submitted']);
        }
        
        $vo_received= null;
        if($request['vo_received']){
        $vo_received = Carbon::parse($request['vo_received']);
        }
        
        $vo_po_requested= null;
        if($request['vo_po_requested']){
        $vo_po_requested = Carbon::parse($request['vo_po_requested']);
        }
        
        $vo_po_received= null;
        if($request['vo_po_received']){
        $vo_po_received = Carbon::parse($request['vo_po_received']);
        }
        
         $vo_submitted2= null;
        if($request['vo_submitted2']){
        $vo_submitted2 = Carbon::parse($request['vo_submitted2']);
        }
        
         $vo_received2= null;
        if($request['vo_received2']){
        $vo_received2 = Carbon::parse($request['vo_received2']);
        }
        
         $vo_po_requested2= null;
        if($request['vo_po_requested2']){
        $vo_po_requested2 = Carbon::parse($request['vo_po_requested2']);
        }
        
         $vo_po_received2= null;
        if($request['vo_po_received2']){
        $vo_po_received2 = Carbon::parse($request['vo_po_received2']);
        }
        
         $vo_submitted3 = null;
        if($request['vo_submitted3']){
        $vo_submitted3 = Carbon::parse($request['vo_submitted3']);
        }
        
         $vo_received3 = null;
        if($request['vo_received3']){
        $vo_received3 = Carbon::parse($request['vo_received3']);
        }
        
         $vo_po_requested3= null;
        if($request['vo_po_requested3']){
        $vo_po_requested = Carbon::parse($request['vo_po_requested3']);
        }
        
         $vo_po_received3= null;
        if($request['vo_po_received3']){
        $vo_po_received3 = Carbon::parse($request['vo_po_received3']);
        }
        
         $vo_submitted4= null;
        if($request['vo_submitted4']){
        $vo_submitted4 = Carbon::parse($request['vo_submitted4']);
        }
        
         $vo_received4= null;
        if($request['vo_received4']){
        $vo_received4 = Carbon::parse($request['vo_received4']);
        }
        
         $vo_po_requested4 = null;
        if($request['vo_po_requested4']){
        $vo_po_requested4 = Carbon::parse($request['vo_po_requested4']);
        }
        
         $vo_po_received4= null;
        if($request['vo_po_received4']){
        $vo_po_received4 = Carbon::parse($request['vo_po_received4']);
        }
        
         $vo_po_requested3= null;
        if($request['vo_po_received4']){
        $vo_po_received4 = Carbon::parse($request['vo_po_received4']);
        }
        
        $build_osp_status = $request['build_osp_status'];
        
         $qa_requested= null;
        if($request['fac_submitted']){
        $qa_requested = Carbon::parse($request['qa_requested']);
        }
        
         $fac_submitted= null;
        if($request['vo_po_received4']){
        $fac_submitted = Carbon::parse($request['fac_submitted']);
        }
        
          $fac_received= null;
        if($request['fac_received']){
        $fac_received = Carbon::parse($request['fac_received']);
        }
        $actual_osp_build_distance_trench = $request['actual_osp_build_distance_trench'];
        $actual_osp_build_distance_3rd_party_ducts = $request['actual_osp_build_distance_3rd_party_ducts'];
        $actual_osp_build_la_existing_duct = $request['actual_osp_build_la_existing_duct'];
        $actual_osp_build_la_existing_network = $request['actual_osp_build_la_existing_network'];
        $actual_osp_build_in_building_conduits = $request['actual_osp_build_in_building_conduits'];
        $actual_osp_110_sleeves_build = $request['actual_osp_110_sleeves_build'];
        $actual_osp_drilling_distance_build = $request['actual_osp_drilling_distance_build'];
        $actual_osp_micro_duct_distance_build = $request['actual_osp_micro_duct_distance_build'];
        $actual_ops_build_total_distance = $request['actual_ops_build_total_distance'];
        $actual_osp_mh_500_x_500_build = $request['actual_osp_mh_500_x_500_build'];
        $actual_osp_mh_1000_x_500_build = $request['actual_osp_mh_1000_x_500_build'];
        $osp_asb_trench = $request['osp_asb_trench'];
        $osp_asb_3rd_party_ducts = $request['osp_asb_3rd_party_ducts'];
        $osp_asb_la_existing_duct = $request['osp_asb_la_existing_duct'];
        $osp_asb_existing_network = $request['osp_asb_existing_network'];
        $osp_asb_distance_focus = $request['osp_asb_distance_focus'];
        $osp_asb_in_building_conduits = $request['osp_asb_in_building_conduits'];
        $isp_a_asb_trench = $request['isp_a_asb_trench'];
        $isp_a_asb_3rd_party_ducts = $request['isp_a_asb_3rd_party_ducts'];
        $isp_a_asb_la_existing_duct = $request['isp_a_asb_la_existing_duct'];
        $isp_a_asb_existing_network = $request['isp_a_asb_existing_network'];
        $isp_a_asb_distance_focus = $request['isp_a_asb_distance_focus'];
        $isp_a_asb_in_building_conduits = $request['isp_a_asb_in_building_conduits'];
        $isp_b_asb_trench = $request['isp_b_asb_trench'];
        $isp_b_asb_3rd_party_ducts = $request['isp_b_asb_3rd_party_ducts'];
        $isp_b_asb_la_existing_duct = $request['isp_b_asb_la_existing_duct'];
        $isp_b_asb_existing_network = $request['isp_b_asb_existing_network'];
        $isp_b_asb_distance_focus = $request['isp_b_asb_distance_focus'];
        $isp_b_asb_in_building_conduits = $request['isp_b_asb_in_building_conduits'];
        $actual_build_completion = $request['actual_build_completion'];
        $actual_osp_build_distance_focus = $request['actual_osp_build_distance_focus'];
        $mat = $request['mat'];
        
        $otdr_distance= null;
        if($request['otdr_distance']){
        $otdr_distance = Carbon::parse($request['otdr_distance']);
        }
        $final_sectional_date= null;
        if($request['final_sectional_date']){
        $final_sectional_date = Carbon::parse($request['final_sectional_date']);
        }
        
        //update query
        $update_master_file_record = BuildMasterFile::Where('id', $id)->update([
                                'build_status' => $build_status,
                                'build_duration' => $build_duration,
                                'planned_start_date' => $planned_start_date,
                                'revised_build_start_date' => $revised_build_start_date,
                                'revised_build_co_date' => $revised_build_co_date,
                                'actual_build_completion_date' => $actual_build_completion_date,
                                'isp_contractor' => $isp_contractor,
                                'osp_contractor' => $osp_contractor,
                                'project_leader' => $project_leader,
                                'build_completion' => $build_completion,
                                'toc_submitted' => $toc_submitted,
                                'toc_received' => $toc_received,
                                'otoc' => $otoc,
                                'potoc' => $potoc,
                                'comments' => $comments,
                                'po_requested' => $po_requested,
                                'po_received' => $po_received,
                                'isp_a_project_leader' => $isp_a_project_leader,
                                'isp_a_civil_contractor' => $isp_a_civil_contractor,
                                'isp_a_jetting_contractor' => $isp_a_jetting_contractor,
                                'isp_a_re_instatement_contractor' => $isp_a_re_instatement_contractor,
                                'isp_a_drilling_contractor' => $isp_a_drilling_contractor,
                                'isp_a_floating_contractor' => $isp_a_floating_contractor,
                                'isp_a_focus_contractor' => $isp_a_focus_contractor,
                                'isp_b_project_leader' => $isp_b_project_leader,
                                'isp_b_civil_contractor' => $isp_b_civil_contractor,
                                'isp_b_jetting_contractor' => $isp_b_jetting_contractor,
                                'isp_b_re_instatement_contractor' => $isp_b_re_instatement_contractor,
                                'isp_b_drilling_contractor' => $isp_b_drilling_contractor,
                                'isp_b_floating_contractor' => $isp_b_floating_contractor,
                                'isp_b_focus_contractor' => $isp_b_focus_contractor,
                                'osp_project_leader' => $osp_project_leader,
                                'osp_civil_contractor' => $osp_civil_contractor,
                                'osp_jetting_contractor' => $osp_jetting_contractor,
                                'osp_re_instatement_contractor' => $osp_re_instatement_contractor,
                                'osp_drilling_contractor' => $osp_drilling_contractor,
                                'osp_focus_contractor' => $osp_focus_contractor,
                                'splicing_team' => $splicing_team,
                                'name' => $name,
                                'province' => $province,
                                'build_planned_completion_dates' => $build_planned_completion_dates,
                                'osp_asbuild_submission' => $osp_asbuild_submission,
                                'isp_asbuild_submission' => $isp_asbuild_submission,
                                'osp_asbuild_received' => $osp_asbuild_received,
                                'isp_asbuild_received' => $isp_asbuild_received,
                                'vo_submitted' => $vo_submitted,
                                'vo_received' => $vo_received,
                                'vo_po_requested' => $vo_po_requested,
                                'vo_po_received' => $vo_po_received,
                                'vo_submitted2' => $vo_submitted2,
                                'vo_received2' => $vo_received2,
                                'vo_po_requested2' => $vo_po_requested2,
                                'vo_po_received2' => $vo_po_received2,
                                'vo_submitted3' => $vo_submitted3,
                                'vo_received3' => $vo_received3,
                                'vo_po_requested3' => $vo_po_requested3,
                                'vo_po_received3' => $vo_po_received3,
                                'vo_submitted4' => $vo_submitted4,
                                'vo_received4' => $vo_received4,
                                'vo_po_requested4' => $vo_po_requested4,
                                'vo_po_received4' => $vo_po_received4,
                                'build_osp_status' => $build_osp_status,
                                'qa_requested' => $qa_requested,
                                'fac_submitted' => $fac_submitted,
                                'fac_received' => $fac_received,
                                'actual_osp_build_distance_trench' => $actual_osp_build_distance_trench,
                                'actual_osp_build_distance_3rd_party_ducts' => $actual_osp_build_distance_3rd_party_ducts,
                                'actual_osp_build_la_existing_duct' => $actual_osp_build_la_existing_duct,
                                'actual_osp_build_la_existing_network' => $actual_osp_build_la_existing_network,
                                'actual_osp_build_distance_focus' => $actual_osp_build_distance_focus,
                                'actual_osp_build_in_building_conduits' => $actual_osp_build_in_building_conduits,
                                'actual_osp_110_sleeves_build' => $actual_osp_110_sleeves_build,
                                'actual_osp_drilling_distance_build' => $actual_osp_drilling_distance_build,
                                'actual_osp_micro_duct_distance_build' => $actual_osp_micro_duct_distance_build,
                                'actual_ops_build_total_distance' => $actual_ops_build_total_distance,
                                'actual_build_completion' => $actual_build_completion,
                                'actual_osp_mh_500_x_500_build' => $actual_osp_mh_500_x_500_build,
                                'actual_osp_mh_1000_x_500_build' => $actual_osp_mh_1000_x_500_build,
                                'osp_asb_trench' => $osp_asb_trench,
                                'osp_asb_3rd_party_ducts' => $osp_asb_3rd_party_ducts,
                                'osp_asb_la_existing_duct' => $osp_asb_la_existing_duct,
                                'osp_asb_existing_network' => $osp_asb_existing_network,
                                'osp_asb_distance_focus' => $osp_asb_distance_focus,
                                'osp_asb_in_building_conduits' => $osp_asb_in_building_conduits,
                                'isp_a_asb_trench' => $isp_a_asb_trench,
                                'isp_a_asb_3rd_party_ducts' => $isp_a_asb_3rd_party_ducts,
                                'isp_a_asb_la_existing_duct' => $isp_a_asb_la_existing_duct,
                                'isp_a_asb_existing_network' => $isp_a_asb_existing_network,
                                'isp_a_asb_distance_focus' => $isp_a_asb_distance_focus,
                                'isp_a_asb_in_building_conduits' => $isp_a_asb_in_building_conduits,
                                'isp_b_asb_trench' => $isp_b_asb_trench,
                                'isp_b_asb_3rd_party_ducts' => $isp_b_asb_3rd_party_ducts,
                                'isp_b_asb_la_existing_duct' => $isp_b_asb_la_existing_duct,
                                'isp_b_asb_existing_network' => $isp_b_asb_existing_network,
                                'isp_b_asb_distance_focus' => $isp_b_asb_distance_focus,
                                'isp_b_asb_in_building_conduits' => $isp_b_asb_in_building_conduits,
                                'otdr_distance' => $otdr_distance,
                                'final_sectional_date' => $final_sectional_date,
                                'mat' => $mat,
                            ]);
        //Check if data is updated or not
        if($update_master_file_record){
            return back()->with('success','Record Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
    
    //function for build status page
    public function build_status_page(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        $view =  view('admin/build-master-files/build-status-page', compact('all_records'));
        return $view;  
    }
    
    //function for build date page
    public function build_date_page(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
          $view =  view('admin/build-master-files/build-date-page', compact('all_records'));
        return $view;  
    }
    
     //function for build osp resource
    public function build_osp_resources(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
          $view =  view('admin/build-master-files/build-osp-resources', compact('all_records'));
        return $view;  
    }
    
     //function for build isp a resource
    public function build_isp_a_resources(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
          $view =  view('admin/build-master-files/build-isp-a-resources', compact('all_records'));
        return $view;  
    }
        
     //function for build isp b resource
    public function build_isp_b_resources(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
          $view =  view('admin/build-master-files/build-isp-b-resources', compact('all_records'));
        return $view;  
    }
    
    //function for build isp b resource
    public function build_po_vo_resources(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        $view =  view('admin/build-master-files/build-po-vo-status', compact('all_records'));
        return $view;  
    }
    
     //function for build complete
    public function build_complete(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        $view =  view('admin/build-master-files/build-complete', compact('all_records'));
        return $view;  
    }
    
    //function for build complete
    public function as_build_otoc(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        $view =  view('admin/build-master-files/as_build_otoc', compact('all_records'));
        return $view;  
    }
    
    //function for build complete
    public function project_cost(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        $view =  view('admin/build-master-files/project-cost', compact('all_records'));
        return $view;  
    }

    //function for material service isp a
    public function material_service_isp_a(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
        $view =  view('admin/build-master-files/material-service-isp-a', compact('all_records'));
        return $view;  
    }

       //Function for show single build status record
       public function single_build_status_record($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
		$all_build_status = BuildStatus::orderBy('build_status')->get();
		$all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		$all_site_status = SiteStatus::orderBy('site_status')->get();
        $sd_status = Sd_Status::orderBy('name')->get();
        $year = Year::orderBy('name')->get();
        $week = Week::orderBy('name')->get();
        $add_comment = AddComment::orderBy('name')->get();
        $resource_team = ResourceTeam::orderBy('name')->get();
        $record = BuildMasterFile::whereIn('region',$is_login_region)->where('circuit_id', $id)->with('site_master_record','permission_record','planning_record',
        'department_record','attachment_record')->get()->toArray();     
        //echo "<pre>";print_r($record);exit;
        $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
        $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
        $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
        $project_type = $record[0]['site_master_record']['type'] ?? '';
        $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
        $build_duration = $record[0]['build_duration'] ?? '';
        // call the function
        $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
        $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
        $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
        $standard_build_duration = $this->calculate_standard_build_duration($project_type);
        $view =  view('admin/build-master-files/build-status-single-page',compact('record','planned_start_date','est_complition_date','revised_build_completion_date',
        'standard_build_duration','all_build_status','all_build_osp_status','all_site_status','sd_status','year','week','add_comment','resource_team'));
        return $view;
    }

        //Function for show single build date record
        public function single_build_date_record($id){
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
			$all_build_status = BuildStatus::orderBy('build_status')->get();
		    $all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		    $all_site_status = SiteStatus::orderBy('site_status')->get();
            $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
            $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
            $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
            $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
            $project_type = $record[0]['site_master_record']['type'] ?? '';
            $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
            $build_duration = $record[0]['build_duration'] ?? '';
            // call the function
            $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
            $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
            $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
            $standard_build_duration = $this->calculate_standard_build_duration($project_type);
            $view =  view('admin/build-master-files/build-date-page-single',compact('record','planned_start_date','est_complition_date','revised_build_completion_date','standard_build_duration','all_build_status','all_build_osp_status','all_site_status'));
            return $view;
        }
        //Function for show single build osp resources
        public function single_build_osp_resources($id){
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
			$all_build_status = BuildStatus::orderBy('build_status')->get();
		    $all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		    $all_site_status = SiteStatus::orderBy('site_status')->get();
            $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
            $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
            $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
            $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
            $project_type = $record[0]['site_master_record']['type'] ?? '';
            $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
            $build_duration = $record[0]['build_duration'] ?? '';
            // call the function
            $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
            $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
            $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
            $standard_build_duration = $this->calculate_standard_build_duration($project_type);
            $view =  view('admin/build-master-files/build-osp-resources-single',compact('record','planned_start_date','est_complition_date','revised_build_completion_date','standard_build_duration','all_build_status','all_build_osp_status','all_site_status'));
            return $view;
        }

          //Function for show single build isp a resources
          public function single_build_isp_a_resources($id){
            $region = Auth::user()->regions;   
            $is_login_region = explode(",",$region);
			$all_build_status = BuildStatus::orderBy('build_status')->get();
		    $all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		    $all_site_status = SiteStatus::orderBy('site_status')->get();
            $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
            $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
            $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
            $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
            $project_type = $record[0]['site_master_record']['type'] ?? '';
            $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
            $build_duration = $record[0]['build_duration'] ?? '';
            // call the function
            $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
            $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
            $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
            $standard_build_duration = $this->calculate_standard_build_duration($project_type);
            // call the function
            $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
            $est_complition_date = $this->calculate_standard_build_duration($project_type,$planned_start_date);
            $view =  view('admin/build-master-files/build-isp-a-resources-single',compact('record','planned_start_date','est_complition_date','revised_build_completion_date','standard_build_duration','all_build_status','all_build_osp_status','all_site_status'));
            return $view;
        }

            //Function for show single build isp b resources
            public function single_build_isp_b_resources($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
				$all_build_status = BuildStatus::orderBy('build_status')->get();
		        $all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		        $all_site_status = SiteStatus::orderBy('site_status')->get();
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
                $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $project_type = $record[0]['site_master_record']['type'] ?? '';
                $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
                $build_duration = $record[0]['build_duration'] ?? '';
                // call the function
                $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
                $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
                $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
                $standard_build_duration = $this->calculate_standard_build_duration($project_type);
                $view =  view('admin/build-master-files/build-isp-b-resources-single',compact('record','planned_start_date','est_complition_date','revised_build_completion_date','standard_build_duration','all_build_status','all_build_osp_status','all_site_status'));
                return $view;
            }

             //Function for show single build po_vo status
             public function single_build_po_vo_status($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
				$all_build_status = BuildStatus::orderBy('build_status')->get();
		        $all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		        $all_site_status = SiteStatus::orderBy('site_status')->get();
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
                $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $project_type = $record[0]['site_master_record']['type'] ?? '';
                $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
                $build_duration = $record[0]['build_duration'] ?? '';
                // call the function
                $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
                $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
                $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
                $standard_build_duration = $this->calculate_standard_build_duration($project_type);
                $view =  view('admin/build-master-files/build-po-vo-status-single',compact('record','planned_start_date','est_complition_date','revised_build_completion_date','standard_build_duration','all_build_status','all_build_osp_status','all_site_status'));
                return $view;
            }

            //Function for show single build % complete
            public function single_build_complete($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
				$all_build_status = BuildStatus::orderBy('build_status')->get();
		        $all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		        $all_site_status = SiteStatus::orderBy('site_status')->get();
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
                $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $project_type = $record[0]['site_master_record']['type'] ?? '';
                $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
                $build_duration = $record[0]['build_duration'] ?? '';
                // call the function
                $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
                $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
                $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
                $standard_build_duration = $this->calculate_standard_build_duration($project_type);
                $view =  view('admin/build-master-files/build-complete-single',compact('record','planned_start_date','est_complition_date','revised_build_completion_date','standard_build_duration','all_build_status','all_build_osp_status','all_site_status'));
                return $view;
            }

             //Function for show as build otoc single
             public function single_as_build_otoc($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
				$all_build_status = BuildStatus::orderBy('build_status')->get();
		        $all_build_osp_status = BuildOSPStatus::orderBy('build_osp_status')->get();
		        $all_site_status = SiteStatus::orderBy('site_status')->get();
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
                $revised_planned_wp2_date = $record[0]['planning_record']['revised_planned_wp2_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $planned_wp2_released_date = $record[0]['planning_record']['planned_wp2_released_date'] ?? '';
                $project_type = $record[0]['site_master_record']['type'] ?? '';
                $revised_build_start_date = $record[0]['revised_build_start_date'] ?? '';
                $build_duration = $record[0]['build_duration'] ?? '';
                // call the function
                $planned_start_date = $this->change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date);
                $est_complition_date = $this->calculate_est_complition_date($project_type,$planned_start_date);
                $revised_build_completion_date = $this->calculate_revised_build_completion_date($revised_build_start_date,$build_duration);
                $standard_build_duration = $this->calculate_standard_build_duration($project_type);
                $view =  view('admin/build-master-files/as-build-otoc-single',compact('record','planned_start_date','est_complition_date','revised_build_completion_date','standard_build_duration','all_build_status','all_build_osp_status','all_site_status'));
                return $view;
            }

            //Function for show build project cost single
            public function project_cost_single($id){
                $region = Auth::user()->regions; 
                $all_osp_planners = OSPPLanners::orderBy('osp_planners')->get();				
                $is_login_region = explode(",",$region);
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
                $view =  view('admin/build-master-files/project-cost-single',compact('record','all_osp_planners'));
                return $view;
            }

            //function for material service isp a single
            public function material_service_isp_a_single($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
                $planning_materials  =  PlanningMaterial::get()->toArray();
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record','planning_isp_a_records')->get()->toArray();
                $view =  view('admin/build-master-files/material-service-isp-a-single', compact('record','planning_materials'));
                return $view;  
            }

             //function for material service isp a
            public function material_service_isp_b(){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
                $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
                $view =  view('admin/build-master-files/material-service-isp-b', compact('all_records'));
                return $view;  
            }

              //function for material service isp a single
              public function material_service_isp_b_single($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
                $planning_materials  =  PlanningMaterial::get()->toArray();
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record','planning_isp_b_records')->get()->toArray();
                $view =  view('admin/build-master-files/material-service-isp-b-single', compact('record','planning_materials'));
                return $view;  
            }

                //function for material service isp osp
                public function material_service_isp_osp(){
                    $region = Auth::user()->regions;   
                    $is_login_region = explode(",",$region);
                    $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id','DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
                    $view =  view('admin/build-master-files/material-service-isp-osp', compact('all_records'));
                    return $view;  
                }

                     //function for material service isp a single
              public function material_service_isp_osp_single($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
                $planning_materials  =  PlanningMaterial::get()->toArray();
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record','planning_osp_records')->get()->toArray();
                $view =  view('admin/build-master-files/material-service-isp-osp-single', compact('record','planning_materials'));
                return $view;  
            }

            //function for build department comment
            public function build_department_comment(){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
                $all_records = BuildMasterFile::whereIn('region',$is_login_region)->whereNoTIn('build_status',['R) Pending CTS'])->orderby('id', 'DESC')->with('site_master_record','permission_record','planning_record','department_record')->paginate(50);
                $view =  view('admin/build-master-files/build-department-comment', compact('all_records'));
                return $view;  
            }

            //function for build department comment single
            public function build_department_comment_single($id){
                $region = Auth::user()->regions;   
                $is_login_region = explode(",",$region);
                $record = BuildMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('site_master_record','permission_record','planning_record','department_record')->get()->toArray();
                $view =  view('admin/build-master-files/build-department-comment-single', compact('record'));
                return $view;  
            }

            //function for update build status and project status
            public function update_build_status(Request $request,$circuit_id){

                //if we select C) PO Requested then it this condition aplied
                if ($request['build_status'] == 'C) PO Requested' &&
                    empty($request['osp_project_leader']) &&
                    empty($request['osp_civil_contractor']) &&
                    empty($request['osp_re_instatement_contractor']) &&
                    empty($request['osp_drilling_contractor']) &&
                    empty($request['osp_floating_contractor']) &&
                    empty($request['isp_a_project_leader']) &&
                    empty($request['isp_a_civil_contractor']) &&
                    empty($request['isp_a_re_instatement_contractor']) &&
                    empty($request['isp_a_drilling_contractor']) &&
                    empty($request['isp_a_floating_contractor']) &&
                    empty($request['isp_b_project_leader']) &&
                    empty($request['isp_b_civil_contractor']) &&
                    empty($request['isp_b_re_instatement_contractor']) &&
                    empty($request['isp_b_drilling_contractor']) &&
                    empty($request['isp_b_floating_contractor'])) {
                    return back()->with('unsuccess', 'Please Add any contarctor then you can change status to C) PO Requested');
                }
                //Call Manage History Helper
                $model = SiteMasterFile::where('circuit_id', $circuit_id)->first();

                // Define fields for which to get original values
                $fields = ['po_mrc', 'po_nrc'];
                
                // Initialize variables to store field names and values
                $fieldsStr = '';
                $valuesStr = '';
                
                // Loop through the fields and get their original values
                foreach ($fields as $field) {
                    // Get the original value of the field
                    $value = $model->getOriginal($field);
                    // Handle null values by converting them to an empty string
                    $value = ($value !== null) ? $value : ''; 
                    // Concatenate field names and values
                    $fieldsStr .= $field . ',';
                    $valuesStr .= $value . ',';
                }
                
                // Remove the trailing comma from the concatenated strings
                $fieldsStr = rtrim($fieldsStr, ',');
                $valuesStr = rtrim($valuesStr, ',');          
                $module_type = "Build";
                $page_name = url()->previous();
                Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);

                $build_status = $request['build_status']; 
                $project_status =   $request['project_status'];   
                //update Query
                $update_master_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                   'build_status' => $build_status]);
                //Check if data is updated or not
                if($update_master_file_record){
                //check project status
                     if($build_status == 'C) PO Requested' || $build_status == 'D) Kick-Off Stage' || $build_status == 'E) Work In Progress' || $build_status == 'H) Splicing Stage'){
                        $new_project_status = 'J) In-Build';
                     } elseif($build_status == 'I) TOC P1 Submitted-L2'){
                        $new_project_status = 'K) TOC P1 Submitted-L2';
                     } elseif($build_status == 'J) TOC P2 Received-L2'){
                         $new_project_status = 'L) TOC P2 Received-L2';
                     } else{
                        $new_project_status = $project_status;
                     }

                    //check sales status
                    $sales_status = 'A) New Sales';
                    if($build_status == 'S) Data Fix'){
                        $sales_status = 'F) Data Fix';
                    } 
                        $update_record = SiteMasterFile::where('circuit_id',$circuit_id)->update([
                        'project_status' => $new_project_status,
                        'sales_status' => $sales_status,
                    ]);

                    //send email to finance
                    if($request['build_status'] == 'C) PO Requested'){
                        $details = [
                            'title' => 'Approval',
                            'items' => [
                                'Circuit ID' => $circuit_id,
                                'ISP Name' => $request->client_name,
                                'Site B Name' => $request->site_b,
                            ],
                            'link' => 'https://www.o2cap.co.za/admin/single-financial/' .$circuit_id. '',
                            'type' => 'To Create PO and Picking Slip',
                        ];
                    
                        //pass email
                        $mail = 'po_pic@linkafrica.co.za';
                      
                        Mail::to($mail)->send(new o2capMail($details));

                        //update status
                        $update = BuildMasterFile::where('circuit_id', $circuit_id)->update([
                            "financial_status" => 'D) PO/Picking Slip Request Received from Build',
                        ]);
                    }
                       //Call Common function for build
                        $this->update_all_single_build($request,$circuit_id);                    
                        //Call Common function for update planning materials
                        $this->update_planning_materials($request,$circuit_id);
                        //call common function for update project cost
                       // $this->update_project_cost($request,$circuit_id);
                     
                        return back()->with('success','Record Updated Successfully');
                    } else {
                        return back()->with('unsuccess','Opps Something wrong!');
                    }
            }
     
            // common function for update planning single page
        public function update_all_single_build($request,$circuit_id){
            $site_master_record = [
                                 'po_mrc' => $request['po_mrc'],
                                 'po_nrc' => $request['po_nrc'], 
                                 'qty' => $request['qty'],
                                 'year' => $request['year'],
                                 'sd_status' => $request['sd_status'],
                                 'week' => $request['week'],
                                 'resources' => $request['resources'],
                                 'comments' => $request['build_comments'],
                            ];
     //Get request for planning records        
      
      
      $planning_record = [
                                
                                 'site_a_status' => $request['site_a_status'],
                                 'site_b_status' => $request['site_b_status'],
                                 'site_a_id' => $request['site_a_id'],
                                 'site_b_id' => $request['site_b_id'], 
                                 'link_dependency' => $request['link_dependency'], 
                                       
      ];

        //Get request for build records
        $po_requested = null;
        if( $request['po_requested']){
        $po_requested = Carbon::parse($request['po_requested']);
        }

        $po_received = null;
        if( $request['po_received']){
        $po_received = Carbon::parse($request['po_received']);
        }

        $planned_start_date = null;
        if( $request['planned_start_date']){
        $planned_start_date = Carbon::parse($request['planned_start_date']);
        }

        $revised_build_start_date = null;
        if( $request['revised_build_start_date']){
        $revised_build_start_date = Carbon::parse($request['revised_build_start_date']);
        }
  
        $osp_asbuild_submission = null;
        if( $request['osp_asbuild_submission']){
        $osp_asbuild_submission = Carbon::parse($request['osp_asbuild_submission']);
        }

        $isp_asbuild_submission = null;
        if( $request['isp_asbuild_submission']){
        $isp_asbuild_submission = Carbon::parse($request['isp_asbuild_submission']);
        }

        $toc_submitted = null;
        if( $request['toc_submitted']){
        $toc_submitted = Carbon::parse($request['toc_submitted']);
        }

        $toc_received = null;
        if( $request['toc_received']){
        $toc_received = Carbon::parse($request['toc_received']);
        }
        $actual_build_completion_date = null;
        if($request['actual_build_completion_date']){
        $actual_build_completion_date = Carbon::parse($request['actual_build_completion_date']);
        }
		 $qa_requested = null;
        if($request['qa_requested']){
        $qa_requested = Carbon::parse($request['qa_requested']);
        }

        $planned_build_completion_date = null;
        if($request['planned_build_completion_date']){
        $planned_build_completion_date = Carbon::parse($request['planned_build_completion_date']);
        }

//echo $request['qa_requested'];exit;
        $build_record =    [
                                 //'osp_asbuild_received' => $request['osp_asbuild_received'],
                                 'planned_build_completion_date' => $planned_build_completion_date,
                                 'actual_build_completion_date' => $actual_build_completion_date,
                                 'build_status' => $request['build_status'],
                                 'actual_osp_build_distance_trench' => $request['actual_osp_build_distance_trench'],
                                 'actual_osp_build_distance_3rd_party_ducts' => $request['actual_osp_build_distance_3rd_party_ducts'],
                                 'actual_osp_build_la_existing_duct' => $request['actual_osp_build_la_existing_duct'],
                                 'actual_osp_build_la_existing_network' => $request['actual_osp_build_la_existing_network'],
                                 'actual_osp_build_distance_focus' => $request['actual_osp_build_distance_focus'],
                                 'actual_osp_build_in_building_conduits' => $request['actual_osp_build_in_building_conduits'],
                                 'isp_a_asb_trench' => $request['isp_a_asb_trench'],
                                 'isp_a_asb_3rd_party_ducts' => $request['isp_a_asb_3rd_party_ducts'],
                                 'isp_a_asb_la_existing_duct' => $request['isp_a_asb_la_existing_duct'],
                                 'isp_a_asb_existing_network' => $request['isp_a_asb_existing_network'],
                                 'isp_a_asb_distance_focus' => $request['isp_a_asb_distance_focus'],
                                 'isp_a_asb_in_building_conduits' => $request['isp_a_asb_in_building_conduits'],
                                 'isp_b_asb_trench' => $request['isp_b_asb_trench'],
                                 'isp_b_asb_3rd_party_ducts' => $request['isp_b_asb_3rd_party_ducts'],
                                 'isp_b_asb_la_existing_duct' => $request['isp_b_asb_la_existing_duct'],
                                 'isp_b_asb_existing_network' => $request['isp_b_asb_existing_network'],
                                 'isp_b_asb_distance_focus' => $request['isp_b_asb_distance_focus'],
                                 'isp_b_asb_in_building_conduits' => $request['isp_b_asb_in_building_conduits'],
                                 'po_requested' => $po_requested,
                                 'po_received' => $po_received,
                                 'planned_start_date' => $planned_start_date,
                                 'revised_build_start_date' => $revised_build_start_date,
                                 'osp_asbuild_submission' => $osp_asbuild_submission,
                                 'isp_asbuild_submission' => $isp_asbuild_submission,
                                 'osp_asbuild_submission' => $osp_asbuild_submission,
                                 'otdr_distance' => $request['otdr_distance'],
                                 'qa_requested' => $qa_requested,
                                 'final_sectional_date' => $request['final_sectional_date'],
								 'otoc' => $request['otoc'],
                                 'fac_received' => $request['fac_received'],
                                 'comments' => $request['comments'],
                                 'splicing_team' => $request['splicing_team'],
                                 'name' => $request['name'],
                                 'toc_submitted' => $toc_submitted,
                                 'toc_received' => $toc_received,
                                 'isp_a_project_leader' => $request['isp_a_project_leader'],
                                'isp_a_civil_contractor' => $request['isp_a_civil_contractor'],
                                'isp_a_jetting_contractor' => $request['isp_a_jetting_contractor'],
                                'isp_a_re_instatement_contractor' => $request['isp_a_re_instatement_contractor'],
                                'isp_a_drilling_contractor' => $request['isp_a_drilling_contractor'],
                                'isp_a_floating_contractor' => $request['isp_a_floating_contractor'],
                                'isp_a_focus_contractor' => $request['isp_a_focus_contractor'],
                                'isp_b_project_leader' => $request['isp_b_project_leader'],
                                'isp_b_civil_contractor' =>$request['isp_b_civil_contractor'],
                                'isp_b_jetting_contractor' => $request['isp_b_jetting_contractor'],
                                'isp_b_re_instatement_contractor' => $request['isp_b_re_instatement_contractor'],
                                'isp_b_drilling_contractor' => $request['isp_b_drilling_contractor'],
                                'isp_b_floating_contractor' => $request['isp_b_floating_contractor'],
                                'isp_b_focus_contractor' => $request['isp_b_focus_contractor'],
                                'osp_project_leader' => $request['osp_project_leader'],
                                'osp_civil_contractor' => $request['osp_civil_contractor'],
                                'osp_jetting_contractor' => $request['osp_jetting_contractor'],
                                'osp_re_instatement_contractor' => $request['osp_re_instatement_contractor'],
                                'osp_drilling_contractor' => $request['osp_drilling_contractor'],
                                'osp_floating_contractor' => $request['osp_floating_contractor'],
                                'osp_focus_contractor' =>$request['osp_focus_contractor'],
                                'build_completion' =>$request['build_completion'],
                                'build_osp_status' => $request['build_osp_status'],
                                'build_duration' => $request['build_duration'],
                                'build_percantage' => $request['build_completion_per']
                           ]; 
         
        //Update Planing
        $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update($planning_record);
        //print_r($update_planning_master_file_record);exit;
        $update_site_master_file_record = SiteMasterFile::Where('circuit_id', $circuit_id)->update($site_master_record);
        $update_build_master_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update($build_record);

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

    //build date trigger
    public function change_planned_start_date($revised_planned_wp2_date,$planned_wp2_released_date){
      $revised_planned_wp2_date = Carbon::parse($revised_planned_wp2_date);
      $planned_wp2_released_date = Carbon::parse($planned_wp2_released_date);

      if($revised_planned_wp2_date == ''){
        $planned_start_date = $planned_wp2_released_date->addDays(5)->format('m/d/Y');
      } else{
        $planned_start_date = $revised_planned_wp2_date->addDays(5)->format('m/d/Y');
      }
      return $planned_start_date;
    }

    //function to calculate standard build duration
    public function calculate_est_complition_date($project_type,$planned_start_date)
    {
        $planned_start_date = Carbon::parse($planned_start_date);
        $est_complition_date = "";
        if($project_type == "Equipment And Splicing"){
            $est_complition_date = $planned_start_date->addDays(19)->format('m/d/Y');
        }elseif($project_type == "OSP ISP With No Wayleaves"){
            $est_complition_date = $planned_start_date->addDays(19)->format('m/d/Y'); 
        }elseif($project_type == "OSP ISP With Wayleaves FTTB"){
            $est_complition_date = $planned_start_date->addDays(40)->format('m/d/Y'); 
        }elseif($project_type == "OSP ISP With Wayleaves FTTS"){
            $est_complition_date = $planned_start_date->addDays(40)->format('m/d/Y');
        }elseif($project_type == "OSP ISP With Wayleaves Other"){
            $est_complition_date = $planned_start_date->addDays(40)->format('m/d/Y');
        }elseif($project_type == "NET4"){
            $est_complition_date = $planned_start_date->addDays(35)->format('m/d/Y');
        }elseif($project_type == "NET6"){
            $est_complition_date = $planned_start_date->addDays(84)->format('m/d/Y');
        }elseif($project_type == "Managed Ports"){
            $est_complition_date = $planned_start_date->addDays(5)->format('m/d/Y');
        }elseif($project_type == "Upgrade or Downgrade"){
            $est_complition_date = $planned_start_date->addDays(4)->format('m/d/Y');
        }elseif($project_type == "NET2"){
            $est_complition_date = $planned_start_date->addDays(19)->format('m/d/Y');
        }elseif($project_type == "NET3.2"){
            $est_complition_date = $planned_start_date->addDays(19)->format('m/d/Y');
        }elseif($project_type == "FTTH Orders"){
            $est_complition_date = $planned_start_date->addDays(9)->format('m/d/Y');
        }elseif($project_type == "ISP NET1"){
            $est_complition_date = $planned_start_date->addDays(19)->format('m/d/Y');
        }
        return $est_complition_date;
    }

      //function to calculate standard build duration
      public function calculate_revised_build_completion_date($revised_build_start_date,$build_duration)
      {
          $revised_build_start_date_new = Carbon::parse($revised_build_start_date);
         
         if($build_duration == ''){
            return "";
         }
         if($revised_build_start_date_new){
            $revised_build_completion_date = $revised_build_start_date_new->addDays($build_duration)->format('m/d/Y');
         }else{
            $revised_build_start_date_new = "";
         }
          return $revised_build_completion_date;
      }
    
  //function to calculate standard build duration
  public function calculate_standard_build_duration($project_type)
  {
      $standard_build_duration = "";
      if($project_type == "Equipment And Splicing"){
          $standard_build_duration = '19 Days';
      }elseif($project_type == "OSP ISP With No Wayleaves"){
          $standard_build_duration = '19 Days'; 
      }elseif($project_type == "OSP ISP With Wayleaves FTTB"){
          $standard_build_duration = '40 Days'; 
      }elseif($project_type == "OSP ISP With Wayleaves FTTS"){
          $standard_build_duration = '40 Days';
      }elseif($project_type == "OSP ISP With Wayleaves Other"){
          $standard_build_duration = '40 Days';
      }elseif($project_type == "NET4"){
          $standard_build_duration = '35 Days';
      }elseif($project_type == "NET6"){
          $standard_build_duration = '84 Days';
      }elseif($project_type == "Managed Ports"){
          $standard_build_duration = '5 Days';
      }elseif($project_type == "Upgrade or Downgrade"){
          $standard_build_duration = '4 Days';
      }elseif($project_type == "NET2"){
          $standard_build_duration = '19 Days';
      }elseif($project_type == "NET3.2"){
          $standard_build_duration = '19 Days';
      }elseif($project_type == "FTTH Orders"){
          $standard_build_duration = '9 Days';
      }elseif($project_type == "ISP NET1"){
          $standard_build_duration = '19 Days';
      }
      return $standard_build_duration;
  }

  //update project cost
  public function update_project_cost(Request $request,$circuit_id){
    //echo $request['osp_planners'];exit;
      $planning_record = [
                        'site_a_id' => $request['site_a_id'],
                        'site_b_id' => $request['site_b_id'], 
                        'osp_planners' => $request['osp_planners'],
                        ];

       $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update($planning_record);

       //check update 
       if( $update_planning_master_file_record){
            $fieldsStr = '';
            $valuesStr = '';           
            $module_type = "Build";
            $page_name = url()->previous();
            Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
            return back()->with('success','Record Updated Successfully');
          } else {
            return back()->with('unsuccess','Opps Something wrong!');
      }
  }

}
 