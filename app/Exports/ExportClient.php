<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\Admin\BuildMasterFileController;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportClient implements FromCollection,WithHeadings,ShouldAutoSize,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'SERVICE ID',
            'PROJECT STATUS',
            'CLIENT NAME',
            'SITE A',
            'SITE B',
            'PROVINCE',
            'SERVICE TYPE',
            'DATE NEW',
            'DATE SITE SURVEY',
            'DATE SUBMITTED FOR LANDLORD',
            'DATE LANDLORD APPROVAL RECEIVED',
            'EST.COMPLETION DATE',
            'PLANNED BUILD COMPLETION DATE',
            'SERVICE DELIVERY COMMENTS',
            'RESPONSIBLE',
            'COMMENT',
        ];
    }

    public function columnFormats(): array {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'J' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }


    public function collection()
    {
        $client_name = Auth::user()->client_name; 
        $allResults = SiteMasterFile::orderBy('id','DESC')->where('client_name', $client_name)->whereNotIn('project_status', ['Q) Cancelled','T) Complete','U) Terminated'])->with('planning_record','permission_record','build_record','landlord_record','site_survey_record')->get()->toArray();
        $reports = $this->get_all_report_list($allResults);
        //echo "<pre>";print_r($allResults);exit; 
        return collect($reports); 
    }

    //selected result
    public function get_all_report_list($allResults){
       

        $all_report_lists = [];
        foreach($allResults as $key => $result ){

            $date_new = "";
            if(isset($result['date_new'])){
                $date_new = Carbon::parse($result['date_new'])->format('Y/m/d');
            }
    
            $date_site_survey = "";
            if(isset($result['site_survey_record']['date_site_survey'])){
                $date_site_survey = Carbon::parse($result['site_survey_record']['date_site_survey'])->format('Y/m/d');
            }
    
            $date_submit_for_landlord = "";
            if(isset($result['landlord_record']['date_submit_for_landlord'])){
                $date_submit_for_landlord = Carbon::parse($result['landlord_record']['date_submit_for_landlord'])->format('Y/m/d');
            }
    
            $date_landlord_approval = "";
            if(isset($result['landlord_record']['date_landlord_approval'])){
                $date_landlord_approval = Carbon::parse($result['landlord_record']['date_landlord_approval'])->format('Y/m/d');
            }
    
            $planned_build_completion_date = "";
            if(isset($result['build_record']['planned_build_completion_date'])){
                $planned_build_completion_date = Carbon::parse($result['build_record']['planned_build_completion_date'])->format('Y/m/d');
            }

            $project_type = $result['type'];
            $BuildMasterFileController = new BuildMasterFileController();
            $planned_start_date = $BuildMasterFileController->change_planned_start_date($result['planning_record']['revised_planned_wp2_date'],$result['planning_record']['planned_wp2_released_date']);
            $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);

            if($date_new){
                $date_new = Date::dateTimeToExcel(Carbon::parse($date_new));
            }
            if($date_site_survey){
                $date_site_survey = Date::dateTimeToExcel(Carbon::parse($date_site_survey));
            }
            if($date_submit_for_landlord){
                $date_submit_for_landlord = Date::dateTimeToExcel(Carbon::parse($date_submit_for_landlord));
            }
            if($date_landlord_approval){
                $date_landlord_approval = Date::dateTimeToExcel(Carbon::parse($date_landlord_approval));
            }
            if($planned_build_completion_date){
                $planned_build_completion_date = Date::dateTimeToExcel(Carbon::parse($planned_build_completion_date));
            }
            if($est_complition_date){
                $est_complition_date = Date::dateTimeToExcel(Carbon::parse($est_complition_date));
            }
            //result
            $all_report_lists[] = [
                'service_id' => $result['service_id'],
                'PROJECT STATUS' => $result['project_status'],
                'CLIENT NAME' => $result['client_name'],
                'SITE A' => $result['site_a'],
                'SITE B' => $result['site_b'],
                'PROVINCE' => $result['province'],
                'SERVICE TYPE' => $result['service_type'],
                'DATE NEW' => $date_new,
                'DATE SITE SURVEY' => $date_site_survey,
                'DATE SUBMITTED FOR LANDLORD' => $date_submit_for_landlord,
                'DATE LANDLORD APPROVAL RECEIVED' => $date_landlord_approval,
                'EST.COMPLETION DATE' => $est_complition_date,
                'PLANNED BUILD COMPLETION DATE' => $planned_build_completion_date,
                'SERVICE DELIVERY COMMENTS' => $result['service_delivery_comments'],
                'RESPONSIBLE' => '',
                'COMMENT' => $result['comments'],
            ];
        }
        return $all_report_lists;

    }
}
