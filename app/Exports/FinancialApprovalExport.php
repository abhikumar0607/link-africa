<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\SiteMasterFile;
use Illuminate\Support\Facades\Auth;

class FinancialApprovalExport implements FromCollection,WithHeadings
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
        $request = $this->request;
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $allResults = SiteMasterFile::whereIn('region',$is_login_region)->whereNotIn('project_status',['V) Pending CTS'])->orderBy('id','DESC')->with(['build_record','planning_record'  => function ($query) {
            $query->where('planning_status', '=', 'H) Financial Approval Requested');
        }])
        ->whereHas('planning_record', function ($query) {
            $query->where('planning_status', '=', 'H) Financial Approval Requested');
        })
        ->get()->toArray();
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
                'PROJECT STATUS' => $result['project_status'],
                'PLANNING STATUS' => $result['planning_record']['planning_status'],
                'BUILD STATUS' => $result['build_record']['build_status'],
                'METRO/AREA' => $result['metro_area'],
                'CLIENT NAME' => $result['client_name'],
                'DATENEW' => $result['date_new'],
                'SITE A' => (int)$result['site_a'],
                'SITE B' => (int)$result['site_b'],
                'SERVICE TYPE' => $result['service_type'],
                'ORDER REF NO' => $result['order_ref_number'],
                'Region' => $result['region'],
            ];
        }
        return $all_report_lists;
    }
}
