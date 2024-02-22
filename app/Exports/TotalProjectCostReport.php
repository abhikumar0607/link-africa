<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\PlanningMasterFile;
use Illuminate\Support\Facades\Auth;

class TotalProjectCostReport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $request;

    public function __construct($request){
        $this->request = $request;
    }

    public function headings():array{
        return[
            'Circuit ID', 
            'PROJECT STATUS',
            'CLIENT NAME',
            'SITE A',
            'SITE B',
            'MATERIAL COST',
            'LABOUR COST',
            'COST PER METER',
            'PO NRC',
            'PO MRC',
        ];
    } 

    public function collection()
    {
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $allResults = PlanningMasterFile::whereIn('region',$is_login_region)->whereNoTIn('planning_status',['Pending CTS'])->orderBy('id', 'DESC')->with('permission_record','site_master_record','build_record')->get()->toArray();
        //Call Commomn function
        $report_lists = $this->get_all_report_list($allResults);
        return collect($report_lists);
    }

    public function get_all_report_list($allResults){
        $all_report_lists = [];
        //Set All records
        foreach($allResults as $key => $result){

              //Set all array
              $all_report_lists[] = [
                'CIRCUIT ID' => $result['circuit_id'],
                'PROJECT STATUS' => $result['site_master_record']['project_status'],
                'CLIENT NAME' => $result['site_master_record']['client_name'],
                'SITE A' => $result['site_master_record']['site_a'],
                'SITE B' => $result['site_master_record']['site_b'],
                'MATERIAL COST' => '',
                'LABOUR COST' => '',
                'COST PER METER' => '',
                'PO NRC' => $result['site_master_record']['po_nrc'],
                'PO MRC' => $result['site_master_record']['po_mrc'],
            ];
        }
        return $all_report_lists;
    }
}
