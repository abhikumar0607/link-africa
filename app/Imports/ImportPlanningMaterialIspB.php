<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;
use App\Models\PlanningMaterialIspB;

class ImportPlanningMaterialIspB implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $service_id = $row['service_id'];
        $circuit_id = $row['circuit_id'];
        $stock_code = $row['stock_code'];
        $quantity = $row['quantity'];
        $isp_b_build_type = $row['isp_b_build_type'];
        
        //Insert query
        $insert = PlanningMaterialIspB::create([
                'service_id'  => $service_id,
                'circuit_id'  => $service_id,
                'stock_code'  => $stock_code,
                'quantity'  => $quantity,
                'isp_b_build_type'  => $isp_b_build_type,
                
        ]);

        return  $insert;
    }
}
