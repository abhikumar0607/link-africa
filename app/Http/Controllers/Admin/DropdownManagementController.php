<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderType;
use App\Models\NetworkType;
use App\Models\ThirdPartyProvider;
use App\Models\LeaseTermInMonth;
use App\Models\ReturnToSale;
use App\Models\Strands;
use App\Models\RateMbitS;
use App\Models\ProjectType;
use App\Models\PlanningStatus;
use App\Models\OspStatusPlanning;
use App\Models\SiteStatus;
use App\Models\OSPPLanners;
use App\Models\IspPLanners;
use App\Models\Surveyors;
use App\Models\AddSiteSurveyStatus;
use App\Models\AddLandlordStatus;
use App\Models\AddPermissionStatus;
use App\Models\AddWayleavesStatus;
use App\Models\Resources;
use App\Models\BuildStatus;
use App\Models\BuildOSPStatus;
use App\Models\AddServiceDeliveryStatus;
use App\Models\Sd_Status;
use App\Models\Year;
use App\Models\Week;
use App\Models\AddComment;
use App\Models\ResourceTeam;
class DropdownManagementController extends Controller
{
    //function for all order name
    public function all_order_name(){
        $all_records = OrderType::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/order-all-list',compact('all_records'));
    }

    //function for submit kam name
    public function submit_order_name(Request $request){
        $order_name = $request['order_name'];
        //validation
        $request->validate([
            'order_name' => 'required', 'string', 'max:255',
        ]);
        //check order name is already exit or not
        $is_order_name = OrderType::where('order_name',$order_name)->exists();
        if($is_order_name){
           return back()->with('unsuccess','Order name is already exist!');
        } else {
        //insert query
            $create_order_name = OrderType::create([
                'order_name' => $request['order_name'],
            ]);
            //Check if new kam name is created
            if($create_order_name) {
                return back()->with('success','New Order name Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
      }
    }

     //function for order  name
     public function delete_order_name($id){
        $delete_order_name = OrderType::where('id', $id)->delete();

        // check record is delete or not
        if($delete_order_name) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

     //function for all network name
     public function all_network_type(){
        $all_records = NetworkType::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/network-all-list',compact('all_records'));
    }

     //function for submit network name
     public function submit_network_type(Request $request){
        $network_type = $request['network_type'];
        //validation
        $request->validate([
            'network_type' => 'required', 'string', 'max:255',
        ]);
        //check order name is already exit or not
        $is_network_type = NetworkType::where('network_type',$network_type)->exists();
        if($is_network_type){
           return back()->with('unsuccess','Network Type is already exist!');
        } else {
        //insert query
        $create_network_type = NetworkType::create([
            'network_type' => $request['network_type'],
        ]);
        //Check if new kam name is created
        if($create_network_type) {
            return back()->with('success','New Network Type Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
    }
    //function for network  name
    public function delete_network_type($id){
        $delete_network_type = NetworkType::where('id', $id)->delete();

        // check record is delete or not
        if($delete_network_type) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all third party provider name
    public function all_third_party_provider_list(){
        $all_records = ThirdPartyProvider::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/third-party-provider-all-list',compact('all_records'));
    }

     //function for submit thirdparty provider
     public function submit_thrd_party_provider(Request $request){
        $thrd_party_provider = $request['thrd_party_provider'];
        //validation
        $request->validate([
            'thrd_party_provider' => 'required', 'string', 'max:255',
        ]);
        //check order name is already exit or not
        $is_thrd_party_provider = ThirdPartyProvider::where('thrd_party_provider',$thrd_party_provider)->exists();
        if($is_thrd_party_provider){
           return back()->with('unsuccess','Third Party Provider is already exist!');
        } else {
        //insert query
        $create_thrd_party_provider = ThirdPartyProvider::create([
            'thrd_party_provider' => $request['thrd_party_provider'],
        ]);
        //Check if new kam name is created
        if($create_thrd_party_provider) {
            return back()->with('success','New Third Party Provider  Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
    }

    //function for delete third party provider  name
    public function delete_third_party_provider($id){
        $delete_third_party_provider = ThirdPartyProvider::where('id', $id)->delete();
        // check record is delete or not
        if($delete_third_party_provider) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

     //function for all lease term in moth list
     public function all_lease_term_in_month_list(){
        $all_records = LeaseTermInMonth::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/lease-term-all-list',compact('all_records'));
    }

     //function for submit lease term in month name
     public function submit_lease_term_in_month(Request $request){
        $lease_term_in_month = $request['lease_term_in_month'];
        //validation
        $request->validate([
            'lease_term_in_month' => 'required', 'string', 'max:255',
        ]);
        //check order name is already exit or not
        $is_lease_term_in_month = LeaseTermInMonth::where('lease_term_in_month',$lease_term_in_month)->exists();
        if($is_lease_term_in_month){
           return back()->with('unsuccess','Lease Term In Month  is already exist!');
        } else {
        //insert query
        $create_lease_term_in_month = LeaseTermInMonth::create([
            'lease_term_in_month' => $request['lease_term_in_month'],
        ]);
        //Check if new kam name is created
        if($create_lease_term_in_month) {
            return back()->with('success','New Lease Term In Month  Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
    }

    //function for delete lease term in month
    public function delete_lease_term_in_month($id){
        $delete_lease_term_in_month = LeaseTermInMonth::where('id', $id)->delete();
        // check record is delete or not
        if($delete_lease_term_in_month) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all return to sale list
    public function all_return_to_sale_list(){
        $all_records = ReturnToSale::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/return-sale-all-list',compact('all_records'));
    }
    //function for submit lease term in month name
    public function submit_return_to_sale(Request $request){
        $return_to_sale = $request['return_to_sale'];
        //validation
        $request->validate([
            'return_to_sale' => 'required', 'string', 'max:255',
        ]);
        //check order name is already exit or not
        $is_return_to_sale = ReturnToSale::where('return_to_sale',$return_to_sale)->exists();
        if($is_return_to_sale){
            return back()->with('unsuccess','Return To Sale  is already exist!');
        } else {
        //insert query
        $create_return_to_sale = ReturnToSale::create([
            'return_to_sale' => $request['return_to_sale'],
        ]);
        //Check if new kam name is created
        if($create_return_to_sale) {
            return back()->with('success','New Return To Sale  Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
    }
    //function for delete return to sale
    public function delete_return_to_sale($id){
        $delete_return_to_sale = ReturnToSale::where('id', $id)->delete();
        // check record is delete or not
        if($delete_return_to_sale) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all strands list
    public function all_strands_list(){
        $all_records = Strands::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/strands-all-list',compact('all_records'));
    }
   
    //function for submit lease term in month name
    public function submit_strands(Request $request){
        $strands = $request['strands'];
        //validation
        $request->validate([
            'strands' => 'required', 'string', 'max:255',
        ]);
        //check order name is already exit or not
        $is_strands_exist = Strands::where('strands',$strands)->exists();
        if($is_strands_exist){
            return back()->with('unsuccess','Strand is already exist!');
        } else {
        //insert query
        $create_strands = Strands::create([
            'strands' => $request['strands'],
        ]);
        //Check if new kam name is created
        if($create_strands) {
            return back()->with('success','New Strand Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
    }
    //function for delete strands
    public function delete_strands($id){
        $delete_strands = Strands::where('id', $id)->delete();
        // check record is delete or not
        if($delete_strands) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all strands list
    public function all_rate_mbit_s_list(){
        $all_records = RateMbitS::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/rate-mbit-s-all-list',compact('all_records'));
    }
     //function for submit 
     public function submit_rate_mbit_s(Request $request){
        $rate_mbit_s = $request['rate_mbit_s'];
        //validation
        $request->validate([
            'rate_mbit_s' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_rate_mbit_s_exist = RateMbitS::where('rate_mbit_s',$rate_mbit_s)->exists();
        if($is_rate_mbit_s_exist){
            return back()->with('unsuccess','Rate Mbit-s is already exist!');
        } else {
        //insert query
        $create_rate_mbit_s = RateMbitS::create([
            'rate_mbit_s' => $request['rate_mbit_s'],
        ]);
        //Check if  is created
        if($create_rate_mbit_s) {
            return back()->with('success','New Rate Mbit-s Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
    }

    //function for delete rate mbit s
    public function delete_rate_mbit_s($id){
        $delete_rate_mbit_s = RateMbitS::where('id', $id)->delete();
        // check record is delete or not
        if($delete_rate_mbit_s) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
	//function for all project type list
    public function all_project_type_list(){
        $all_records = ProjectType::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/project-type-all-list',compact('all_records'));
    }
	//function for submit  name
    public function submit_project_type(Request $request){
        $project_type = $request['project_type'];
        //validation
        $request->validate([
            'project_type' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_project_type_exist = ProjectType::where('project_type',$project_type)->exists();
        if($is_project_type_exist){
            return back()->with('unsuccess','Project Type is already exist!');
        } else {
        //insert query
        $create_project_type = ProjectType::create([
            'project_type' => $request['project_type'],
        ]);
        //Check if  is created
        if($create_project_type) {
            return back()->with('success','New Project Type Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
	}
	//function for delete project type
    public function delete_project_type($id){
        $delete_project_type = ProjectType::where('id', $id)->delete();
        // check record is delete or not
        if($delete_project_type) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
	//function for all project type list
    public function all_planning_status_list(){
        $all_records = PlanningStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/planning-status-all-list',compact('all_records'));
    }
	//function for submit planning status
    public function submit_planning_status(Request $request){
        $planning_status = $request['planning_status'];

        //validation
        $request->validate([
            'planning_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_planning_status_exist = PlanningStatus::where('planning_status',$planning_status)->exists();
        if($is_planning_status_exist){
            return back()->with('unsuccess','Planning Status is already exist!');
        } else {
        //insert query
        $create_planning_status = PlanningStatus::create([
            'planning_status' => $request['planning_status'],
        ]);
        //Check if  is created
        if($create_planning_status) {
            return back()->with('success','New Planning Status Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
	}
	//function for delete 
    public function delete_planning_status($id){
        $delete_planning_status = PlanningStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_planning_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
	//function for all  list
    public function all_osp_status_planning_list(){
        $all_records = OspStatusPlanning::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/osp-status-planning-all-list',compact('all_records'));
    }
		//function for submit planning status
    public function submit_osp_planning_status(Request $request){
        $osp_planning_status = $request['osp_status_planning'];

        //validation
        $request->validate([
            'osp_status_planning' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_osp_planning_status_exist = OspStatusPlanning::where('osp_status_planning',$osp_planning_status)->exists();
        if($is_osp_planning_status_exist){
            return back()->with('unsuccess','Osp Status Planning is already exist!');
        } else {
        //insert query
        $create_osp_planning_status = OspStatusPlanning::create([
            'osp_status_planning' => $request['osp_status_planning'],
        ]);
        //Check if  is created
        if($create_osp_planning_status) {
            return back()->with('success','New Osp Status Planning Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
	}
	//function for delete 
    public function delete_osp_planning_status($id){
        $delete_osp_planning_status = OspStatusPlanning::where('id', $id)->delete();
        // check record is delete or not
        if($delete_osp_planning_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
	//function for all  list
    public function all_site_status_list(){
        $all_records = SiteStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/site-status-all-list',compact('all_records'));
    }
	//function for submit planning status
    public function submit_site_status(Request $request){
        $site_status = $request['site_status'];

        //validation
        $request->validate([
            'site_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_site_status_exist = SiteStatus::where('site_status',$site_status)->exists();
        if($is_site_status_exist){
            return back()->with('unsuccess','Site Status is already exist!');
        } else {
        //insert query
        $create_site_status = SiteStatus::create([
            'site_status' => $request['site_status'],
        ]);
        //Check if  is created
        if($create_site_status) {
            return back()->with('success','New Site Status Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
	}
	//function for delete 
    public function delete_site_status($id){
        $delete_site_status = SiteStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_site_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
    //function for all  list
    public function all_osp_planner_list(){
        $all_records = OSPPLanners::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/ops-planners-all-list',compact('all_records'));
    }
    //function for submit osp planner status
    public function submit_osp_planner(Request $request){
        $osp_planners = $request['osp_planners'];

        //validation
        $request->validate([
            'osp_planners' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_osp_planners_exist = OSPPLanners::where('osp_planners',$osp_planners)->exists();
        if($is_osp_planners_exist){
            return back()->with('unsuccess','Osp Planner is already exist!');
        } else {
        //insert query
        $create_osp_planners = OSPPLanners::create([
            'osp_planners' => $request['osp_planners'],
        ]);
        //Check if  is created
        if($create_osp_planners) {
            return back()->with('success','New Osp Planner Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
        }
    }
    //function for delete 
    public function delete_osp_planners($id){
        $delete_osp_planners = OSPPLanners::where('id', $id)->delete();
        // check record is delete or not
        if($delete_osp_planners) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
    //function for all  list
    public function all_isp_planner_list(){
        $all_records = IspPLanners::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/isp-planners-all-list',compact('all_records'));
    }
    //function for submit isp planner status
    public function submit_isp_planner(Request $request){
        $isp_planners = $request['isp_planners'];

        //validation
        $request->validate([
            'isp_planners' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_isp_planners_exist = IspPLanners::where('isp_planners',$isp_planners)->exists();
        if($is_isp_planners_exist){
            return back()->with('unsuccess','Isp Planner is already exist!');
        } else {
        //insert query
        $create_isp_planners = IspPLanners::create([
            'isp_planners' => $request['isp_planners'],
        ]);
        //Check if  is created
        if($create_isp_planners) {
            return back()->with('success','New Isp Planner Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
        }
    }
    //function for delete 
    public function delete_isp_planners($id){
        $delete_isp_planners = IspPLanners::where('id', $id)->delete();
        // check record is delete or not
        if($delete_isp_planners) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
    //function for all  list
    public function all_surveyors_list(){
        $all_records = Surveyors::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/surveyors-all-list',compact('all_records'));
    }

    //function for submit  
    public function submit_surveyors(Request $request){
        $surveyors = $request['surveyors'];

        //validation
        $request->validate([
            'surveyors' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_surveyors_exist = Surveyors::where('surveyors',$surveyors)->exists();
        if($is_surveyors_exist){
            return back()->with('unsuccess','Surveyors is already exist!');
        } else {
            //insert query
            $create_surveyors = Surveyors::create([
                'surveyors' => $request['surveyors'],
            ]);
            //Check if  is created
            if($create_surveyors) {
                return back()->with('success','New Surveyors Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_surveyors($id){
        $delete_surveyors = Surveyors::where('id', $id)->delete();
        // check record is delete or not
        if($delete_surveyors) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
    public function all_site_survey_status_list(){
        $all_records = AddSiteSurveyStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/site-survey-all-list',compact('all_records'));
    }

      //function for submit  
      public function submit_site_survey_status(Request $request){
        $site_survey_status = $request['site_survey_status'];

        //validation
        $request->validate([
            'site_survey_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_site_survey_status_exist = AddSiteSurveyStatus::where('site_survey_status',$site_survey_status)->exists();
        if($is_site_survey_status_exist){
            return back()->with('unsuccess','Site Survey Status is already exist!');
        } else {
            //insert query
            $create_site_survey_status = AddSiteSurveyStatus::create([
                'site_survey_status' => $request['site_survey_status'],
            ]);
            //Check if  is created
            if($create_site_survey_status) {
                return back()->with('success','New Site Survey Status Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_site_survey_status($id){
        $delete_site_survey_status = AddSiteSurveyStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_site_survey_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
     public function all_landlord_status_list(){
        $all_records = AddLandlordStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/landlord-status-all-list',compact('all_records'));
    }

    //function for submit  
    public function submit_landlord_status(Request $request){
        $landlord_status = $request['landlord_status'];

        //validation
        $request->validate([
            'landlord_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_landlord_status_exist = AddLandlordStatus::where('landlord_status',$landlord_status)->exists();
        if($is_landlord_status_exist){
            return back()->with('unsuccess','Landlord Status is already exist!');
        } else {
            //insert query
            $create_landlord_status = AddLandlordStatus::create([
                'landlord_status' => $request['landlord_status'],
            ]);
            //Check if  is created
            if($create_landlord_status) {
                return back()->with('success','New Landlord Status Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_landlord_status($id){
        $delete_landlord_status = AddLandlordStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_landlord_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
    public function all_permission_status_list(){
        $all_records = AddPermissionStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/permission-status-all-list',compact('all_records'));
    }

    //function for submit  
    public function submit_permission_status(Request $request){
        $permission_status = $request['permission_status'];

        //validation
        $request->validate([
            'permission_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_permission_status_exist = AddPermissionStatus::where('permission_status',$permission_status)->exists();
        if($is_permission_status_exist){
            return back()->with('unsuccess','Permission Status is already exist!');
        } else {
            //insert query
            $create_permission_status = AddPermissionStatus::create([
                'permission_status' => $request['permission_status'],
            ]);
            //Check if  is created
            if($create_permission_status) {
                return back()->with('success','New Permission Status Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_permission_status($id){
        $delete_permission_status = AddPermissionStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_permission_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
    public function all_wayleaves_status_list(){
        $all_records = AddWayleavesStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/wayleaves-status-all-list',compact('all_records'));
    }

    //function for submit  
    public function submit_wayleaves_status(Request $request){
        $wayleaves_status = $request['wayleaves_status'];

        //validation
        $request->validate([
            'wayleaves_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_wayleaves_status_exist = AddWayleavesStatus::where('wayleaves_status',$wayleaves_status)->exists();
        if($is_wayleaves_status_exist){
            return back()->with('unsuccess','Wayleaves Status is already exist!');
        } else {
            //insert query
            $create_wayleaves_status = AddWayleavesStatus::create([
                'wayleaves_status' => $request['wayleaves_status'],
            ]);
            //Check if  is created
            if($create_wayleaves_status) {
                return back()->with('success','New Wayleaves Status Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }
    //function for delete 
    public function delete_wayleaves_status($id){
        $delete_wayleaves_status = AddWayleavesStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_wayleaves_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
    public function all_resources_list(){
        $all_records = Resources::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/resources-all-list',compact('all_records'));
    }

    //function for submit  
    public function submit_resources(Request $request){
        $resources = $request['resources'];

        //validation
        $request->validate([
            'resources' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_resources_exist = Resources::where('resources',$resources)->exists();
        if($is_resources_exist){
            return back()->with('unsuccess','Resources is already exist!');
        } else {
            //insert query
            $create_resources = Resources::create([
                'resources' => $request['resources'],
            ]);
            //Check if  is created
            if($create_resources) {
                return back()->with('success','New Resources Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_resources($id){
        $delete_resources = Resources::where('id', $id)->delete();
        // check record is delete or not
        if($delete_resources) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
    public function all_build_status_list(){
        $all_records = BuildStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/build-status-all-list',compact('all_records'));
    }

    //function for submit  
    public function submit_build_status(Request $request){
        $build_status = $request['build_status'];

        //validation
        $request->validate([
            'build_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_build_status_exist = BuildStatus::where('build_status',$build_status)->exists();
        if($is_build_status_exist){
            return back()->with('unsuccess','Build Status is already exist!');
        } else {
            //insert query
            $create_build_status = BuildStatus::create([
                'build_status' => $request['build_status'],
            ]);
            //Check if  is created
            if($create_build_status) {
                return back()->with('success','New Build Status  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_build_status($id){
        $delete_build_status = BuildStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_build_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
     public function all_build_osp_status_list(){
        $all_records = BuildOSPStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/build-osp-status',compact('all_records'));
    }

    //function for submit  
    public function submit_build_osp_status(Request $request){
        $build_osp_status = $request['build_osp_status'];

        //validation
        $request->validate([
            'build_osp_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_build_osp_status_exist = BuildOSPStatus::where('build_osp_status',$build_osp_status)->exists();
        if($is_build_osp_status_exist){
            return back()->with('unsuccess','Build OSP Status is already exist!');
        } else {
            //insert query
            $create_build_osp_status = BuildOSPStatus::create([
                'build_osp_status' => $request['build_osp_status'],
            ]);
            //Check if  is created
            if($create_build_osp_status) {
                return back()->with('success','New Build OSP Status  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

     //function for delete 
     public function delete_build_osp_status($id){
        $delete_build_osp_status = BuildOSPStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_build_osp_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for all  list
    public function all_service_delivery_status_list(){
        $all_records = AddServiceDeliveryStatus::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/service-delivery-status-all-list',compact('all_records'));
    }

    //function for submit  
    public function submit_service_delivery_status(Request $request){
        $service_delivery_status = $request['service_delivery_status'];

        //validation
        $request->validate([
            'service_delivery_status' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_service_delivery_status_exist = AddServiceDeliveryStatus::where('service_delivery_status',$service_delivery_status)->exists();
        if($is_service_delivery_status_exist){
            return back()->with('unsuccess','Service Delivery Status is already exist!');
        } else {
            //insert query
            $create_service_delivery_status = AddServiceDeliveryStatus::create([
                'service_delivery_status' => $request['service_delivery_status'],
            ]);
            //Check if  is created
            if($create_service_delivery_status) {
                return back()->with('success','New Service Delivery Status  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_service_delivery_status($id){
        $delete_service_delivery_status = AddServiceDeliveryStatus::where('id', $id)->delete();
        // check record is delete or not
        if($delete_service_delivery_status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

        //function for add sd status
        public function all_sd_status_list(){
            $all_records = Sd_Status::orderBy('id','DESC')->get();
            return view('admin/dropdown-managment/sd-status',compact('all_records'));
        }

      //function for submit  
      public function submit_sd_status_status(Request $request){
        $name = $request['name'];

        //validation
        $request->validate([
            'name' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_name_exist = Sd_Status::where('name',$name)->exists();
        if($is_name_exist){
            return back()->with('unsuccess','Service Delivery Status is already exist!');
        } else {
            //insert query
            $create_name = Sd_Status::create([
                'name' => $request['name'],
            ]);
            //Check if  is created
            if($create_name) {
                return back()->with('success','New Sd Status  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_sd_status($id){
        $delete_Sd_Status = Sd_Status::where('id', $id)->delete();
        // check record is delete or not
        if($delete_Sd_Status) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for add years
    public function all_year_list(){
        $all_records = Year::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/year-list',compact('all_records'));
    }

    //function for submit  
    public function submit_years(Request $request){
        $name = $request['name'];

        //validation
        $request->validate([
            'name' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_name_exist = Sd_Status::where('name',$name)->exists();
        if($is_name_exist){
            return back()->with('unsuccess','name is already exist!');
        } else {
            //insert query
            $create_name = Year::create([
                'name' => $request['name'],
            ]);
            //Check if  is created
            if($create_name) {
                return back()->with('success','New Year Name  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_year($id){
        $delete_year = Year::where('id', $id)->delete();
        // check record is delete or not
        if($delete_year) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for add week
    public function all_week_list(){
        $all_records = Week::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/all-week-list',compact('all_records'));
    }

    //function for submit  
    public function submit_weeks(Request $request){
        $name = $request['name'];

        //validation
        $request->validate([
            'name' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_name_exist = Week::where('name',$name)->exists();
        if($is_name_exist){
            return back()->with('unsuccess','name is already exist!');
        } else {
            //insert query
            $create_name = Week::create([
                'name' => $request['name'],
            ]);
            //Check if  is created
            if($create_name) {
                return back()->with('success','New Week Name  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_week($id){
        $delete_week = Week::where('id', $id)->delete();
        // check record is delete or not
        if($delete_week) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

    //function for add comment
    public function all_comment_list(){
        $all_records = AddComment::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/all-comment-list',compact('all_records'));
    }

    //function for submit  
    public function submit_comments(Request $request){
        $name = $request['name'];

        //validation
        $request->validate([
            'name' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_name_exist = AddComment::where('name',$name)->exists();
        if($is_name_exist){
            return back()->with('unsuccess','name is already exist!');
        } else {
            //insert query
            $create_name = AddComment::create([
                'name' => $request['name'],
            ]);
            //Check if  is created
            if($create_name) {
                return back()->with('success','New Comment  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_comment($id){
        $delete_week = AddComment::where('id', $id)->delete();
        // check record is delete or not
        if($delete_week) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
    
    //function for add comment
    public function all_resource_team_list(){
        $all_records = ResourceTeam::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/all-resource-team-list',compact('all_records'));
    }

    //function for submit  
    public function submit_resource_team(Request $request){
        $name = $request['name'];

        //validation
        $request->validate([
            'name' => 'required', 'string', 'max:255',
        ]);
        //check already exit or not
        $is_name_exist = ResourceTeam::where('name',$name)->exists();
        if($is_name_exist){
            return back()->with('unsuccess','name is already exist!');
        } else {
            //insert query
            $create_name = ResourceTeam::create([
                'name' => $request['name'],
            ]);
            //Check if  is created
            if($create_name) {
                return back()->with('success','New Resource  Is Created Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }
    }

    //function for delete 
    public function delete_resource_team($id){
        $delete_week = ResourceTeam::where('id', $id)->delete();
        // check record is delete or not
        if($delete_week) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }

}
