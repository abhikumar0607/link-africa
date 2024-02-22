<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMasterFile;
use App\Models\BuildMasterFile;
use App\Models\Site;
use App\Models\KamName;
use App\Models\OrderType;
use App\Models\NetworkType;
use App\Models\ThirdPartyProvider;
use App\Models\LeaseTermInMonth;
use App\Models\ReturnToSale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\o2capMail;
use Illuminate\Support\Facades\Mail;

class financialController extends Controller
{
    //function for single page
    public function single_financial($id){
        $all_kam_name = KamName::orderBy('kam_name')->get();
        $all_order_name = OrderType::orderBy('order_name')->get();
        $all_network_type = NetworkType::orderBy('network_type')->get();
        $all_thrd_party_provider = ThirdPartyProvider::orderBy('thrd_party_provider')->get();
        $all_return_to_sale = ReturnToSale::orderBy('return_to_sale')->get();
        $region = Auth::user()->regions;
        $is_login_region = explode(",",$region);
        $record  =  SiteMasterFile::whereIn('region',$is_login_region)->where('circuit_id', $id)->with('planning_record','build_record','permission_record')->get()->toArray();
        $all_site_a_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_a')->Where('module_type','sale')->orderBy('id', 'DESC')->get();
        $all_site_b_lists = Site::orderBy('site_name', 'ASC')->Where('site_type','site_b')->Where('module_type','sale')->orderBy('id', 'DESC')->get();
		return view('admin.financial.financial-single',compact('record','all_site_a_lists','all_site_b_lists','all_kam_name','all_order_name','all_network_type'
       ,'all_thrd_party_provider','all_return_to_sale'));
	}

    //function for all list
    public function all_list(){
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->whereNotIn('project_status',['V) Pending CTS'])->orderBy('id','DESC')->with(['build_record','planning_record'  => function ($query) {
            $query->where('planning_status', '=', 'H) Financial Approval Requested');
        }])
        ->whereHas('planning_record', function ($query) {
            $query->where('planning_status', '=', 'H) Financial Approval Requested');
        })
        ->paginate(10);
        $view =  view('admin/financial/all-list', compact('all_records'));
        return $view;
    }

     //function for submit layer
    public function submit_finacial(Request $request , $circuit_id){
        //echo "yes";exit;
        $financial_status = $request['financial_status'];
        $regional_manager_approval = $request['regional_manager_approval'];
        $coo_approval = $request['coo_approval'];
        $cfo_approval = $request['cfo_approval'];
        $regional_manager_comment = $request['regional_manager_comment'];
        $coo_manager_comment = $request['coo_manager_comment'];
        $cfo_manager_comment = $request['cfo_manager_comment'];
        $finance_comment = $request['finance_comment'];

        $is_mail_sent_by_regional_manager = $request['is_regional_manager_email'];
        $is_mail_sent_by_coo = $request['is_coo_email'];
        $is_mail_sent_by_cfo = $request['is_cfo_email'];
        $regions = $request['region'];

          //send email to coo by regional manger
          if($regional_manager_approval == 'A) Approved' AND $is_mail_sent_by_regional_manager == 'no'){
            $details = [
                'title' => 'Approval',
                'items' => [
                    'Circuit ID' => $request['circuit_id'],
                    'ISP Name' => $request['client_name'],
                    'Site B Name' => $request['site_b'],
                ],
                'link' => 'https://www.o2cap.co.za/admin/single-financial/' .$circuit_id. '',
                'type' => 'for aprroval',
            ];

            $mail = 'cooapp@linkafrica.co.za';
            $mail_sent = Mail::to($mail)->send(new o2capMail($details));
            //status update if mail is sent
            $update_regional_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                          "is_regional_manager_email" => 'yes',
                                                          "regional_mang_appr_date" => Carbon::now()->format('Y-m-d'),
            ]);   
        } elseif($regional_manager_approval == 'B) Rejected' OR $regional_manager_approval == 'C) Request Changes'){

            //check regions
            if($regions == 'Northern Region'){
                $mail = 'pmgp@linkafrica.co.za';
            } elseif($regions == 'Eastern Region'){
                $mail = 'pmkzn@linkafrica.co.za';
            } elseif($regions == 'Western Region'){
                $mail = 'pmwc@linkafrica.co.za';
            }
            // email send to logged in person
            $details = [
                'title' => 'Rejected',
                'items' => [
                    'Circuit ID' => $request['circuit_id'],
                    'ISP Name' => $request['client_name'],
                    'Site B Name' => $request['site_b'],
                ],
                'link' => 'https://www.o2cap.co.za/admin/single-financial/' .$circuit_id. '',
                'type' => 'for aprroval',
            ];

            $mail_sent = Mail::to($mail)->send(new o2capMail($details));
            $update_regional_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                            "is_regional_manager_email" => 'no',
            ]);    
        } elseif($regional_manager_approval == '') {
            $update_regional_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                "is_regional_manager_email" => 'no',
            ]); 
        }

        //send mail to cfo by coo
        if($coo_approval == 'A) Approved' AND $is_mail_sent_by_coo == 'no'){
            $details = [
                'title' => 'Approval',
                'items' => [
                    'Circuit ID' => $request['circuit_id'],
                    'ISP Name' => $request['client_name'],
                    'Site B Name' => $request['site_b'],
                ],
                'link' => 'https://www.o2cap.co.za/admin/single-financial/' .$circuit_id. '',
                'type' => 'for aprroval',
            ];
            $mail = 'cfoapp@linkafrica.co.za';
            $mail_sent = Mail::to($mail)->send(new o2capMail($details));
            //status update if mail is sent
            $update_coo_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                     "is_coo_email" => 'yes',
                                                     "coo_appr_date" => Carbon::now()->format('Y-m-d'),
            ]);   
        } elseif($coo_approval == 'B) Rejected' OR $coo_approval == 'C) Request Changes'){

            if($regions == 'Northern Region'){
                $mail = 'rmgp@linkafrica.co.za';
            } elseif($regions == 'Eastern Region'){
                $mail = 'rmkzn@linkafrica.co.za';
            } elseif($regions == 'Western Region'){
                $mail = 'rmwc@linkafrica.co.za';
            }
              // email send to logged in person
              $details = [
                  'title' => 'Rejected',
                  'items' => [
                      'Circuit ID' => $request['circuit_id'],
                      'ISP Name' => $request['client_name'],
                      'Site B Name' => $request['site_b'],
                  ],
                  'link' => 'https://www.o2cap.co.za/admin/single-financial/' .$circuit_id. '',
                  'type' => 'for aprroval',
              ];
  
              $mail_sent = Mail::to($mail)->send(new o2capMail($details));
             $update_coo_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                    "is_coo_email" => 'no',
            ]);    
        } elseif($coo_approval == '') {
            $update_coo_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                     "is_coo_email" => 'no',
            ]); 
        }

          //send mail to person by cfo
          if($cfo_approval == 'A) Approved' AND $is_mail_sent_by_cfo == 'no'){
            $details = [
                'title' => 'Approval',
                'items' => [
                    'Circuit ID' => $request['circuit_id'],
                    'ISP Name' => $request['client_name'],
                    'Site B Name' => $request['site_b'],
                ],
                'link' => 'https://www.o2cap.co.za/admin/planning/project-status/' .$circuit_id. '',
                'type' => 'for Project approved',
            ];
            
              //check regions
            if($regions == 'Northern Region'){
                $mail = 'pmgp@linkafrica.co.za';
            } elseif($regions == 'Eastern Region'){
                $mail = 'pmkzn@linkafrica.co.za';
            } elseif($regions == 'Western Region'){
                $mail = 'pmwc@linkafrica.co.za';
            }

            $mail_sent = Mail::to($mail)->send(new o2capMail($details));
            //status update if mail is sent
            $update_coo_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                     "is_cfo_email" => 'yes',
                                                     "cfo_appr_date" => Carbon::now()->format('Y-m-d'),
                                                     "financial_status" => 'C) Project Approved',
            ]);   
        } elseif($cfo_approval == 'B) Rejected' OR $cfo_approval == 'C) Request Changes'){
            //check region
            if($regions == 'Northern Region'){
                $mail = 'cooapp@linkafrica.co.za';
            } elseif($regions == 'Eastern Region'){
                $mail = 'cooapp@linkafrica.co.za';
            } elseif($regions == 'Western Region'){
                $mail = 'cooapp@linkafrica.co.za';
            }
              // email send to logged in person
              $details = [
                  'title' => 'Rejected',
                  'items' => [
                      'Circuit ID' => $request['circuit_id'],
                      'ISP Name' => $request['client_name'],
                      'Site B Name' => $request['site_b'],
                  ],
                  'link' => 'https://www.o2cap.co.za/admin/planning/project-status/' .$circuit_id. '',
                  'type' => 'for aprroval',

              ];
  
              $mail_sent = Mail::to($mail)->send(new o2capMail($details));
              $update_coo_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                        "is_cfo_email" => 'no',
            ]);    
        } elseif($cfo_approval == ''){
            $update_coo_email_field = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                        "is_cfo_email" => 'no',
            ]);  
        }

        $coo_appr_date = '';
        if($request['coo_appr_date']){
            $coo_appr_date = Carbon::parse($request['coo_appr_date']);
        }

        $regional_mang_appr_date = '';
        if($request['regional_mang_appr_date']){
            $regional_mang_appr_date = Carbon::parse($request['regional_mang_appr_date']);
        }

        $cfo_appr_date = '';
        if($request['cfo_appr_date']){
            $cfo_appr_date = Carbon::parse($request['cfo_appr_date']);
        }

        $kam_name = $request['kam_name'];
        $order_type = $request['order_type'];
        $feasibility_ref_nr = $request['feasibility_ref_nr'];
        $penalty_charges = $request['penalty_charges'];
        $network_types = $request['network_types'];
        $return_to_sales = $request['return_to_sales'];
        $thrd_party_nrc = $request['thrd_party_nrc'];
        $thrd_party_mrc = $request['thrd_party_mrc'];
        $thrd_party_provider = $request['thrd_party_provider'];
        $site_b = $request['site_b'];
        $site_a = $request['site_a'];

        $cancellation_date = '';
        if($request['cancellation_date']){
            $cancellation_date = Carbon::parse($request['cancellation_date']);
        }
        $termination_date = '';
        if($request['termination_date']){
            $termination_date = Carbon::parse($request['termination_date']);
        }


        // $po_request_received = '';
        // if($request['po_request_received']){
        //     $po_request_received = Carbon::parse($request['po_request_received']);
        // }
        $po_released = '';
        if($request['po_released']){
            $po_released = Carbon::parse($request['po_released']);
        }
        // $pick_slip_req_received = '';
        // if($request['pick_slip_req_received']){
        //     $pick_slip_req_received = Carbon::parse($request['pick_slip_req_received']);
        // }
        $pick_slip_release = '';
        if($request['pick_slip_release']){
            $pick_slip_release = Carbon::parse($request['pick_slip_release']);
        }
        // $toc_p2_rece = '';
        // if($request['toc_p2_rece']){
        //     $toc_p2_rece = Carbon::parse($request['toc_p2_rece']);
        // }
        $billing_commenced = '';
        if($request['billing_commenced']){
            $billing_commenced = Carbon::parse($request['billing_commenced']);
        }
        $billing_stopped = '';
        if($request['billing_stopped']){
            $billing_stopped = Carbon::parse($request['billing_stopped']);
        }

        //update_query
        $update_master_file_record = SiteMasterFile::Where('circuit_id', $circuit_id)->update([
                                                    'kam_name' => $kam_name,
                                                    'order_type' => $order_type,
                                                    'feasibility_ref_nr' => $feasibility_ref_nr,
                                                    'penalty_charges' => $penalty_charges,
                                                    'network_types' => $network_types,
                                                    'return_to_sales' => $return_to_sales,
                                                    'thrd_party_nrc' => $thrd_party_nrc,
                                                    'thrd_party_mrc' => $thrd_party_mrc,
                                                    'thrd_party_provider' => $thrd_party_provider,
                                                    'site_b' => $site_b,
                                                    'site_a' => $site_a,
                                                    'cancellation_date' => $cancellation_date,
                                                    'termination_date' => $termination_date,
        ]);
        
        if($update_master_file_record){
        $update_build_file_record = BuildMasterFile::Where('circuit_id', $circuit_id)->update([
                                                    "financial_status" => $financial_status,
                                                    "regional_manager_approval" => $regional_manager_approval,
                                                    "coo_approval" => $coo_approval,
                                                    "cfo_approval" => $cfo_approval,
                                                    "regional_manager_comment" => $regional_manager_comment,
                                                    "coo_manager_comment" => $coo_manager_comment,
                                                    "cfo_manager_comment" => $cfo_manager_comment,
                                                    //"po_request_received" => $po_request_received,
                                                    "po_released" => $po_released,
                                                    //"pick_slip_req_received" => $pick_slip_req_received,
                                                    "pick_slip_release" => $pick_slip_release,
                                                    "billing_commenced" => $billing_commenced,
                                                    "billing_stopped" => $billing_stopped,
                                                    //"toc_p2_rece" => $toc_p2_rece,
                                                    "finance_comment" => $finance_comment,
        ]); 
        
        if($update_build_file_record){
            return back()->with('success','Record Updated Successfully');	
            } else {
                return back()->with('unsuccess','Opps Something wrong!');	
            }
        } else {                  
        return back()->with('unsuccess','Opps Something wrong!');    
        }
    }

     //function for serach list
     public function search_financial_records(Request $request){
        $keyword = $request->get('keyword');
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $all_records = SiteMasterFile::whereIn('region',$is_login_region)->Where('service_id','like','%'.$keyword.'%')->orderBy('id','DESC')->with(['build_record',
        'planning_record'  => function ($query) {
            $query->where('planning_status', '=', 'H) Financial Approval Requested');
        }])
        ->whereHas('planning_record', function ($query) {
            $query->where('planning_status', '=', 'H) Financial Approval Requested');
        })
        ->paginate(10);
        $view =  view('admin/financial/all-list', compact('all_records'));
        return $view;
    }


    //public function send email
    public function send_email() {
        try {
            $details = [
                'title' => 'Approval',
                'items' => [
                    'Circuit ID' => 'yes',
                    'ISP Name' => 'yes',
                    'Site B Name' => 'yes',
                ],
                'link' => 'https://www.o2cap.co.za/admin/single-financial/',
                'type' => 'for aprroval',
            ];
    
            $mail = 'abhishek@linkafrica.co.za';
            Mail::to($mail)->send(new o2capMail($details));
    
            echo 'Email sent successfully.';
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            echo 'Error sending email: ' . $e->getMessage();
        }
    }
}
