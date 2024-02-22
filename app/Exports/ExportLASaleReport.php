<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\SiteMasterFile;
use App\Models\BuildMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExportLASaleReport implements FromCollection,WithHeadings,WithColumnFormatting
{
    protected $request;

    public function __construct($request){
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'KAM Name',
            'CLIENT NAME',
            'DATE PO/ORDER Rx',
            'PENDING CTS DATE',
            'RECEIVED CTS DATE',
            'TOC RECEIVED',
            'Termination Date',
            'SERVICE TYPE',
            'Rate Mbit-S',
            'PO MRC',
            'PO NRC',
            'Special Build NRC',
            '3rd Party MRC',
            '3rd Party NRC',
            'Net Delta MRC',
            'Net Delta NRC',
            'PROJECT STATUS',
            'Order Type',
            'Network Types',
            'Circuit ID',
            'PROVINCE',
            'SITE B',
            'SERVICE ID',
        ];
    } 

    public function columnFormats(): array {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'C' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'E' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
		
			'J' => NumberFormat::FORMAT_NUMBER_00,
			'K' => NumberFormat::FORMAT_NUMBER_00,
            'O' => NumberFormat::FORMAT_NUMBER_00,
            'P' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    public function collection()
    {
        $request = $this->request;
        $allResults = SiteMasterFile::orderBy('id','DESC')->with('planning_record','permission_record','build_record','landlord_record','site_survey_record')->get()->toArray();
        //Call Commomn function
        $report_lists = $this->get_all_report_list($allResults);
        return collect($report_lists);
    }

    public function get_all_report_list($allResults){
        $all_report_lists = [];
        //Set All records
        foreach($allResults as $key => $result){
            //Check if date_po_order_rx value is exit or not
            $date_po_order_rx = "";
            if(isset($result['date_po_order_rx'])){
                $date_po_order_rx = Carbon::parse($result['date_po_order_rx'])->format('d-M-y');
            }
            //Check if toc_received value is exit or not
            $toc_received = "";
            if(isset($result['build_record']['toc_received'])){
                $toc_received = Carbon::parse($result['build_record']['toc_received'])->format('d-M-y');
            }

            //po_mrc remove R and .00 format
            $new_po_mrc = 0;
            if(isset($result['po_mrc'])){
                $po_mrc = $result['po_mrc'];
                $r_po_mrc = str_replace("R","",$po_mrc);
                $new_po_mrc = str_replace(",","",$r_po_mrc);          
            }

            //po_nrc remove R and .00 format 
            $new_po_nrc = 0;
            if(isset($result['po_nrc'])){
                $po_nrc = $result['po_nrc'];
                $r_po_nrc = str_replace("R","",$po_nrc);
                $new_po_nrc = str_replace(",","",$r_po_nrc);
            }
           
            //net delta mrc
            $new_thrd_party_mrc = 0;
            if(isset($result['thrd_party_mrc'])){
                $thrd_party_mrc = $result['thrd_party_mrc'];
                $r_thrd_party_mrc = str_replace("R","",$thrd_party_mrc);
                $new_thrd_party_mrc = str_replace(",","",$r_thrd_party_mrc);
            }
            $net_delta_mrc = 0;
            if(!empty($new_thrd_party_mrc)){
                $net_delta_mrc = (int)$new_po_mrc - (int)$new_thrd_party_mrc;
            }

            //net delta nrc
            $new_thrd_party_nrc = 0;
            if(isset($result['thrd_party_nrc'])){
                $thrd_party_nrc = $result['thrd_party_nrc'];
                $r_thrd_party_nrc = str_replace("R","",$thrd_party_nrc);
                $new_thrd_party_nrc = str_replace(",","",$r_thrd_party_nrc);
            }
            $net_delta_nrc = 0;
            if(!empty($thrd_party_nrc)){
                $net_delta_nrc = (int)$new_po_nrc - (int)$new_thrd_party_nrc;
            }
            
            //Date termination_date date format
            $termination_date = "";
            if(isset($result['termination_date'])){
                $termination_date = Carbon::parse($result['termination_date'])->format('Y-m-d');
            }

            //special_build_nrc remove R and .00 format 
            $new_special_build_nrc = "";
            if(isset($result['special_build_nrc'])){
                $special_build_nrc = $result['special_build_nrc'];
                $remove_r_special_build_nrc = str_replace("R","",$special_build_nrc);;
                $remove_format_special_build_nrc = str_replace(".00","",$remove_r_special_build_nrc);
                $new_special_build_nrc = $remove_format_special_build_nrc;
            }
            $cts_date = "";
            if(isset($result['cts_date'])){
                $cts_date = Carbon::parse($result['cts_date'])->format('Y/m/d');
            }

            $received_cts_date = "";
            if(isset($result['received_cts_date'])){
                $received_cts_date = Carbon::parse($result['received_cts_date'])->format('Y/m/d');
            }

           //Check code csv format
            if($cts_date){
            $cts_date = Date::dateTimeToExcel(Carbon::parse($cts_date));
            }
            if($received_cts_date){
                $received_cts_date = Date::dateTimeToExcel(Carbon::parse($received_cts_date));
            }
            if($date_po_order_rx){
                $date_po_order_rx = Date::dateTimeToExcel(Carbon::parse($date_po_order_rx));
            }
            if($termination_date){
                $termination_date = Date::dateTimeToExcel(Carbon::parse($termination_date));
            }
            if($toc_received){
                $toc_received = Date::dateTimeToExcel(Carbon::parse($toc_received));
            }
            //Set all array
            $all_report_lists[] = [
                                'kam_name' => $result['kam_name'],
                                'client_name' => $result['client_name'],
                                'date_po_order_rx' => $date_po_order_rx,
                                'PENDING CTS DATE' => $cts_date,
                                'RECEIVED CTS DATE' => $received_cts_date,
                                'toc_received' => $toc_received,
                                'termination_date' => $termination_date,
                                'service_type' => $result['service_type'],
                                'rate_mbit_s' => $result['rate_mbit_s'],
                                'po_mrc' => (int)$new_po_mrc,
                                'po_nrc' => (int)$new_po_nrc,
                                'special_build_nrc' => $new_special_build_nrc,
                                '3rd Party MRC' => (int)$new_thrd_party_mrc,
                                '3rd Party NRC' => (int)$new_thrd_party_nrc,
                                'Net Delta MRC' => $net_delta_mrc,
                                'Net Delta NRC' => $net_delta_nrc,
                                'project_status' => $result['project_status'],
                                'order_type' => $result['order_type'],
                                'network_types' => $result['network_types'],
                                'circuit_id' => $result['circuit_id'],
                                'province' => $result['province'],
                                'site_b' => $result['site_b'],
                                'service_id' => $result['service_id'],
                            ];
        }
        return $all_report_lists;
    }
}