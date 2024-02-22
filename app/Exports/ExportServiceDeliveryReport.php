<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SiteMasterFile;
use Carbon\Carbon;

class ExportServiceDeliveryReport implements FromCollection,WithHeadings,ShouldAutoSize
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
            'CIRCUIT ID',
            'PROJECT STATUS',
            'PLANNING STATUS',
            'PERMISSION STATUS',
            'BUILD STATUS',
            'SERVICE DELIVERY STATUS',
            'ORDER TYPE',
            'METRO/AREA',
            'CLIENT NAME',
            'SITE A',
            'SITE B',
        ];
    } 
    public function collection()
    {
        $region = Auth::user()->regions;   
        $is_login_region = explode(",",$region);
        $allResults = SiteMasterFile::whereIn('region',$is_login_region)->whereNoTIn('project_status',['V) Pending CTS'])->orderby('id','DESC')->with('planning_record','permission_record','build_record')
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
                                'PERMISSION STATUS' => $result['permission_record']['permissions_status'],
                                'BUILD STATUS' => $result['build_record']['build_status'] ?? '',
                                'SERVICE DELIVERY STATUS' => $result['service_delivery_status'],
                                'ORDER TYPE' => $result['order_type'],
                                'METRO/AREA' => $result['metro_area'],
                                'CLIENT NAME' => $result['client_name'],
                                'SITE A' => $result['site_a'],
                                'SITE B' => $result['site_b'],
                            ];
        }
        return $all_report_lists;
    }
}
