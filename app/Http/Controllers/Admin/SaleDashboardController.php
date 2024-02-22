<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SiteMasterFile;
use Carbon\Carbon; 

class SaleDashboardController extends Controller
{
    //Function for show index view file
    public function index(){
        //count according to date
        $current_date =  Carbon::now()->format('Y-m-d');
        $sixteen_sub_days = Carbon::now()->subDays(60)->endOfDay()->format('Y-m-d');
        $nintyeen_sub_days = Carbon::now()->subDays(90)->endOfDay()->format('Y-m-d'); 
        $one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');  
        $more_then_one_twitty_sub_days = Carbon::now()->subDays(120)->endOfDay()->format('Y-m-d');
        
        $current_date_count = SiteMasterFile::where('date_new', '=', $current_date)->count(); 
        $sixteen_sub_days_count = SiteMasterFile::where('date_new', '>', $sixteen_sub_days)->count(); 
        $nintyeen_sub_days_count = SiteMasterFile::where('date_new', '>', $nintyeen_sub_days)->count(); 
        $one_twitty_sub_count = SiteMasterFile::where('date_new', '>', $one_twitty_sub_days)->count(); 
        $more_then_one_twitty_sub_days_count = SiteMasterFile::where('date_new', '<', $more_then_one_twitty_sub_days)->count();  
     
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
   
           $view =  view('admin/site-master-files/sale-dashboard',compact('current_date_count','sixteen_sub_days_count', 'nintyeen_sub_days_count','one_twitty_sub_count','more_then_one_twitty_sub_days_count','count_new_sale','count_new_inplanning','count_in_planning','count_d_permissions','count_e_financial_approval','count_f_new_build','count_i_toc_submitted','count_j_toc_recieved','count_l_cancelled','count_m_on_hold','count_n_complete','count_v_terminated'));
           return $view;
       }

    //Function for show home_project_ageing view files
    public function home_project_ageing($any){
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
      } elseif($any == "more-120-days"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('date_new', '<', $more_then_one_twitty_sub_days)->with('planning_record','permission_record','build_record')->paginate(50);
      }
      
      $view =  view('admin/site-master-files/home-project-ageing',compact('all_records'));
        return $view;
    }

    //Function for show home_project_status view files
    public function home_project_status($any){
      //Check project status type
      $all_records = SiteMasterFile::with('planning_record','permission_record','build_record')->paginate(50);
      if($any == "new-sale"){
         $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'A) New Sales')->with('planning_record','permission_record','build_record')->paginate(50);     
      } elseif($any == "new-in-planning"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'B) New In-Planning')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "in-Planning"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'C) In-Planning')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "permissions"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'D) Permissions')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "financial-approval"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'E) Financial Approval')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "new-in-build"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'F) New In-Build')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "in-build"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'G) In-Build')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "toc-submitted"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'I) TOC Submitted')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "toc-received"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'J) TOC Received')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "cancelled"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'L) Cancelled')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "on-hold"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'M) On-Hold')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "complete"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'N) Complete')->with('planning_record','permission_record','build_record')->paginate(50);
      } elseif($any == "terminated"){
        $all_records = SiteMasterFile::orderBy('id','DESC')->where('project_status', 'V) Terminated')->with('planning_record','permission_record','build_record')->paginate(50);
      }
      
      $view =  view('admin/site-master-files/home-project-status',compact('all_records'));
        return $view;
    }
}
