<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuildMasterFile;
use App\Models\SiteMasterFile;
use App\Models\KamName;
use Carbon\Carbon;
use DB;
class DurationController extends Controller
{
    public function monthlY_project_duration(Request $request){
    //check year
    $currentYear = date('Y');
    if($request->year == '2023'){
        $currentYear = '2023';
    } elseif($request->year == '2024'){
        $currentYear = date('Y');
    }
    $jan_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 1)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
    $count_jan_service_id = count($jan_project_duration);
    //project duration
    //check jan has data or not
    $jan_avg_of_project_duration = '0';
    if($jan_project_duration){
        foreach($jan_project_duration as $key => $result){
            //For Project Duration
            $project_duration = null;
            if($result['site_master_record']['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['toc_submitted']);
                    $date_new = Carbon::parse($result['site_master_record']['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $jan_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['site_master_record']['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                }
            }
            
        }

       // Variable to store the total duration
        $jan_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($jan_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $jan_total_Duration += $project['duration'];
            }
       }

       $count_jan_project_duration = count($jan_project_Durations);
      // average of project duration in jan
      $jan_avg_of_project_duration = round($jan_total_Duration/$count_jan_project_duration);
    }
        
    // feb start here
    $feb_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 2)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
    $count_feb_service_id = count($feb_project_duration);

    //check feb has data or not
    $feb_avg_of_project_duration = '0';
    if($feb_project_duration){
    //project duration
    foreach($feb_project_duration as $key => $result){
        //For Project Duration
        $project_duration = null;
        if($result['site_master_record']['project_status'] == "L) Cancelled"){
            $project_duration = 0;
        } else {
            if(isset($result['toc_submitted'])){
                $date_toc_submitted = Carbon::parse($result['toc_submitted']);
                $date_new = Carbon::parse($result['site_master_record']['date_new']);
                $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                $project_duration = $date_toc_submitted_diff+1;
                $feb_project_Durations[] = array("duration" => $project_duration);
            } else {

                $date_new = Carbon::parse($result['site_master_record']['date_new']);
                $date_new_diff = $new_current_date->diffInDays($date_new);
                $project_duration = $date_new_diff+1;
            }
        }
        
    }

   // Variable to store the total duration
    $feb_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($feb_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $feb_total_Duration += $project['duration'];
        }
   }

    $count_feb_project_duration = count($feb_project_Durations);
    // average of project duration in feb
    $feb_avg_of_project_duration = round($feb_total_Duration/$count_feb_project_duration);  
  }
  //feb code ends here

  //march start here
  $mar_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 3)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
  $count_mar_service_id = count($mar_project_duration);

  //check march has data or not
  $mar_avg_of_project_duration = '0';
  if($mar_project_duration){
  //project duration
  foreach($mar_project_duration as $key => $result){
      //For Project Duration
      $project_duration = null;
      if($result['site_master_record']['project_status'] == "L) Cancelled"){
          $project_duration = 0;
      } else {
          if(isset($result['toc_submitted'])){
              $date_toc_submitted = Carbon::parse($result['toc_submitted']);
              $date_new = Carbon::parse($result['site_master_record']['date_new']);
              $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
              $project_duration = $date_toc_submitted_diff+1;
              $mar_project_Durations[] = array("duration" => $project_duration);
          } else {

              $date_new = Carbon::parse($result['site_master_record']['date_new']);
              $date_new_diff = $new_current_date->diffInDays($date_new);
              $project_duration = $date_new_diff+1;
          }
      }
      
  }

 // Variable to store the total duration
  $mar_total_Duration = 0;

  // Loop through the array and sum up the durations
  foreach ($mar_project_Durations as $project) {
      // Check if 'duration' key exists in the sub-array
      if (isset($project['duration'])) {
          // Add the duration to the total
          $mar_total_Duration += $project['duration'];
      }
 }

    $count_mar_project_duration = count($mar_project_Durations);
    // average of project duration in mar
    $mar_avg_of_project_duration = round($mar_total_Duration/$count_mar_project_duration);
}
//march code end here
// april start here
$april_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 4)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_april_service_id = count($april_project_duration);

//check jan has data or not
$april_avg_of_project_duration = '0';
if($april_project_duration){
//project duration
foreach($april_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $april_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

// Variable to store the total duration
$april_total_Duration = 0;

// Loop through the array and sum up the durations
foreach ($april_project_Durations as $project) {
    // Check if 'duration' key exists in the sub-array
    if (isset($project['duration'])) {
        // Add the duration to the total
        $april_total_Duration += $project['duration'];
    }
}

    $count_april_project_duration = count($april_project_Durations);
    // average of project duration in april
    $april_avg_of_project_duration = round($april_total_Duration/$count_april_project_duration);
}
// april code ends here

//May code start here
$may_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 5)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_may_service_id = count($may_project_duration);

//check may has data or not
$may_avg_of_project_duration = '0';
if($may_project_duration){
//project duration
foreach($may_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $may_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

// Variable to store the total duration
$may_total_Duration = 0;

// Loop through the array and sum up the durations
foreach ($may_project_Durations as $project) {
    // Check if 'duration' key exists in the sub-array
    if (isset($project['duration'])) {
        // Add the duration to the total
        $may_total_Duration += $project['duration'];
    }
}

    $count_may_project_duration = count($may_project_Durations);
    // average of project duration in may
    $may_avg_of_project_duration = round($may_total_Duration/$count_may_project_duration);
}
// may code end here

// june start end here
$june_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 6)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_june_service_id = count($june_project_duration);

//check june has data or not
$june_avg_of_project_duration = '0';
if($june_project_duration){
//project duration
foreach($june_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $june_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

    // Variable to store the total duration
    $june_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($june_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $june_total_Duration += $project['duration'];
        }
    }

    $count_june_project_duration = count($june_project_Durations);
    // average of project duration in june
    $june_avg_of_project_duration = round($june_total_Duration/$count_june_project_duration);
}
// june code end here

//july code start here
$july_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 7)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_july_service_id = count($july_project_duration);

//check july has data or not
$july_avg_of_project_duration = '0';
if($july_project_duration){
//project duration
foreach($july_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $july_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

    // Variable to store the total duration
    $july_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($july_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $july_total_Duration += $project['duration'];
        }
    }

    $count_july_project_duration = count($july_project_Durations);
    // average of project duration in july
    $july_avg_of_project_duration = round($july_total_Duration/$count_july_project_duration);
}
//july code end here

//aug code start here
$aug_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 8)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_aug_service_id = count($aug_project_duration);

//check may has data or not
$aug_avg_of_project_duration = '0';
if($aug_project_duration){
//project duration
foreach($aug_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $aug_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

    // Variable to store the total duration
    $aug_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($aug_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $aug_total_Duration += $project['duration'];
        }
    }

    $count_aug_project_duration = count($aug_project_Durations);
    // average of project duration in aug
    $aug_avg_of_project_duration = round($aug_total_Duration/$count_aug_project_duration);
}
//aug code end here

//sep code start here
$sep_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 9)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_sep_service_id = count($sep_project_duration);

//check may has data or not
$sep_avg_of_project_duration = '0';
if($sep_project_duration){
//project duration
foreach($sep_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $sep_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

    // Variable to store the total duration
    $sep_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($sep_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $sep_total_Duration += $project['duration'];
        }
    }

    $count_sep_project_duration = count($sep_project_Durations);
    // average of project duration in sep
    $sep_avg_of_project_duration = round($sep_total_Duration/$count_sep_project_duration);
}
//sep code end here

//oct code start here
$oct_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 10)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_oct_service_id = count($oct_project_duration);

//check may has data or not
$oct_avg_of_project_duration = '0';
if($oct_project_duration){
//project duration
foreach($oct_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $oct_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

    // Variable to store the total duration
    $oct_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($oct_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $oct_total_Duration += $project['duration'];
        }
    }

    $count_oct_project_duration = count($oct_project_Durations);
    // average of project duration in oct
    $oct_avg_of_project_duration = round($oct_total_Duration/$count_oct_project_duration);
}
//oct code end here

//nov code start here
$nov_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 11)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_nov_service_id = count($nov_project_duration);

//check may has data or not
$nov_avg_of_project_duration = '0';
if($nov_project_duration){
//project duration
foreach($nov_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $nov_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

    // Variable to store the total duration
    $nov_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($nov_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $nov_total_Duration += $project['duration'];
        }
    }

    $count_nov_project_duration = count($nov_project_Durations);
    // average of project duration in nov
    $nov_avg_of_project_duration = round($nov_total_Duration/$count_nov_project_duration);
}
//nov code end here

//dec code start here
$dec_project_duration = BuildMasterFile::orderby('id','DESC')->whereYear('toc_submitted',$currentYear)->whereMonth('toc_submitted', 12)->whereNotNull('toc_submitted')->with('site_master_record')->get()->toArray();
$count_dec_service_id = count($dec_project_duration);

//check may has data or not
$dec_avg_of_project_duration = '0';
if($dec_project_duration){
//project duration
foreach($dec_project_duration as $key => $result){
    //For Project Duration
    $project_duration = null;
    if($result['site_master_record']['project_status'] == "L) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result['toc_submitted'])){
            $date_toc_submitted = Carbon::parse($result['toc_submitted']);
            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = $date_toc_submitted_diff+1;
            $dec_project_Durations[] = array("duration" => $project_duration);
        } else {

            $date_new = Carbon::parse($result['site_master_record']['date_new']);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = $date_new_diff+1;
        }
    }
    
}

    // Variable to store the total duration
    $dec_total_Duration = 0;

    // Loop through the array and sum up the durations
    foreach ($dec_project_Durations as $project) {
        // Check if 'duration' key exists in the sub-array
        if (isset($project['duration'])) {
            // Add the duration to the total
            $dec_total_Duration += $project['duration'];
        }
    }

    $count_dec_project_duration = count($dec_project_Durations);
    // average of project duration in dec
    $dec_avg_of_project_duration = round($dec_total_Duration/$count_dec_project_duration);
}
//dec code end here

$view =  view('admin/main-dashboard/monthly-duration-dashboard',compact('count_jan_service_id','jan_avg_of_project_duration','count_feb_service_id','feb_avg_of_project_duration',
    'mar_avg_of_project_duration','count_mar_service_id','april_avg_of_project_duration','count_april_service_id','may_avg_of_project_duration','count_may_service_id',
'june_avg_of_project_duration','count_june_service_id','july_avg_of_project_duration','count_july_service_id','aug_avg_of_project_duration','count_aug_service_id',
'sep_avg_of_project_duration','count_sep_service_id','oct_avg_of_project_duration','count_oct_service_id','nov_avg_of_project_duration','count_nov_service_id',
'dec_avg_of_project_duration','count_dec_service_id'));
        return $view;
    }

    public function project_status_duration(){
        $New_sale_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'A) New Sales')->with('build_record')->get()->toArray();
        //echo "<pre>";print_r($New_sale_project_duration);exit;
        $count_New_sale_service_id = count($New_sale_project_duration);
        //project duration
        foreach($New_sale_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $New_sale_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $New_sale_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $New_sale_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($New_sale_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $New_sale_total_Duration += $project['duration'];
            }
       }

       $count_New_sale_project_duration = count($New_sale_project_Durations);
      // average of project duration in jan
      $New_sale_avg_of_project_duration = round($New_sale_total_Duration/$count_New_sale_project_duration);
      //new sale ends here

      //new in planning code start
      $new_in_planning_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'B) New In-Planning')->with('build_record')->get()->toArray();
        //echo "<pre>";print_r($new_in_planning_project_duration);exit;
        $count_new_in_planning_service_id = count($new_in_planning_project_duration);
        //project duration
        foreach($new_in_planning_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $new_in_planning_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $new_in_planning_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $new_in_planning_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($new_in_planning_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $new_in_planning_total_Duration += $project['duration'];
            }
       }

       $count_new_in_planning_project_duration = count($new_in_planning_project_Durations);
      // average of project duration in jan
      $new_in_planning_avg_of_project_duration = round($new_in_planning_total_Duration/$count_new_in_planning_project_duration);
      // new in planning code end
     
      // in survey code start here
      $in_survey_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'C) In-Survey')->with('build_record')->get()->toArray();
        //echo "<pre>";print_r($in_survey_project_duration);exit;
        $count_in_survey_service_id = count($in_survey_project_duration);
        //project duration
        foreach($in_survey_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $in_survey_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $in_survey_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $in_survey_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($in_survey_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $in_survey_total_Duration += $project['duration'];
            }
       }

       $count_in_survey_project_duration = count($in_survey_project_Durations);
      // average of project duration in jan
      $in_survey_avg_of_project_duration = round($in_survey_total_Duration/$count_in_survey_project_duration);
      //in survey code ends here

      // in planning code start here
      $in_planning_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'D) In-Planning')->with('build_record')->get()->toArray();
        //echo "<pre>";print_r($in_planning_project_duration);exit;
        $count_in_planning_service_id = count($in_planning_project_duration);
        //project duration
        foreach($in_planning_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $in_planning_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $in_planning_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $in_planning_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($in_planning_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $in_planning_total_Duration += $project['duration'];
            }
       }

       $count_in_planning_project_duration = count($in_planning_project_Durations);
      // average of project duration in jan
      $in_planning_avg_of_project_duration = round($in_planning_total_Duration/$count_in_planning_project_duration);
      //in planning code ends here

      //land lord approval code start here
      $landlord_approval_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'E) Landlord-Approval')->with('build_record')->get()->toArray();
        $count_landlord_approval_service_id = count($landlord_approval_project_duration);
        //project duration
        foreach($landlord_approval_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $landlord_approval_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $landlord_approval_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $landlord_approval_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($landlord_approval_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $landlord_approval_total_Duration += $project['duration'];
            }
       }

       $count_landlord_approval_project_duration = count($landlord_approval_project_Durations);
      // average of project duration in jan
      $landlord_approval_avg_of_project_duration = round($landlord_approval_total_Duration/$count_landlord_approval_project_duration);
      // land lord approval code end here

      //permission code start 
      $permission_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'F) Permissions')->with('build_record')->get()->toArray();
        $count_permission_service_id = count($permission_project_duration);
        //project duration
        foreach($permission_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $permission_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $permission_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $permission_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($permission_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $permission_total_Duration += $project['duration'];
            }
       }

       $count_permission_project_duration = count($permission_project_Durations);
      // average of project duration in jan
      $permission_avg_of_project_duration = round($permission_total_Duration/$count_permission_project_duration);
      //permission code end

      //financial approval start here
      $financial_approval_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'H) Financial Approval')->with('build_record')->get()->toArray();
        $count_financial_approval_service_id = count($financial_approval_project_duration);
        //project duration
        foreach($financial_approval_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $financial_approval_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $financial_approval_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $financial_approval_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($financial_approval_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $financial_approval_total_Duration += $project['duration'];
            }
       }

       $count_financial_approval_project_duration = count($financial_approval_project_Durations);
      // average of project duration in jan
      $financial_approval_avg_of_project_duration = round($financial_approval_total_Duration/$count_financial_approval_project_duration);
      // financial approval ends here

     // New in build code start here
     $new_in_build_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'I) New In-Build')->with('build_record')->get()->toArray();
        $count_new_in_build_service_id = count($new_in_build_project_duration);
        //project duration
        foreach($new_in_build_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $new_in_build_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $new_in_build_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $new_in_build_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($new_in_build_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $new_in_build_total_Duration += $project['duration'];
            }
       }

       $count_new_in_build_project_duration = count($new_in_build_project_Durations);
      // average of project duration in jan
      $new_in_build_avg_of_project_duration = round($new_in_build_total_Duration/$count_new_in_build_project_duration);
      //new in build end here

      //in build code start here
      $in_build_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'J) In-Build')->with('build_record')->get()->toArray();
        $count_in_build_service_id = count($in_build_project_duration);
        //project duration
        foreach($in_build_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $in_build_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $in_build_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $in_build_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($in_build_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $in_build_total_Duration += $project['duration'];
            }
       }

       $count_in_build_project_duration = count($in_build_project_Durations);
      // average of project duration in jan
      $in_build_avg_of_project_duration = round($in_build_total_Duration/$count_in_build_project_duration);
      // in build code end here

      // toc p1 submitted l2 start here
      $toc_submitted_l2_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'K) TOC P1 Submitted-L2')->with('build_record')->get()->toArray();
        $count_toc_submitted_l2_service_id = count($toc_submitted_l2_project_duration);
        //project duration
        foreach($toc_submitted_l2_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $toc_submitted_l2_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $toc_submitted_l2_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $toc_submitted_l2_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($toc_submitted_l2_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $toc_submitted_l2_total_Duration += $project['duration'];
            }
       }

       $count_toc_submitted_l2_project_duration = count($toc_submitted_l2_project_Durations);
      // average of project duration in jan
      $toc_submitted_l2_avg_of_project_duration = round($toc_submitted_l2_total_Duration/$count_toc_submitted_l2_project_duration);
      // end here

      // on hold start here
      $on_hold_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'R) On-Hold')->with('build_record')->get()->toArray();
        $count_on_hold_service_id = count($on_hold_project_duration);
        //project duration

    //check on hold has data or not 
    $on_hold_avg_of_project_duration = '0';
    if($on_hold_project_duration){
        foreach($on_hold_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $date_new = Carbon::parse($result['date_new']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                    $project_duration = $date_toc_submitted_diff+1;
                    $on_hold_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $date_new = Carbon::parse($result['date_new']);
                    $date_new_diff = $new_current_date->diffInDays($date_new);
                    $project_duration = $date_new_diff+1;
                    $on_hold_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $on_hold_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($on_hold_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $on_hold_total_Duration += $project['duration'];
            }
       }

       $count_on_hold_project_duration = count($on_hold_project_Durations);
      // average of project duration in jan
      $on_hold_avg_of_project_duration = round($on_hold_total_Duration/$count_on_hold_project_duration);
    }
      // on hold ends here

      // Return to sale start here
      $return_to_sale_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'S) Return to Sales')->with('build_record')->get()->toArray();
      $count_return_to_sale_service_id = count($return_to_sale_project_duration);
      //project duration
      foreach($return_to_sale_project_duration as $key => $result){
          //For Project Duration
          $current_date =  Carbon::now()->format('Y-m-d');
          $new_current_date =  Carbon::now();
          $project_duration = null;
          if($result['project_status'] == "L) Cancelled"){
              $project_duration = 0;
          } else {
              if(isset($result['build_record']['toc_submitted'])){
                  $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                  $date_new = Carbon::parse($result['date_new']);
                  $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
                  $project_duration = $date_toc_submitted_diff+1;
                  $return_to_sale_project_Durations[] = array("duration" => $project_duration);
              } else {

                  $date_new = Carbon::parse($result['date_new']);
                  $date_new_diff = $new_current_date->diffInDays($date_new);
                  $project_duration = $date_new_diff+1;
                  $return_to_sale_project_Durations[] = array("duration" => $project_duration);
              }
          }
          
      }

     // Variable to store the total duration
      $return_to_sale_total_Duration = 0;

      // Loop through the array and sum up the durations
      foreach ($return_to_sale_project_Durations as $project) {
          // Check if 'duration' key exists in the sub-array
          if (isset($project['duration'])) {
              // Add the duration to the total
              $return_to_sale_total_Duration += $project['duration'];
          }
     }

     $count_return_to_sale_project_duration = count($return_to_sale_project_Durations);
    // average of project duration in jan
    $return_to_sale_avg_of_project_duration = round($return_to_sale_total_Duration/$count_return_to_sale_project_duration);
    // return to sale ends here

   // pending cts code start here
   $pending_cts_project_duration = SiteMasterFile::orderby('id','DESC')->where('project_status', 'V) Pending CTS')->with('build_record')->get()->toArray();
        $count_pending_cts_service_id = count($pending_cts_project_duration);
        //project duration
        foreach($pending_cts_project_duration as $key => $result){
            //For Project Duration
            $current_date =  Carbon::now()->format('Y-m-d');
            $new_current_date =  Carbon::now();
            $project_duration = null;
            if($result['project_status'] == "L) Cancelled"){
                $project_duration = 0;
            } else {
                if(isset($result['build_record']['toc_submitted'])){
                    $date_toc_submitted = Carbon::parse($result['build_record']['toc_submitted']);
                    $cts_date = Carbon::parse($result['cts_date']);
                    $date_toc_submitted_diff = $date_toc_submitted->diffInDays($cts_date);
                    $project_duration = $date_toc_submitted_diff+1;
                    $pending_cts_project_Durations[] = array("duration" => $project_duration);
                } else {

                    $cts_date = Carbon::parse($result['cts_date']);
                    $date_new_diff = $new_current_date->diffInDays($cts_date);
                    $project_duration = $date_new_diff+1;
                    $pending_cts_project_Durations[] = array("duration" => $project_duration);
                }
            }
            
        }

       // Variable to store the total duration
        $pending_cts_total_Duration = 0;

        // Loop through the array and sum up the durations
        foreach ($pending_cts_project_Durations as $project) {
            // Check if 'duration' key exists in the sub-array
            if (isset($project['duration'])) {
                // Add the duration to the total
                $pending_cts_total_Duration += $project['duration'];
            }
       }

       $count_pending_cts_project_duration = count($pending_cts_project_Durations);
      // average of project duration in jan
      $pending_cts_avg_of_project_duration = round($pending_cts_total_Duration/$count_pending_cts_project_duration);
      // end here 

$view =  view('admin/main-dashboard/status-project-duration',compact('New_sale_avg_of_project_duration','count_New_sale_service_id','new_in_planning_avg_of_project_duration',
'count_new_in_planning_service_id','in_survey_avg_of_project_duration','count_in_survey_service_id','in_planning_avg_of_project_duration','count_in_planning_service_id',
'landlord_approval_avg_of_project_duration','count_landlord_approval_service_id','permission_avg_of_project_duration','count_permission_service_id','financial_approval_avg_of_project_duration',
'count_financial_approval_service_id','new_in_build_avg_of_project_duration','count_new_in_build_service_id','in_build_avg_of_project_duration','count_in_build_service_id',
'toc_submitted_l2_avg_of_project_duration','count_toc_submitted_l2_service_id','on_hold_avg_of_project_duration','count_on_hold_service_id','return_to_sale_avg_of_project_duration',
'count_return_to_sale_service_id','pending_cts_avg_of_project_duration','count_pending_cts_service_id'));
        return $view;
    }
       // public function for get kam name accoding to months

          // public function for get kam name accoding to months
public function kam_months(Request $request){
    //check year
    $currentYear = date('Y');
    if($request->year == '2023'){
      $currentYear = '2023';
    } elseif($request->year == '2024'){
      $currentYear = date('Y');
    }
    //get kam name
    $values = ['CARLA THOMAS','THARICK JITHOO', 'THOBELANI NTULI','TERENCE KRISHNA','ZANDILE SIBIYA','ZANELE MASENYA'];
    $kam_name = KamName::whereIn('kam_name',$values)->get();
  
  
      $all_kam_name_records = [];
      foreach($kam_name as $name){
          //get all mrc according to kam name
          $site_masters_po_mrc = SiteMasterFile::select('kam_name','service_id','date_new','po_mrc','cts_date')
                                                          ->where('kam_name', $name->kam_name)
                                                          ->whereYear('date_new',$currentYear)                                                      
                                                          ->orwhere('kam_name', $name->kam_name)
                                                          ->whereYear('cts_date',$currentYear)
                                                          ->get()->toArray();
                                                          //echo "<pre>";print_r($site_masters_po_mrc);exit;
                                                         
                                                          
          //Month Array according to kam name
          $jan_data = ['po_mrc' => 0];
          $feb_data = ['po_mrc' => 0];
          $march_data = ['po_mrc' => 0];
          $april_data = ['po_mrc' => 0];
          $may_data = ['po_mrc' => 0];
          $june_data = ['po_mrc' => 0];
          $july_data = ['po_mrc' => 0];
          $aug_data = ['po_mrc' => 0];
          $sep_data = ['po_mrc' => 0];
          $oct_data = ['po_mrc' => 0];
          $nov_data = ['po_mrc' => 0];
          $dec_data = ['po_mrc' => 0];
  
          $site_master_jan_po_mrc_data = 0;
          $site_master_feb_po_mrc_data = 0;
          $site_master_march_po_mrc_data = 0;
          $site_master_april_po_mrc_data = 0;
          $site_master_may_po_mrc_data = 0;
          $site_master_june_po_mrc_data = 0;
          $site_master_july_po_mrc_data = 0;
          $site_master_aug_po_mrc_data = 0;
          $site_master_sep_po_mrc_data = 0;
          $site_master_oct_po_mrc_data = 0;
          $site_master_nov_po_mrc_data = 0;
          $site_master_dec_po_mrc_data = 0;
  
          // total count
          $total_count = [];
          $jan_count = 0;
          $feb_count = 0;
          $march_count = 0;
          $april_count = 0;
          $may_count = 0;
          $june_count = 0;
          $july_count = 0;
          $aug_count = 0;
          $sep_count = 0;
          $oct_count = 0;
          $nov_count = 0;
          $dec_count = 0;
          foreach($site_masters_po_mrc as $site_master_po_mrc){
              //Check if jan monnth po mrc
 
              if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){

                if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                    $get_jan_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                    $get_jan_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                }
              } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                $get_jan_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
              } else {
                $get_jan_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
              }

              $jan_month = "01";


              if($get_jan_month == $jan_month){
                  $po_mrc_north = $site_master_po_mrc['po_mrc'];
                  $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                  $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                  $site_master_jan_po_mrc_data += (int)$new_po_mrc_north;
                  $jan_count++;
              }  
              //echo "<pre>"; print_r($site_master_jan_po_mrc_data);exit;
               //Check if feb monnth po mrc
               if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){

                if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                    $get_feb_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                    $get_feb_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                }
              } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                $get_feb_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
              } else {
                $get_feb_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
              }

              $feb_month = "02";

              if($get_feb_month == $feb_month){
                  $po_mrc_north = $site_master_po_mrc['po_mrc'];
                  $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                  $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                  $site_master_feb_po_mrc_data += (int)$new_po_mrc_north;
                  $feb_count++;
              } 
  
                  //Check if march monnth po mrc
                  if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
    
                    if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                        $get_march_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                    } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                        $get_march_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                  } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                    $get_march_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                  } else {
                    $get_march_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                  }
                
                  $march_month =  "03";
                  if($get_march_month == $march_month){
                      $po_mrc_north = $site_master_po_mrc['po_mrc'];
                      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                      $site_master_march_po_mrc_data += (int)$new_po_mrc_north;
                      $march_count++;
                  }
  
                //Check if april monnth po mrc
                if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
    
                    if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                        $get_april_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                    } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                        $get_april_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                  } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                    $get_april_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                  } else {
                    $get_april_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                }
                 
                $april_month = "04";
                  
                  if($get_april_month == $april_month){
                      $po_mrc_north = $site_master_po_mrc['po_mrc'];
                      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                      $site_master_april_po_mrc_data += (int)$new_po_mrc_north;
                      $april_count++;
                  }
  
                     //Check if may monnth po mrc
                     if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
        
                        if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                            $get_may_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                        } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                            $get_may_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                        }
                      } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                        $get_may_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                      } else {
                        $get_may_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }

                  $may_month = "05";             

                  if($get_may_month == $may_month){
                      $po_mrc_north = $site_master_po_mrc['po_mrc'];
                      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                      $site_master_may_po_mrc_data += (int)$new_po_mrc_north;
                      $may_count++;
                  }
  
                //Check if june monnth po mrc
                if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
    
                    if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                        $get_june_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                    } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                        $get_june_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                  } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                    $get_june_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                  } else {
                    $get_june_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                }

                  $june_month =  "06";
                  if($get_june_month == $june_month){
                      $po_mrc_north = $site_master_po_mrc['po_mrc'];
                      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                      $site_master_june_po_mrc_data += (int)$new_po_mrc_north;
                      $june_count++;
                  }
  
                   //Check if july monnth po mrc
                if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
    
                    if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                        $get_july_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                    } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                        $get_july_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                  } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                    $get_july_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                  } else {
                    $get_july_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                }
                  $july_month =  "07";

                  if($get_july_month  == $july_month){
                      $po_mrc_north = $site_master_po_mrc['po_mrc'];
                      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                      $site_master_july_po_mrc_data += (int)$new_po_mrc_north;
                      $july_count++;
                  }
  
                    //Check if aug monnth po mrc
                    if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
        
                        if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                            $get_aug_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                        } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                            $get_aug_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                        }
                      } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                        $get_aug_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                      } else {
                        $get_aug_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                 
                    $aug_month =  "08";

                    if($get_aug_month == $aug_month){
                        $po_mrc_north = $site_master_po_mrc['po_mrc'];
                        $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                        $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                        $site_master_aug_po_mrc_data += (int)$new_po_mrc_north;
                        $aug_count++;
                    }

                    //Check if sep monnth po mrc
                    if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
        
                        if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                            $get_sep_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                        } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                            $get_sep_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                        }
                      } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                        $get_sep_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                      } else {
                        $get_sep_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                    $sep_month =  "09";

                    if($get_sep_month == $sep_month){
                        $po_mrc_north = $site_master_po_mrc['po_mrc'];
                        $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                        $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                        $site_master_sep_po_mrc_data += (int)$new_po_mrc_north;
                        $sep_count++;
                    }

                     //Check if oct monnth po mrc
                     if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
        
                        if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                            $get_oct_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                        } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                            $get_oct_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                        }
                      } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                        $get_oct_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                      } else {
                        $get_oct_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                     $oct_month = "10";
                     //$oct_month_cts_date = "10";
                     if($get_oct_month == $oct_month){
                         $po_mrc_north = $site_master_po_mrc['po_mrc'];
                         $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                         $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                         $site_master_oct_po_mrc_data += (int)$new_po_mrc_north;
                         $oct_count++;
                     }

                      //Check if nov monnth po mrc
                      if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
        
                        if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                            $get_nov_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                        } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                            $get_nov_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                        }
                      } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                        $get_nov_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                      } else {
                        $get_nov_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                     $nov_month = "11";
                     //$nov_month_cts_date = "10";
                     if($get_nov_month == $nov_month){
                         $po_mrc_north = $site_master_po_mrc['po_mrc'];
                         $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                         $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                         $site_master_nov_po_mrc_data += (int)$new_po_mrc_north;
                         $nov_count++;
                     }

                      //Check if dec monnth po mrc
                      if(!empty($site_master_po_mrc['date_new']) AND !empty($site_master_po_mrc['cts_date'])){
        
                        if(Carbon::parse($site_master_po_mrc['date_new'])->format('Y') == $currentYear){
                            $get_dec_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                        } elseif(Carbon::parse($site_master_po_mrc['cts_date'])->format('Y') == $currentYear){
                            $get_dec_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                        }
                      } elseif(!empty($site_master_po_mrc['date_new']) AND empty($site_master_po_mrc['cts_date'])){
                        $get_dec_month = Carbon::parse($site_master_po_mrc['date_new'])->format('m');
                      } else {
                        $get_dec_month = Carbon::parse($site_master_po_mrc['cts_date'])->format('m');
                    }
                     $dec_month = "12";
                     //$dec_month_cts_date = "10";
                     if($get_dec_month == $dec_month){
                         $po_mrc_north = $site_master_po_mrc['po_mrc'];
                         $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                         $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                         $site_master_dec_po_mrc_data += (int)$new_po_mrc_north;
                         $dec_count++;
                     }
  
          }
  
              $jan_data = ['po_mrc' => $site_master_jan_po_mrc_data, 'jan_count' => $jan_count];
              $feb_data = ['po_mrc' => $site_master_feb_po_mrc_data, 'feb_count' => $feb_count];
              $march_data = ['po_mrc' => $site_master_march_po_mrc_data, 'march_count' => $march_count];
              $april_data = ['po_mrc' => $site_master_april_po_mrc_data, 'april_count' => $april_count];
              $may_data = ['po_mrc' => $site_master_may_po_mrc_data, 'may_count' =>$may_count];
              $june_data = ['po_mrc' => $site_master_june_po_mrc_data,'june_count' => $june_count];
              $july_data = ['po_mrc' => $site_master_july_po_mrc_data, 'july_count' => $july_count];
              $aug_data = ['po_mrc' => $site_master_aug_po_mrc_data, 'aug_count' => $aug_count];
              $sep_data = ['po_mrc' => $site_master_sep_po_mrc_data, 'sep_count' => $sep_count];
              $oct_data = ['po_mrc' => $site_master_oct_po_mrc_data, 'oct_count' => $oct_count];
              $nov_data = ['po_mrc' => $site_master_nov_po_mrc_data, 'nov_count' => $nov_count];
              $dec_data = ['po_mrc' => $site_master_dec_po_mrc_data, 'dec_count' => $dec_count];
              //Final kam name array records
              $all_kam_name_records[] = ['kam_name' => $name->kam_name,'jan_data' => $jan_data,'feb_data' => $feb_data,'march_data' => $march_data,
              'april_data' =>$april_data,'may_data' => $may_data,'june_data' => $june_data,'july_data' => $july_data,'aug_data' => $aug_data,'sep_data' => $sep_data,
              'oct_data' => $oct_data,'nov_data' => $nov_data,'dec_data' => $dec_data] ;
      
          }
          //echo "<pre>";print_r($jan_data);exit;
          $view =  view('admin/main-dashboard/kam-name-dashboard', compact('all_kam_name_records'));
          return $view;
      }
}
