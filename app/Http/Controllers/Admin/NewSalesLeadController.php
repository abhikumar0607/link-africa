<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewSalesLead;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;

class NewSalesLeadController extends Controller
{
   //function for view new leads sales
   public function index(){
      $record  =  Product::all()->toArray();
      $all_customers = Customer::orderBy('id', 'DESC')->get()->toArray();
      return view('admin/new-sale-lead/add-new-record',compact('record','all_customers'));  
   }
   
    //function for submit new record
    public function submit_new_record(Request $request){
	//validation rule
    request()->validate([
    'date_intiated' => 'required', 'number', 'max:255',
     ]);
     
      $date_intiated = null;
      if($request['date_intiated']){
      $date_intiated = Carbon::parse($request['date_intiated']);
      }
      $customer_name = $request['customer_name'];
      $kam = $request['kam'];
      $segment = $request['segment'];
      $province = $request['province'];
      $site_name = $request['site_name'];
      $lease_term_months = $request['lease_term_months'];
      $expected_close_month = null;
      if($request['expected_close_month']){
      $expected_close_month = Carbon::parse($request['expected_close_month']);
      }
      $product = $request['product'];
      $estimated_mrc = $request['estimated_mrc'];
      $expected_invoice_month = null;
      if($request['expected_invoice_month']){
      $expected_invoice_month = Carbon::parse($request['expected_invoice_month']);
      }
      $sales_stage = $request['sales_stage'];
      $estimated_nrc = $request['estimated_nrc'];
      $actual_closing_date = null;
      if($request['actual_closing_date']){
      $actual_closing_date = Carbon::parse($request['actual_closing_date']);
      }
      $probability = $request['probability'];
      $actual_invoice_date = null;
      if($request['actual_invoice_date']){
      $actual_invoice_date = Carbon::parse($request['actual_closing_date']);
      }
      $comments = $request['comments'];
      
      $new_sales_lead = NewSalesLead::create([
     'date_intiated' => $date_intiated,
     'customer_name' => $customer_name,
     'segment' => $segment,
     'kam' => $kam,
     'province' => $province,
     'site_name' => $site_name,
     'lease_term_months' => $lease_term_months,
     'expected_close_month' => $expected_close_month,
     'product' => $product,
     'estimated_mrc' => $estimated_mrc,
     'expected_invoice_month' => $expected_invoice_month,
     'sales_stage' => $sales_stage,
     'estimated_nrc' => $estimated_nrc,
     'actual_closing_date' => $actual_closing_date,
     'probability' => $probability,
     'actual_invoice_date' => $actual_invoice_date,
     'comments' => $comments,
     ]);
      
       //Check if data is updated or not
        if($new_sales_lead){
            return back()->with('success','Record added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
    
    //function for get records of new leads sales
    public function lead_sales_all_records(){
    $all_records  =  NewSalesLead::orderBy('id', 'DESC')->paginate(50);
    return view('admin/new-sale-lead/all-sales-pipeline', compact('all_records'));  
   }
   
   //function for view all sales pipeline update page
    public function single_sales_pipeline_records($id){
    $record  =  NewSalesLead::where('id', $id)->get()->toArray();
    $product  =  Product::all()->toArray();
    $all_customers = Customer::orderBy('id', 'DESC')->get()->toArray();
    return view('admin/new-sale-lead/single-sales-pipeline', compact('record','product','all_customers'));  
   }
}
