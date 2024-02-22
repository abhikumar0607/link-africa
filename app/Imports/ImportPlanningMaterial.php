<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;
use App\Models\PlanningMaterial;

class ImportPlanningMaterial implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $stock_code = $row['stock_code'];
        $description = $row['description'];
        $unit_measurement = $row['unit_measurement'];
        $list_price = $row['list_price'];
        $stock_code_description = $row['stock_code_description'];
        $catergory = $row['catergory'];
        
        //Insert query
        $insert = PlanningMaterial::create([
                'stock_code'  => $stock_code,
                'description'  => $description,
                'unit_measurement'  => $unit_measurement,
                'list_price'  => $list_price,
                'stock_code_description'  => $stock_code_description,
                'catergory'  => $catergory,
                
        ]);

        return  $insert;
    }
}
