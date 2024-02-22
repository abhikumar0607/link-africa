<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
//use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LayerReport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'CIRCUIT ID',
            'PROJECT STATUS',
            'PLANNING STATUS',
            'BUILD STATUS',
            'METRO/AREA',
            'CLIENT NAME',
            'DATENEW',
            'SITE A',
            'SITE B',
            'SERVICE TYPE',
            'ORDER REF NO',
            'Region',
            'CLIENT RING',
        ];
    }

    public function collection()
    {
        $allResults = SiteMasterFile::orderBy('id','DESC')->with('planning_record','build_record')->get()->toArray();
        $reports = $this->get_all_report_list($allResults);
        //echo "<pre>";print_r($allResults);exit; 
        return collect($reports); 
    }

    public function get_all_report_list($allResults){
       

        $all_report_lists = [];
        foreach($allResults as $key => $result ){

            $date_new = "";
            if(isset($result['date_new'])){
                $date_new = Carbon::parse($result['date_new'])->format('Y/m/d');
            }
            if($date_new){
                $date_new = Date::dateTimeToExcel(Carbon::parse($date_new));
            }

             //result
             $all_report_lists[] = [
                'CIRCUIT ID' => $result['circuit_id'],
                'PROJECT STATUS' => $result['project_status'],
                'PLANNING STATUS' => $result['planning_record']['planning_status'],
                'BUILD STATUS' => $result['build_record']['build_status'] ?? '',
                'METRO/AREA' => $result['metro_area'],
                'CLIENT NAME' => $result['client_name'],
                'DATENEW' => $date_new,
                'SITE A' => $result['site_a'],
                'SITE B' => $result['site_b'],
                'SERVICE TYPE' => $result['service_type'],
                'ORDER REF NO' => $result['order_ref_number'],
                'Region' => $result['region'],
                'CLIENT RING' => $result['client_ring'],
            ];
        }
        return $all_report_lists;
    }
}
