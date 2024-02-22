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
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class ExportProjectAgeingReport implements FromCollection,WithHeadings,WithColumnFormatting,ShouldAutoSize
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
            'SERVICE ID', 
            'CLIENT NAME',
            'SITE A',
            'SITE B',
            'Region',
            'Project Type',
            'CTS Ageing',
            'Sales Ageing',
            'Project Duration',
            'Survey Ageing',
            'Planning Ageing',
            'Landlord Approval Ageing',
            'Wayleave Ageing',
            'Financial Approval Ageing',
            'Build Ageing',
            'OTOC AGEING',
            'SALES COMMENTS',
            'Planning Comments',
            'Service Delivery Comments',
            'DATE PO/ORDER Rx',
            'PENDING CTS DATE',
            'RECEIVED CTS DATE',
            'DateNew',
            'Rx IN PLANNING',
            'DATE SITE SURVEY',
            'DATE SUBMITTED FOR LANDLORD',
            'DATE LANDLORD APPROVAL RECEIVED',
            'WP2 APPROVAL REQUESTED',
            'WP2 APPROVAL RECEIVED',
            'Project Ageing',
            'TOC RECEIVED',
            'TOC SUBMITTED',  
        ];
    } 

    public function columnFormats(): array {
        return [
			'T' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'U' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'V' => NumberFormat::FORMAT_DATE_DDMMYYYY,  
			'W' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'X' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'Y' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'Z' => NumberFormat::FORMAT_DATE_DDMMYYYY,   
            'AA' => NumberFormat::FORMAT_DATE_DDMMYYYY,  
            'AB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AC' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AE' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AF' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_NUMBER_00, 
            'H' => NumberFormat::FORMAT_NUMBER_00, 
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'M' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
            'O' => NumberFormat::FORMAT_NUMBER_00,
            'P' => NumberFormat::FORMAT_NUMBER_00,
            'AD' => NumberFormat::FORMAT_NUMBER_00,
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
        
        $current_date =  Carbon::now()->format('Y-m-d');
        $new_current_date =  Carbon::now();
        //Set All records
        $all_report_lists = [];
        foreach($allResults as $key => $result){
            //For Project Duration
            $project_duration = "";
            if($result['project_status'] == "Q) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = (int)$date_toc_submitted_diff+1;
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = (int)$date_new_diff+1;
                }
            }

             //for sales ageing
             $sales_ageing = "";
             if(!empty($result['date_po_order_rx']) && !empty($result['date_new'])){
                 $date_new = Carbon::parse($result['date_new']);
                 $date_po_order_rx = Carbon::parse($result['date_po_order_rx']);
                 $sales_ageing_diff = $date_new->diffInDays($date_po_order_rx);
                 $sales_ageing = (int)$sales_ageing_diff+1;
             }
 
             //for survey ageing
             $survey_ageing = "";
             if(!empty($result['landlord_record']['date_submit_for_landlord']) && !empty($result['planning_record']['rx_in_planning'])){
                 $date_submit_for_landlord = Carbon::parse($result['landlord_record']['date_submit_for_landlord']);
                 $rx_in_planning = Carbon::parse($result['planning_record']['rx_in_planning'])->format('Y/m/d');
                 $survey_ageing_diff = $date_submit_for_landlord->diffInDays($rx_in_planning);
                 $survey_ageing = (int)$survey_ageing_diff+1;
             } else {
                 if(isset($result['planning_record']['rx_in_planning'])){
                 $rx_in_planning = Carbon::parse($result['planning_record']['rx_in_planning'])->format('Y/m/d');
                 $survey_ageing_diff = $new_current_date->diffInDays($rx_in_planning);
                 $survey_ageing = (int)$survey_ageing_diff+1;
              }
            }

              //for cts ageing
              $cts_ageing = "";
              if(!empty($result['cts_date']) && !empty($result['received_cts_date'])){
                   $cts_date = Carbon::parse($result['cts_date']);
                   $received_cts_date = Carbon::parse($result['received_cts_date']);
                   $cts_ageing_diff = $received_cts_date->diffInDays($cts_date);
                   $cts_ageing = (int)$cts_ageing_diff+1;
              }
 
              //for Planning ageing
              $planning_ageing = "";
              if(!empty($result['landlord_record']['date_submit_for_landlord']) && !empty($result['site_survey_record']['date_site_survey'])){
                  $date_submit_for_landlord = Carbon::parse($result['landlord_record']['date_submit_for_landlord']);
                  $date_site_survey = Carbon::parse($result['site_survey_record']['date_site_survey'])->format('Y/m/d');
                  $planning_ageing_diff = $date_submit_for_landlord->diffInDays($date_site_survey);
                  $planning_ageing = (int)$planning_ageing_diff+1;
              } else {
                 if(isset($result['site_survey_record']['date_site_survey'])){
                  $date_site_survey = Carbon::parse($result['site_survey_record']['date_site_survey'])->format('Y/m/d');
                  $planning_ageing_diff = $new_current_date->diffInDays($date_site_survey);
                  $planning_ageing = (int)$planning_ageing_diff+1;
                }
             }
 
              //for landlord approval ageing
              $landlord_approval_ageing = "";
              if(!empty($result['landlord_record']['landlord_date_received_from']) && !empty($result['landlord_record']['date_submit_for_landlord']) ){
                  $date_landlord_approval_received = Carbon::parse($result['landlord_record']['landlord_date_received_from']);
                  $date_submit_for_landlord = Carbon::parse($result['landlord_record']['date_submit_for_landlord'])->format('Y/m/d');
                  $landlord_approval_diff = $date_landlord_approval_received->diffInDays($date_submit_for_landlord);
                  $landlord_approval_ageing = (int)$landlord_approval_diff+1;
              } else {
                 if(isset($result['landlord_record']['date_submit_for_landlord'])){
                  $date_submit_for_landlord = Carbon::parse($result['landlord_record']['date_submit_for_landlord'])->format('Y/m/d');
                  $landlord_approval_diff = $new_current_date->diffInDays($date_submit_for_landlord);
                  $landlord_approval_ageing = (int)$landlord_approval_diff+1;
                 }
             }
 
             //for financial approval ageing
             $financial_approval_ageing = "";
             if(!empty($result['planning_record']['wp2_approval_received']) && !empty($result['planning_record']['wp2_approval_requested'])){
                 $wp2_approval_received = Carbon::parse($result['planning_record']['wp2_approval_received']);
                 $wp2_approval_requested = Carbon::parse($result['planning_record']['wp2_approval_requested'])->format('Y/m/d');
                 $financial_approval_diff = $wp2_approval_received->diffInDays($wp2_approval_requested);
                 $financial_approval_ageing = (int)$financial_approval_diff+1;
             } else {
                 if(isset($result['planning_record']['wp2_approval_requested'])){
                 $wp2_approval_requested = Carbon::parse($result['planning_record']['wp2_approval_requested'])->format('Y/m/d');
                 $financial_approval_diff = $new_current_date->diffInDays($wp2_approval_requested);
                 $financial_approval_ageing = (int)$financial_approval_diff+1;
               }
            }
 
             //for wayleaves ageing
             $wayleaves_ageing = "";
             if(!empty($result['planning_record']['wp2_approval_received']) && !empty($result['permission_record']['wayleaves_submitted'])){
                 $wayleaves_received = Carbon::parse($result['permission_record']['wayleaves_received']);
                 $wayleaves_submitted = Carbon::parse($result['permission_record']['wayleaves_submitted'])->format('Y/m/d');
                 $wayleaves_diff = $wayleaves_received->diffInDays($wayleaves_submitted);
                 $wayleaves_ageing = (int)$wayleaves_diff+1;
             } else {
                 if(isset($result['permission_record']['wayleaves_submitted'])){
                 $wayleaves_submitted = Carbon::parse($result['permission_record']['wayleaves_submitted'])->format('Y/m/d');
                 $wayleaves_diff = $new_current_date->diffInDays($wayleaves_submitted);
                 $wayleaves_ageing = (int)$wayleaves_diff+1;
              }
            }
 
              //for build ageing
              $build_ageing = "";
              if(!empty($result['build_record']['actual_build_completion_date']) && !empty($result['build_record']['revised_build_start_date'])){
                  $actual_build_completion_date = Carbon::parse($result['build_record']['actual_build_completion_date']);
                  $revised_build_start_date_parse = Carbon::parse($result['build_record']['revised_build_start_date'])->format('Y/m/d');
                  $build_ageing_diff = $actual_build_completion_date->diffInDays($revised_build_start_date_parse);
                  $build_ageing = (int)$build_ageing_diff+1;
              } else {
                 if(isset($result['build_record']['revised_build_start_date'])){
                  $revised_build_start_date_parse = Carbon::parse($result['build_record']['revised_build_start_date'])->format('Y/m/d');
                  $build_ageing_diff = $new_current_date->diffInDays($revised_build_start_date_parse);
                  $build_ageing = (int)$build_ageing_diff+1;
              }
             }

             //for OTOC ageing
            $otoc_ageing = '';
            if(empty($result['build_record']['toc_submitted'])){
                $otoc_ageing = '0';
            } elseif(empty($result['build_record']['otoc'])  && !empty($result['build_record']['toc_submitted'])){
                $toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                $otoc_ageing_diff = $new_current_date->diffInDays($toc_submitted);
                $otoc_ageing = $otoc_ageing_diff+1;
            } else {
                if(!empty($result['build_record']['otoc']) && !empty($result['build_record']['toc_submitted'])){
                $toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                $otoc = Carbon::parse($result['build_record']['otoc']);
                $otoc_ageing_diff = $otoc->diffInDays($toc_submitted);
                $otoc_ageing = $otoc_ageing_diff+1;
            }
            }
            //For Ageing
            $ageing = "";
            if($project_duration == 0){
                $ageing = "Cancelled";
            } elseif($project_duration < 30){
                $ageing = "Current";
            } elseif($project_duration > 30 AND $project_duration < 60){
                $ageing = "60 Days";
            } elseif($project_duration > 60 AND $project_duration < 91){
                $ageing = "90 days";
            } elseif($project_duration > 90 AND $project_duration < 121){
                $ageing = "120 days";
            } elseif($project_duration > 90 AND $project_duration < 121){
                $ageing = "More than 120 Days";
            } else {
                $ageing = "Query";
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
            //date_new format
            $date_new = "";
            if(isset($result['date_new'])){
                $date_new = Carbon::parse($result['date_new'])->format('Y/m/d');
            }
            
            //Date po order rx date format
            $date_po_order_rx = "";
            if(isset($result['date_po_order_rx'])){
                $date_po_order_rx = Carbon::parse($result['date_po_order_rx'])->format('Y/m/d');
            }

            //toc_received format
            $toc_received = "";
            if(isset($result['build_record']['toc_received'])){
                $toc_received = Carbon::parse($result['build_record']['toc_received'])->format('Y/m/d');
            }

            //toc_submitted format
            $toc_submitted = "";
            if(isset($result['build_record']['toc_submitted'])){
                $toc_submitted = Carbon::parse($result['build_record']['toc_submitted'])->format('Y/m/d');
            }         

            //rx_in_planning format
            $rx_in_planning = "";
            if(isset($result['planning_record']['rx_in_planning'])){
                $rx_in_planning = Carbon::parse($result['planning_record']['rx_in_planning'])->format('Y/m/d');
            }

            //wp2_approval_requested format
            $wp2_approval_requested = "";
            if(isset($result['planning_record']['wp2_approval_requested'])){
                $wp2_approval_requested = Carbon::parse($result['planning_record']['wp2_approval_requested'])->format('Y/m/d');
            }

            //wp2_approval_received format
            $wp2_approval_received = "";
            if(isset($result['planning_record']['wp2_approval_received'])){
                $wp2_approval_received = Carbon::parse($result['planning_record']['wp2_approval_received'])->format('Y/m/d');
            }
          
           
            //date_site_survey format
            $date_site_survey = "";
            if(isset($result['site_survey_record']['date_site_survey'])){
                $date_site_survey = Carbon::parse($result['site_survey_record']['date_site_survey'])->format('Y/m/d');
            }
            //date_site_survey format
            $date_submit_for_landlord = "";
            if(isset($result['landlord_record']['date_submit_for_landlord'])){
                $date_submit_for_landlord = Carbon::parse($result['landlord_record']['date_submit_for_landlord'])->format('Y/m/d');
            }
            $landlord_date_received_from = "";
            if(isset($result['landlord_record']['landlord_date_received_from'])){
                $landlord_date_received_from = Carbon::parse($result['landlord_record']['landlord_date_received_from'])->format('Y/m/d');
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
            if($landlord_date_received_from){
            $landlord_date_received_from = Date::dateTimeToExcel(Carbon::parse($landlord_date_received_from));
            }
            
            if($date_submit_for_landlord){
                $date_submit_for_landlord = Date::dateTimeToExcel(Carbon::parse($date_submit_for_landlord));
            }
            if($date_site_survey){
                $date_site_survey = Date::dateTimeToExcel(Carbon::parse($date_site_survey));
            }
          
            if($wp2_approval_received){
                $wp2_approval_received = Date::dateTimeToExcel(Carbon::parse($wp2_approval_received));
            }
            if($wp2_approval_requested){
                $wp2_approval_requested = Date::dateTimeToExcel(Carbon::parse($wp2_approval_requested));
            }
            if($date_new){
                $date_new = Date::dateTimeToExcel(Carbon::parse($date_new));
            }
            if($toc_received){
                $toc_received = Date::dateTimeToExcel(Carbon::parse($toc_received));
            }
			if($date_po_order_rx){
                $date_po_order_rx = Date::dateTimeToExcel(Carbon::parse($date_po_order_rx));
            }
			if($toc_submitted){
                $toc_submitted = Date::dateTimeToExcel(Carbon::parse($toc_submitted));
            }
			if($rx_in_planning){
			   $rx_in_planning = Date::dateTimeToExcel(Carbon::parse($rx_in_planning));
			}
			
			

            //Set all array
            $all_report_lists[] = [
                                'service_id' => $result['service_id'], 
                                'client_name' => $result['client_name'],
                                'site_a' => $result['site_a'],
                                'site_b' => $result['site_b'],
                                'region' => $result['region'],
                                'Project Type' => $result['type'],
                                'CTS Ageing' =>  $cts_ageing,
                                'Sales Ageing' =>  $sales_ageing ?? '',
                                'Project Duration' => $project_duration ?? '',
                                'Survey Ageing' => $survey_ageing,
                                'Planning Ageing' => $planning_ageing,
                                'Landlord Approval Ageing' => $landlord_approval_ageing,
                                'Wayleave Ageing' => $wayleaves_ageing,
                                'Financial Approval Ageing' => $financial_approval_ageing,
                                'Build Ageing' => $build_ageing,
                                'OTOC AGEING' => $otoc_ageing,
                                'SALES COMMENTS' => $result['sales_comments'],
                                'Planning Comments' => $result['planning_record']['comment'] ?? '',
                                'Service Delivery Comments' => $result['service_delivery_comments'],
                                'DATE PO/ORDER Rx' => $date_po_order_rx ?? '',
                                'PENDING CTS DATE' => $cts_date ?? '',
                                'RECEIVED CTS DATE' => $received_cts_date ?? '', 
                                'DateNew' => $date_new ?? '',
                                'Rx IN PLANNING' => $rx_in_planning ?? '',
                                'DATE SITE SURVEY' => $date_site_survey ?? '',
                                'DATE SUBMITTED FOR LANDLORD' => $date_submit_for_landlord ?? '',
                                'DATE LANDLORD APPROVAL RECEIVED' => $landlord_date_received_from ?? '',
                                'WP2 APPROVAL REQUESTED' => $wp2_approval_requested ?? '',
                                'WP2 APPROVAL RECEIVED' => $wp2_approval_received ?? '',
                                'Project Ageing' => $ageing,
                                'TOC RECEIVED' => $toc_received ?? '',
                                'TOC SUBMITTED' => $toc_submitted ?? '', 
                            ];
                            
        }
        return $all_report_lists;
    }
}