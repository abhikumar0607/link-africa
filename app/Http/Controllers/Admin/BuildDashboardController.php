<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BuildMasterFile;
use App\Models\SiteMasterFile;
use Carbon\Carbon;

class BuildDashboardController extends Controller
{
    //Function for show index view file
    public function index(){
      //Set Date
      $current_date =  Carbon::now()->format('Y-m-d');
      $sixteen_sub_days = Carbon::now()->subDays(60)->endOfDay()->format('Y-m-d');
      $nintyeen_sub_days = Carbon::now()->subDays(90)->endOfDay()->format('Y-m-d'); 
      $one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');  
      $more_then_one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');

      //Count Project Ageing 
      $current_date_count = BuildMasterFile::where('datenew', '=', $current_date)->count(); 
      $sixteen_sub_days_count = BuildMasterFile::where('datenew', '>', $sixteen_sub_days)->count(); 
      $nintyeen_sub_days_count = BuildMasterFile::where('datenew', '>', $nintyeen_sub_days)->count(); 
      $one_twitty_sub_count = BuildMasterFile::where('datenew', '>', $one_twitty_sub_days)->count(); 
      $more_then_one_twitty_sub_days_count = BuildMasterFile::where('datenew', '<', $more_then_one_twitty_sub_days)->count();  
      //Count all project status types
      $count_new_sale = SiteMasterFile::where('project_status', 'A) New Sales')->count();
     $count_new_inplanning = SiteMasterFile::where('project_status', 'B) New In-Planning')->count();
     $count_in_planning = SiteMasterFile::where('project_status', 'D) In-Planning')->count();
     $count_d_permissions = SiteMasterFile::where('project_status', 'F) Permissions')->count();
     $count_e_financial_approval = SiteMasterFile::where('project_status', 'H) Financial Approval')->count();
     $count_f_new_build = SiteMasterFile::where('project_status', 'I) New In-Build')->count();
     $count_i_toc_submitted = SiteMasterFile::where('project_status', 'K) TOC P1 Submitted-L2')->count();
     $count_j_toc_recieved = SiteMasterFile::where('project_status', 'L) TOC P2 Received-L2')->count();
     $count_l_cancelled = SiteMasterFile::where('project_status', 'Q) Cancelled')->count();
     $count_m_on_hold = SiteMasterFile::where('project_status', 'R) On-Hold')->count();
     $count_n_complete = SiteMasterFile::where('project_status', 'T) Complete')->count();
     $count_v_terminated = SiteMasterFile::where('project_status', 'U) Terminated')->count();

      //Count Build Status
      $count_a_new_sale = BuildMasterFile::where('build_status', 'A) New Sales')->count();
      $count_build_stage = BuildMasterFile::where('build_status', 'B) Pre-Build Stage')->count();
      $count_c_po_req = BuildMasterFile::where('build_status', 'C) PO Requested')->count();
      $count_d_kickoff = BuildMasterFile::where('build_status', 'D) Kick-Off Stage')->count();
      $count_e_work_in_progress = BuildMasterFile::where('build_status', 'E) Work In Progress')->count();
      $count_g_on_hold = BuildMasterFile::where('build_status', 'G) On-Hold')->count();
      $count_h_splicing_stage = BuildMasterFile::where('build_status', 'H) Splicing Stage')->count();
      $count_i_toc_sub = BuildMasterFile::where('build_status', 'K) TOC P2 Submitted-SD')->count();
      $count_j_as_build = BuildMasterFile::where('build_status', 'L) As Build Stage')->count();
      $count_K_quality_assu = BuildMasterFile::where('build_status', 'M) Quality Assurance Stage')->count();
      $count_l_otoc_rec = BuildMasterFile::where('build_status', 'N) OTOC Received')->count();
      $count_P_cancelled = BuildMasterFile::where('build_status', 'P) Cancelled')->count();
      $count_r_final_sectional = BuildMasterFile::where('build_status', 'R) Final Sectional')->count();
      $count_s_terminate = BuildMasterFile::where('build_status', 'Q) Terminated')->count();

      //Count BUILD TOC STATUS
      $count_build_toc_status_no = BuildMasterFile::where('build_osp_status', 'U) BLD-OSP Complete')->count();
      $count_build_toc_status_yes = BuildMasterFile::where('build_osp_status', 'BLD-OTOC')->count();
          
      $view =  view('admin/build-master-files/build-dashboard',compact('current_date_count','sixteen_sub_days_count', 'nintyeen_sub_days_count','one_twitty_sub_count','more_then_one_twitty_sub_days_count','count_new_sale','count_new_inplanning','count_in_planning','count_d_permissions','count_e_financial_approval','count_f_new_build','count_i_toc_submitted','count_j_toc_recieved','count_l_cancelled','count_m_on_hold','count_n_complete','count_v_terminated','count_a_new_sale','count_build_stage','count_c_po_req','count_d_kickoff','count_e_work_in_progress','count_g_on_hold','count_h_splicing_stage','count_i_toc_sub','count_j_as_build','count_K_quality_assu','count_l_otoc_rec','count_P_cancelled','count_r_final_sectional','count_s_terminate','count_build_toc_status_no','count_build_toc_status_yes'));
      return $view;
    }

    //Function for Project Status
    public function home_project_status($any){
      //Check types
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->with('planning_record','permission_record','build_record')->paginate(50);
      if($any == "new-sale"){
         $all_records = SiteMasterFile::orderBy('id', 'DESC')->with('planning_record','permission_record','build_record')->paginate(50);  
      } elseif($any == "new-in-planning"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'B) New In-Planning')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "in-planning"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'C) In-Planning')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "permissions"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'D) Permissions')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "financial-approval"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'E) Financial Approval')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "new-in-build"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'F) New In-Build')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "in-build"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'G) In-Build')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "toc-submitted"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'I) TOC Submitted')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "toc-recieved"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'J) TOC Received')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "cancelled"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'L) Cancelled')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "on-hold"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'M) On-Hold')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "complete"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'N) Complete')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "terminated"){
        $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'V) Terminated')->with('planning_record','permission_record','build_record')->paginate(50);
      }
      
      $view =  view('admin/build-master-files/home-project-status',compact('all_records'));
      return $view;
    }

    //Function For Build Status
    public function home_build_status($any){
      //Check type
      $all_records = BuildMasterFile::paginate(50);
      if($any == "new-sale"){
        $all_records = BuildMasterFile::where('build_status', 'A) New Sales')->paginate(50);
      } elseif($any == "pre-build-stage"){
        $all_records = BuildMasterFile::where('build_status', 'B) Pre-Build Stage')->paginate(50);
      } elseif($any == "po-requested"){
        $all_records = BuildMasterFile::where('build_status', 'C) PO Requested')->paginate(50);
      } elseif($any == "kick-off-stage"){
        $all_records = BuildMasterFile::where('build_status', 'D) Kick-Off Stage')->paginate(50);
      } elseif($any == "work-in-progress"){
        $all_records = BuildMasterFile::where('build_status', 'E) Work In Progress')->paginate(50);
      } elseif($any == "on-hold"){
        $all_records = BuildMasterFile::where('build_status', 'G) On-Hold')->paginate(50);
      } elseif($any == "splicing-stage"){
        $all_records = BuildMasterFile::where('build_status', 'H) Splicing Stage')->paginate(50);
      } elseif($any == "toc-submitted-sd"){
        $all_records = BuildMasterFile::where('build_status', 'I) TOC Submitted-SD')->paginate(50);
      } elseif($any == "as-build-stage"){
        $all_records = BuildMasterFile::where('build_status', 'J) As Build Stage')->paginate(50);
      } elseif($any == "quality-assurance-st"){
        $all_records = BuildMasterFile::where('build_status', 'K) Quality Assurance St')->paginate(50);
      } elseif($any == "otoc-recieved"){
        $all_records = BuildMasterFile::where('build_status', 'L) OTOC Recieved')->paginate(50);
      } elseif($any == "cancelled"){
        $all_records = BuildMasterFile::where('build_status', 'P) Cancelled')->paginate(50);
      } elseif($any == "final-sectional"){
        $all_records = BuildMasterFile::where('build_status', 'R) Final Sectional')->paginate(50);
      } elseif($any == "terminated"){
        $all_records = BuildMasterFile::where('build_status', 'S) Terminated')->paginate(50);
      } 

      $view =  view('admin/build-master-files/home-build-status',compact('all_records'));
      return $view;
    }


    //Function For Project Ageing
    public function home_project_ageing($any){
      $current_date =  Carbon::now()->format('Y-m-d');
      $sixteen_sub_days = Carbon::now()->subDays(60)->endOfDay()->format('Y-m-d');
      $nintyeen_sub_days = Carbon::now()->subDays(90)->endOfDay()->format('Y-m-d'); 
      $one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');  
      $more_then_one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');

      //Check type
      $all_records = SiteMasterFile::paginate(50);
      if($any == "current"){
         $all_records = SiteMasterFile::orderBy('id','DESC')->where('date_new', '=', $current_date)->with('planning_record','permission_record','build_record')->paginate(50);     
      } elseif($any == "60-days"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('date_new', '>', $sixteen_sub_days)->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "90-days"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('date_new', '>', $nintyeen_sub_days)->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "120-days"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('date_new', '>', $one_twitty_sub_days)->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "more-than-120"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('date_new', '<', $more_then_one_twitty_sub_days)->with('planning_record','permission_record','build_record')->paginate(50);
      }
      
      $view =  view('admin/build-master-files/home-project-ageing',compact('all_records'));
      return $view;
    }

    //Function For BUILD TOC STATUS
    public function home_build_toc_status($any){
      //Check type
      $all_records = BuildMasterFile::paginate(50);
      if($any == "no"){
        $all_records = BuildMasterFile::where('build_osp_status', 'U) BLD-OSP Complete')->paginate(50);
      } elseif($any == "yes"){
        $all_records = BuildMasterFile::where('build_osp_status', 'BLD-OTOC')->paginate(50);
      } 

      $view =  view('admin/build-master-files/home-build-toc-status',compact('all_records'));
      return $view;
    }
}
