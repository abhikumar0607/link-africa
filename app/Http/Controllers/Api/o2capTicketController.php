<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use Illuminate\Support\Facades\Config;

class o2capTicketController extends Controller
{
    //public function for api
    public function api_record(Request $request){

    $apiKey = 'bGlua0FmZnJpY2FPMmNhcF8xNTQ3NTRAIUAjJCVeJiooKVJvaGl0';

    $api_record = [];
    if($apiKey == $request->api_key){
    $api_record = DB::table('site_master_file_records')
                        ->select('site_master_file_records.circuit_id','site_master_file_records.client_name','site_master_file_records.contact_name_site_b',
                        'site_master_file_records.email_address_site_b',
                        'site_master_file_records.gps_co_ordinates_site_b_x',
                        'site_master_file_records.gps_co_ordinates_site_b_y',
                        'site_master_file_records.mobile_number_site_b',
                        'site_master_file_records.network_types',
                        'site_master_file_records.order_ref_number',
                        'site_master_file_records.physical_address_site_b',
                        'site_master_file_records.port_location',
                        'site_master_file_records.port_number',
                        'site_master_file_records.port_type',
                        'site_master_file_records.province',
                        'site_master_file_records.rate_mbit_s',
                        'site_master_file_records.region',
                        'site_master_file_records.service_type',
                        'site_master_file_records.site_a',
                        'site_master_file_records.site_b',
                        'site_master_file_records.work_number_site_b',
                        'planning_master_file_records.link_dependency',)
                        ->join('planning_master_file_records', 'planning_master_file_records.circuit_id', '=', 'site_master_file_records.circuit_id')
                        ->paginate(100);
                        if($api_record){
                            $success['status'] = 200;
                                $success['message'] = "Order list";
                                $success['data'] = $api_record;
                                return response()->json($success, 200);
                    
                        } else {
                                $responce = array(
                                 'status' => 202,
                                 'message' => 'oops! something went wrong',
                                 'data' => $api_record);
                                  return response()->json($responce);
                         }
            } else {
                    $responce = array(
                    'status' => 202,
                    'message' => 'Please provide valid api key',
                    'data' => $api_record);
                     return response()->json($responce);
            }

   }

       //public function for single circuit_id api
       public function single_api_record(Request $request){


        $apiKey = 'bGlua0FmZnJpY2FPMmNhcF8xNTQ3NTRAIUAjJCVeJiooKVJvaGl0';
        $circuit_id = $request->circuit_id;
        $api_record = [];
        if($apiKey == $request->api_key){
            if($circuit_id){
        $api_record = DB::table('site_master_file_records')
                            ->where('site_master_file_records.circuit_id', $circuit_id)
                            ->select('site_master_file_records.circuit_id','site_master_file_records.client_name','site_master_file_records.contact_name_site_b',
                            'site_master_file_records.email_address_site_b',
                            'site_master_file_records.gps_co_ordinates_site_b_x',
                            'site_master_file_records.gps_co_ordinates_site_b_y',
                            'site_master_file_records.mobile_number_site_b',
                            'site_master_file_records.network_types',
                            'site_master_file_records.order_ref_number',
                            'site_master_file_records.physical_address_site_b',
                            'site_master_file_records.port_location',
                            'site_master_file_records.port_number',
                            'site_master_file_records.port_type',
                            'site_master_file_records.province',
                            'site_master_file_records.rate_mbit_s',
                            'site_master_file_records.region',
                            'site_master_file_records.service_type',
                            'site_master_file_records.site_a',
                            'site_master_file_records.site_b',
                            'site_master_file_records.work_number_site_b',
                            'planning_master_file_records.link_dependency',)
                            ->join('planning_master_file_records', 'planning_master_file_records.circuit_id', '=', 'site_master_file_records.circuit_id')
                            ->get();
                            if($api_record){
                                $success['status'] = 200;
                                    $success['message'] = "Single Order list";
                                    $success['data'] = $api_record;
                                    return response()->json($success, 200);
                        
                            } else {
                                    $responce = array(
                                     'status' => 202,
                                     'message' => 'oops! something went wrong',
                                     'data' => $api_record);
                                      return response()->json($responce);
                             }
                } else {
                    $responce = array(
                        'status' => 202,
                        'message' => 'Please provide circuit_id',
                        'data' => $api_record);
                         return response()->json($responce);
                }    
            } else {
                        $responce = array(
                        'status' => 202,
                        'message' => 'Please provide valid api key',
                        'data' => $api_record);
                         return response()->json($responce);
            }
    
       }
}