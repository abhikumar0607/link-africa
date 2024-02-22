<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\SiteMasterFile;


use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ExportMrcReport implements FromCollection,WithHeadings,WithColumnFormatting,ShouldAutoSize
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
            'PO MRC',
            'PO NRC',
            'Special Build NRC'
        ];
    }

    public function columnFormats(): array {
        return [	
			'G' => NumberFormat::FORMAT_NUMBER_00,
			'H' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    public function collection()
    {
        $allResults = SiteMasterFile::orderBy('id','DESC')->get()->toArray();
        $report_lists = $this->get_all_report_list($allResults);
        return collect($report_lists);
    }

    public function get_all_report_list($allResults){
        
        //Set All records
        $all_report_lists = [];
        foreach($allResults as $key => $result){
           // print_r($result);exit;
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

              $all_report_lists[] = [
                                    'SERVICE ID' => $result['service_id'],
                                    'CLIENT NAME' => $result['client_name'],
                                    'SITE A' => $result['site_a'],
                                    'SITE B' => $result['site_b'],
                                    'Region' => $result['region'],
                                    'Project Type' => $result['type'],
                                    'PO MRC' => (int)$new_po_mrc,
                                    'PO NRC' => (int)$new_po_nrc,
                                    'Special Build NRC' => $new_special_build_nrc,
              ];
        }
        return $all_report_lists;
    }
}
