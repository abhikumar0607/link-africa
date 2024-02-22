<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\SiteMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExportOpenOrderBookReport implements FromCollection,WithHeadings,WithColumnFormatting
{
    protected $request;

    public function __construct($request){
        $this->request = $request;
    }

    public function columnFormats(): array {
        return [
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'P' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'E' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
		
			'H' => NumberFormat::FORMAT_NUMBER_00,
			'I' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'KAM Name', 
            'CLIENT NAME',
            'SERVICE ID',
            'Circuit ID',
            'DATE PO/ORDER Rx',
            'SERVICE TYPE',
            'Rate Mbit-S',
            'PO MRC',
            'PO NRC',
            'Special Build NRC',
            'PROVINCE',
            'PROJECT STATUS',
            'Order Type',
            'Network Types',
            'TOC SUBMITTED',
            'TOC RECEIVED',
            'Termination Date'
        ];
    } 
    public function collection()
    {
        $request = $this->request;
        $allResults = SiteMasterFile::Select('kam_name','client_name','service_id','circuit_id','date_po_order_rx','service_type','rate_mbit_s','po_mrc','po_nrc','special_build_nrc','province','project_status','order_type','network_types','termination_date')->orderBy('id','DESC')->with('build_record')->get()->toArray();
        //Call Commomn function
        $report_lists = $this->get_all_report_list($allResults);
        return collect($report_lists);
    }

    public function get_all_report_list($allResults){
        $current_date =  Carbon::now()->format('Y-m-d');
        $all_report_lists = [];
        //Set All records
        foreach($allResults as $key => $result){
            //Check if date_po_order_rx value is exit or not
            $date_po_order_rx = "";
            if(isset($result['date_po_order_rx'])){
                $date_po_order_rx = Carbon::parse($result['date_po_order_rx'])->format('d-M-y');
            }
            //Check if toc_submitted value is exit or not
            $toc_submitted = "";
            if(isset($result['build_record']['toc_submitted'])){
                $toc_submitted = Carbon::parse($result['build_record']['toc_submitted'])->format('d-M-y');
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

            //Date termination_date date format
            $termination_date = "";
            if(isset($result['termination_date'])){
                $termination_date = Carbon::parse($result['termination_date'])->format('d-M-y');
            }

            //special_build_nrc remove R and .00 format 
            $new_special_build_nrc = "";
            if(isset($result['special_build_nrc'])){
                $special_build_nrc = $result['special_build_nrc'];
                $remove_r_special_build_nrc = str_replace("R","",$special_build_nrc);;
                $remove_format_special_build_nrc = str_replace(".00","",$remove_r_special_build_nrc);
                $new_special_build_nrc = $remove_format_special_build_nrc;
            }
            //Check code csv format
            if($date_po_order_rx){
            $date_po_order_rx = Date::dateTimeToExcel(Carbon::parse($date_po_order_rx));
            }
            if($termination_date){
            $termination_date = Date::dateTimeToExcel(Carbon::parse($termination_date));
            }
            if($toc_received){
            $toc_received = Date::dateTimeToExcel(Carbon::parse($toc_received));
            }
            if($toc_submitted){
                $toc_submitted = Date::dateTimeToExcel(Carbon::parse($toc_submitted));
            }
            //Set all array
            $all_report_lists[] = [
                                'kam_name' => $result['kam_name'],
                                'client_name' => $result['client_name'],
                                'service_id' => $result['service_id'],
                                'circuit_id' => $result['circuit_id'],
                                'date_po_order_rx' => $date_po_order_rx,
                                'service_type' => $result['service_type'],
                                'rate_mbit_s' => $result['rate_mbit_s'],
                                'po_mrc' => (int)$new_po_mrc,
                                'po_nrc' => (int)$new_po_nrc,
                                'special_build_nrc' => $new_special_build_nrc,
                                'province' => $result['province'],
                                'project_status' => $result['project_status'],
                                'order_type' => $result['order_type'],
                                'network_types' => $result['network_types'],
                                'toc_submitted' => $toc_submitted,
                                'toc_received' => $toc_received,
                                'termination_date' => $termination_date,
                            ];
        }
        return $all_report_lists;
    }
}