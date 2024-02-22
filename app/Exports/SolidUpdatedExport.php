<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SiteMasterFile;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class SolidUpdatedExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $request;

    public function __construct($request){
        $this->request = $request;
    }

    public function headings():array{
        return[
            'Circuit Number',
            'TicketNumber',
            'CreateDate',
            'Service Type',
            'Client Name',
            'Client Ring',
            'Province',
            'Region',
            'Vodacom VCW',
            'Site A',
            'Site B',
            'Record Status',
        ];
    } 

    public function collection()
    {
         $allResults = DB::connection('mysql2')->table('tickets AS t')
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
            'psv_n.value as network_types',
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
            'uids.cityId as metro_area',
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
            ->join('product_service_values as psv_producttype', 'psv_producttype.productServiceId', '=', 'ps.id')
            ->join('service_type_parameter_options as stpo_producttype', 'stpo_producttype.insertValue', '=', 'psv_producttype.value')
            ->join('master_accounts as ma', 'ma.id', '=', 'q.masterAccountId')
            ->join('logical_circuit as lc', 'lc.id', '=', 'tpv_lcid.value')
            ->leftJoin('admin_users as au', 'au.id', '=', 'lc.keyAccountManagerId')
            ->join('physical_circuit as pct', 'lc.physicalCircuitId', '=', 'pct.id')
            ->join('uids', 'uids.uid', '=', 'pct.uid')
            ->leftJoin('select_options as so_province', function ($join) {
                $join->on('uids.provinceId', '=', 'so_province.optionKey')
                    ->where('so_province.groupid', '=', 3652); // uid provinces
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
            ->join('product_service_values as psv_n', function ($join) {
                $join->on('psv_n.productServiceId', '=', 'ps.id')
                    ->where('psv_n.serviceTypeParameterId', '=', 7357004); // Network type
            })
            ->where('t.tickettypeid', '=', 684) // Link Africa Fibre Ticket
            ->whereIn('t.ticketCenterId', [21941, 21963]) // Link Africa Fibre: (1) Sales, Link Africa Fibre: (8) Service Delivery
            ->where('t.currentStatusId', '<>', 100) // Closed
            ->where('psv_producttype.serviceTypeParameterId', '=', 7357002) // Product type
            ->where('stpo_producttype.serviceTypeParameterId', '=', 7357002) // Product type
            ->get()->toArray();
            $report_lists = $this->get_all_report_list($allResults);
            return collect($report_lists);
    }

    public function get_all_report_list($allResults){
        $all_report_lists = [];
        //Set All records
        foreach($allResults as $key => $result){


            $check_id_exist = SiteMasterFile::where('circuit_id', $result->Circuit_number)->exists();
              //Set all array
              $record_status = 'Created';
              if($check_id_exist){
                $record_status = 'Updated';
              }
                $all_report_lists[] = [
                    'Circuit Number' => $result->Circuit_number,
                    'TicketNumber' => $result->ticketNumber,
                    'CreateDate' => $result->createDate,
                    'Service Type' => $result->Service_type,
                    'Client Name' => $result->client_name,
                    'Client Ring' => $result->client_ring,
                    'Province' => $result->province,
                    'Region' => $result->region,
                    'Vodacom VCW' => $result->Vodacom_VCW,
                    'Site A' => $result->Site_A,
                    'Site B' => $result->Site_B,
                    'Record Status' => $record_status,
                ];
              
            
        }
        return $all_report_lists;
    }
}
