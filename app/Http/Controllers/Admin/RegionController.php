<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ImportRegion;

class RegionController extends Controller
{
    //function for get province record
   public function fetch_province_record(Request $request){
     //Get Request
    $region_name = $request->region_name; 
    $records = ImportRegion::groupBy('province')->where('region', $region_name)->get()->toArray();
    //echo "<pre>"; print_r($records); echo "</pre>";exit;
    echo '<option value="">Please select</option>';
   foreach($records as $record){ ?>
    <option value="<?php echo $record['province']?>"><?php echo $record['province']?></option>
   <?php }
   }

      //function for get metro area record
      public function fetch_metro_record(Request $request){
        //Get Request
       $province = $request->province; 
       $records = ImportRegion::where('province', $province)->get()->toArray();
       //echo "<pre>"; print_r($records); echo "</pre>";exit;
      echo '<option value="">Please select</option>';
      foreach($records as $record){ ?>
       <option value="<?php echo $record['munic_name']?>"><?php echo $record['munic_name']?></option>
      <?php }
      }
}
