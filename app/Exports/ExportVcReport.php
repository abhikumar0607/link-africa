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

class ExportVcReport implements FromCollection,WithHeadings,WithColumnFormatting
{
    protected $request;

    public function __construct($request){
        $this->request = $request;
    }

    public function columnFormats(): array {
        return [
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'T' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'V' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'X' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'Y' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'Z' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'AC' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'AD' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'AE' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AG' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AH' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AI' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AJ' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AK' => NumberFormat::FORMAT_DATE_DDMMYYYY,
		
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'SERVICE ID',
            'VODACOM VCW',
            'ORDER REF NO',
            'PROJECT STATUS',
            'PLANNING STATUS',
            'PERMISSIONS STATUS',
            'BUILD STATUS',
            'PROVINCE',
            'CLIENT NAME',
            'Client PO NUM',
            'DATE PO/ORDER Rx',
            'SERVICE TYPE',
            'CLIENT RING',
            'SITE A',
            'SITE B',
            'SITE A STATUS',
            'SITE A SURVEY DATE',
            'SITE A ISP SUBMISSION',
            'SITE B STATUS',
            'SITE B SURVEY DATE',
            'SITE B ISP SUBMISSION',
            'WAYLEAVES RECEIVED',
            'WAYLEAVES STATUS',
            'TOC SUBMITTED',
            'TOC RECEIVED',
            'Rx IN PLANNING',
            'PLanning Days',
            'Build Days',
            'PLANNED WP2 RELEASED DATE',
            'REVISED PLANNED WP2 DATE',
            'REVISED BUILD START DATE',
            'BUILD DURATION',
            'ISP B WP2 APPROVAL RECEIVED',
            'SITE A LLA RECEIVED',
            'SITE B LLA RECEIVED',
            'BUILD PLANNED COMPLETION DATES',
            'ACTUAL BUILD COMPLETION DATE'
        ];
    } 
    public function collection()
    {
        $request = $this->request;
        $allResults = SiteMasterFile::Select('service_id','circuit_id','date_new','date_po_order_rx','project_status','type','vodacom_vcw','order_ref_number','province','client_name','client_po_num','service_type','client_ring','site_a','site_b')->orderBy('id','DESC')->with('planning_record','permission_record','build_record')->get()->toArray();
        //Call Commomn function
        $report_lists = $this->get_all_report_list($allResults);
        return collect($report_lists);
    }

    public function get_all_report_list($allResults){
        $current_date =  Carbon::now()->format('Y-m-d');
        //Set All records
        $all_report_lists = [];
        foreach($allResults as $key => $result){
            //Check if date_po_order_rx value is exit or not
            $old_date_po_order_rx = "";
            if(isset($result['date_po_order_rx'])){
                $old_date_po_order_rx = Carbon::parse($result['date_po_order_rx'])->format('d-M-y');
            }
            //Check if site_a_survey_date value is exit or not
            $site_a_survey_date = "";
            if(isset($result['planning_record']['site_a_survey_date'])){
                $site_a_survey_date = Carbon::parse($result['planning_record']['site_a_survey_date'])->format('d-M-y');
            }

            //Check if site_b_survey_date value is exit or not
            $site_b_survey_date = "";
            if(isset($result['planning_record']['site_b_survey_date'])){
                $site_b_survey_date = Carbon::parse($result['planning_record']['site_b_survey_date'])->format('d-M-y');
            }

            //Check if wayleaves_received value is exit or not
            $wayleaves_received = "";
            if(isset($result['permission_record']['wayleaves_received'])){
                $wayleaves_received = Carbon::parse($result['permission_record']['wayleaves_received'])->format('d-M-y');
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
            //Check if rx_in_planning value is exit or not
            $rx_in_planning = "";
            if(isset($result['planning_record']['rx_in_planning'])){
                $rx_in_planning = Carbon::parse($result['planning_record']['rx_in_planning'])->format('d-M-y');
            }
            
            //For Project Duration
            $project_duration = "";
            if($result['project_status'] == "Q) Cancelled"){
                $project_duration = 0;
            }
            if(isset($result['build_record']['toc_submitted'])){
                $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                $date_date_po_order_rx = Carbon::parse($result['date_new']);
                $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_date_po_order_rx);
                $project_duration = (int)$date_toc_submitted_diff+1;
            } else {
                $date_po_order_rx = Carbon::parse($result['date_new']);
                $date_po_order_rx_diff = $date_po_order_rx->diffInDays($current_date);
                $project_duration = (int)$date_po_order_rx_diff+1;
            }

            $planning_days = 0;
            $build_days = 0;
            //PROJECT TYPE
            if($result['type'] == "Equipment And Splicing"){
                $planning_days = 4;
                $build_days = 19;
            }elseif($result['type'] == "ISP NET1"){
                $planning_days = 10;
                $build_days = 19;
            }elseif($result['type'] == "OSP ISP With No Wayleaves"){
                $planning_days = 40;
                $build_days = 19;
            }elseif($result['type'] == "OSP ISP With Wayleaves FTTB"){
                $planning_days = 49;
                $build_days = 40;
            }elseif($result['type'] == "OSP ISP With Wayleaves FTTS"){
                $planning_days = 49;
                $build_days = 40;
            }elseif($result['type'] == "OSP ISP With Wayleaves Other"){
                $planning_days = 49;
                $build_days = 40;
            }elseif($result['type'] == "NET4"){
                $planning_days = 4;
                $build_days = 35;
            }elseif($result['type'] == "NET6"){
                $planning_days = 40;
                $build_days = 84;
            }elseif($result['type'] == "Managed Ports"){
                $planning_days = 4;
                $build_days = 5;
            }elseif($result['type'] == "Upgrade or Downgrade"){
                $planning_days = 4;
                $build_days = 4;
            }elseif($result['type'] == "NET3.2"){
                $planning_days = 10;
                $build_days = 19;
            }elseif($result['type'] == "NET2"){
                $planning_days = 10;
                $build_days = 19;
            }elseif($result['type'] == "FTTH Orders"){
                $planning_days = 2;
                $build_days = 9;
            }

            //PLANNED WP2 RELEASED DATE
            $planned_wp2_released_date = "";
            if(isset($result['planning_record']['planned_wp2_released_date'])){
                $rx_in_planning_parse = Carbon::parse($result['date_new']);
                $planned_wp2_released_date = $rx_in_planning_parse->addDays($planning_days)->format('d-M-y');
            }

            //revised_planned_wp2_date DATE
            $revised_planned_wp2_date = "";
            if(isset($result['planning_record']['revised_planned_wp2_date'])){
                $revised_planned_wp2_date = Carbon::parse($result['planning_record']['revised_planned_wp2_date'])->format('d-M-y');
            }

            //revised_build_start_date DATE
            $revised_build_start_date = "";
            if(isset($result['build_record']['revised_build_start_date'])){
                $revised_build_start_date = Carbon::parse($result['build_record']['revised_build_start_date'])->format('d-M-y');
            }

            //actual_build_completion_date DATE
            $actual_build_completion_date = "";
            if(isset($result['build_record']['actual_build_completion_date'])){
                $actual_build_completion_date = Carbon::parse($result['build_record']['actual_build_completion_date'])->format('d-M-y');
            }

            //isp_b_wp2_approval_received DATE
            $isp_b_wp2_approval_received = "";
            if(isset($result['planning_record']['isp_b_wp2_approval_received'])){
                $isp_b_wp2_approval_received = Carbon::parse( $result['planning_record']['isp_b_wp2_approval_received'])->format('d-M-y');
            }
               
               $site_a_lla_received = "";
               if(isset($result['permission_record']['site_a_lla_received'])){
                   $site_a_lla_received = Carbon::parse( $result['permission_record']['site_a_lla_received'])->format('d-M-y');
               }
               $site_b_lla_received = "";
               if(isset($result['permission_record']['site_b_lla_received'])){
                   $site_b_lla_received = Carbon::parse( $result['permission_record']['site_b_lla_received'])->format('d-M-y');
               }
               $build_planned_completion_dates = "";
               if(isset($result['build_record']['build_planned_completion_dates'])){
                   $build_planned_completion_dates = Carbon::parse( $result['build_record']['build_planned_completion_dates'])->format('d-M-y');
               }
                //check data according to csv
                if($old_date_po_order_rx){
                    $old_date_po_order_rx = Date::dateTimeToExcel(Carbon::parse($old_date_po_order_rx));
                    }
                    if($rx_in_planning){
                        $rx_in_planning = Date::dateTimeToExcel(Carbon::parse($rx_in_planning));
                        }
                    if($toc_received){
                        $toc_received = Date::dateTimeToExcel(Carbon::parse($toc_received));
                        }    
                    if($toc_submitted){
                        $toc_submitted = Date::dateTimeToExcel(Carbon::parse($toc_submitted));
                        }  
                    if($wayleaves_received){
                        $wayleaves_received = Date::dateTimeToExcel(Carbon::parse($wayleaves_received));
                        }  
                    if($site_b_survey_date){
                        $site_b_survey_date = Date::dateTimeToExcel(Carbon::parse($site_b_survey_date));
                        }  
                    if($site_a_survey_date){
                        $site_a_survey_date = Date::dateTimeToExcel(Carbon::parse($site_a_survey_date));
                        } 
                if($build_planned_completion_dates){
                     $build_planned_completion_dates = Date::dateTimeToExcel(Carbon::parse($build_planned_completion_dates));
                    }
                if($site_b_lla_received){
                    $site_b_lla_received = Date::dateTimeToExcel(Carbon::parse($site_b_lla_received));
                    }  
                if($site_a_lla_received){
                    $site_a_lla_received = Date::dateTimeToExcel(Carbon::parse($site_a_lla_received));
                    }  
                if($isp_b_wp2_approval_received){
                    $isp_b_wp2_approval_received = Date::dateTimeToExcel(Carbon::parse($isp_b_wp2_approval_received));
                    }     
                if($actual_build_completion_date){
                    $actual_build_completion_date = Date::dateTimeToExcel(Carbon::parse($actual_build_completion_date));
                    }  
                if($revised_build_start_date){
                    $revised_build_start_date = Date::dateTimeToExcel(Carbon::parse($revised_build_start_date));
                    }  
                if($revised_planned_wp2_date){
                    $revised_planned_wp2_date = Date::dateTimeToExcel(Carbon::parse($revised_planned_wp2_date));
                    }  
                if($planned_wp2_released_date){
                    $planned_wp2_released_date = Date::dateTimeToExcel(Carbon::parse($planned_wp2_released_date));
                    }              
            //Set all array 
            $all_report_lists[] = [
                                'service_id' => $result['service_id'],
                                'vodacom_vcw' => $result['vodacom_vcw'],
                                'order_ref_number' => $result['order_ref_number'],
                                'project_status' => $result['project_status'],
                                'planning_status' => $result['planning_record']['planning_status'] ?? '',
                                'permissions_status' => $result['permission_record']['permissions_status'] ?? '',
                                'build_status' => $result['build_record']['build_status'] ?? '',
                                'province' => $result['province'],
                                'client_name' => $result['client_name'],
                                'client_po_num' => $result['client_po_num'],
                                'date_po_order_rx' => $old_date_po_order_rx,
                                'service_type' => $result['service_type'],
                                'client_ring' => $result['client_ring'],
                                'site_a' => $result['site_a'],
                                'site_b' => $result['site_b'],
                                'site_a_status' => $result['planning_record']['site_a_status'] ?? '',
                                'site_a_survey_date' => $site_a_survey_date,
                                'site_a_isp_submission' => $result['planning_record']['site_a_isp_submission'] ?? '',
                                'site_b_status' => $result['planning_record']['site_b_status'] ?? '',
                                'site_b_survey_date' =>  $site_b_survey_date ?? '',
                                'site_b_isp_submission' => $result['planning_record']['site_b_isp_submission'] ?? '',
                                'wayleaves_received' =>  $wayleaves_received,
                                'wayleaves_status' => $result['permission_record']['wayleaves_status'] ?? '',
                                'toc_submitted' => $toc_submitted,
                                'toc_received' => $toc_received,
                                'rx_in_planning' => $rx_in_planning,
                                'planning_days' => $planning_days,
                                'build_days' => $build_days,
                                'planned_wp2_released_date' => $planned_wp2_released_date,
                                'revised_planned_wp2_date' =>  $revised_planned_wp2_date,
                                'revised_build_start_date' => $revised_build_start_date,
                                'build_duration' => $result['build_record']['build_duration'] ?? '',
                                'isp_b_wp2_approval_received' =>  $isp_b_wp2_approval_received,
                                'site_a_lla_received' => $site_a_lla_received,
                                'site_b_lla_received' => $site_b_lla_received,
                                'build_planned_completion_dates' => $build_planned_completion_dates,
                                'actual_build_completion_date' =>  $actual_build_completion_date,
                            ];
        }
        return $all_report_lists;
    }
}
