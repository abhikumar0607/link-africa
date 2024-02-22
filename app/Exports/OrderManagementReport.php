<?php

namespace App\Exports;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BuildMasterFileController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\SiteMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderManagementReport implements FromCollection,WithHeadings,WithColumnFormatting,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'SERVICE ID', 
            'Circuit ID',
            'Project ID',
            'CLIENT NAME',
            'SITE A',
            'SITE B',
            'PROVINCE',
            'Region',
            'SERVICE TYPE',
            'Rate Mbit-S',
            'Lease term in Months',
            'Project Type',
            'Order Type',
            'Network Types',
            'PROJECT STATUS',
            'Site Survey Status',
            'PLANNING STATUS',
            'Landlord Approval Status',
            'WAYLEAVE STATUS',
            'PERMISSIONS STATUS',
            'BUILD STATUS',
            'Service Delivery Status',
            'KAM Name',
            'Feasibility Ref Nr',
            'PO MRC',
            'PO NRC',
            'Special Build NRC',
            '3rd Party NRC',
            '3rd Party MRC',
            '3rd Party Provider',
            'DATE PO/ORDER Rx',
            'PENDING CTS DATE' ,
            'RECEIVED CTS DATE',
            'CTS AGEING', 
            'DateNew',
            'Sales Ageing',
            'Project Duration',
            'Project Ageing',
            'TOC RECEIVED',
            'TOC SUBMITTED',
            'Physical Address - Site B',
            'Contact Name  - Site B',
            'Work Number - Site B',
            'Mobile Number - Site B',
            'Email Address - Site B',
            'GPS Co- ordinates - Site B-X',
            'GPS Co- ordinates - Site B-Y',
            'Link dependency',
            'Port Type',
            'Port location',
            'Port Number',
            'OSP PLANNERS',
            'ISP PLANNERS',
            'SURVEYORS',
            'PLanning Days',
            'Build Days',
            'Rx IN PLANNING',
            'SITE B SURVEY DATE',
            'DATE SITE SURVEY',
            'Survey Ageing',
            'SITE B ISP SUBMISSION',
            'DATE SUBMITTED FOR LANDLORD',
            'Planning Ageing',
            'DATE LANDLORD APPROVAL RECEIVED',
            'Landlord Approval Ageing',
            'WP2 APPROVAL REQUESTED',
            'WP2 APPROVAL RECEIVED',
            'Financial Approval Ageing',
            'WAYLEAVES SUBMITTED',
            'WAYLEAVES RECEIVED',
            'Wayleave Ageing',
            'PLANNED WP2 RELEASED DATE',
            'REVISED PLANNED WP2 DATE',
            'EST Build Completion Date', 
            'REVISED BUILD START DATE',
            'BUILD DURATION',
            'REVISED BUILD COMPLETION DATE',
            'Planned Build Completion Date',
            'ACTUAL BUILD COMPLETION DATE',
            'SHOW ME THE MONEY',
            'Build Ageing',
            'OTDR DISTANCE',
            'QA REQUESTED',
            'OTOC',
            'OTOC AGEING',
            'SALES COMMENTS',
            'Planning COMMENT',
            'Service Delivery Comments',
            'Return to Sales',
            'Termination Date',
            'Penalty Charges',
            'Cancellation date',
            'Client PO NUM',
            'Vodacom VCW',
            'ORDER REF NO',
            'CLIENT RING',
            'Transmission Project',
            'Request Type',
            'OSP DISTANCE - TRENCH',
            'OSP DISTANCE - 3RD PARTY DUCTS',
            'OSP LA EXISTING DUCT',
            'OSP LA EXISTING NETWORK',
            'OSP DISTANCE - FOCUS',
            'OSP in - Buildin Conduits',
            'ISP A DISTANCE - TRENCH',
            'ISP A DISTANCE - 3RD PARTY DUCTS',
            'ISP A LA EXISTING DUCT',
            'ISP A LA EXISTING NETWORK',
            'ISP A DISTANCE - FOCUS',
            'ISP A in - Buildin Conduits',
            'ISP B DISTANCE - TRENCH',
            'ISP B DISTANCE - 3RD PARTY DUCTS',
            'ISP B LA EXISTING DUCT',
            'ISP B LA EXISTING NETWORK',
            'ISP B DISTANCE - FOCUS',
            'ISP B in - Buildin Conduits',
            'OSP ASB - TRENCH',
            'OSP ASB - 3RD PARTY DUCTS',
            'OSP ASB - LA EXISTING DUCT',
            'OSP ASB - EXISTING NETWORK',
            'OSP ASB - DISTANCE – FOCUS',
            'OSP ASB – IN BUILDING CONDUITS',
            'ISP A ASB - TRENCH',
            'ISP A ASB - 3RD PARTY DUCTS',
            'ISP A ASB - LA EXISTING DUCT',
            'ISP A ASB - EXISTING NETWORK',
            'ISP A ASB - DISTANCE – FOCUS',
            'ISP A ASB - IN BUILDING CONDUITS',
            'ISP B ASB - TRENCH',
            'ISP B ASB - 3RD PARTY DUCTS',
            'ISP B ASB - LA EXISTING DUCT',
            'ISP B ASB - EXISTING NETWORK',
            'ISP B ASB - DISTANCE – FOCUS',
            'ISP B ASB - IN BUILDING CONDUITS',
            'QTY',
            'YEAR',
            'SD STATUS',
            'WEEK',
            'RESOURCES',
            'COMMENTS',
        ];
    } 

    public function columnFormats(): array {
        return [
            'AE' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'AF' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'AG' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'AI' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'AJ' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'AK' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'AM' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AN' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'BC' => NumberFormat::FORMAT_DATE_DDMMYYYY,  
			'BD' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'BE' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'BF' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'BG' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'BI' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BJ' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'BK' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'BL' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'BN' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'BO' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'BQ' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'BR' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'BS' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BT' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BU' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BV' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BW' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BY' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BZ' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'Y' => NumberFormat::FORMAT_NUMBER_00,
			'Z' => NumberFormat::FORMAT_NUMBER_00,
            'AB' => NumberFormat::FORMAT_NUMBER_00,
            'AH' => NumberFormat::FORMAT_NUMBER_00,
            'AC' => NumberFormat::FORMAT_NUMBER_00,
            'AJ' => NumberFormat::FORMAT_NUMBER_00,
            'AK' => NumberFormat::FORMAT_NUMBER_00,
            'AL' => NumberFormat::FORMAT_NUMBER_00,
            'BH' => NumberFormat::FORMAT_NUMBER_00,
            'BK' => NumberFormat::FORMAT_NUMBER_00,
            'BM' => NumberFormat::FORMAT_NUMBER_00,
            'BP' => NumberFormat::FORMAT_NUMBER_00,
            'BS' => NumberFormat::FORMAT_NUMBER_00,

            'CG' => NumberFormat::FORMAT_NUMBER_00,
            'CC' => NumberFormat::FORMAT_NUMBER_00,
            'CB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'BX' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'CA' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'CE' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'CF' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'CL' => NumberFormat::FORMAT_DATE_DDMMYYYY,    
            'CN' => NumberFormat::FORMAT_DATE_DDMMYYYY,   
        ];
    }
    public function collection()
    {
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
             if(!empty($result['landlord_record']['date_landlord_approval']) && !empty($result['landlord_record']['date_submit_for_landlord']) ){
                 $date_landlord_approval_received = Carbon::parse($result['landlord_record']['date_landlord_approval']);
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

            $cts_ageing = "";
            if(!empty($result['cts_date']) && !empty($result['received_cts_date'])){
                 $cts_date = Carbon::parse($result['cts_date']);
                 $received_cts_date = Carbon::parse($result['received_cts_date']);
                 $cts_ageing_diff = $received_cts_date->diffInDays($cts_date);
                 $cts_ageing = (int)$cts_ageing_diff+1;
            }
            //for OTOC ageing
            $otoc_ageing = '0';
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

            //For project Ageing
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
            //REVISED BUILD COMPLETION DATE
            $revised_build_completion_date = "";  
            if(isset($result['build_record']['revised_build_start_date'])){
                $revised_build_start_date_parse = Carbon::parse($result['build_record']['revised_build_start_date']);
                $build_duration = $result['build_record']['build_duration'];
                $revised_build_completion_date = $revised_build_start_date_parse->addDays($build_duration)->format('Y/m/d');
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
                $planned_wp2_released_date = $rx_in_planning_parse->addDays($planning_days)->format('Y/m/d');
            }
            //Planned Build Completion Date
            // $planned_build_completion_date = "";
            //
            $planned_build_completion_date = '';
            if(!empty($result['build_record']['planned_build_completion_date'])){
            $planned_build_completion_date = Carbon::parse($result['build_record']['planned_build_completion_date'])->format('Y/m/d');
            }
               
           
            

            $project_type = $result['type'];
            $BuildMasterFileController = new BuildMasterFileController();
            $planned_start_date = $BuildMasterFileController->change_planned_start_date($result['planning_record']['revised_planned_wp2_date'],$result['planning_record']['planned_wp2_released_date']);
            $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);
         
            // for show me the money
            $show_me_the_money = '';
            if($ageing == 'Cancelled'){
                $show_me_the_money = "";
            } elseif($ageing != 'Cancelled' && !empty($result['build_record']['toc_submitted'])){
                $show_me_the_money = Carbon::parse($result['build_record']['toc_submitted'])->format('Y/m/d');
            } elseif(empty($result['build_record']['toc_submitted']) && !empty($result['build_record']['actual_build_completion_date'])){
                $show_me_the_money = Carbon::parse($result['build_record']['actual_build_completion_date'])->format('Y/m/d');
            } elseif(empty($result['build_record']['actual_build_completion_date']) && !empty($planned_build_completion_date)){
                $show_me_the_money = Carbon::parse($planned_build_completion_date)->format('Y/m/d');
            } elseif(empty($planned_build_completion_date) && !empty($result['build_record']['revised_build_co_date'])){
                $show_me_the_money = Carbon::parse($result['build_record']['revised_build_co_date'])->format('Y/m/d');
            } elseif(empty($result['build_record']['revised_build_co_date']) && !empty($est_complition_date)){
                $show_me_the_money = Carbon::parse($est_complition_date)->format('Y/m/d');
            }
            
       
            //date_new format
            $date_new = "";
            if(isset($result['date_new'])){
                $date_new = Carbon::parse($result['date_new'])->format('Y/m/d');
            }
          

         

         

            //po_mrc remove R and .00 format
              //po_mrc remove R and .00 format
            //   $new_po_mrc = "";
            //   if(isset($result['po_mrc'])){
            //       $po_mrc = $result['po_mrc'];
            //       $remove_r_po_mrc = str_replace("R","",$po_mrc);;
            //       //$remove_format_po_mrc = str_replace(".00","",$remove_r_po_mrc);
            //       $new_po_mrc = number_format((float) $remove_r_po_mrc,2);
            //   }
  
              //po_nrc remove R and .00 format 
            //po_mrc remove R and .00 format
              //po_mrc remove R and .00 format
              //po_mrc remove R and .00 format
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
            //po_nrc remove R and .00 format 
            $new_lease_term_in_months = 'N/A';
            if(isset($result['lease_term_in_months'])){
                $lease_term_in_months = $result['lease_term_in_months'];
                $m_lease_term_in_months = str_replace("month","",$lease_term_in_months);
                $new_lease_term_in_months = str_replace(",","",$m_lease_term_in_months);
            }
            //special_build_nrc remove R and .00 format 
            $new_special_build_nrc = ""; 
           // if(isset($result['special_build_nrc'])){
                $special_build_nrc = $result['special_build_nrc'];
                if($result['special_build_nrc'] == " NaN" OR $result['special_build_nrc'] == "NaN" OR $result['special_build_nrc'] == "R NaN"){
                    $new_special_build_nrc = 0;
                } else {
                    $remove_r_special_build_nrc = str_replace("R","",$special_build_nrc);;
                    $remove_format_special_build_nrc = str_replace(".00","",$remove_r_special_build_nrc);
                    $new_special_build_nrc = $remove_format_special_build_nrc;
                }
            //}

            
            
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
            $planned_build_date = "";
			if(isset($result['planned_build_date'])){
			   $planned_build_date = Carbon::parse($result['planned_build_date'])->format('Y/m/d');
			}
            //build_planned_completion_dates format
            $build_planned_completion_dates = "";
            if(isset($result['build_record']['build_planned_completion_dates'])){
                $build_planned_completion_dates = Carbon::parse($result['build_record']['build_planned_completion_dates'])->format('Y/m/d');
            }
           
            //actual_build_completion_date format
            $actual_build_completion_date = "";
            if(isset($result['build_record']['actual_build_completion_date'])){
                $actual_build_completion_date = Carbon::parse($result['build_record']['actual_build_completion_date'])->format('Y/m/d');
            }

            //rx_in_planning format
            $rx_in_planning = "";
            if(isset($result['planning_record']['rx_in_planning'])){
                $rx_in_planning = Carbon::parse($result['planning_record']['rx_in_planning'])->format('Y/m/d');
            }

            //revised_planned_wp2_date format
            $revised_planned_wp2_date = "";
            if(isset($result['planning_record']['revised_planned_wp2_date'])){
                $revised_planned_wp2_date = Carbon::parse($result['planning_record']['revised_planned_wp2_date'])->format('Y/m/d');
            }

            //revised_build_start_date format
            $revised_build_start_date = "";
            if(isset($result['build_record']['revised_build_start_date'])){
                $revised_build_start_date = Carbon::parse($result['build_record']['revised_build_start_date'])->format('Y/m/d');
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
            //wp2_approval_requested format
            $wp2_approval_received = "";
            if(isset($result['planning_record']['wp2_approval_received'])){
                $wp2_approval_received = Carbon::parse($result['planning_record']['wp2_approval_received'])->format('Y/m/d');
            }

             //wp2_approval_requested format
             $wp2_approval_received = "";
             if(isset($result['planning_record']['wp2_approval_received'])){
                 $wp2_approval_received = Carbon::parse($result['planning_record']['wp2_approval_received'])->format('Y/m/d');
             }
             //site_b_isp_submission format
             $site_b_isp_submission = "";
             if(isset($result['planning_record']['site_b_isp_submission'])){
                 $site_b_isp_submission = Carbon::parse($result['planning_record']['site_b_isp_submission'])->format('Y/m/d');
             }
             //site_b_survey_date format
             $site_b_survey_date = "";
             if(isset($result['planning_record']['site_b_survey_date'])){
                 $site_b_survey_date = Carbon::parse($result['planning_record']['site_b_survey_date'])->format('Y/m/d');
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
            //date_site_survey format
            $date_landlord_approval = "";
            if(isset($result['landlord_record']['date_landlord_approval'])){
                $date_landlord_approval = Carbon::parse($result['landlord_record']['date_landlord_approval'])->format('Y/m/d');
            }
             //date_site_survey format
             $wayleaves_submitted = "";
             if(isset($result['permission_record']['wayleaves_submitted'])){
                 $wayleaves_submitted = Carbon::parse($result['permission_record']['wayleaves_submitted'])->format('Y/m/d');
             }
              //date_site_survey format
            $wayleaves_received = "";
            if(isset($result['permission_record']['wayleaves_received'])){
                $wayleaves_received = Carbon::parse($result['permission_record']['wayleaves_received'])->format('Y/m/d');
            }
            $cancellation_date = "";
            if(isset($result['cancellation_date'])){
                $cancellation_date = Carbon::parse($result['cancellation_date'])->format('Y/m/d');
            }
            $landlord_date_received_from = "";
            if(isset($result['landlord_record']['landlord_date_received_from'])){
                $landlord_date_received_from = Carbon::parse($result['landlord_record']['landlord_date_received_from'])->format('Y/m/d');
            }
            $termination_date = "";
            if(isset($result['termination_date'])){
                $termination_date = Carbon::parse($result['termination_date'])->format('Y/m/d');
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
           if($show_me_the_money){
            $show_me_the_money = Date::dateTimeToExcel(Carbon::parse($show_me_the_money));
            }
            if($cts_date){
            $cts_date = Date::dateTimeToExcel(Carbon::parse($cts_date));
            }
            if($received_cts_date){
                $received_cts_date = Date::dateTimeToExcel(Carbon::parse($received_cts_date));
            }
            if($termination_date){
            $termination_date = Date::dateTimeToExcel(Carbon::parse($termination_date));
            }
            if($landlord_date_received_from){
            $landlord_date_received_from = Date::dateTimeToExcel(Carbon::parse($landlord_date_received_from));
            }
            if($cancellation_date){
            $cancellation_date = Date::dateTimeToExcel(Carbon::parse($cancellation_date));
            }
            if($wayleaves_submitted){
                $wayleaves_submitted = Date::dateTimeToExcel(Carbon::parse($wayleaves_submitted));
            }
            if($wayleaves_received){
                $wayleaves_received = Date::dateTimeToExcel(Carbon::parse($wayleaves_received));
            }
            if($date_landlord_approval){
                $date_landlord_approval = Date::dateTimeToExcel(Carbon::parse($date_landlord_approval));
            }
            if($date_submit_for_landlord){
                $date_submit_for_landlord = Date::dateTimeToExcel(Carbon::parse($date_submit_for_landlord));
            }
            if($date_site_survey){
                $date_site_survey = Date::dateTimeToExcel(Carbon::parse($date_site_survey));
            }
            if($site_b_survey_date){
                $site_b_survey_date = Date::dateTimeToExcel(Carbon::parse($site_b_survey_date));
            }
            if($site_b_isp_submission){
                $site_b_isp_submission = Date::dateTimeToExcel(Carbon::parse($site_b_isp_submission));
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
			if($planned_wp2_released_date){
			   $planned_wp2_released_date = Date::dateTimeToExcel(Carbon::parse($planned_wp2_released_date));
			}
			if($revised_planned_wp2_date){
			   $revised_planned_wp2_date = Date::dateTimeToExcel(Carbon::parse($revised_planned_wp2_date));
			}
			if($revised_build_start_date){
			   $revised_build_start_date = Date::dateTimeToExcel(Carbon::parse($revised_build_start_date));
			}
			if($planned_build_completion_date){
			   $planned_build_completion_date = Date::dateTimeToExcel(Carbon::parse($planned_build_completion_date));
			}
			if($build_planned_completion_dates){
			   $build_planned_completion_dates = Date::dateTimeToExcel(Carbon::parse($build_planned_completion_dates));
			}
			if($revised_build_completion_date){
			   $revised_build_completion_date = Date::dateTimeToExcel(Carbon::parse($revised_build_completion_date));
			}
			if($actual_build_completion_date){
			   $actual_build_completion_date = Date::dateTimeToExcel(Carbon::parse($actual_build_completion_date));
			}
			if($planned_build_date){
			   $planned_build_date = Date::dateTimeToExcel(Carbon::parse($planned_build_date));
			}
            if($est_complition_date){
                $est_complition_date = Date::dateTimeToExcel(Carbon::parse($est_complition_date));
             }
			

            //Set all array
            $all_report_lists[] = [
                                    'service_id' => $result['service_id'],
                                    'circuit_id' => $result['circuit_id'],
                                    'project_id' => $result['project_id'],
                                    'client_name' => $result['client_name'],
                                    'site_a' => $result['site_a'],
                                    'site_b' => $result['site_b'],
                                    'province' => $result['province'],
                                    'region'=> $result['region'],
                                    'service_type' => $result['service_type'],
                                    'rate_mbit_s' => $result['rate_mbit_s'],
                                    'lease_term_in_months' => $new_lease_term_in_months,
                                    'type' => $result['type'],
                                    'order_type' => $result['order_type'],
                                    'Network Types' => $result['network_types'],
                                    'PROJECT STATUS' => $result['project_status'],
                                    'Site Survey Status' => $result['site_survey_record']['site_survey_status'] ?? '',
                                    'PLANNING STATUS' => $result['planning_record']['planning_status'] ?? '',
                                    'Landlord Approval Status' => $result['landlord_record']['landlord_approval_status'] ?? '',
                                    'WAYLEAVE STATUS' => $result['permission_record']['wayleaves_status'] ?? '',
                                    'PERMISSIONS STATUS' => $result['permission_record']['permissions_status'] ?? '',
                                    'BUILD STATUS' => $result['build_record']['build_status'] ?? '',
                                    'Service Delivery Status' => $result['service_delivery_status'],
                                    'KAM Name' => $result['kam_name'],
                                    'Feasibility Ref Nr' => $result['feasibility_ref_nr'],
                                    'PO MRC' => (int)$new_po_mrc,
                                    'PO NRC' => (int) $new_po_nrc,
                                    'Special Build NRC' => $new_special_build_nrc,
                                    '3rd Party NRC' => $result['thrd_party_nrc'],
                                    '3rd Party MRC' => $result['thrd_party_mrc'],
                                    '3rd Party Provider' => $result['thrd_party_provider'],
                                    'DATE PO/ORDER Rx' => $date_po_order_rx ?? '',
                                    'PENDING CTS DATE' => $cts_date,
                                    'RECEIVED CTS DATE' => $received_cts_date,
                                    'CTS AGEING' => $cts_ageing,
                                    'DateNew' => $date_new ?? '',
                                    'Sales Ageing' => $sales_ageing ?? '',
                                    'Project Duration' => $project_duration ?? '',
                                    'Project Ageing' => $ageing,
                                    'TOC RECEIVED' => $toc_received ?? '',
                                    'TOC SUBMITTED' => $toc_submitted ?? '',
                                    'Physical Address - Site B' => $result['physical_address_site_b'],
                                    'Contact Name  - Site B' => $result['contact_name_site_b'],
                                    'Work Number - Site B' => $result['work_number_site_b'],
                                    'Mobile Number - Site B' => $result['mobile_number_site_b'],
                                    'Email Address - Site B' => $result['email_address_site_b'],
                                    'GPS Co- ordinates - Site B-X' => $result['gps_co_ordinates_site_b_x'],
                                    'GPS Co- ordinates - Site B-Y' => $result['gps_co_ordinates_site_b_y'],
                                    'Link dependency' => $result['planning_record']['link_dependency'] ?? '',
                                    'Port Type' => $result['port_type'],
                                    'Port location' => $result['port_location'],
                                    'Port Number' => $result['port_number'],
                                    'OSP PLANNERS' => $result['planning_record']['osp_planners'] ?? '',
                                    'ISP PLANNERS' => $result['planning_record']['isp_planners'] ?? '',
                                    'SURVEYORS' => $result['planning_record']['surveyors'] ?? '',
                                    'PLanning Days' => $planning_days,
                                    'Build Days' => $build_days,
                                    'Rx IN PLANNING' => $rx_in_planning ?? '',
                                    'SITE B SURVEY DATE' => $site_b_survey_date ?? '', 
                                    'DATE SITE SURVEY' => $date_site_survey ?? '',
                                    'Survey Ageing' => $survey_ageing,
                                    'SITE B ISP SUBMISSION' => $site_b_isp_submission ?? '',
                                    'DATE SUBMITTED FOR LANDLORD' => $date_submit_for_landlord ?? '',
                                    'Planning Ageing' => $planning_ageing,
                                    'DATE LANDLORD APPROVAL RECEIVED' => $date_landlord_approval ?? '',
                                    'Landlord Approval Ageing' => $landlord_approval_ageing,
                                    'WP2 APPROVAL REQUESTED' => $wp2_approval_requested ?? '',
                                    'WP2 APPROVAL RECEIVED' => $wp2_approval_received ?? '',
                                    'Financial Approval Ageing' => $financial_approval_ageing,
                                    'WAYLEAVES SUBMITTED' => $wayleaves_submitted ?? '',
                                    'WAYLEAVES RECEIVED' => $wayleaves_received ?? '',
                                    'Wayleave Ageing' => $wayleaves_ageing,
                                    'PLANNED WP2 RELEASED DATE' => $planned_wp2_released_date ?? '',
                                    'REVISED PLANNED WP2 DATE' => $revised_planned_wp2_date ?? '',
                                    'EST Build Completion Date' => $est_complition_date ?? '',
                                    'REVISED BUILD START DATE' =>  $revised_build_start_date ?? '',
                                    'BUILD DURATION' => $result['build_record']['build_duration'] ?? '',
                                    'REVISED BUILD COMPLETION DATE' => $revised_build_completion_date ?? '',
                                    'Planned Build Completion Date' => $planned_build_completion_date ?? '',
                                    'ACTUAL BUILD COMPLETION DATE' => $actual_build_completion_date ?? '',
                                    'SHOW ME THE MONEY' =>  $show_me_the_money, 
                                    'Build Ageing' => $build_ageing,
                                    'OTDR DISTANCE' => $result['build_record']['otdr_distance'] ?? '',
                                    'QA REQUESTED' => $result['build_record']['qa_requested'] ?? '',
                                    'OTOC' => $result['build_record']['otoc'] ?? '',
                                    'OTOC AGEING' => $otoc_ageing ?? '',
                                    'SALES COMMENTS' => $result['sales_comments'],
                                    'Planning COMMENT' => $result['planning_record']['comment'] ?? '',
                                    'Service Delivery Comments' => $result['service_delivery_comments'],
                                    'Return to Sales' => $result['return_to_sales'],
                                    'Termination Date' => $termination_date ?? '',
                                    'Penalty Charges' => $result['penalty_charges'],
                                    'Cancellation date' => $cancellation_date ?? '',
                                    'Client PO NUM' => $result['client_po_num'],
                                    'Vodacom VCW' => $result['vodacom_vcw'],
                                    'ORDER REF NO' => $result['order_ref_number'],
                                    'CLIENT RING' => $result['client_ring'],
                                    'Transmission Project' => $result['transmission_project'],
                                    'Request Type' => $result['request_type'],
                                    'OSP DISTANCE - TRENCH' => $result['planning_record']['osp_distance_trench'] ?? '',
                                    'OSP DISTANCE - 3RD PARTY DUCTS' => $result['planning_record']['osp_distance_3rd_party_ducts'] ?? '',
                                    'OSP LA EXISTING DUCT' => $result['planning_record']['osp_la_existing_duct'] ?? '',
                                    'OSP LA EXISTING NETWORK' => $result['planning_record']['osp_la_existing_network'] ?? '',
                                    'OSP DISTANCE - FOCUS' => $result['planning_record']['osp_distance_focus'] ?? '',
                                    'OSP in - Buildin Conduits' => $result['planning_record']['osp_in_buildin_conduits'] ?? '',
                                    'ISP A DISTANCE - TRENCH' => $result['planning_record']['isp_a_distance_trench'] ?? '',
                                    'ISP A DISTANCE - 3RD PARTY DUCTS' => $result['planning_record']['isp_a_distance_3rd_party_ducts'] ?? '',
                                    'ISP A LA EXISTING DUCT' => $result['planning_record']['isp_a_la_existing_duct'] ?? '',
                                    'ISP A LA EXISTING NETWORK' => $result['planning_record']['isp_a_la_existing_network'] ?? '',
                                    'ISP A DISTANCE - FOCUS' => $result['planning_record']['isp_a_distance_focus'] ?? '',
                                    'ISP A in - Buildin Conduits' => $result['planning_record']['isp_a_in_buildin_conduits'] ?? '',
                                    'ISP B DISTANCE - TRENCH' => $result['planning_record']['isp_b_distance_trench'] ?? '',
                                    'ISP B DISTANCE - 3RD PARTY DUCTS' => $result['planning_record']['isp_b_distance_3rd_party_ducts'] ?? '',
                                    'ISP B LA EXISTING DUCT' => $result['planning_record']['isp_b_la_existing_duct'] ?? '',
                                    'ISP B LA EXISTING NETWORK' => $result['planning_record']['isp_b_la_existing_network'] ?? '',
                                    'ISP B DISTANCE - FOCUS' => $result['planning_record']['isp_b_distance_focus'] ?? '',
                                    'ISP B in - Buildin Conduits' => $result['planning_record']['isp_b_in_buildin_conduits'] ?? '',
                                    'OSP ASB - TRENCH' => $result['build_record']['osp_asb_trench'] ?? '',
                                    'OSP ASB - 3RD PARTY DUCTS' => $result['build_record']['osp_asb_3rd_party_ducts'] ?? '',
                                    'OSP ASB - LA EXISTING DUCT' => $result['build_record']['osp_asb_la_existing_duct'] ?? '',
                                    'OSP ASB - EXISTING NETWORK' => $result['build_record']['osp_asb_existing_network'] ?? '',
                                    'OSP ASB - DISTANCE – FOCUS' => $result['build_record']['osp_asb_distance_focus'] ?? '',
                                    'OSP ASB – IN BUILDING CONDUITS' => $result['build_record']['osp_asb_in_building_conduits'] ?? '',
                                    'ISP A ASB - TRENCH' => $result['build_record']['isp_a_asb_trench'] ?? '',
                                    'ISP A ASB - 3RD PARTY DUCTS' => $result['build_record']['isp_a_asb_3rd_party_ducts'] ?? '',
                                    'ISP A ASB - LA EXISTING DUCT' => $result['build_record']['isp_a_asb_la_existing_duct'] ?? '',
                                    'ISP A ASB - EXISTING NETWORK' => $result['build_record']['isp_a_asb_existing_network'] ?? '',
                                    'ISP A ASB - DISTANCE – FOCUS' => $result['build_record']['isp_a_asb_distance_focus'] ?? '',
                                    'ISP A ASB - IN BUILDING CONDUITS' => $result['build_record']['isp_a_asb_in_building_conduits'] ?? '',
                                    'ISP B ASB - TRENCH' => $result['build_record']['isp_b_asb_trench'] ?? '',
                                    'ISP B ASB - 3RD PARTY DUCTS' => $result['build_record']['isp_b_asb_3rd_party_ducts'] ?? '',
                                    'ISP B ASB - LA EXISTING DUCT' => $result['build_record']['isp_b_asb_la_existing_duct'] ?? '',
                                    'ISP B ASB - EXISTING NETWORK' => $result['build_record']['isp_b_asb_existing_network'] ?? '',
                                    'ISP B ASB - DISTANCE – FOCUS' => $result['build_record']['isp_b_asb_distance_focus'] ?? '',
                                    'ISP B ASB - IN BUILDING CONDUITS' => $result['build_record']['isp_b_asb_in_building_conduits'] ?? '', 
                                    'QTY' => $result['qty'] ?? '', 
                                    'YEAR' =>  $result['year'] ?? '', 
                                    'SD STATUS' =>  $result['sd_status'] ?? '', 
                                    'WEEK' =>  $result['week'] ?? '', 
                                    'RESOURCES' => $result['resources'] ?? '',
                                    'COMMENTS' => $result['comments'] ?? ''
                                ];
                            
        }
       // print_r(count($all_report_lists));exit;
        return $all_report_lists;
    }
}
