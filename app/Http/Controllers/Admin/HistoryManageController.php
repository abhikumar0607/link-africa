<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMasterFile;
use App\Models\PlanningMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\BuildMasterFile;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;

class HistoryManageController extends Controller
{
    //function for view history manage home page
    public function index(){
        //Set Date
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
     
        //Count Project status
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

        return view('admin/history-management/history-dashboard',compact('current_date_count','sixteen_sub_days_count', 'nintyeen_sub_days_count','one_twitty_sub_count','more_then_one_twitty_sub_days_count','count_new_sale','count_new_inplanning','count_in_planning','count_d_permissions','count_e_financial_approval','count_f_new_build','count_i_toc_submitted','count_j_toc_recieved','count_l_cancelled','count_m_on_hold','count_n_complete','count_v_terminated'));
    }

   
    //function for show history list
    public function history_list_record(){
        $all_record = History::orderBy('id','DESC')->with('user_list')->paginate(10);  
        //echo "<pre>";print_r($all_record);exit;       
        return view('admin/history-management/history-list',compact('all_record'));

    }

    //serach history
    public function search_history(Request $request){
        $keyword = $request->get('keyword');
        $all_record = History::orderBy('id','DESC')->where('service_id','like','%'.$keyword.'%')->with('user_list')->paginate(10);
        return view('admin/history-management/history-list',compact('all_record'));
    }
}
