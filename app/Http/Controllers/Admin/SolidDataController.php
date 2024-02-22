<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SiteMasterFile;
use App\Models\PlanningMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\BuildMasterFile;
use App\Models\Site;

class SolidDataController extends Controller
{
    //function for get circuit id
    public function get_solid_sale_data(){
        
        $tickets = DB::connection('mysql2')->table('tickets AS t')
        ->select([
            't.ticketNumber',
            't.createDate',
            'lc.internalCircuitNumber as Circuit_number',
            'stpo_producttype.displayValue as Service_type',
            DB::raw('CONCAT(ma.accountId, ":", ma.customerName) as client_name'),
            'lc.clientRing as client_ring',
            'so_province.displayValue as province',
            'so_region.displayValue as region',
            'lc.vcwNumber as Vodacom_VCW',
            'lc.siteA as Site_A',
            'lc.SiteAContactName as Contact_Name_Site_A',
            'lc.PhysicalAddressSiteA as Physical_Address_Site_A',
            'lc.siteALatitude as GPS_Co_ordinates_Site_A_X',
            'lc.siteALongitude as GPS_Co_ordinates_Site_A_Y',
            'lc.WorkNumberSiteA as Work_Number_Site_A',
            'lc.MobileNumberSiteA as Mobile_Number_Site_A',
            'lc.EmailAddressSiteA as Email_Address_Site_A',
            'lc.customerCompanyName as Site_B',
             DB::raw("CONCAT(lc.customerFirstname, ' ', lc.customerLastname) as 'Contact_Name_Site_b'"),
            'uids.streetAddress as Physical_Address_Site_B',
            'uids.latitude as GPS_Co_ordinates_Site_B_X',
            'uids.longitude as GPS_Co_ordinates_Site_B_Y',
            'lc.CustomerWorkNumber as Work_Number_Site_B',
            'lc.CustomerContactNumber as Mobile_Number_Site_B',
            'lc.CustomerEmailAddress as Emai_Address_Site_B',
            'lc.llcReceivedId as LLC_Received',
            DB::raw("CONCAT(au.firstname, ' ', au.lastname) as 'KAM_Name'"),
            'psv_b.value as rate_mbit_s',
            'psv_l.value as lease_term_in_months',
            'stpo_n.displayValue as network_types',
            'qlm_f.value as feasibility_ref_nr',
            DB::raw('
                CASE 
                    WHEN ql.adjustmentTypeId = 0 THEN ql.unitPriceExclVat * (1 - ql.adjustment/100) * ql.conversionRate
                    WHEN ql.adjustmentTypeId = 1 THEN ql.unitPriceExclVat - ql.adjustment * ql.conversionRate
                END as po_mrc'
            ),
            DB::raw('
                CASE 
                    WHEN ql.setupAdjustmentTypeid = 0 THEN ql.setupUnitPriceExclVat * (1 - ql.setupAdjustment/100) * ql.conversionRate 
                    WHEN ql.setupAdjustmentTypeid = 1 THEN ql.setupUnitPriceExclVat - ql.setupAdjustment * ql.conversionRate 
                END as po_nrc'
            ),
            DB::raw('ql_s.onceOffUnitPriceExclVAT * ql_s.quantity as special_build_nrc'),
            'so.displayValue as metro_area',
            'o.orderTypeId as order_type',
           ])
            ->join('ticket_parameter_values as tpv_lcid', function ($join) {
                $join->on('tpv_lcid.ticketId', '=', 't.id')
                    ->where('tpv_lcid.ticketTypeParameterId', '=', 684000); // Logical circuit id
            })
            ->join('order_tx_lines as ol', 'ol.ticketId', '=', 't.id')
            ->join('order_tx as o', 'ol.orderId', '=', 'o.id')
            ->join('quote_tx_lines as ql', 'ol.quoteTxLineId', '=', 'ql.id')
            ->join('quote_tx as q', 'ql.quoteId', '=', 'q.id')
            ->leftJoin('quote_tx_lines_meta as qlm_f', function ($join) {
                $join->on('qlm_f.quoteTxLineId', '=', 'ql.id')
                    ->where('qlm_f.serviceTypeParameterId', '=', 7357013);
            })
            ->leftJoin('quote_tx_lines_meta as qlm_s', function ($join) {
                $join->on('qlm_s.quoteTxLineId', '=', 'ql.id')
                    ->where('qlm_s.serviceTypeParameterId', '=', 7357014); // Special Build Quote Line Id
            })
            ->leftJoin('quote_tx_lines as ql_s', 'ql_s.id', '=', 'qlm_s.value')
            ->join('products as p', 'ql.productId', '=', 'p.id')
            ->join('product_services as ps', function ($join) {
                $join->on('ps.productId', '=', 'p.id')
                    ->where('ps.serviceTypeId', '=', 7357); // Link Africa Fibre Service
            })
            // service type come from these tables
            ->join('product_service_values as psv_producttype', 'psv_producttype.productServiceId', '=', 'ps.id')
            ->join('service_type_parameter_options as stpo_producttype', 'stpo_producttype.insertValue', '=', 'psv_producttype.value')
            // isp name comes from this table
            ->join('master_accounts as ma', 'ma.id', '=', 'q.masterAccountId')
            ->join('logical_circuit as lc', 'lc.id', '=', 'tpv_lcid.value')
            ->leftJoin('admin_users as au', 'au.id', '=', 'lc.keyAccountManagerId')
            ->join('physical_circuit as pct', 'lc.physicalCircuitId', '=', 'pct.id')
            ->join('uids', 'uids.uid', '=', 'pct.uid')
            ->leftJoin('select_options as so_province', function ($join) {
                $join->on('uids.provinceId', '=', 'so_province.optionKey')
                    ->where('so_province.groupid', '=', 3652); // uid provinces
            })
            ->leftJoin('select_options as so', function ($join) {
                $join->on('uids.cityId', '=', 'so.optionKey')
                    ->where('so.groupid', '=', 3617); // uid cities
            })
            ->leftJoin('select_options as so_region', function ($join) {
                $join->on('o.projectRegionId', '=', 'so_region.optionKey')
                    ->where('so_region.groupId', '=', 3506); // ordertxprojectregion
            })
            ->join('product_service_values as psv_b', function ($join) {
                $join->on('psv_b.productServiceId', '=', 'ps.id')
                    ->where('psv_b.serviceTypeParameterId', '=', 7357000); // Bandwidth
            })
            ->join('product_service_values as psv_l', function ($join) {
                $join->on('psv_l.productServiceId', '=', 'ps.id')
                    ->where('psv_l.serviceTypeParameterId', '=', 7357001); // Contract term
            })

            // network value come from these tables
            ->join('product_service_values as psv_n', function ($join) {
                $join->on('psv_n.productServiceId', '=', 'ps.id')
                     ->where('psv_n.serviceTypeParameterId', '=', 7357004); 
            })
            ->join('service_type_parameter_options as stpo_n', 'stpo_n.insertValue', '=', 'psv_n.value')


            ->where('t.tickettypeid', '=', 684) // Link Africa Fibre Ticket
            ->whereIn('t.ticketCenterId', [21941, 21963]) // Link Africa Fibre: (1) Sales, Link Africa Fibre: (8) Service Delivery
            ->where('t.currentStatusId', '<>', 100) // Closed
            ->where('psv_producttype.serviceTypeParameterId', '=', 7357002) // Product type
            ->where('stpo_producttype.serviceTypeParameterId', '=', 7357002) // Product type
            ->where('stpo_n.serviceTypeParameterId', '=', 7357004) // Network type
            ->get();

          echo "<pre>";print_r($tickets);exit;
        $updatedCount = 0;
        $createdCount = 0;
        foreach($tickets as $record){
            //check region
            $region = $record->region;
            if($region == 'DBN'){
               $region_update = 'Eastern Region';
            } elseif($region == 'JHB'){
                $region_update = 'Northern Region';
            } elseif($region == 'CTN'){
                $region_update = 'Western Region';
            } 

               // remove the code from client name
               $input = $record->client_name;
               // Find the position of the colon
               $colonPosition = strpos($input, ":");
               // Check if the colon is found
               if ($colonPosition !== false) {
                   // Extract the part after the colon
                   $result = substr($input, $colonPosition + 1);
               } else {
                   // If colon is not found, handle it accordingly
                   $result =  $record->client_name;
               }

                //check this id is exit or not in database
                $check_id_exist = SiteMasterFile::where('circuit_id', $record->Circuit_number)->exists();
                if($check_id_exist){               
                    $updatedCount++;   
                } else {

                    if($record->Service_type !== 'Link Residential'){
                        $site_record_create = SiteMasterFile::create([
                            'circuit_id' => $record->Circuit_number, 
                            'service_id' => $record->Circuit_number,
                            'date_new' => $record->createDate,
                            'service_type' => $record->Service_type,
                            'client_name' =>  $result,
                            'client_ring' => $record->client_ring,
                            'province' => $record->province,
                            'region' =>$region_update,
                            'vodacom_vcw' => $record->Vodacom_VCW,
                            'site_a' => $record->Site_A,
                            'contact_name_site_a' => $record->Contact_Name_Site_A,
                            'physical_address_site_a' => $record->Physical_Address_Site_A,
                            'gps_co_ordinates_site_a_x' => $record->GPS_Co_ordinates_Site_A_X,
                            'gps_co_ordinates_site_a_y' => $record->GPS_Co_ordinates_Site_A_Y,
                            'work_number_site_a' => $record->Work_Number_Site_A,
                            'mobile_number_site_a' => $record->Mobile_Number_Site_A,
                            'email_address_site_a' => $record->Email_Address_Site_A,
                            'site_b' => $record->Site_B,
                            'contact_name_site_b' => $record->Contact_Name_Site_b,
                            'physical_address_site_b' => $record->Physical_Address_Site_B,
                            'gps_co_ordinates_site_b_x' => $record->GPS_Co_ordinates_Site_B_X,
                            'gps_co_ordinates_site_b_y' => $record->GPS_Co_ordinates_Site_B_Y,
                            'work_number_site_b' => $record->Work_Number_Site_B,
                            'mobile_number_site_b' => $record->Mobile_Number_Site_B,
                            'email_address_site_b' => $record->Emai_Address_Site_B,
                            'llc_received' => $record->LLC_Received,
                            'kam_name' =>  $record->KAM_Name,  
                            'service_delivery_status' => 'A) New Sales',
                            'project_status' => 'A) New Sales',
                            'rate_mbit_s' =>  $record->rate_mbit_s,  
                            'lease_term_in_months' =>  $record->lease_term_in_months, 
                            'network_types' =>  $record->network_types, 
                            'feasibility_ref_nr' =>  $record->feasibility_ref_nr, 
                            'po_mrc' =>  'R ' . str_replace(',', '', number_format($record->po_mrc, 2)),
                            'po_nrc' =>  'R ' . str_replace(',', '', number_format($record->po_nrc, 2)),
                            'metro_area' =>  $record->metro_area, 
                            'order_type' =>  $record->order_type, 
                            'special_build_nrc' =>  $record->special_build_nrc, 
                            'data_from' =>  'Api Record', 
                        ]);

                    //check record is created or not 
                    if($site_record_create){

                       //create site a
                        $isSite_a_Exits = Site::where('site_name', $record->Site_A)->where('site_type', 'site_a')->count();

                        if($isSite_a_Exits >= 1){
                            echo 'no';
                        } else{
                            $create_site_a =  Site::create([
                                'site_name' => $record->Site_A,
                                'site_type' => 'site_a',
                            ]);
                        }
                    
                        //create site b
                        $isSite_b_Exits = Site::where('site_name', $record->Site_A)->where('site_type', 'site_a')->count();
                        if($isSite_a_Exits >= 1){
                            echo 'no';
                        } else{
                            $create_site_b =  Site::create([
                                'site_name' => $record->Site_B,
                                'site_type' => 'site_b',
                            ]);
                        }
                        //create planning
                        $insert_planning =  PlanningMasterFile::create([
                            'service_id' => $record->Circuit_number,
                            'circuit_id' => $record->Circuit_number,
                            'datenew' => $record->createDate,
                            'planning_status' => 'A) New Sales',
                            "region" => $region_update,
                        ]);

                        //create permission
                        $insert_permission =  PermissionMasterFile::create([
                            'service_id' => $record->Circuit_number,
                            'circuit_id' => $record->Circuit_number,
                            'datenew' => $record->createDate,
                            'permissions_status' => 'A) New Sales',
                            "region" => $region_update,
                        ]);

                        //create build
                        $insert_build =  BuildMasterFile::create([
                            'service_id' => $record->Circuit_number,
                            'circuit_id' => $record->Circuit_number,
                            'datenew' => $record->createDate,
                            'build_status' => 'A) New Sales',
                            "region" => $region_update,
                        ]);
                        
                        //check record is created or not 
                        $createdCount++;
                    }
                }
            } 
           
        }
       

        return response()->json([
            "updated_count" => $updatedCount,
            "created_count" => $createdCount
        ]);
    }

    //function for get how many records in the solid
    public function count_solid_records(){

        $results = DB::connection('mysql2')->table('tickets as t')
        ->select('t.id', 't.ticketNumber', 'o.orderTypeId')
        ->join('order_tx_lines as ol', 'ol.ticketId', '=', 't.id')
        ->join('order_tx as o', 'ol.orderid', '=', 'o.id')
        ->where('t.ticketTypeId', 684)  // Link Africa Fibre Ticket
        ->where('t.workflowstepid', 100) // Sales
        ->get();
        
        echo "<pre>";print_r($results);
        
    }

}
