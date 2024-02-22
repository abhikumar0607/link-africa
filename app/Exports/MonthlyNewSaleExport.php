<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\KamName;
use App\Models\SiteMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;



class MonthlyNewSaleExport implements FromCollection,WithHeadings,ShouldAutoSize,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function headings():array{
        return[
            'SERVICE ID', 
            'KAM NAME',
            'PROJECT STATUS',
            'PO MRC',
            'DATE NEW',
            'CTS DATE',              
        ];
    } 

    public function columnFormats(): array {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'F' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
			'D' => NumberFormat::FORMAT_NUMBER_00, 
        ];
    }    
    public function collection()
    {
        $currentYear = date('Y');
        //get kam name
        $values = ['CARLA THOMAS','THARICK JITHOO', 'THOBELANI NTULI','TERENCE KRISHNA','ZANDILE SIBIYA','ZANELE MASENYA'];
        $all_result =  SiteMasterFile::select('kam_name','service_id','date_new','po_mrc','project_status','cts_date')
                        ->whereIn('kam_name', $values)
                        ->whereYear('date_new',$currentYear)
                        ->orwhereIn('kam_name', $values)
                        ->whereYear('cts_date',$currentYear)
                        ->get()->toArray();

                       // echo "<pre>";print_r($all_result);exit;
         $report_lists = $this->get_all_report_list($all_result);
         return collect($report_lists);
    }

    public function get_all_report_list($all_result){
       
        
        $all_report_lists = [];
        foreach($all_result as $key => $result){

        $cts_date = "";
        if(isset($result['cts_date'])){
            $cts_date = Carbon::parse($result['cts_date'])->format('Y/m/d');
        }  

        $date_new = "";
        if(isset($result['date_new'])){
            $date_new = Carbon::parse($result['date_new'])->format('Y/m/d');
        }


        //set format
        if($cts_date){
            $cts_date = Date::dateTimeToExcel(Carbon::parse($cts_date));
        }

        if($date_new){
            $date_new = Date::dateTimeToExcel(Carbon::parse($date_new));
        }

        $new_po_mrc = 0;
        if(isset($result['po_mrc'])){
            $po_mrc = $result['po_mrc'];
            $r_po_mrc = str_replace("R","",$po_mrc);
            $new_po_mrc = str_replace(",","",$r_po_mrc);          
        }


        $all_report_lists[] = [
            'SERVICE ID' => $result['service_id'],
            'KAM NAME' => $result['kam_name'],
            'PROJECT STATUS' => $result['project_status'],
            'PO MRC' => (int)$new_po_mrc,
            'DATE NEW' => $date_new,
            'CTS DATE' => $cts_date,
        ];            
    }
        return $all_report_lists;

    }    
}
