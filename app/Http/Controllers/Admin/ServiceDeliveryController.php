<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMasterFile;
use App\Models\PlanningMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\BuildMasterFile;
use App\Models\ReturnToSale;
use App\Models\AddServiceDeliveryStatus;
use App\Models\Sd_Status;
use App\Models\Year;
use App\Models\Week;
use App\Models\AddComment;
use App\Models\ResourceTeam;
use Carbon\Carbon;
use Helper;

class ServiceDeliveryController extends Controller
{
    //function for view service delivery home page
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

        return view('admin/service-delivery-status/service-dashboard',compact('current_date_count','sixteen_sub_days_count', 'nintyeen_sub_days_count','one_twitty_sub_count','more_then_one_twitty_sub_days_count','count_new_sale','count_new_inplanning','count_in_planning','count_d_permissions','count_e_financial_approval','count_f_new_build','count_i_toc_submitted','count_j_toc_recieved','count_l_cancelled','count_m_on_hold','count_n_complete','count_v_terminated'));
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
        } elseif($any == "more-120-days"){
          $all_records = SiteMasterFile::orderBy('id','DESC')->where('date_new', '<', $more_then_one_twitty_sub_days)->with('planning_record','permission_record','build_record')->paginate(50);
        }
        
        $view =  view('admin/service-delivery-status/home-project-ageing',compact('all_records'));
          return $view;
      }
  
      //Function For Project Status
      public function home_project_status($any){
        //Check type
        $all_records = SiteMasterFile::paginate(50);
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
        
        $view =  view('admin/service-delivery-status/home-project-status',compact('all_records'));
          return $view;
      }
    
    //function for sd_table_view
    public function sd_table_view(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->whereNoTIn('project_status',['V) Pending CTS'])->orderby('id','DESC')->with('planning_record','permission_record','build_record')->paginate(50);
        $view =  view('admin/service-delivery-status/sd-table-view', compact('all_records'));
        return $view;
    }

    //function for sd table single view
    public function sd_table_single_view($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_return_to_sale = ReturnToSale::orderBy('return_to_sale')->get();
        $all_service_delivery_status = AddServiceDeliveryStatus::orderBy('service_delivery_status')->get();
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('id',$id)->with('planning_record','permission_record','build_record')->get()->toArray();
        $view =  view('admin/service-delivery-status/sd-table-single-record', compact('all_records','all_return_to_sale','all_service_delivery_status'));
        return $view;
    }

    //function for project status
    public function project_status(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->whereNoTIn('project_status',['V) Pending CTS'])->orderby('id','DESC')->with('planning_record','permission_record','build_record')->paginate(50);
        $view =  view('admin/service-delivery-status/project-status', compact('all_records'));
        return $view;
    }

     //function for single project status
     public function single_project_status($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_return_to_sale = ReturnToSale::orderBy('return_to_sale')->get();
        $all_service_delivery_status = AddServiceDeliveryStatus::orderBy('service_delivery_status')->get();
        $sd_status = Sd_Status::orderBy('name')->get();
        $year = Year::orderBy('name')->get();
        $week = Week::orderBy('name')->get();
        $add_comment = AddComment::orderBy('name')->get();
        $resource_team = ResourceTeam::orderBy('name')->get();
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('id',$id)->with('planning_record','permission_record','build_record','attachment_record','landlord_record','site_survey_record')->get()->toArray();  
        return view('admin/service-delivery-status/project-status-single',compact('all_records','all_return_to_sale','all_service_delivery_status','sd_status','year','week','add_comment','resource_team')); 
      }

    //function for department_comment_view
    public function department_comment_view(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->orderby('id','DESC')->with('planning_record','permission_record','build_record')->paginate(50);
        $view =  view('admin/service-delivery-status/department-comment-view', compact('all_records'));
        return $view;
    }

    //function for department_comment_single
    public function department_comment_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('id',$id)->with('planning_record','permission_record','build_record')->get()->toArray();  
        $view =  view('admin/service-delivery-status/department-comment-single', compact('all_records'));
        return $view;
    }

    //function for project_comment_view
    public function project_comment_view(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->orderby('id','DESC')->with('planning_record','permission_record','build_record')->paginate(50);
        $view =  view('admin/service-delivery-status/project-comment-view', compact('all_records'));
        return $view;
    }

    //function for project_comment_single
    public function project_comment_single($id){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('id',$id)->with('planning_record','permission_record','build_record')->get()->toArray();  
        $view =  view('admin/service-delivery-status/project-comment-single', compact('all_records'));
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
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('service_id','like','%'.$keyword.'%')->with('planning_record','permission_record','build_record')->paginate(50);
        } 
        
        if(!empty($request->get('region'))){
          $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('region','like','%'.$region.'%')->with('planning_record','permission_record','build_record')->paginate(50);
        } 

        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
          $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('planning_record','permission_record','build_record')->paginate(50);
        }
       
        $view =  view('admin/service-delivery-status/search-list', compact('all_records'));
        return $view;
    }
	  //function for search records
    public function search_department_records(Request $request){
        //Get Request
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('service_id','like','%'.$keyword.'%')->with('planning_record','permission_record','build_record')->paginate(50);
        } 
        
        if(!empty($request->get('region'))){
          $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('region','like','%'.$region.'%')->with('planning_record','permission_record','build_record')->paginate(50);
        } 

        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
          $all_records = SiteMasterFile::whereIn('region',$is_login_region)->where('service_id','like','%'.$keyword.'%')->where('region','like','%'.$region.'%')->with('planning_record','permission_record','build_record')->paginate(50);
        }
        $view =  view('admin/service-delivery-status/search-department-list', compact('all_records'));
        return $view;
    }

      
          //function for update new record
          public function update_service_delivery_status(Request $request, $circuit_id){  

            $build_status = $request['build_status'];  
            $project_status = $request['project_status']; 
            $service_delivery_status = $request['service_delivery_status'];  

            $sales_status = $request['sales_status'];
           // echo $sales_status;exit;
            $planning_status = $request['planning_status']; 
            $permission_status = $request['permissions_status']; 
            $update_master_file_record = SiteMasterFile::Where('circuit_id', $circuit_id)->update([
                'service_delivery_status' => $service_delivery_status]);
            //Check if data is updated or not
            if($update_master_file_record){        
            //check project status
             
                if($sales_status == 'D) Cancelled' OR $planning_status == 'O) Cancelled' OR  $permission_status == 'H) Cancelled' OR $build_status == 'P) Cancelled' AND $service_delivery_status == 'J) Cancelled' ){
                    $new_project_status = 'Q) Cancelled';
                } elseif( $sales_status == 'C) On-Hold' OR $planning_status == 'L) On-hold' OR $build_status == 'G) On-Hold' OR $permission_status == 'D) On-Hold' AND $service_delivery_status == 'I) On-Hold'){
                    $new_project_status = 'R) On-Hold';
                } elseif($planning_status == 'N) Return to Sales' OR $build_status == 'O) Return to Sales' AND $service_delivery_status == 'R) Return to Sales' ){   
                    $new_project_status = 'S) Return to Sales';
                }  elseif( $build_status == 'F) VO Requested' && $service_delivery_status == 'L) Back to Planning'){
                  $new_project_status = 'G) VO Process';
                } elseif($build_status == 'K) TOC P2 Submitted-SD' && $service_delivery_status == 'D) TOC P2 Received-Build'){
                   $new_project_status = 'M) Service Delivery';
                } elseif($service_delivery_status == 'E) TOC P2 Submitted-Client'){
                  $new_project_status = 'N) TOC P2 Submitted';
                } elseif($service_delivery_status == 'F) TOC P2 Received-Client'){
                  $new_project_status = 'O) TOC P2 Received';
                } elseif($service_delivery_status == 'Q) Deemed Toc Received'){
                  $new_project_status = 'O) TOC P2 Received';
                } elseif($sales_status == 'E) Terminated' && $service_delivery_status == 'S) Terminated'){
                    $new_project_status = 'U) Terminated';
                } elseif($build_status == 'N) OTOC Received' &&  $service_delivery_status == "K) OTOC'd"){
                    $new_project_status = 'T) Complete';
                } elseif($build_status == 'K) TOC P2 Submitted-SD'  && $service_delivery_status == 'D) TOC P2 Received-Build'){
                  $new_project_status = 'M) Service Delivery';
                } else{
                  $new_project_status = $project_status;
                }
               
                //check sales status
                $sales_status = 'A) New Sales';
                if($service_delivery_status == 'U) Data Fix'){
                  $sales_status = 'F) Data Fix';
                }
                   $update_record = SiteMasterFile::where('circuit_id',$circuit_id)->update([
                   'project_status' => $new_project_status,
                   'sales_status' => $sales_status,
                  ]);
                    $this->update_all_service_delivery($request,$circuit_id);
                    //Call Manage History Helper
                    $fieldsStr = '';
                    $valuesStr = '';   
                    $module_type = "Service Delivery";
                    $page_name = url()->previous();
                    Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
                    return back()->with('success','Record Updated Successfully');
                } else {
                    return back()->with('unsuccess','Opps Something wrong!');
                }
        }
     

        //function for update all service delivery
        public function update_all_service_delivery($request,$circuit_id){

            $sch_date = null;
            if( $request['sch_date']){
            $sch_date = Carbon::parse($request['sch_date']);
            }
            $site_master_record = [
                                 'service_delivery_status' => $request['service_delivery_status'],
                                 'service_delivery_comments' => $request['service_delivery_comments'],
                                 'sales_comments' => $request['sales_comments'],
                                 'shc_status' => $request['shc_status'],  
                                 'sch_date' => $sch_date,   
                                 'return_to_sales' => $request['return_to_sales'], 
                                 'estimated_enterprise_usage' => $request['estimated_enterprise_usage'], 
                                 'qty' => $request['qty'],
                                 'year' => $request['year'],
                                 'sd_status' => $request['sd_status'],
                                 'week' => $request['week'],
                                 'resources' => $request['resources'],
                                 'comments' => $request['comments'],
                                 ];
           // build
            $Submitted_to_customer = null;
            if( $request['Submitted_to_customer']){
            $Submitted_to_customer = Carbon::parse($request['Submitted_to_customer']);
            }
            $toc_received_date_recieved = null;
            if( $request['toc_received_date_recieved']){
            $toc_received_date_recieved = Carbon::parse($request['toc_received_date_recieved']);
            }
            $planned_build_completion_date = null;
            if( $request['planned_build_completion_date']){
            $planned_build_completion_date = Carbon::parse($request['planned_build_completion_date']);
            }

            $build_record =     [
                                'Submitted_to_customer' => $Submitted_to_customer,
                                'toc_received_date_recieved' => $toc_received_date_recieved,
                                'planned_build_completion_date' => $planned_build_completion_date,
                                ]; 
 
            //update                    
            $update_site_master_file_record = SiteMasterFile::Where('circuit_id', $circuit_id)->update($site_master_record);
            $update_build_master_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update($build_record);                    
}
}
