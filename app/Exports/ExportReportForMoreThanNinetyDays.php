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
class ExportReportForMoreThanNinetyDays implements FromCollection,WithHeadings,WithColumnFormatting,ShouldAutoSize
{
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
            'Project Ageing',
        ];
    }

    public function columnFormats(): array {
        return [
            'G' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }


    public function collection()
    {
        $current_date =  Carbon::now()->format('Y-m-d');
        $nintyeen_sub_days = Carbon::now()->subDays(90)->endOfDay()->format('Y-m-d'); 
        $allResults = SiteMasterFile::where('date_new', '>', $nintyeen_sub_days)->get()->toArray();
        $report_lists = $this->get_all_report_list($allResults);
        return collect($report_lists);
    }

    public function get_all_report_list($allResults){
        
       
        $new_current_date =  Carbon::now();
        //Set All records
        $all_report_lists = [];
        foreach($allResults as $key => $result){
           // print_r($result);exit;
                            
            $project_duration = "";
            if($result['project_status'] == "Q.Cancelled"){
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

              $all_report_lists[] = [
                                    'SERVICE ID' => $result['service_id'],
                                    'CLIENT NAME' => $result['client_name'],
                                    'SITE A' => $result['site_a'],
                                    'SITE B' => $result['site_b'],
                                    'Region' => $result['region'],
                                    'Project Type' => $result['type'],                               
                                    'Project Ageing' => $ageing,
              ];
        }
        return $all_report_lists;
    }
}
