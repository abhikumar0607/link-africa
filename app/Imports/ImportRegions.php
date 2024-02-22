<?php

namespace App\Imports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\ImportRegion;

class ImportRegions implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
       //print_r($row);exit;
            $province = $row['province'];
            $region = $row['region'];
            $province_code = $row['province_code'];
            $munic_name = $row['munic_name'];
            $namecode = $row['namecode'];
            $map_title = $row['map_title'];
            $district = $row['district'];
            $district_n = $row['district_n'];

            $insert_master_file_record = ImportRegion::create([
                'province'  => $province,
                'region'  => $region,
                'province_code'  => $province_code,
                'munic_name'  => $munic_name,
                'namecode'  => $namecode,
                'map_title'  => $map_title,
                'district'  => $district,
                'district_n'  => $district_n,
            ]);  
             //check if record in inserted or not
         
            //echo $province;exit;
            return  $insert_master_file_record;

    }
        
    }

