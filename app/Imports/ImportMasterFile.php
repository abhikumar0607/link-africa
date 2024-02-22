<?php

namespace App\Imports;

use App\Models\SiteMasterFile;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\HardwareSoftware;


use Carbon\Carbon;

class ImportMasterFile implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $totalUpdated = 0; // Initialize a variable to keep track of the total count of updated records
    
        foreach ($rows as $row) 
        {
            // Extract values from the row
            $service_id = $row['service_id'];
            $site_a = $row['site_a'];
            $site_b = $row['site_b'];
    
            // Perform validation if needed
    
            // Update records in the SiteMasterFile model based on service_id
            $updatedCount = SiteMasterFile::where('service_id', $service_id)->update([
                'site_a' => $site_a,
                'site_b' => $site_b,
            ]);
    
            // Increment the total count of updated records
            $totalUpdated += $updatedCount;
        }
    
        // Output the total count of updated records
        echo "Total records updated: " . $totalUpdated;
    }
    
}
