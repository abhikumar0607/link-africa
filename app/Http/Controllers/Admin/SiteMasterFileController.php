<?php 
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\SiteMasterFile;
use App\Models\PlanningMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\BuildMasterFile;
use App\Models\ServiceType;
use App\Models\Customer;
use App\Models\Site;
use App\Models\Description;
use App\Models\ImportRegion;
use App\Models\DepartmentComment;
use App\Models\KamName;
use App\Models\OrderType;
use App\Models\NetworkType;
use App\Models\ThirdPartyProvider;
use App\Models\LeaseTermInMonth;
use App\Models\ReturnToSale;
use App\Models\Strands;
use App\Models\RateMbitS;
use App\Models\ProjectType;
use App\Models\SalesAttachment;
use App\Models\LandlordApproval;
use App\Models\SiteSurveyStatus;
use Carbon\Carbon;
use Helper;

class SiteMasterFileController extends Controller
{
    //Function for show index view file
    public function index(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->whereNoTIn('project_status',['V) Pending CTS'])->orderBy('id','DESC')->with('planning_record','permission_record','build_record')->paginate(50);
        $view =  view('admin/site-master-files/all-list', compact('all_records'));
        return $view;
    }
    
    //Function for show add new record view file
    public function add_new_record(){
        $all_customers = Customer::orderBy('id', 'DESC')->get();
        $all_kam_name = KamName::orderBy('kam_name')->get();
        $all_order_name = OrderType::orderBy('order_name')->get();
        $all_network_type = NetworkType::orderBy('network_type')->get();
        $all_service_types = ServiceType::orderBy('id', 'DESC')->whereNotNull('service_name')->get();
		$all_thrd_party_provider = ThirdPartyProvider::orderBy('thrd_party_provider')->get();
		$all_lease_term_in_month = LeaseTermInMonth::orderBy('id', 'ASC')->get();
		$all_return_to_sale = ReturnToSale::orderBy('return_to_sale')->get();
		$all_strands = Strands::orderBy('id', 'ASC')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_project_type = ProjectType::orderBy('project_type')->get();
        $all_site_a_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_a')->Where('module_type','sale')->orderBy('id', 'DESC')->get();
        $all_site_b_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_b')->Where('module_type','sale')->orderBy('id', 'DESC')->get();
        $all_descriptions = Description::orderBy('id', 'DESC')->get();
        
        $view =  view('admin/site-master-files/add-new-record',compact('all_customers','all_service_types','all_site_a_lists','all_site_b_lists','all_descriptions','all_kam_name','all_order_name','all_network_type','all_thrd_party_provider','all_lease_term_in_month','all_return_to_sale','all_strands','all_rate_mbit_s','all_project_type'));
        return $view;
    }
    
    //function for submit new record
    public function submit_new_record(Request $request){
		//validation rule
        request()->validate([
            'service_id' => 'required', 'string', 'max:255',
        ]);

         
        $service_id = $request['service_id'];
        $circuit_id = $request['circuit_id'];
        $project_id = $request['project_id'];

        //Check if service id is exit or not
        $isServiceIdExits = SiteMasterFile::where('service_id', $service_id)->count();
        if($isServiceIdExits >= 1){
            return back()->with('unsuccess','Service Id already exits. please try with new service id.');
        } else {
            $date_new = null;
            if($request['date_new']){
                $date_new = Carbon::parse($request['date_new']);
            }
           
            $cts_date = null;
            if($request['project_status'] == 'V) Pending CTS'){
                $cts_date = Carbon::now(); 
            }
           
            
            $project_status = $request['project_status'];
            $order_ref_number = $request['order_ref_number'];
            $province = $request['province'];
            $metro_area = $request['metro_area'];
            $client_name = $request['client_name'];
            $service_type = $request['service_type'];
            $client_ring = $request['client_ring'];
            $rate_mbit_s = $request['rate_mbit_s'];
            $site_a = $request['site_a'];
            $site_b = $request['site_b'];
            $date_po_order_rx = null;
            if($request['date_po_order_rx']){
                $date_po_order_rx = Carbon::parse($request['date_po_order_rx']);
            }
            $po_mrc = $request['po_mrc'];
            $po_nrc = $request['po_nrc'];
            $physical_address_site_a = $request['physical_address_site_a'];
            $gps_co_ordinates_site_a_x = $request['gps_co_ordinates_site_a_x'];
            $gps_co_ordinates_site_a_y = $request['gps_co_ordinates_site_a_y'];
            $contact_name_site_a = $request['contact_name_site_a'];
            $work_number_site_a = $request['work_number_site_a'];
            $mobile_number_site_a = $request['mobile_number_site_a'];
            $email_address_site_a = $request['email_address_site_a'];
            $physical_address_site_b = $request['physical_address_site_b'];
            $gps_co_ordinates_site_b_x = $request['gps_co_ordinates_site_b_x'];
            $gps_co_ordinates_site_b_y = $request['gps_co_ordinates_site_b_y'];
            $contact_name_site_b = $request['contact_name_site_b'];
            $work_number_site_b = $request['work_number_site_b'];
            $mobile_number_site_b = $request['mobile_number_site_b'];
            $email_address_site_b = $request['email_address_site_b'];
            $description = $request['description'];
            $lease_term_in_months = $request['lease_term_in_months'];
            $crossconnect = $request['crossconnect'];
            $technical_hands = $request['technical_hands'];
            $core_network_colocation_facilities = $request['core_network_colocation_facilities'];
            $rack_space_18u = $request['rack_space_18u'];
            $rack_space_9u_core_access_active = $request['rack_space_9u_core_access_active'];
            $rack_space_9u_core_access_passive = $request['rack_space_9u_core_access_passive'];
            $rack_space_1u_passive = $request['rack_space_1u_passive'];
            $order_quantity_primary_link_pair_2_strand = $request['order_quantity_primary_link_pair_2_strand'];
            $sla = $request['sla'];
            $sla_premium = $request['sla_premium'];
            $landlord_name_site_b = $request['landlord_name_site_b'];
            $managing_agent_site_b = $request['managing_agent_site_b'];
            $landlord_name_site_a = $request['landlord_name_site_a'];
            $landlord_contact_number_a = $request['landlord_contact_number_a'];
            $managing_agent_site_a = $request['managing_agent_site_a'];
            $landlord_contact_number_b = $request['landlord_contact_number_b'];
            $la_invoice = $request['la_invoice'];
            $strands = $request['strands'];
            $type = $request['type'];
            $llc_received = $request['llc_received'];
            $vodacom_vcw = $request['vodacom_vcw'];
            $kam_name = $request['kam_name'];
            $order_type = $request['order_type'];
            $feasibility_ref_nr = $request['feasibility_ref_nr'];
            $penalty_charges = $request['penalty_charges'];
            $cancellation_date = null;
            if($request['cancellation_date']){
                $cancellation_date = Carbon::parse($request['cancellation_date']);
            }
            $network_types = $request['network_types'];
            $special_build_nrc = $request['special_build_nrc'];
            $return_to_sales = $request['return_to_sales'];
            $termination_date = $request['termination_date'];
            $thrd_party_nrc = $request['thrd_party_nrc'];
            $thrd_party_mrc = $request['thrd_party_mrc'];
            $thrd_party_provider = $request['thrd_party_provider'];
            $region = $request['region'];
            $sales_comments = $request['sales_comments'];

            //check if planning status
            $service_delivery_status = 'A) New Sales';
            if($project_status == 'V) Pending CTS'){
              $service_delivery_status = 'T) Pending CTS';
            }
            //Insert query
            $insert_master_file_record =  SiteMasterFile::create([
                'service_id' => $service_id,
                'circuit_id' => $circuit_id,
                'project_id' => $project_id,
                'date_new' => $date_new,
                'project_status' => $project_status,
                'order_ref_number' => $order_ref_number,
                'province' => $province,
                'metro_area' => $metro_area,
                'client_name' => $client_name,
                'service_type' => $service_type,
                'client_ring' => $client_ring,
                'rate_mbit_s' => $rate_mbit_s,
                'site_a' => $site_a,
                'site_b' => $site_b,
                'date_po_order_rx' => $date_po_order_rx,
                'po_mrc' => $po_mrc,
                'po_nrc' => $po_nrc,
                "physical_address_site_a" =>  $physical_address_site_a, 
                "gps_co_ordinates_site_a_x" => $gps_co_ordinates_site_a_x,
                "gps_co_ordinates_site_a_y" => $gps_co_ordinates_site_a_y,
                "contact_name_site_a" => $contact_name_site_a,
                "work_number_site_a" => $work_number_site_a,
                "mobile_number_site_a" => $mobile_number_site_a,
                "email_address_site_a" => $email_address_site_a,
                "physical_address_site_b" => $physical_address_site_b,
                "gps_co_ordinates_site_b_x" => $gps_co_ordinates_site_b_x,
                "gps_co_ordinates_site_b_y" => $gps_co_ordinates_site_b_y,
                "contact_name_site_b" => $contact_name_site_b,
                "work_number_site_b" => $work_number_site_b,
                "mobile_number_site_b" => $mobile_number_site_b,
                "email_address_site_b" => $email_address_site_b,
                "description" => $description,
                "lease_term_in_months" => $lease_term_in_months,
                "crossconnect" => $crossconnect,
                "technical_hands" => $technical_hands,
                "core_network_colocation_facilities" => $core_network_colocation_facilities,
                "rack_space_18u" => $rack_space_18u,
                "rack_space_9u_core_access_active" => $rack_space_9u_core_access_active,
                "rack_space_9u_core_access_passive" => $rack_space_9u_core_access_passive,
                "rack_space_1u_passive" => $rack_space_1u_passive,
                "sla" => $sla,
                "sla_premium" => $sla_premium,
                "landlord_name_site_b" => $landlord_name_site_b,
                "managing_agent_site_b" => $managing_agent_site_b,
                "landlord_name_site_a" => $landlord_name_site_a,
                "landlord_contact_number_a" => $landlord_contact_number_a,
                "managing_agent_site_a" => $managing_agent_site_a,
                "landlord_contact_number_b" => $landlord_contact_number_b,
                "la_invoice" => $la_invoice,
                "strands" => $strands,
                "type" => $type,
                "llc_received" => $llc_received,
                "vodacom_vcw" => $vodacom_vcw,
                "kam_name" => $kam_name,
                "order_type" => $order_type,
                "feasibility_ref_nr" => $feasibility_ref_nr,
                "penalty_charges" => $penalty_charges,
                "cancellation_date" => $cancellation_date,
                "network_types" => $network_types,
                "special_build_nrc" => $special_build_nrc,
                "return_to_sales" => $return_to_sales,
                "termination_date" => $termination_date,
                "thrd_party_nrc" => $thrd_party_nrc,
                "thrd_party_mrc" => $thrd_party_mrc,
                "thrd_party_provider" => $thrd_party_provider,
                "region" => $region,
                "sales_comments" => $sales_comments,
                "service_delivery_status" => $service_delivery_status,
                "cts_date" => $cts_date,
                "sla_group" => $request->sla_group,
                "mttr_sla" => $request->mttr_sla,
            ]);
            //Check if data is inserted or not
            if($insert_master_file_record){

                //Insert Planning Query
                //check if planning status
                $planning_status = 'A) New Sales';
                if($project_status == 'V) Pending CTS'){
                  $planning_status = 'Pending CTS';
                }

                $insert_planning =  PlanningMasterFile::create([
                    'service_id' => $service_id,
                    'circuit_id' => $circuit_id,
                    'datenew' => $date_new,
                    'planning_status' => $planning_status,
                    "region" => $region,
                ]);
                
                //Insert permission Query

                //check if permissions_status 
                $permissions_status = 'A) New Sales';
                if($project_status == 'V) Pending CTS'){
                  $permissions_status = 'G) Pending CTS';
                }
                $insert_permission =  PermissionMasterFile::create([
                    'service_id' => $service_id,
                    'circuit_id' => $circuit_id,
                    'datenew' => $date_new,
                    'permissions_status' => $permissions_status,
                    "region" => $region,
                ]);
                
                //Insert build Query

                //check if build_status 
                $build_status = 'A) New Sales';
                if($project_status == 'V) Pending CTS'){
                  $build_status = 'R) Pending CTS';
                }
                $insert_permission =  BuildMasterFile::create([
                    'service_id' => $service_id,
                    'circuit_id' => $circuit_id,
                    'datenew' => $date_new,
                    'build_status' => $build_status,
                    "region" => $region,
                ]);
                
               // Gather the values from the request
                $values = [
                    $request->po_mrc,
                    $request->po_nrc,
                    $request->service_type,
                    $request->type,
                    $request->client_name,
                    $request->region,
                    $request->province,
                    $request->metro_area
                ];

                // Define fields for which to get original values
                $fields = ['po_mrc', 'po_nrc', 'service_type', 'type', 'client_name', 'region', 'province', 'metro_area'];

                // Initialize variables to store field names and values
                $fieldsStr = '';
                $valuesStr = '';

                // Loop through the fields and get their values
                foreach ($fields as $key => $field) {
                    // Get the value of the field from the request
                    $value = $values[$key];
                    // Handle null values by converting them to an empty string
                    $value = ($value !== null) ? $value : ''; 
                    // Concatenate field names and values
                    $fieldsStr .= $field . ',';
                    $valuesStr .= $value . ',';
                }

                // Remove the trailing comma from the concatenated strings
                $fieldsStr = rtrim($fieldsStr, ',');
                $valuesStr = rtrim($valuesStr, ',');

                // Call the history helper to save the change
                $module_type = "sale created";
                $page_name = url()->previous();
                Helper::submit_history_helper($request, $module_type, $page_name,$fieldsStr,$valuesStr);
                //end
                return back()->with('success','Sale Added Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            }
        }
    }
    
    
    
    //Function for show single record view file
    public function single_record($id){
        $region = Auth::user()->regions;
        $is_login_region = explode(",",$region);
        $record  =  SiteMasterFile::whereIn('region',$is_login_region)->where('id', $id)->with('attachment_record')->get()->toArray();
        $all_customers = Customer::orderBy('name')->get()->toArray();
        $all_kam_name = KamName::orderBy('kam_name')->get();
        $all_order_name = OrderType::orderBy('order_name')->get();
        $all_network_type = NetworkType::orderBy('network_type')->get();
        $all_service_types = ServiceType::orderBy('id', 'DESC')->whereNotNull('service_name')->get()->toArray();
		$all_thrd_party_provider = ThirdPartyProvider::orderBy('thrd_party_provider')->get();
		$all_lease_term_in_month = LeaseTermInMonth::orderBy('id', 'ASC')->get();
		$all_return_to_sale = ReturnToSale::orderBy('return_to_sale')->get();
		$all_strands = Strands::orderBy('id', 'ASC')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_project_type = ProjectType::orderBy('project_type')->get();
        $all_site_a_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_a')->Where('module_type','sale')->orderBy('id', 'DESC')->get()->ToArray();
        $all_site_b_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_b')->Where('module_type','sale')->orderBy('id', 'DESC')->get()->ToArray();
        $all_descriptions = Description::orderBy('id', 'DESC')->get();
        $all_regions = ImportRegion::orderBy('id', 'DESC')->get();
    
        $view =  view('admin/site-master-files/single-record', compact('record','all_customers','all_service_types','all_site_a_lists','all_site_b_lists','all_descriptions','all_regions','all_kam_name','all_order_name','all_network_type','all_thrd_party_provider','all_lease_term_in_month','all_return_to_sale','all_strands','all_rate_mbit_s','all_project_type'));
        return $view;
    }

    //function for single pending cts
    public function single_pending_cts($id){
        $region = Auth::user()->regions;
        $is_login_region = explode(",",$region);
        $record  =  SiteMasterFile::whereIn('region',$is_login_region)->where('id', $id)->get()->toArray();
        $all_customers = Customer::orderBy('id', 'DESC')->get()->toArray();
        $all_kam_name = KamName::orderBy('kam_name')->get();
        $all_order_name = OrderType::orderBy('order_name')->get();
        $all_network_type = NetworkType::orderBy('network_type')->get();
        $all_service_types = ServiceType::orderBy('id', 'DESC')->get()->toArray();
		$all_thrd_party_provider = ThirdPartyProvider::orderBy('thrd_party_provider')->get();
		$all_lease_term_in_month = LeaseTermInMonth::orderBy('id', 'ASC')->get();
		$all_return_to_sale = ReturnToSale::orderBy('return_to_sale')->get();
		$all_strands = Strands::orderBy('id', 'ASC')->get();
		$all_rate_mbit_s = RateMbitS::orderBy('id', 'ASC')->get();
		$all_project_type = ProjectType::orderBy('project_type')->get();
        $all_site_a_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_a')->Where('module_type','sale')->orderBy('id', 'DESC')->get()->ToArray();
        $all_site_b_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_b')->Where('module_type','sale')->orderBy('id', 'DESC')->get()->ToArray();
        $all_descriptions = Description::orderBy('id', 'DESC')->get();
        $all_regions = ImportRegion::orderBy('id', 'DESC')->get();
    
        $view =  view('admin/site-master-files/single-pending-cts', compact('record','all_customers','all_service_types','all_site_a_lists','all_site_b_lists','all_descriptions','all_regions','all_kam_name','all_order_name','all_network_type','all_thrd_party_provider','all_lease_term_in_month','all_return_to_sale','all_strands','all_rate_mbit_s','all_project_type'));
        return $view; 
    }

    public function all_pending_cts_all_list(){
      $region = Auth::user()->regions;
      $is_login_region = explode(",",$region);
      $all_records  =  SiteMasterFile::orderBy('id','DESC')->whereIn('region',$is_login_region)->whereIn('project_status',['V) Pending CTS'])->paginate(50);
      $view =  view('admin/site-master-files/pending-cts',compact('all_records'));
      //echo "<pre>"; print_r($all_records); echo "</pre>"; exit;
      return $view;
    }
    
    //function for update new record
    public function update_new_record(Request $request, $id){ 
		//validation rule
        request()->validate([
            'service_id' => 'required', 'string', 'max:255',
        ]);
        
        //Call Manage History Helper
        $model = SiteMasterFile::findOrFail($id);

        // Define fields for which to get original values
        $fields = ['po_mrc', 'po_nrc', 'service_type', 'type', 'client_name', 'region', 'province', 'metro_area'];
        
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
        
        // Call the history helper to save the change
        $module_type = "sale";
        $page_name = url()->previous();
        Helper::submit_history_helper($request, $module_type, $page_name,$fieldsStr,$valuesStr);        
        //end

        $date_new = null;
        if($request['date_new']){
                $date_new = Carbon::parse($request['date_new']);
        }
           
        $cts_date = null;
            if($request['project_status'] == 'V) Pending CTS'){
                $cts_date = Carbon::now(); 
        }
        
        $date_po_order_rx = null;
        if($request['date_po_order_rx']){
                $date_po_order_rx = Carbon::parse($request['date_po_order_rx']);
        }
        $service_id = $request['service_id'];
        $circuit_id = $request['circuit_id'];
        $project_status = $request['project_status'];
        $order_ref_number = $request['order_ref_number'];
        $province = $request['province'];
        $metro_area = $request['metro_area'];
        $client_name = $request['client_name'];
        $service_type = $request['service_type'];
        $client_ring = $request['client_ring'];
        $rate_mbit_s = $request['rate_mbit_s'];
        $site_a = $request['site_a'];
        $site_b = $request['site_b'];

        $po_mrc = $request['po_mrc'];
        $po_nrc = $request['po_nrc'];
        $physical_address_site_a = $request['physical_address_site_a'];
        $gps_co_ordinates_site_a_x = $request['gps_co_ordinates_site_a_x'];
        $gps_co_ordinates_site_a_y = $request['gps_co_ordinates_site_a_y'];
        $contact_name_site_a = $request['contact_name_site_a'];
        $work_number_site_a = $request['work_number_site_a'];
        $mobile_number_site_a = $request['mobile_number_site_a'];
        $email_address_site_a = $request['email_address_site_a'];
        $physical_address_site_b = $request['physical_address_site_b'];
        $gps_co_ordinates_site_b_x = $request['gps_co_ordinates_site_b_x'];
        $gps_co_ordinates_site_b_y = $request['gps_co_ordinates_site_b_y'];
        $contact_name_site_b = $request['contact_name_site_b'];
        $work_number_site_b = $request['work_number_site_b'];
        $mobile_number_site_b = $request['mobile_number_site_b'];
        $email_address_site_b = $request['email_address_site_b'];
        $description = $request['description'];
        $lease_term_in_months = $request['lease_term_in_months'];
        $crossconnect = $request['crossconnect'];
        $technical_hands = $request['technical_hands'];
        $core_network_colocation_facilities = $request['core_network_colocation_facilities'];
        $rack_space_18u = $request['rack_space_18u'];
        $rack_space_9u_core_access_active = $request['rack_space_9u_core_access_active'];
        $rack_space_9u_core_access_passive = $request['rack_space_9u_core_access_passive'];
        $rack_space_1u_passive = $request['rack_space_1u_passive'];
        $sla = $request['sla'];
        $sla_premium = $request['sla_premium'];
        $landlord_name_site_b = $request['landlord_name_site_b'];
        $managing_agent_site_b = $request['managing_agent_site_b'];
        $landlord_name_site_a = $request['landlord_name_site_a'];
        $landlord_contact_number_a = $request['landlord_contact_number_a'];
        $managing_agent_site_a = $request['managing_agent_site_a'];
        $landlord_contact_number_b = $request['landlord_contact_number_b'];
        $la_invoice = $request['la_invoice'];
        $strands = $request['strands'];
        $type = $request['type'];
        $llc_received = $request['llc_received'];
        $vodacom_vcw = $request['vodacom_vcw'];
        $kam_name = $request['kam_name'];
        $order_type = $request['order_type'];
        $feasibility_ref_nr = $request['feasibility_ref_nr'];
        $network_types = $request['network_types'];
        $special_build_nrc = $request['special_build_nrc'];
        $return_to_sales = $request['return_to_sales'];
        $termination_date = $request['termination_date'];
        $thrd_party_nrc = $request['thrd_party_nrc'];
        $thrd_party_mrc = $request['thrd_party_mrc'];
        $thrd_party_provider = $request['thrd_party_provider'];
        $region = $request['region'];
        $sales_comments = $request['sales_comments'];
        $cancellation_date = $request['cancellation_date'];
        $penalty_charges = $request['penalty_charges'];
        $sales_status = $request['sales_status'];
        

        $service_delivery_status = $request['service_delivery_status'];
        if($project_status == 'A) New Sales'){
              $service_delivery_status = 'A) New Sales';
        } elseif($project_status == 'V) Pending CTS'){
             $service_delivery_status = 'T) Pending CTS'; 
        } elseif($order_type == 'L) Cancelled'){
            $service_delivery_status = 'J) Cancelled';
        } elseif($order_type == 'H) Termination'){
            $service_delivery_status = 'S) Terminated';
        } 

      

        $project_status = $request['project_status'];
        if($order_type == 'L) Cancelled'){
            $project_status = 'Q) Cancelled';
        } elseif($order_type == 'H) Termination'){
            $project_status = 'U) Terminated';
        } 
       
        $sales_status = $request['sales_status'];
        if($order_type == 'L) Cancelled'){
            $sales_status = 'D) Cancelled';
        } elseif($order_type == 'H) Termination'){
            $sales_status = 'E) Terminated';
        } 
     

        //update Query
        $update_master_file_record = SiteMasterFile::Where('id', $id)->update([
                                'date_new' => $date_new,
                                'circuit_id' => $circuit_id,
                                'project_status' => $project_status,
                                'order_ref_number' => $order_ref_number,
                                'province' => $province,
                                'metro_area' => $metro_area,
                                'client_name' => $client_name,
                                'service_type' => $service_type,
                                'client_ring' => $client_ring,
                                'rate_mbit_s' => $rate_mbit_s,
                                'site_a' => $site_a,
                                'site_b' => $site_b,
                                'po_mrc' => $po_mrc,
                                'po_nrc' => $po_nrc,
                                "physical_address_site_a" =>  $physical_address_site_a, 
                                "gps_co_ordinates_site_a_x" => $gps_co_ordinates_site_a_x,
                                "gps_co_ordinates_site_a_y" => $gps_co_ordinates_site_a_y,
                                "contact_name_site_a" => $contact_name_site_a,
                                "work_number_site_a" => $work_number_site_a,
                                "mobile_number_site_a" => $mobile_number_site_a,
                                "email_address_site_a" => $email_address_site_a,
                                "physical_address_site_b" => $physical_address_site_b,
                                "gps_co_ordinates_site_b_x" => $gps_co_ordinates_site_b_x,
                                "gps_co_ordinates_site_b_y" => $gps_co_ordinates_site_b_y,
                                "contact_name_site_b" => $contact_name_site_b,
                                "work_number_site_b" => $work_number_site_b,
                                "mobile_number_site_b" => $mobile_number_site_b,
                                "email_address_site_b" => $email_address_site_b,
                                "description" => $description,
                                "lease_term_in_months" => $lease_term_in_months,
                                "crossconnect" => $crossconnect,
                                "technical_hands" => $technical_hands,
                                "core_network_colocation_facilities" => $core_network_colocation_facilities,
                                "rack_space_18u" => $rack_space_18u,
                                "rack_space_9u_core_access_active" => $rack_space_9u_core_access_active,
                                "rack_space_9u_core_access_passive" => $rack_space_9u_core_access_passive,
                                "rack_space_1u_passive" => $rack_space_1u_passive,
                                "sla" => $sla,
                                "sla_premium" => $sla_premium,
                                "landlord_name_site_b" => $landlord_name_site_b,
                                "managing_agent_site_b" => $managing_agent_site_b,
                                "landlord_name_site_a" => $landlord_name_site_a,
                                "landlord_contact_number_a" => $landlord_contact_number_a,
                                "managing_agent_site_a" => $managing_agent_site_a,
                                "landlord_contact_number_b" => $landlord_contact_number_b,
                                "la_invoice" => $la_invoice,
                                "strands" => $strands,
                                "type" => $type,
                                "llc_received" => $llc_received,
                                "vodacom_vcw" => $vodacom_vcw,
                                "kam_name" => $kam_name,
                                "order_type" => $order_type,
                                "feasibility_ref_nr" => $feasibility_ref_nr,
                                "penalty_charges" => $penalty_charges,
                                "cancellation_date" => $cancellation_date,
                                "network_types" => $network_types,
                                "special_build_nrc" => $special_build_nrc,
                                "return_to_sales" => $return_to_sales,
                                "termination_date" => $termination_date,
                                "thrd_party_nrc" => $thrd_party_nrc,
                                "thrd_party_mrc" => $thrd_party_mrc,
                                "thrd_party_provider" => $thrd_party_provider,
                                "region" => $region,
                                "sales_comments" => $sales_comments,
                                "service_delivery_status" => $service_delivery_status,
                                "sales_status" => $sales_status,
                                "cts_date" => $cts_date,
                                "date_po_order_rx" => $date_po_order_rx,
                                "sla_group" => $request->sla_group,
                                "mttr_sla" => $request->mttr_sla,
                            ]);	
							
        //Check if data is updated or not
        if($update_master_file_record){
            //update planning region
            $get_planning_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->get();
            $planning_status = $get_planning_file_record[0]['planning_status'];
            if($project_status == 'A) New Sales'){
               $planning_status = 'A) New Sales';
            } elseif($project_status == 'V) Pending CTS') {
                $planning_status = 'Pending CTS';
            } elseif($order_type == 'L) Cancelled'){
                $planning_status = 'O) Cancelled';
            } elseif($order_type == 'H) Termination'){
                $planning_status = 'P) Terminated';
            } 
            $update_planning_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update([
                "region" => $region,
                "planning_status" => $planning_status,
                "datenew" =>  $date_new,
            ]); 
            //update permission region

            $get_permission_status = PermissionMasterFile::Where('circuit_id', $circuit_id)->get();
            $permission_status = $get_permission_status[0]['permissions_status'];
            if($project_status == 'A) New Sales'){
               $permission_status = 'A) New Sales';
            } elseif($project_status == 'V) Pending CTS') {
                $permission_status = 'G) Pending CTS';
            } elseif($order_type == 'L) Cancelled'){
                $permission_status = 'H) Cancelled';
            } elseif($order_type == 'H) Termination'){
                $permission_status = 'I) Terminated';
            } 

            $update_permission_file_record = PermissionMasterFile::Where('circuit_id', $circuit_id)->update([
                "region" => $region,
                "permissions_status" => $permission_status,
                "datenew" =>  $date_new,
            ]); 
            //update build region

            $get_build_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->get();
            $build_status = $get_build_file_record[0]['build_status'];
            if($project_status == 'A) New Sales'){
               $build_status = 'A) New Sales';
            } elseif($project_status == 'V) Pending CTS') {
                $build_status = 'R) Pending CTS';
            } elseif($order_type == 'L) Cancelled'){
                $build_status = 'P) Cancelled';
            } elseif($order_type == 'H) Termination'){
                $build_status = 'Q) Terminated';
            } 
            $update_build_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                "region" => $region,
                "build_status" => $build_status,
                "datenew" =>  $date_new,
            ]);   
            
            // insert attachments for sales
            $files = [];
            if($request->hasfile('filenames'))
                {
                foreach($request->file('filenames') as $file)
                {
                    $name = time().rand(1,50).'.'.$file->extension();
                    $file->move('public/upload/sales', $name) ;  
                    $files[] = $name;  
                    $extension = $file->getClientOriginalExtension();
                    $postdata = SalesAttachment::create([
                        'service_id' => $service_id, 
                        'circuit_id' => $circuit_id,
                        'attachment_name' => $name,
                                ]);
                    
                    }
            } 

        if($project_status == 'V) Pending CTS'){
            return redirect('/admin/pending-cts/all-list');
        } else {
            return back()->with('success','Sale Updated Successfully');	
        }
							          
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
    
    //function for update pending cts record
    public function update_pending_cts_record(Request $request, $id){ 
		//validation rule
        request()->validate([
            'service_id' => 'required', 'string', 'max:255',
        ]);
        
        //Call Manage History Helper
        $fieldsStr = '';
        $valuesStr = '';  
        $module_type = "Pending cts";
        $page_name = url()->previous();
        Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);

        $date_new = null;
        if($request['date_new']){
                $date_new = Carbon::parse($request['date_new']);
        }
           
        $cts_date = null;
        if($request['cts_date']){
            $cts_date  = Carbon::parse($request['cts_date']);
        } 

        $service_id = $request['service_id'];
        $circuit_id = $request['circuit_id'];
        $project_status = $request['project_status'];
        $order_ref_number = $request['order_ref_number'];
        $province = $request['province'];
        $metro_area = $request['metro_area'];
        $client_name = $request['client_name'];
        $service_type = $request['service_type'];
        $client_ring = $request['client_ring'];
        $rate_mbit_s = $request['rate_mbit_s'];
        $site_a = $request['site_a'];
        $site_b = $request['site_b'];
        $date_po_order_rx = null;
        $po_mrc = $request['po_mrc'];
        $po_nrc = $request['po_nrc'];
        $physical_address_site_a = $request['physical_address_site_a'];
        $gps_co_ordinates_site_a_x = $request['gps_co_ordinates_site_a_x'];
        $gps_co_ordinates_site_a_y = $request['gps_co_ordinates_site_a_y'];
        $contact_name_site_a = $request['contact_name_site_a'];
        $work_number_site_a = $request['work_number_site_a'];
        $mobile_number_site_a = $request['mobile_number_site_a'];
        $email_address_site_a = $request['email_address_site_a'];
        $physical_address_site_b = $request['physical_address_site_b'];
        $gps_co_ordinates_site_b_x = $request['gps_co_ordinates_site_b_x'];
        $gps_co_ordinates_site_b_y = $request['gps_co_ordinates_site_b_y'];
        $contact_name_site_b = $request['contact_name_site_b'];
        $work_number_site_b = $request['work_number_site_b'];
        $mobile_number_site_b = $request['mobile_number_site_b'];
        $email_address_site_b = $request['email_address_site_b'];
        $description = $request['description'];
        $lease_term_in_months = $request['lease_term_in_months'];
        $crossconnect = $request['crossconnect'];
        $technical_hands = $request['technical_hands'];
        $core_network_colocation_facilities = $request['core_network_colocation_facilities'];
        $rack_space_18u = $request['rack_space_18u'];
        $rack_space_9u_core_access_active = $request['rack_space_9u_core_access_active'];
        $rack_space_9u_core_access_passive = $request['rack_space_9u_core_access_passive'];
        $rack_space_1u_passive = $request['rack_space_1u_passive'];
        $sla = $request['sla'];
        $sla_premium = $request['sla_premium'];
        $landlord_name_site_b = $request['landlord_name_site_b'];
        $managing_agent_site_b = $request['managing_agent_site_b'];
        $landlord_name_site_a = $request['landlord_name_site_a'];
        $landlord_contact_number_a = $request['landlord_contact_number_a'];
        $managing_agent_site_a = $request['managing_agent_site_a'];
        $landlord_contact_number_b = $request['landlord_contact_number_b'];
        $la_invoice = $request['la_invoice'];
        $strands = $request['strands'];
        $type = $request['type'];
        $llc_received = $request['llc_received'];
        $vodacom_vcw = $request['vodacom_vcw'];
        $kam_name = $request['kam_name'];
        $order_type = $request['order_type'];
        $feasibility_ref_nr = $request['feasibility_ref_nr'];
        $network_types = $request['network_types'];
        $special_build_nrc = $request['special_build_nrc'];
        $return_to_sales = $request['return_to_sales'];
        $termination_date = $request['termination_date'];
        $thrd_party_nrc = $request['thrd_party_nrc'];
        $thrd_party_mrc = $request['thrd_party_mrc'];
        $thrd_party_provider = $request['thrd_party_provider'];
        $region = $request['region'];
        $sales_comments = $request['sales_comments'];
        $cancellation_date = $request['cancellation_date'];
        $penalty_charges = $request['penalty_charges'];
        $sales_status = $request['sales_status'];

        $service_delivery_status = $request['service_delivery_status'];
        if($project_status == 'A) New Sales'){
              $service_delivery_status = 'A) New Sales';
        } elseif($project_status == 'V) Pending CTS'){
             $service_delivery_status = 'T) Pending CTS'; 
        } elseif($order_type == 'L) Cancelled'){
            $service_delivery_status = 'J) Cancelled';
        } elseif($order_type == 'H) Termination'){
            $service_delivery_status = 'S) Terminated';
        } 

        $received_cts_date = null;
        if($request['project_status'] == 'A) New Sales'){
                $received_cts_date = Carbon::now(); 
        }

        $project_status = $request['project_status'];
        if($order_type == 'L) Cancelled'){
            $project_status = 'Q) Cancelled';
        } elseif($order_type == 'H) Termination'){
            $project_status = 'U) Terminated';
        } 
       
        $sales_status = $request['sales_status'];
        if($order_type == 'L) Cancelled'){
            $sales_status = 'D) Cancelled';
        } elseif($order_type == 'H) Termination'){
            $sales_status = 'E) Terminated';
        } 
     

        //update Query
        $update_master_file_record = SiteMasterFile::Where('id', $id)->update([
                                'date_new' => $date_new,
                                'circuit_id' => $circuit_id,
                                'project_status' => $project_status,
                                'order_ref_number' => $order_ref_number,
                                'province' => $province,
                                'metro_area' => $metro_area,
                                'client_name' => $client_name,
                                'service_type' => $service_type,
                                'client_ring' => $client_ring,
                                'rate_mbit_s' => $rate_mbit_s,
                                'site_a' => $site_a,
                                'site_b' => $site_b,
                                'po_mrc' => $po_mrc,
                                'po_nrc' => $po_nrc,
                                "physical_address_site_a" =>  $physical_address_site_a, 
                                "gps_co_ordinates_site_a_x" => $gps_co_ordinates_site_a_x,
                                "gps_co_ordinates_site_a_y" => $gps_co_ordinates_site_a_y,
                                "contact_name_site_a" => $contact_name_site_a,
                                "work_number_site_a" => $work_number_site_a,
                                "mobile_number_site_a" => $mobile_number_site_a,
                                "email_address_site_a" => $email_address_site_a,
                                "physical_address_site_b" => $physical_address_site_b,
                                "gps_co_ordinates_site_b_x" => $gps_co_ordinates_site_b_x,
                                "gps_co_ordinates_site_b_y" => $gps_co_ordinates_site_b_y,
                                "contact_name_site_b" => $contact_name_site_b,
                                "work_number_site_b" => $work_number_site_b,
                                "mobile_number_site_b" => $mobile_number_site_b,
                                "email_address_site_b" => $email_address_site_b,
                                "description" => $description,
                                "lease_term_in_months" => $lease_term_in_months,
                                "crossconnect" => $crossconnect,
                                "technical_hands" => $technical_hands,
                                "core_network_colocation_facilities" => $core_network_colocation_facilities,
                                "rack_space_18u" => $rack_space_18u,
                                "rack_space_9u_core_access_active" => $rack_space_9u_core_access_active,
                                "rack_space_9u_core_access_passive" => $rack_space_9u_core_access_passive,
                                "rack_space_1u_passive" => $rack_space_1u_passive,
                                "sla" => $sla,
                                "sla_premium" => $sla_premium,
                                "landlord_name_site_b" => $landlord_name_site_b,
                                "managing_agent_site_b" => $managing_agent_site_b,
                                "landlord_name_site_a" => $landlord_name_site_a,
                                "landlord_contact_number_a" => $landlord_contact_number_a,
                                "managing_agent_site_a" => $managing_agent_site_a,
                                "landlord_contact_number_b" => $landlord_contact_number_b,
                                "la_invoice" => $la_invoice,
                                "strands" => $strands,
                                "type" => $type,
                                "llc_received" => $llc_received,
                                "vodacom_vcw" => $vodacom_vcw,
                                "kam_name" => $kam_name,
                                "order_type" => $order_type,
                                "feasibility_ref_nr" => $feasibility_ref_nr,
                                "penalty_charges" => $penalty_charges,
                                "cancellation_date" => $cancellation_date,
                                "network_types" => $network_types,
                                "special_build_nrc" => $special_build_nrc,
                                "return_to_sales" => $return_to_sales,
                                "termination_date" => $termination_date,
                                "thrd_party_nrc" => $thrd_party_nrc,
                                "thrd_party_mrc" => $thrd_party_mrc,
                                "thrd_party_provider" => $thrd_party_provider,
                                "region" => $region,
                                "sales_comments" => $sales_comments,
                                "service_delivery_status" => $service_delivery_status,
                                "received_cts_date" => $received_cts_date,
                                "cts_date" => $cts_date,
                                "sales_status" => $sales_status,
                            ]);	
							
        //Check if data is updated or not
        if($update_master_file_record){
            //update planning region
            $get_planning_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->get();
            $planning_status = $get_planning_file_record[0]['planning_status'];
            if($project_status == 'A) New Sales'){
               $planning_status = 'A) New Sales';
            } elseif($project_status == 'V) Pending CTS') {
                $planning_status = 'Pending CTS';
            } elseif($order_type == 'L) Cancelled'){
                $planning_status = 'O) Cancelled';
            } elseif($order_type == 'H) Termination'){
                $planning_status = 'P) Terminated';
            } 
            $update_planning_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update([
                "region" => $region,
                "planning_status" => $planning_status,
                'datenew' => $date_new,
            ]); 
            //update permission region

            $get_permission_status = PermissionMasterFile::Where('circuit_id', $circuit_id)->get();
            $permission_status = $get_permission_status[0]['permissions_status'];
            if($project_status == 'A) New Sales'){
               $permission_status = 'A) New Sales';
            } elseif($project_status == 'V) Pending CTS') {
                $permission_status = 'G) Pending CTS';
            } elseif($order_type == 'L) Cancelled'){
                $permission_status = 'H) Cancelled';
            } elseif($order_type == 'H) Termination'){
                $permission_status = 'I) Terminated';
            } 

            $update_permission_file_record = PermissionMasterFile::Where('circuit_id', $circuit_id)->update([
                "region" => $region,
                "permissions_status" => $permission_status,
                'datenew' => $date_new,
            ]); 
            //update build region

            $get_build_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->get();
            $build_status = $get_build_file_record[0]['build_status'];
            if($project_status == 'A) New Sales'){
               $build_status = 'A) New Sales';
            } elseif($project_status == 'V) Pending CTS') {
                $build_status = 'R) Pending CTS';
            } elseif($order_type == 'L) Cancelled'){
                $build_status = 'P) Cancelled';
            } elseif($order_type == 'H) Termination'){
                $build_status = 'Q) Terminated';
            } 
            $update_build_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                "region" => $region,
                "build_status" => $build_status,
                'datenew' => $date_new,
            ]);   
            
            // insert attachments for sales
            $files = [];
            if($request->hasfile('filenames'))
                {
                foreach($request->file('filenames') as $file)
                {
                    $name = time().rand(1,50).'.'.$file->extension();
                    $file->move('public/upload/sales', $name) ;  
                    $files[] = $name;  
                    $extension = $file->getClientOriginalExtension();
                    $postdata = SalesAttachment::create([
                        'service_id' => $service_id, 
                        'circuit_id' => $circuit_id,
                        'attachment_name' => $name,
                                ]);
                    
                    }
            } 


        if($project_status == 'V) Pending CTS'){
            return redirect('/admin/pending-cts/all-list');
        } else {
            return redirect('/admin/sale/all-list');
        }
							          
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
    
    //function for search records
    public function search_records(Request $request){
        //Get Request 
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);

        $keyword = $request->get('keyword');
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->Where('service_id','like','%'.$keyword.'%')->whereNoTIn('project_status',['V) Pending CTS'])->paginate(50);
        } 
        
        if(!empty($request->get('region'))){
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->Where('region', 'like', '%'. $region.'%')->whereNoTIn('project_status',['V) Pending CTS'])->paginate(50);
        } 

        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->whereNoTIn('project_status',['V) Pending CTS'])->paginate(50);
        }
        
        $view =  view('admin/site-master-files/search-list', compact('all_records'));
        return $view;
    }

     //function for search pending records
     public function search_pending_cts_records(Request $request){
        //Get Request 
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);

        $keyword = $request->get('keyword');
        $region = $request->get('region');
        if(!empty($request->get('keyword'))){
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->Where('service_id','like','%'.$keyword.'%')->whereIn('project_status',['V) Pending CTS'])->paginate(50);
        } 
        
        if(!empty($request->get('region'))){
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->Where('region', 'like', '%'. $region.'%')->whereIn('project_status',['V) Pending CTS'])->paginate(50);
        } 

        if(!empty($request->get('keyword')) AND !empty($request->get('region'))){
            $all_records = SiteMasterFile::whereIn('region',$is_login_region)->Where('service_id','like','%'.$keyword.'%')->Where('region', 'like', '%'. $region.'%')->whereIn('project_status',['V) Pending CTS'])->paginate(50);
        }
        
        $view =  view('admin/site-master-files/search-pending-cts', compact('all_records'));
        return $view;
    }
    
    public function all_project_status(){
    

                $status = SiteMasterFile::select('service_delivery_status','service_id')->where('service_delivery_status','Pending CTS')->get()->toArray();
                //$project_status = '';
                //echo "<pre>"; print_r($status); echo "</pre>";exit;
                foreach($status as $stt){
                  //  echo "<pre>";print_r($stt['project_status']);echo "</pre>";
                    if($stt['service_delivery_status'] == 'Pending CTS'){
                        $service_delivery_status = 'T) Pending CTS';
                    } 
        
                    $update_master_file_record = SiteMasterFile::Where('service_id',$stt['service_id'])->update([
                        'service_delivery_status' => $service_delivery_status,
                        ]);
	} 
  
}

// public function get_unmacthed_id(){

//     $service_id = DB::table('planning_master_file_records')
//     ->select('service_id',(DB::raw('COUNT(service_id)')))
//     ->groupBy(['service_id'])
//     ->havingRaw('COUNT(service_id) > 1')
//     ->pluck('service_id');
//     dd($service_id);
// }

// public function remove_u_service_id(){

//     $update_cts = SiteMasterFile::select('created_at','service_id')->whereNotNull('received_cts_date')->get()->toArray();
//     $count = 0;
//     foreach($update_cts as $cts){
//       $upd = SiteMasterFile::where('service_id',$cts['service_id'])->update(['cts_date' => $cts['created_at']]);
//       $count++;
//     }
//     echo $count;
//  }

    //function for delete order
    public function delete_record($id){
        $delete = SiteMasterFile::where('circuit_id',$id)->delete();
        if($delete){
             PlanningMasterFile::where('circuit_id',$id)->delete();
             PermissionMasterFile::where('circuit_id',$id)->delete();
             BuildMasterFile::where('circuit_id',$id)->delete();
            return back()->with('success','Record Deleted Successfully');	
        } else {
            return back()->with('unsuccess','Oops Something went Wrong!');	
        }
    }
}



