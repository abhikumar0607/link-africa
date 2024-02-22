<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BuildMasterFileController;
use App\Models\SiteMasterFile;
use App\Models\BuildMasterFile;
use Illuminate\Http\Request;

use App\Models\Customer;

class CustomerController extends Controller
{
    //Function for show index view file
    public function index(){
        $view =  view('admin/customer/add-new-customer');
        return $view;
    }
    
     //Function for show map view file
     public function view_map(){
        $view =  view('admin/customer/map');
        return $view;
    }

    //Function for show map view file
    public function view_customer_map(){
        $view =  view('admin/customer/customer-map');
        return $view;
    }
    //function for submit new record
    public function submit_customer(Request $request){
		//validation rule
        request()->validate([
            'name' => 'required', 'string', 'max:255',
        ]);
        $name = $request['name'];
        $contact_number = $request['contact_number'];
        //echo $contact_number;exit;
        $email = $request['email'];
      
        //Insert query
        $is_insert =  Customer::create([
            'name' => $name,
            'contact_number' => $contact_number,
            'email' => $email,
           
        ]);
        //Check if data is inserted or not
        if($is_insert){
            return back()->with('success','New Customer Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    //function for get all customer
    public function get_customer(){
        $records = Customer::orderBy('id','DESC')->get();
        $view =  view('admin/customer/all-customer', compact('records'));
        return $view;
    }

   //function for delete customer
   public function delete_customer($id){
    $delete_custumer = Customer::where('id', $id)->delete();
    if($delete_custumer){
        return back()->with('success','Customer deleted Successfully');
    } else {
        return back()->with('unsuccess','Opps Something wrong!');
    }
   } 

    //public fucntion for customer view
    public function customer_view(){

        $client_name = Auth::user()->client_name; 
        $all_records = SiteMasterFile::where('client_name', $client_name)->whereNotIn('project_status', ['Q) Cancelled','T) Complete','U) Terminated'])->with('planning_record','build_record','site_survey_record','landlord_record')->paginate(50);
        //echo "<pre>";print_r($all_records);exit;
        //foreach for get estimation date
        foreach($all_records as  $result){
            $project_type = $result->type;

            //call another function
            //$project_type = $result['type'];
            $BuildMasterFileController = new BuildMasterFileController();
            $planned_start_date = $BuildMasterFileController->change_planned_start_date($result->planning_record->revised_planned_wp2_date,$result->planning_record->planned_wp2_released_date);
            $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);
            //echo"<pre>";print_r($est_complition_date);
        }
        $view =  view('admin/customer/customer-view', compact('all_records','est_complition_date'));
        return $view;
   }

    //public fucntion for single customer view
    public function single_customer_view($id){
    $client_name = Auth::user()->client_name; 
    $record = SiteMasterFile::where('id', $id)->with('planning_record','build_record','site_survey_record','landlord_record')->get();
    $project_type = $record[0]->type;

    //call another function
    $BuildMasterFileController = new BuildMasterFileController();
    $planned_start_date = $BuildMasterFileController->change_planned_start_date($record[0]->planning_record->revised_planned_wp2_date,$record[0]->planning_record->planned_wp2_released_date);
    $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);

    $view =  view('admin/customer/single-customer', compact('record','est_complition_date'));
    return $view;
   }

//public function for customer comment
 public function customer_comment(Request $request ,$id){
     $comments = $request['comments'];
     $record = SiteMasterFile::where('id', $id)->update([
                                 "comments" => $comments,
     ]);
    if($record){
        return back()->with('success','Comment Added Successfully');
    } else {
        return back()->with('unsuccess','Opps Something wrong!');
    }                         
  }

  public function search_customer_records(Request $request){
    //Get Request 
   // echo "yes";
    $client_name = Auth::user()->client_name; 
    $keyword = $request->get('keyword');
    $all_records = SiteMasterFile::where('client_name', $client_name)->Where('service_id','like','%'.$keyword.'%')->paginate(50);  
    $view =  view('admin/customer/serach-customer', compact('all_records'));
    return $view;
 }

 //public function for all customer view
 public function all_customer_view(){
    $all_records = SiteMasterFile::orderBy('id','DESC')->whereNotIn('project_status', ['Q) Cancelled','T) Complete','U) Terminated'])
    ->with('planning_record','permission_record','build_record','landlord_record','site_survey_record')->paginate(50);
    foreach($all_records as  $result){
        $project_type = $result->type;

        //call another function
        //$project_type = $result['type'];
        $BuildMasterFileController = new BuildMasterFileController();
        $planned_start_date = $BuildMasterFileController->change_planned_start_date($result->planning_record->revised_planned_wp2_date,$result->planning_record->planned_wp2_released_date);
        $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);
        //echo"<pre>";print_r($est_complition_date);
    }
    
    $all_customers = Customer::orderBy('name')->get();
    $view =  view('admin/customer/all-customer-view', compact('all_records','est_complition_date','all_customers'));
    return $view;
 }

 //function for search customer
 public function search_single_customer_records(Request $request){
    //Get Request 
   // echo "yes";
    $client_name = $request->get('client_name');
    $keyword = $request->get('keyword');
    if(!empty($request->get('keyword'))){
        $all_records = SiteMasterFile::Where('service_id','like','%'.$keyword.'%')->whereNotIn('project_status', ['Q) Cancelled','T) Complete','U) Terminated'])
        ->with('planning_record','permission_record','build_record','landlord_record','site_survey_record')->paginate(50);
    } 
    
    if(!empty($request->get('client_name'))){
        $all_records = SiteMasterFile::Where('client_name', 'like', '%'. $client_name.'%')->whereNotIn('project_status', ['Q) Cancelled','T) Complete','U) Terminated'])
        ->with('planning_record','permission_record','build_record','landlord_record','site_survey_record')->paginate(50);
    } 

    if(!empty($request->get('keyword')) AND !empty($request->get('client_name'))){
        $all_records = SiteMasterFile::Where('service_id','like','%'.$keyword.'%')->Where('client_name', 'like', '%'. $client_name.'%')->whereNotIn('project_status', ['Q) Cancelled','T) Complete','U) Terminated'])
        ->with('planning_record','permission_record','build_record','landlord_record','site_survey_record')->paginate(50);
    }

       $est_complition_date = '';
        foreach($all_records as  $result){
            $project_type = $result->type;

            //call another function
            //$project_type = $result['type'];
            $BuildMasterFileController = new BuildMasterFileController();
            $planned_start_date = $BuildMasterFileController->change_planned_start_date($result->planning_record->revised_planned_wp2_date,$result->planning_record->planned_wp2_released_date);
            $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);
            //echo"<pre>";print_r($est_complition_date);
        }
    $all_customers = Customer::orderBy('name')->get();
    $view =  view('admin/customer/admin-search-customer', compact('all_records','est_complition_date','all_customers'));
    return $view;
 }

 // function for admin single customer
 public function admin_single_customer_view($id){
    $record = SiteMasterFile::where('id', $id)->with('planning_record','build_record','site_survey_record','landlord_record')->get();
    $project_type = $record[0]->type;

    //call another function
    $BuildMasterFileController = new BuildMasterFileController();
    $planned_start_date = $BuildMasterFileController->change_planned_start_date($record[0]->planning_record->revised_planned_wp2_date,$record[0]->planning_record->planned_wp2_released_date);
    $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);

    $view =  view('admin/customer/admin-single-customer', compact('record','est_complition_date'));
    return $view;
   }

 //public function for customer comment
 public function admin_customer_comment(Request $request ,$id){
    $comments = $request['comments'];
    $record = SiteMasterFile::where('id', $id)->update([
                                "comments" => $comments,
    ]);
   if($record){
       return back()->with('success','Comment Added Successfully');
   } else {
       return back()->with('unsuccess','Opps Something wrong!');
   }                         
 }
}
