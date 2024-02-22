<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;
use App\Models\PlanningMaterialOsp;

class ImportPlanningMaterialOsp implements ToModel, WithHeadingRow
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
        $osp_build_type = $row['osp_build_type'];
        
        //Insert query
        $insert = PlanningMaterialOsp::create([
                'service_id'  => $service_id,
                'circuit_id'  => $service_id,
                'stock_code'  => $stock_code,
                'quantity'  => $quantity,
                'osp_build_type'  => $osp_build_type,
                
        ]);

        return  $insert;
    }
}
