<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PlanningMasterFile;
use App\Models\SiteMasterFile;
use Carbon\Carbon;

class PlanningDashboardController extends Controller
{
    //Function for show index view file
    public function index(){
      //Set Dates
      $current_date =  Carbon::now()->format('Y-m-d');
      $sixteen_sub_days = Carbon::now()->subDays(60)->endOfDay()->format('Y-m-d');
      $nintyeen_sub_days = Carbon::now()->subDays(90)->endOfDay()->format('Y-m-d'); 
      $one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');  
      $more_then_one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');
      
      //Count Project Ageing
      $current_date_count = SiteMasterFile::where('date_new', '=', $current_date)->count(); 
      $sixteen_sub_days_count = SiteMasterFile::where('date_new', '>', $sixteen_sub_days)->count(); 
      $nintyeen_sub_days_count = SiteMasterFile::where('date_new', '>', $nintyeen_sub_days)->count(); 
      $one_twitty_sub_count = SiteMasterFile::where('date_new', '>', $one_twitty_sub_days)->count(); 
      $more_then_one_twitty_sub_days_count = SiteMasterFile::where('date_new', '<', $more_then_one_twitty_sub_days)->count();  
        
        
      //Count Project Status
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
        
      //Count Planning Status
      $count_a_new_sale = PlanningMasterFile::where('planning_status', 'A) New Sales')->count();
      $count_wp1_stage = PlanningMasterFile::where('planning_status', 'B) Wp1 Stage')->count();
      $count_wp2_complition = PlanningMasterFile::where('planning_status', 'F) WP2 Compilation')->count();
      $count_d1_permissions = PlanningMasterFile::where('planning_status', 'G) Permissions')->count();
      $count_e_financial_requested = PlanningMasterFile::where('planning_status', 'H) Financial Approval Requested')->count();
      $count_wp2_planning = PlanningMasterFile::where('planning_status', 'I) WP2 Planning Complete')->count();
      $count_f_on_hold = PlanningMasterFile::where('planning_status', 'L) On-Hold')->count();
      $count_i_planning_complete = PlanningMasterFile::where('planning_status', 'M) Planning Complete')->count();
      $count_m_cancelled = PlanningMasterFile::where('planning_status', 'O) Cancelled')->count();
      $count_o_terminate = PlanningMasterFile::where('planning_status', 'P) Terminated')->count();
        
      //Count Project Types
      $count_equipment_and_splicing = SiteMasterFile::where('type', 'Equipment And Splicing')->count();
      $count_isp_net1 = SiteMasterFile::where('type', 'ISP NET1')->count();
      $count_osp_isp_with_no_wayleaves = SiteMasterFile::where('type', 'OSP ISP With No Wayleaves')->count();
      $count_osp_isp_with_wayleaves_fttb = SiteMasterFile::where('type', 'OSP ISP With Wayleaves FTTB')->count();
      $count_osp_isp_with_wayleaves_ftts = SiteMasterFile::where('type', 'OSP ISP With Wayleaves FTTS')->count();
      $count_osp_isp_with_wayleaves_other = SiteMasterFile::where('type', 'OSP ISP With Wayleaves Other')->count();
      $count_net4 = SiteMasterFile::where('type', 'NET4')->count();
      $count_net6 = SiteMasterFile::where('type', 'NET6')->count();
      $count_managed_ports = SiteMasterFile::where('type', 'Managed Ports')->count();
      $count_upgrade_or_downgrade = SiteMasterFile::where('type', 'Upgrade or Downgrade')->count();
      $count_net2 = SiteMasterFile::where('type', 'NET2')->count();
      $count_net3_2 = SiteMasterFile::where('type', 'NET3.2')->count();
      $count_migration_projects = SiteMasterFile::where('type', 'Migration Projects')->count();
      $count_ftth_orders = SiteMasterFile::where('type', 'FTTH Orders')->count();
        
      $view =  view('admin/planning-master-files/planning-dashboard',compact('current_date_count','sixteen_sub_days_count',
        'nintyeen_sub_days_count','one_twitty_sub_count','more_then_one_twitty_sub_days_count',
        'count_new_sale','count_new_inplanning','count_in_planning','count_d_permissions','count_e_financial_approval',
        'count_f_new_build','count_i_toc_submitted','count_j_toc_recieved','count_l_cancelled',
        'count_m_on_hold','count_n_complete','count_v_terminated','count_a_new_sale','count_wp1_stage','count_wp2_complition','count_d1_permissions',
        'count_e_financial_requested','count_wp2_planning',
        'count_f_on_hold','count_i_planning_complete','count_m_cancelled','count_m_cancelled','count_o_terminate','count_equipment_and_splicing','count_isp_net1','count_osp_isp_with_no_wayleaves','count_osp_isp_with_wayleaves_fttb','count_osp_isp_with_wayleaves_ftts','count_osp_isp_with_wayleaves_other','count_net4','count_net6','count_managed_ports','count_upgrade_or_downgrade','count_net2','count_net3_2','count_migration_projects','count_ftth_orders'));
      return $view;
    }

    //Function for Project Status
    public function home_project_status($any){
      //Check types
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->with('planning_record','permission_record','build_record')->paginate(50);
      if($any == "new-sale"){
         $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('project_status', 'A) New Sales')->with('planning_record','permission_record','build_record')->paginate(50);  
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
      } elseif($any == "toc-received"){
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
      
      $view =  view('admin/planning-master-files/home-project-status',compact('all_records'));
        return $view;
    }

  //Function for Planning Status
  public function home_planning_status($any){
      //Check types
      $all_records = PlanningMasterFile::orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->paginate(50);
      if($any == "new-sale"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'A) New Sales')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "wp1-stage"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'B) Wp1 Stage')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "wp2-compilation"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'C) Wp2 Compilation')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "permissions"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'D) Permissions')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "financial-approval-requested"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'E) Financial Approval Requested')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "wp2-planning-complete"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'F) Wp2 Planning Complete')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "on-hold"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'F) On-Hold')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "planning-complete"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'I) Planning Complete')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "cancelled"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'M) Cancelled')->with('permission_record','site_master_record','build_record')->paginate(50);
      } elseif($any == "terminated"){
        $all_records = PlanningMasterFile::orderBy('id', 'DESC')->where('planning_status', 'O) Terminated')->with('permission_record','site_master_record','build_record')->paginate(50);
      } 

      $view =  view('admin/planning-master-files/home-planning-status',compact('all_records'));
      return $view;
  }

  //Function for Project Types
  public function home_project_types($any){
    //Check types
    $all_records = SiteMasterFile::orderBy('id', 'DESC')->with('planning_record','permission_record','build_record')->paginate(50);
    if($any == "equipment-and-splicing"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'Equipment And Splicing')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "isp-net1"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'ISP NET1')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "osp-isp-with-no-wayleaves"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'OSP ISP With No Wayleaves')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "osp-isp-with-wayleaves-fttb"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'OSP ISP With Wayleaves FTTB')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "osp-isp-with-wayleaves-ftts"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'OSP ISP With Wayleaves FTTS')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "osp-isp-with-wayleaves-other"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'OSP ISP With Wayleaves Other')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "net4"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'NET4')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "net6"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'NET6')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "managed-ports"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'Managed Ports')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "upgrade-or-downgrade"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'Upgrade or Downgrade')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "net2"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'NET2')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "net3-2"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'NET3.2')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "migration-projects"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'Migration Projects')->with('planning_record','permission_record','build_record')->paginate(50);
    } elseif($any == "ftth-orders"){
      $all_records = SiteMasterFile::orderBy('id', 'DESC')->where('type', 'FTTH Order')->with('planning_record','permission_record','build_record')->paginate(50);
    } 

    $view =  view('admin/planning-master-files/home-project-types',compact('all_records'));
    return $view;
  }

  //Function for Project Ageing
  public function home_project_ageing($any){
    //Set Dates
    $current_date =  Carbon::now()->format('Y-m-d');
    $sixteen_sub_days = Carbon::now()->subDays(60)->endOfDay()->format('Y-m-d');
    $nintyeen_sub_days = Carbon::now()->subDays(90)->endOfDay()->format('Y-m-d'); 
    $one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');  
    $more_then_one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');

    //Check project ageing type
    $all_records = SiteMasterFile::with('planning_record','permission_record','build_record')->paginate(50);     
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
    
    $view =  view('admin/planning-master-files/home-project-ageing',compact('all_records'));
    return $view;
  }
}
