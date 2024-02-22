<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteMasterFile;
use App\Models\BuildMasterFile;
use App\Models\User;
use Carbon\Carbon; 
use DB;


class DashboardController extends Controller
{
    //function for admin dashboartd
    public function index(){
        $view =  view('admin.dashboard');
        return $view;
    }
    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function logout(Request $request)
    {
        $user = Auth::user();
        //Update Online Status 
        $update = User::where('id', $user->id)->update(['online_status' => 0]); 
		if ($user->user_type == "Super_Admin") {
		    $request->session()->flush();
        	$request->session()->regenerate();
        	return redirect('/admin-login');
		} elseif($user->user_type == "Admin") {
		    $request->session()->flush();
        	$request->session()->regenerate();
        	return redirect('//admin-login');
		}  elseif($user->user_type == "Customer") {
		    $request->session()->flush();
        	$request->session()->regenerate();
        	return redirect('/login');
		} 
    }

//function for main dashboard
public function main_dashboard(){

//sum of mrc for new sale and north region
$new_sale_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'A) New Sales')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

                              
$count_mrc_new_sale_north_region = count($new_sale_northen_region);

$north_region_final_total = 0;
foreach($new_sale_northen_region as $north_region_mrc){
     $service_id = $north_region_mrc->service_id;
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_final_total += (int)$new_po_mrc_north;   
 }
//echo "<pre>";print_r($service_id);exit;
   //sum of mrc for new sale and Western Region 
 $new_sale_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'A) New Sales')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_new_sale_western_region = count($new_sale_western_region);
 $western_region_final_total = 0;
  foreach($new_sale_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $new_sale_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'A) New Sales')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_new_sale_eastern_region = count($new_sale_eastern_region);
 $eastern_region_final_total = 0;
  foreach($new_sale_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eastern_region_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $new_sale_total_sum_of_po_mrc = $north_region_final_total + $western_region_final_total + $eastern_region_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $new_sale_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'A) New Sales')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_new_sale_eastern_region = count($new_sale_nrc_eastern_region);
 $eastern_region_nrc_final_total = 0;
  foreach($new_sale_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eastern_region_nrc_final_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $new_sale_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'A) New Sales')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_new_sale_northern_region = count($new_sale_nrc_northern_region);
 $northern_region_nrc_final_total = 0;
   foreach($new_sale_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $northern_region_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $new_sale_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'A) New Sales')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_new_sale_western_region = count($new_sale_nrc_western_region);
 $western_region_nrc_final_total = 0;
  foreach($new_sale_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_nrc_final_total += (int)$new_po_nrc_western;
 }


  //count mrc and nrc record
  $count_sale_record[] = array($count_mrc_new_sale_north_region,$count_mrc_new_sale_western_region,$count_mrc_new_sale_eastern_region,$count_nrc_new_sale_northern_region,$count_nrc_new_sale_western_region,$count_nrc_new_sale_eastern_region);
  //echo "<pre>";print_r($count_sale_record);exit;
  // sum of nrc for eastern region,western region and northen region
  $new_sale_total_sum_of_po_nrc = $western_region_nrc_final_total + $northern_region_nrc_final_total + $eastern_region_nrc_final_total;

  $new_sale_record[] = array($north_region_final_total,$western_region_final_total,$eastern_region_final_total,$new_sale_total_sum_of_po_mrc,$eastern_region_nrc_final_total,$northern_region_nrc_final_total,$western_region_nrc_final_total,$new_sale_total_sum_of_po_nrc);
//new sale code end

// Get po mrc and nrc according to B) NEW IN-PLANNING 
//sum of mrc for B) NEW IN-PLANNING and north region
//sum of mrc for new sale and north region
$new_in_planning_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'B) New In-Planning')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_new_in_planning_north_region = count($new_in_planning_northen_region);
//echo $count;exit;
$count_mrc_new_in_planning_northen_region = count($new_in_planning_northen_region);
$north_region_new_in_planning_final_total = 0;
foreach($new_in_planning_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_new_in_planning_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_new_in_planning_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $new_in_planning_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'B) New In-Planning')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_new_in_planning_western_region = count($new_in_planning_western_region);
 $western_region_new_in_planning_final_total = 0;
  foreach($new_in_planning_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_new_in_planning_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $new_in_planning_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'B) New In-Planning')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_new_in_planning_eastern_region = count($new_in_planning_eastern_region);
 $eeastern_region_new_in_planning_final_total = 0;
  foreach($new_in_planning_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_new_in_planning_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $new_in_planning_total_sum_of_po_mrc = $north_region_new_in_planning_final_total + $western_region_new_in_planning_final_total + $eeastern_region_new_in_planning_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $new_in_planning_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'B) New In-Planning')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_new_in_planning_eastern_region = count($new_in_planning_nrc_eastern_region);
 $eeastern_region_new_in_planning_final_nrc_total = 0;
  foreach($new_in_planning_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_new_in_planning_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $new_in_planning_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'B) New In-Planning')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_new_in_planning_northen_region = count($new_in_planning_nrc_northern_region);
 $north_region_new_in_planning_nrc_final_total = 0;
   foreach($new_in_planning_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_new_in_planning_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $new_in_planning_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'B) New In-Planning')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_new_in_planning_western_region = count($new_in_planning_nrc_western_region);
 $western_region_new_in_planning_final_nrc_total = 0;
  foreach($new_in_planning_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_new_in_planning_final_nrc_total += (int)$new_po_nrc_western;
 }


 //count mrc and nrc record
$count_new_in_planning[] = array($count_mrc_new_in_planning_northen_region,$count_mrc_new_in_planning_western_region,$count_mrc_new_in_planning_eastern_region,$count_nrc_new_in_planning_northen_region,$count_nrc_new_in_planning_western_region,$count_nrc_new_in_planning_eastern_region);

// sum of nrc for eastern region,western region and northen region
$new_in_planning_total_sum_of_po_nrc = $eeastern_region_new_in_planning_final_nrc_total + $north_region_new_in_planning_nrc_final_total + $western_region_new_in_planning_final_nrc_total;

$new_in_planning_record[] = array("easterRegionmrc" => $eeastern_region_new_in_planning_final_total,"northregionmrc" => $north_region_new_in_planning_final_total,"westernregionmrc" => $western_region_new_in_planning_final_total,"mrctotal" =>$new_in_planning_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_new_in_planning_final_nrc_total,"northregionrc" =>$north_region_new_in_planning_nrc_final_total,"westernregionnrc" =>$western_region_new_in_planning_final_nrc_total,"nrctotal" =>$new_in_planning_total_sum_of_po_nrc); 
//new in planning ends here

//in survey starts here

$In_Survey_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'C) In-Survey')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_In_Survey_north_region = count($In_Survey_northen_region);
//echo $count;exit;
$count_mrc_In_Survey_northen_region = count($In_Survey_northen_region);
$north_region_In_Survey_final_total = 0;
foreach($In_Survey_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_In_Survey_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_In_Survey_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $In_Survey_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'C) In-Survey')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_In_Survey_western_region = count($In_Survey_western_region);
 $western_region_In_Survey_final_total = 0;
  foreach($In_Survey_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_In_Survey_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $In_Survey_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'C) In-Survey')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_In_Survey_eastern_region = count($In_Survey_eastern_region);
 $eeastern_region_In_Survey_final_total = 0;
  foreach($In_Survey_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_In_Survey_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $In_Survey_total_sum_of_po_mrc = $north_region_In_Survey_final_total + $western_region_In_Survey_final_total + $eeastern_region_In_Survey_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $In_Survey_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'C) In-Survey')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_In_Survey_eastern_region = count($In_Survey_nrc_eastern_region);
 $eeastern_region_In_Survey_final_nrc_total = 0;
  foreach($In_Survey_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_In_Survey_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $In_Survey_nrc_northen_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'C) In-Survey')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_In_Survey_northen_region = count($In_Survey_nrc_northen_region);
 $north_region_In_Survey_nrc_final_total = 0;
   foreach($In_Survey_nrc_northen_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_In_Survey_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $In_Survey_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'C) In-Survey')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_In_Survey_western_region = count($In_Survey_nrc_western_region);
 $western_region_In_Survey_final_nrc_total = 0;
  foreach($In_Survey_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_In_Survey_final_nrc_total += (int)$new_po_nrc_western;
 }


// sum of nrc for eastern region,western region and northen region
$In_Survey_total_sum_of_po_nrc = $eeastern_region_In_Survey_final_nrc_total + $north_region_In_Survey_nrc_final_total + $western_region_In_Survey_final_nrc_total;
 //count mrc and nrc record
$count_In_Survey[] = array($count_mrc_In_Survey_northen_region,$count_mrc_In_Survey_western_region,$count_mrc_In_Survey_eastern_region,$count_nrc_In_Survey_northen_region,$count_nrc_In_Survey_western_region,$count_nrc_In_Survey_eastern_region);
$In_Survey_record[] = array("easterRegionmrc" => $eeastern_region_In_Survey_final_total,"northregionmrc" => $north_region_In_Survey_final_total,"westernregionmrc" => $western_region_In_Survey_final_total,"mrctotal" =>$In_Survey_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_In_Survey_final_nrc_total,"northregionrc" =>$north_region_In_Survey_nrc_final_total,"westernregionnrc" =>$western_region_In_Survey_final_nrc_total,"nrctotal" =>$In_Survey_total_sum_of_po_nrc); 
// in survey end here

//In-planning start here
$In_Planning_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'D) In-Planning')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_In_Planning_north_region = count($In_Planning_northen_region);
//echo $count;exit;
$count_mrc_In_Planning_northen_region = count($In_Planning_northen_region);
$north_region_In_Planning_final_total = 0;
foreach($In_Planning_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_In_Planning_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_In_Planning_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $In_Planning_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'D) In-Planning')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_In_Planning_western_region = count($In_Planning_western_region);
 $western_region_In_Planning_final_total = 0;
  foreach($In_Planning_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_In_Planning_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $In_Planning_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'D) In-Planning')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_In_Planning_eastern_region = count($In_Planning_eastern_region);
 $eeastern_region_In_Planning_final_total = 0;
  foreach($In_Planning_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_In_Planning_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $In_Planning_total_sum_of_po_mrc = $north_region_In_Planning_final_total + $western_region_In_Planning_final_total + $eeastern_region_In_Planning_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $In_Planning_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'D) In-Planning')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_In_Planning_eastern_region = count($In_Planning_nrc_eastern_region);
 $eeastern_region_In_Planning_final_nrc_total = 0;
  foreach($In_Planning_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_In_Planning_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $In_Planning_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'D) In-Planning')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_In_Planning_northen_region = count($In_Planning_nrc_northern_region);
 $north_region_In_Planning_nrc_final_total = 0;
   foreach($In_Planning_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_In_Planning_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $In_Planning_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'D) In-Planning')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_In_Planning_western_region = count($In_Planning_nrc_western_region);
 $western_region_In_Planning_final_nrc_total = 0;
  foreach($In_Planning_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_In_Planning_final_nrc_total += (int)$new_po_nrc_western;
 }


 // sum of nrc for eastern region,western region and northen region
$In_Planning_total_sum_of_po_nrc = $eeastern_region_In_Planning_final_nrc_total + $north_region_In_Planning_nrc_final_total + $western_region_In_Planning_final_nrc_total;

//count mrc and nrc record
$count_In_Planning[] = array($count_mrc_In_Planning_northen_region,$count_mrc_In_Planning_western_region,$count_mrc_In_Planning_eastern_region,$count_nrc_In_Planning_northen_region,$count_nrc_In_Planning_western_region,$count_nrc_In_Planning_eastern_region);
$In_Planning_record[] = array("easterRegionmrc" => $eeastern_region_In_Planning_final_total,"northregionmrc" => $north_region_In_Planning_final_total,"westernregionmrc" => $western_region_In_Planning_final_total,"mrctotal" =>$In_Planning_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_In_Planning_final_nrc_total,"northregionrc" =>$north_region_In_Planning_nrc_final_total,"westernregionnrc" =>$western_region_In_Planning_final_nrc_total,"nrctotal" =>$In_Planning_total_sum_of_po_nrc); 
//In planning ends here

//landlord approval start here
$Landlord_Approval_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'E) Landlord-Approval')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_Landlord_Approval_north_region = count($Landlord_Approval_northen_region);
//echo $count;exit;
$count_mrc_Landlord_Approval_northen_region = count($Landlord_Approval_northen_region);
$north_region_Landlord_Approval_final_total = 0;
foreach($Landlord_Approval_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_Landlord_Approval_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_Landlord_Approval_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $Landlord_Approval_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'E) Landlord-Approval')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_Landlord_Approval_western_region = count($Landlord_Approval_western_region);
 $western_region_Landlord_Approval_final_total = 0;
  foreach($Landlord_Approval_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_Landlord_Approval_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $Landlord_Approval_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'E) Landlord-Approval')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_Landlord_Approval_eastern_region = count($Landlord_Approval_eastern_region);
 $eeastern_region_Landlord_Approval_final_total = 0;
  foreach($Landlord_Approval_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_Landlord_Approval_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $Landlord_Approval_total_sum_of_po_mrc = $north_region_Landlord_Approval_final_total + $western_region_Landlord_Approval_final_total + $eeastern_region_Landlord_Approval_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $Landlord_Approval_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'E) Landlord-Approval')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Landlord_Approval_eastern_region = count($Landlord_Approval_nrc_eastern_region);
 $eeastern_region_Landlord_Approval_final_nrc_total = 0;
  foreach($Landlord_Approval_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_Landlord_Approval_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $Landlord_Approval_nrc_northen_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'E) Landlord-Approval')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_Landlord_Approval_northen_region = count($Landlord_Approval_nrc_northen_region);
 $north_region_Landlord_Approval_nrc_final_total = 0;
   foreach($Landlord_Approval_nrc_northen_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_Landlord_Approval_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $Landlord_Approval_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'E) Landlord-Approval')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Landlord_Approval_western_region = count($Landlord_Approval_nrc_western_region);
 $western_region_Landlord_Approval_final_nrc_total = 0;
  foreach($Landlord_Approval_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_Landlord_Approval_final_nrc_total += (int)$new_po_nrc_western;
 }


  //count mrc and nrc record
  $Landlord_Approval_total_sum_of_po_nrc = $eeastern_region_Landlord_Approval_final_nrc_total + $north_region_Landlord_Approval_nrc_final_total + $western_region_Landlord_Approval_final_nrc_total;
//count mrc and nrc record
 $count_Landlord_Approval[] = array($count_mrc_Landlord_Approval_northen_region,$count_mrc_Landlord_Approval_western_region,$count_mrc_Landlord_Approval_eastern_region,$count_nrc_Landlord_Approval_northen_region,$count_nrc_Landlord_Approval_western_region,$count_nrc_Landlord_Approval_eastern_region);
 $Landlord_Approval_record[] = array("easterRegionmrc" => $eeastern_region_Landlord_Approval_final_total,"northregionmrc" => $north_region_Landlord_Approval_final_total,"westernregionmrc" => $western_region_Landlord_Approval_final_total,"mrctotal" =>$Landlord_Approval_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_Landlord_Approval_final_nrc_total,"northregionrc" =>$north_region_Landlord_Approval_nrc_final_total,"westernregionnrc" =>$western_region_Landlord_Approval_final_nrc_total,"nrctotal" =>$Landlord_Approval_total_sum_of_po_nrc); 

//permission start here
$Permissions_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'F) Permissions')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_Permissions_north_region = count($Permissions_northen_region);
//echo $count;exit;
$count_mrc_Permissions_northen_region = count($Permissions_northen_region);
$north_region_Permissions_final_total = 0;
foreach($Permissions_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_Permissions_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_Permissions_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $Permissions_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'F) Permissions')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_Permissions_western_region = count($Permissions_western_region);
 $western_region_Permissions_final_total = 0;
  foreach($Permissions_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_Permissions_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $Permissions_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'F) Permissions')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_Permissions_eastern_region = count($Permissions_eastern_region);
 $eeastern_region_Permissions_final_total = 0;
  foreach($Permissions_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_Permissions_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $Permissions_total_sum_of_po_mrc = $north_region_Permissions_final_total + $western_region_Permissions_final_total + $eeastern_region_Permissions_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $Permissions_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'F) Permissions')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Permissions_eastern_region = count($Permissions_nrc_eastern_region);
 $eeastern_region_Permissions_final_nrc_total = 0;
  foreach($Permissions_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_Permissions_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $Permissions_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'F) Permissions')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_Permissions_northen_region = count($Permissions_nrc_northern_region);
 $north_region_Permissions_nrc_final_total = 0;
   foreach($Permissions_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_Permissions_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $Permissions_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'F) Permissions')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Permissions_western_region = count($Permissions_nrc_western_region);
 $western_region_Permissions_final_nrc_total = 0;
  foreach($Permissions_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_Permissions_final_nrc_total += (int)$new_po_nrc_western;
 }


// sum of nrc for eastern region,western region and northen region
$Permissions_total_sum_of_po_nrc = $eeastern_region_Permissions_final_nrc_total + $north_region_Permissions_nrc_final_total + $western_region_Permissions_final_nrc_total;
 //count mrc and nrc record
$count_Permissions[] = array($count_mrc_Permissions_northen_region,$count_mrc_Permissions_western_region,$count_mrc_Permissions_eastern_region,$count_nrc_Permissions_northen_region,$count_nrc_Permissions_western_region,$count_nrc_Permissions_eastern_region);
$Permissions_record[] = array("easterRegionmrc" => $eeastern_region_Permissions_final_total,"northregionmrc" => $north_region_Permissions_final_total,"westernregionmrc" => $western_region_Permissions_final_total,"mrctotal" =>$Permissions_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_Permissions_final_nrc_total,"northregionrc" =>$north_region_Permissions_nrc_final_total,"westernregionnrc" =>$western_region_Permissions_final_nrc_total,"nrctotal" =>$Permissions_total_sum_of_po_nrc); 
//permission end here



//financial approval start here
$Financial_Approval_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'H) Financial Approval')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_Financial_Approval_north_region = count($Financial_Approval_northen_region);
//echo $count;exit;
$count_mrc_Financial_Approval_northen_region = count($Financial_Approval_northen_region);
$north_region_Financial_Approval_final_total = 0;
foreach($Financial_Approval_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_Financial_Approval_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_Financial_Approval_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $Financial_Approval_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'H) Financial Approval')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_Financial_Approval_western_region = count($Financial_Approval_western_region);
 $western_region_Financial_Approval_final_total = 0;
  foreach($Financial_Approval_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_Financial_Approval_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $Financial_Approval_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'H) Financial Approval')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_Financial_Approval_eastern_region = count($Financial_Approval_eastern_region);
 $eeastern_region_Financial_Approval_final_total = 0;
  foreach($Financial_Approval_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_Financial_Approval_final_total += (int)$new_po_mrc_eastern;
 }



// sum of mrc for eastern region,western region and northen region
$Financial_Approval_total_sum_of_po_mrc = $north_region_Financial_Approval_final_total + $western_region_Financial_Approval_final_total + $eeastern_region_Financial_Approval_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $Financial_Approval_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'H) Financial Approval')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Financial_Approval_eastern_region = count($Financial_Approval_nrc_eastern_region);
 $eeastern_region_Financial_Approval_final_nrc_total = 0;
  foreach($Financial_Approval_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_Financial_Approval_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $Financial_Approval_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'H) Financial Approval')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_Financial_Approval_northen_region = count($Financial_Approval_nrc_northern_region);
 $north_region_Financial_Approval_nrc_final_total = 0;
   foreach($Financial_Approval_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_Financial_Approval_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $Financial_Approval_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'H) Financial Approval')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Financial_Approval_western_region = count($Financial_Approval_nrc_western_region);
 $western_region_Financial_Approval_final_nrc_total = 0;
  foreach($Financial_Approval_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_Financial_Approval_final_nrc_total += (int)$new_po_nrc_western;
 }


// sum of nrc for eastern region,western region and northen region
$Financial_Approval_total_sum_of_po_nrc = $eeastern_region_Financial_Approval_final_nrc_total + $north_region_Financial_Approval_nrc_final_total + $western_region_Financial_Approval_final_nrc_total;
//count mrc and nrc record
$count_Financial_Approval[] = array($count_mrc_Financial_Approval_northen_region,$count_mrc_Financial_Approval_western_region,$count_mrc_Financial_Approval_eastern_region,$count_nrc_Financial_Approval_northen_region,$count_nrc_Financial_Approval_western_region,$count_nrc_Financial_Approval_eastern_region);
$Financial_Approval_record[] = array("easterRegionmrc" => $eeastern_region_Financial_Approval_final_total,"northregionmrc" => $north_region_Financial_Approval_final_total,"westernregionmrc" => $western_region_Financial_Approval_final_total,"mrctotal" =>$Financial_Approval_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_Financial_Approval_final_nrc_total,"northregionrc" =>$north_region_Financial_Approval_nrc_final_total,"westernregionnrc" =>$western_region_Financial_Approval_final_nrc_total,"nrctotal" =>$Financial_Approval_total_sum_of_po_nrc);  

//financial approvall end

//new in build start
$New_In_Build_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'I) New In-Build')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_New_In_Build_north_region = count($New_In_Build_northen_region);
//echo $count;exit;
$count_mrc_New_In_Build_northen_region = count($New_In_Build_northen_region);
$north_region_New_In_Build_final_total = 0;
foreach($New_In_Build_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_New_In_Build_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_New_In_Build_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $New_In_Build_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'I) New In-Build')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_New_In_Build_western_region = count($New_In_Build_western_region);
 $western_region_New_In_Build_final_total = 0;
  foreach($New_In_Build_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_New_In_Build_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $New_In_Build_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'I) New In-Build')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_New_In_Build_eastern_region = count($New_In_Build_eastern_region);
 $eeastern_region_New_In_Build_final_total = 0;
  foreach($New_In_Build_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_New_In_Build_final_total += (int)$new_po_mrc_eastern;
 }



// sum of mrc for eastern region,western region and northen region
$New_In_Build_total_sum_of_po_mrc = $north_region_New_In_Build_final_total + $western_region_New_In_Build_final_total + $eeastern_region_New_In_Build_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $New_In_Build_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'I) New In-Build')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_New_In_Build_eastern_region = count($New_In_Build_nrc_eastern_region);
 $eeastern_region_New_In_Build_final_nrc_total = 0;
  foreach($New_In_Build_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_New_In_Build_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $New_In_Build_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'I) New In-Build')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_New_In_Build_northen_region = count($New_In_Build_nrc_northern_region);
 $north_region_New_In_Build_nrc_final_total = 0;
   foreach($New_In_Build_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_New_In_Build_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $New_In_Build_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'I) New In-Build')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_New_In_Build_western_region = count($New_In_Build_nrc_western_region);
 $western_region_New_In_Build_final_nrc_total = 0;
  foreach($New_In_Build_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_New_In_Build_final_nrc_total += (int)$new_po_nrc_western;
 }


// sum of nrc for eastern region,western region and northen region
$New_In_Build_total_sum_of_po_nrc = $eeastern_region_New_In_Build_final_nrc_total + $north_region_New_In_Build_nrc_final_total + $western_region_New_In_Build_final_nrc_total;
//count mrc and nrc record
$count_New_In_Build[] = array($count_mrc_New_In_Build_northen_region,$count_mrc_New_In_Build_western_region,$count_mrc_New_In_Build_eastern_region,$count_nrc_New_In_Build_northen_region,$count_nrc_New_In_Build_western_region,$count_nrc_New_In_Build_eastern_region);
$New_In_Build_record[] = array("easterRegionmrc" => $eeastern_region_New_In_Build_final_total,"northregionmrc" => $north_region_New_In_Build_final_total,"westernregionmrc" => $western_region_New_In_Build_final_total,"mrctotal" =>$New_In_Build_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_New_In_Build_final_nrc_total,"northregionrc" =>$north_region_New_In_Build_nrc_final_total,"westernregionnrc" =>$western_region_New_In_Build_final_nrc_total,"nrctotal" =>$New_In_Build_total_sum_of_po_nrc); 

//new in build end

//In build start
$In_Build_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'J) In-Build')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_In_Build_north_region = count($In_Build_northen_region);
//echo $count;exit;
$count_mrc_In_Build_northen_region = count($In_Build_northen_region);
$north_region_In_Build_final_total = 0;
foreach($In_Build_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_In_Build_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_In_Build_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $In_Build_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'J) In-Build')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_In_Build_western_region = count($In_Build_western_region);
 $western_region_In_Build_final_total = 0;
  foreach($In_Build_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_In_Build_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $In_Build_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'J) In-Build')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_In_Build_eastern_region = count($In_Build_eastern_region);
 $eeastern_region_In_Build_final_total = 0;
  foreach($In_Build_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_In_Build_final_total += (int)$new_po_mrc_eastern;
 }



// sum of mrc for eastern region,western region and northen region
$In_Build_total_sum_of_po_mrc = $north_region_In_Build_final_total + $western_region_In_Build_final_total + $eeastern_region_In_Build_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $In_Build_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'J) In-Build')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_In_Build_eastern_region = count($In_Build_nrc_eastern_region);
 $eeastern_region_In_Build_final_nrc_total = 0;
  foreach($In_Build_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_In_Build_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $In_Build_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'J) In-Build')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_In_Build_northen_region = count($In_Build_nrc_northern_region);
 $north_region_In_Build_nrc_final_total = 0;
   foreach($In_Build_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_In_Build_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $In_Build_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'J) In-Build')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_In_Build_western_region = count($In_Build_nrc_western_region);
 $western_region_In_Build_final_nrc_total = 0;
  foreach($In_Build_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_In_Build_final_nrc_total += (int)$new_po_nrc_western;
 }


// sum of nrc for eastern region,western region and northen region
$In_Build_total_sum_of_po_nrc = $eeastern_region_In_Build_final_nrc_total + $north_region_In_Build_nrc_final_total + $western_region_In_Build_final_nrc_total;
 //count mrc and nrc record
$count_In_Build[] = array($count_mrc_In_Build_northen_region,$count_mrc_In_Build_western_region,$count_mrc_In_Build_eastern_region,$count_nrc_In_Build_northen_region,$count_nrc_In_Build_western_region,$count_nrc_In_Build_eastern_region);
$In_Build_record[] = array("easterRegionmrc" => $eeastern_region_In_Build_final_total,"northregionmrc" => $north_region_In_Build_final_total,"westernregionmrc" => $western_region_In_Build_final_total,"mrctotal" =>$In_Build_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_In_Build_final_nrc_total,"northregionrc" =>$north_region_In_Build_nrc_final_total,"westernregionnrc" =>$western_region_In_Build_final_nrc_total,"nrctotal" =>$In_Build_total_sum_of_po_nrc); 

//in build end

//k toc submitted l2 start
$TOC_P1_Submitted_L2_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'K) TOC P1 Submitted-L2')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_TOC_P1_Submitted_L2_north_region = count($TOC_P1_Submitted_L2_northen_region);
//echo $count;exit;
$count_mrc_TOC_P1_Submitted_L2_northen_region = count($TOC_P1_Submitted_L2_northen_region);
$north_region_TOC_P1_Submitted_L2_final_total = 0;
foreach($TOC_P1_Submitted_L2_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_TOC_P1_Submitted_L2_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_TOC_P1_Submitted_L2_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $TOC_P1_Submitted_L2_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'K) TOC P1 Submitted-L2')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_TOC_P1_Submitted_L2_western_region = count($TOC_P1_Submitted_L2_western_region);
 $western_region_TOC_P1_Submitted_L2_final_total = 0;
  foreach($TOC_P1_Submitted_L2_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_TOC_P1_Submitted_L2_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $TOC_P1_Submitted_L2_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'K) TOC P1 Submitted-L2')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_TOC_P1_Submitted_L2_eastern_region = count($TOC_P1_Submitted_L2_eastern_region);
 $eeastern_region_TOC_P1_Submitted_L2_final_total = 0;
  foreach($TOC_P1_Submitted_L2_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_TOC_P1_Submitted_L2_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $TOC_P1_Submitted_L2_total_sum_of_po_mrc = $north_region_TOC_P1_Submitted_L2_final_total + $western_region_TOC_P1_Submitted_L2_final_total + $eeastern_region_TOC_P1_Submitted_L2_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $TOC_P1_Submitted_L2_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'K) TOC P1 Submitted-L2')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_TOC_P1_Submitted_L2_eastern_region = count($TOC_P1_Submitted_L2_nrc_eastern_region);
 $eeastern_region_TOC_P1_Submitted_L2_final_nrc_total = 0;
  foreach($TOC_P1_Submitted_L2_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_TOC_P1_Submitted_L2_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $TOC_P1_Submitted_L2_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'K) TOC P1 Submitted-L2')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_TOC_P1_Submitted_L2_northen_region = count($TOC_P1_Submitted_L2_nrc_northern_region);
 $north_region_TOC_P1_Submitted_L2_nrc_final_total = 0;
   foreach($TOC_P1_Submitted_L2_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_TOC_P1_Submitted_L2_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $TOC_P1_Submitted_L2_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'K) TOC P1 Submitted-L2')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_TOC_P1_Submitted_L2_western_region = count($TOC_P1_Submitted_L2_nrc_western_region);
 $western_region_TOC_P1_Submitted_L2_final_nrc_total = 0;
  foreach($TOC_P1_Submitted_L2_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_TOC_P1_Submitted_L2_final_nrc_total += (int)$new_po_nrc_western;
 }


 // sum of nrc for eastern region,western region and northen region
 $TOC_P1_Submitted_L2_total_sum_of_po_nrc = $eeastern_region_TOC_P1_Submitted_L2_final_nrc_total + $north_region_TOC_P1_Submitted_L2_nrc_final_total + $western_region_TOC_P1_Submitted_L2_final_nrc_total;
 //count mrc and nrc record
 $count_TOC_P1_Submitted_L2[] = array($count_mrc_TOC_P1_Submitted_L2_northen_region,$count_mrc_TOC_P1_Submitted_L2_western_region,$count_mrc_TOC_P1_Submitted_L2_eastern_region,$count_nrc_TOC_P1_Submitted_L2_northen_region,$count_nrc_TOC_P1_Submitted_L2_western_region,$count_nrc_TOC_P1_Submitted_L2_eastern_region);
 $TOC_P1_Submitted_L2_record[] = array("easterRegionmrc" => $eeastern_region_TOC_P1_Submitted_L2_final_total,"northregionmrc" => $north_region_TOC_P1_Submitted_L2_final_total,"westernregionmrc" => $western_region_TOC_P1_Submitted_L2_final_total,"mrctotal" =>$TOC_P1_Submitted_L2_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_TOC_P1_Submitted_L2_final_nrc_total,"northregionrc" =>$north_region_TOC_P1_Submitted_L2_nrc_final_total,"westernregionnrc" =>$western_region_TOC_P1_Submitted_L2_final_nrc_total,"nrctotal" =>$TOC_P1_Submitted_L2_total_sum_of_po_nrc); 
 
 //ends here
//on hold start here
$On_Hold_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'R) On-Hold')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_On_Hold_north_region = count($On_Hold_northen_region);
//echo $count;exit;
$count_mrc_On_Hold_northen_region = count($On_Hold_northen_region);
$north_region_On_Hold_final_total = 0;
foreach($On_Hold_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_On_Hold_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_On_Hold_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $On_Hold_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'R) On-Hold')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_On_Hold_western_region = count($On_Hold_western_region);
 $western_region_On_Hold_final_total = 0;
  foreach($On_Hold_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_On_Hold_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $On_Hold_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'R) On-Hold')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_On_Hold_eastern_region = count($On_Hold_eastern_region);
 $eeastern_region_On_Hold_final_total = 0;
  foreach($On_Hold_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_On_Hold_final_total += (int)$new_po_mrc_eastern;
 }



// sum of mrc for eastern region,western region and northen region
$On_Hold_total_sum_of_po_mrc = $north_region_On_Hold_final_total + $western_region_On_Hold_final_total + $eeastern_region_On_Hold_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $On_Hold_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'R) On-Hold')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_On_Hold_eastern_region = count($On_Hold_nrc_eastern_region);
 $eeastern_region_On_Hold_final_nrc_total = 0;
  foreach($On_Hold_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_On_Hold_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $On_Hold_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'R) On-Hold')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_On_Hold_northen_region = count($On_Hold_nrc_northern_region);
 $north_region_On_Hold_nrc_final_total = 0;
   foreach($On_Hold_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_On_Hold_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $On_Hold_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'R) On-Hold')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_On_Hold_western_region = count($On_Hold_nrc_western_region);
 $western_region_On_Hold_final_nrc_total = 0;
  foreach($On_Hold_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_On_Hold_final_nrc_total += (int)$new_po_nrc_western;
 }


// sum of nrc for eastern region,western region and northen region
$On_Hold_total_sum_of_po_nrc = $eeastern_region_On_Hold_final_nrc_total + $north_region_On_Hold_nrc_final_total + $western_region_On_Hold_final_nrc_total;
//count mrc and nrc record
$count_On_Hold[] = array($count_mrc_On_Hold_northen_region,$count_mrc_On_Hold_western_region,$count_mrc_On_Hold_eastern_region,$count_nrc_On_Hold_northen_region,$count_nrc_On_Hold_western_region,$count_nrc_On_Hold_eastern_region);
$On_Hold_record[] = array("easterRegionmrc" => $eeastern_region_On_Hold_final_total,"northregionmrc" => $north_region_On_Hold_final_total,"westernregionmrc" => $western_region_On_Hold_final_total,"mrctotal" =>$On_Hold_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_On_Hold_final_nrc_total,"northregionrc" =>$north_region_On_Hold_nrc_final_total,"westernregionnrc" =>$western_region_On_Hold_final_nrc_total,"nrctotal" =>$On_Hold_total_sum_of_po_nrc);  
//ends here  

//return to sale start
$Return_to_Sales_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'S) Return to Sales')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_Return_to_Sales_north_region = count($Return_to_Sales_northen_region);
//echo $count;exit;
$count_mrc_Return_to_Sales_northen_region = count($Return_to_Sales_northen_region);
$north_region_Return_to_Sales_final_total = 0;
foreach($Return_to_Sales_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_Return_to_Sales_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_Return_to_Sales_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $Return_to_Sales_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'S) Return to Sales')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_Return_to_Sales_western_region = count($Return_to_Sales_western_region);
 $western_region_Return_to_Sales_final_total = 0;
  foreach($Return_to_Sales_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_Return_to_Sales_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $Return_to_Sales_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'S) Return to Sales')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_Return_to_Sales_eastern_region = count($Return_to_Sales_eastern_region);
 $eeastern_region_Return_to_Sales_final_total = 0;
  foreach($Return_to_Sales_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_Return_to_Sales_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $Return_to_Sales_total_sum_of_po_mrc = $north_region_Return_to_Sales_final_total + $western_region_Return_to_Sales_final_total + $eeastern_region_Return_to_Sales_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $Return_to_Sales_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'S) Return to Sales')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Return_to_Sales_eastern_region = count($Return_to_Sales_nrc_eastern_region);
 $eeastern_region_Return_to_Sales_final_nrc_total = 0;
  foreach($Return_to_Sales_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_Return_to_Sales_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $Return_to_Sales_nrc_northern_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'S) Return to Sales')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_Return_to_Sales_northen_region = count($Return_to_Sales_nrc_northern_region);
 $north_region_Return_to_Sales_nrc_final_total = 0;
   foreach($Return_to_Sales_nrc_northern_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_Return_to_Sales_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $Return_to_Sales_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'S) Return to Sales')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_Return_to_Sales_western_region = count($Return_to_Sales_nrc_western_region);
 $western_region_Return_to_Sales_final_nrc_total = 0;
  foreach($Return_to_Sales_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_Return_to_Sales_final_nrc_total += (int)$new_po_nrc_western;
 }


// sum of nrc for eastern region,western region and northen region
$Return_to_Sales_total_sum_of_po_nrc = $eeastern_region_Return_to_Sales_final_nrc_total + $north_region_Return_to_Sales_nrc_final_total + $western_region_Return_to_Sales_final_nrc_total;
//count mrc and nrc record
$count_Return_to_Sales[] = array($count_mrc_Return_to_Sales_northen_region,$count_mrc_Return_to_Sales_western_region,$count_mrc_Return_to_Sales_eastern_region,$count_nrc_Return_to_Sales_northen_region,$count_nrc_Return_to_Sales_western_region,$count_nrc_Return_to_Sales_eastern_region);
$Return_to_Sales_record[] = array("easterRegionmrc" => $eeastern_region_Return_to_Sales_final_total,"northregionmrc" => $north_region_Return_to_Sales_final_total,"westernregionmrc" => $western_region_Return_to_Sales_final_total,"mrctotal" =>$Return_to_Sales_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_Return_to_Sales_final_nrc_total,"northregionrc" =>$north_region_Return_to_Sales_nrc_final_total,"westernregionnrc" =>$western_region_Return_to_Sales_final_nrc_total,"nrctotal" =>$Return_to_Sales_total_sum_of_po_nrc);  
//ends here




//pending cts start
$V_Pending_CTS_northen_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'V) Pending CTS')
                              ->where('site_master_file_records.region','Northern Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

//$count_mrc_V_Pending_CTS_north_region = count($V_Pending_CTS_northen_region);
//echo $count;exit;
$count_mrc_V_Pending_CTS_northen_region = count($V_Pending_CTS_northen_region);
$north_region_V_Pending_CTS_final_total = 0;
foreach($V_Pending_CTS_northen_region as $north_region_mrc){
     $po_mrc_north = $north_region_mrc->po_mrc;
     $r_po_mrc_north = str_replace("R","",$po_mrc_north);
     $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
     $north_region_V_Pending_CTS_final_total += (int)$new_po_mrc_north;   
 }
 //echo "<pre>";print_r($count_mrc_V_Pending_CTS_north_region);exit;
   //sum of mrc for new sale and Western Region 
 $V_Pending_CTS_western_region = DB::table('site_master_file_records')
                              ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                              ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                              ->where('site_master_file_records.project_status', 'V) Pending CTS')
                              ->where('site_master_file_records.region','Western Region')
                              ->whereNull('build_master_file_records.toc_submitted') 
                              ->get()->toArray();

 $count_mrc_V_Pending_CTS_western_region = count($V_Pending_CTS_western_region);
 $western_region_V_Pending_CTS_final_total = 0;
  foreach($V_Pending_CTS_western_region as $western_region_mrc){
       $po_mrc_western = $western_region_mrc->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $western_region_V_Pending_CTS_final_total += (int)$new_po_mrc_western;
 }


 //sum of mrc for new sale and Eeastern  Region 

 $V_Pending_CTS_eastern_region =  DB::table('site_master_file_records')
                                ->select('site_master_file_records.project_status','site_master_file_records.po_mrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                ->where('site_master_file_records.project_status', 'V) Pending CTS')
                                ->where('site_master_file_records.region','Eastern Region')
                                ->whereNull('build_master_file_records.toc_submitted') 
                                ->get()->toArray();
 
 $count_mrc_V_Pending_CTS_eastern_region = count($V_Pending_CTS_eastern_region);
 $eeastern_region_V_Pending_CTS_final_total = 0;
  foreach($V_Pending_CTS_eastern_region as $eastern_region_mrc){
       $po_mrc_eastern = $eastern_region_mrc->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $eeastern_region_V_Pending_CTS_final_total += (int)$new_po_mrc_eastern;
 }



 // sum of mrc for eastern region,western region and northen region
 $V_Pending_CTS_total_sum_of_po_mrc = $north_region_V_Pending_CTS_final_total + $western_region_V_Pending_CTS_final_total + $eeastern_region_V_Pending_CTS_final_total;

 
 //sum of nrc for new sale and Eeastern  Region 
 $V_Pending_CTS_nrc_eastern_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'V) Pending CTS')
                                  ->where('site_master_file_records.region','Eastern Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_V_Pending_CTS_eastern_region = count($V_Pending_CTS_nrc_eastern_region);
 $eeastern_region_V_Pending_CTS_final_nrc_total = 0;
  foreach($V_Pending_CTS_nrc_eastern_region as $eastern_region_nrc){
       $po_nrc_eastern = $eastern_region_nrc->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $eeastern_region_V_Pending_CTS_final_nrc_total += (int)$new_po_nrc_eastern;
 }

 //sum of nrc for new sale and Northern Region
 
 $V_Pending_CTS_nrc_northen_region = DB::table('site_master_file_records')
                                    ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                    ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                    ->where('site_master_file_records.project_status', 'V) Pending CTS')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereNull('build_master_file_records.toc_submitted') 
                                    ->get()->toArray();

 $count_nrc_V_Pending_CTS_northen_region = count($V_Pending_CTS_nrc_northen_region);
 $north_region_V_Pending_CTS_nrc_final_total = 0;
   foreach($V_Pending_CTS_nrc_northen_region as $northern_region_nrc){
         $po_nrc_northern = $northern_region_nrc->po_nrc;
         $r_po_nrc_northern = str_replace("R","",$po_nrc_northern);
         $new_po_nrc_northern = str_replace(",","",$r_po_nrc_northern);  
         $north_region_V_Pending_CTS_nrc_final_total += (int)$new_po_nrc_northern;
   }

 //sum of nrc for new sale and Western  Region 
 
 $V_Pending_CTS_nrc_western_region = DB::table('site_master_file_records')
                                  ->select('site_master_file_records.project_status','site_master_file_records.po_nrc','build_master_file_records.toc_submitted','site_master_file_records.service_id')
                                  ->join('build_master_file_records', 'build_master_file_records.service_id', '=', 'site_master_file_records.service_id')
                                  ->where('site_master_file_records.project_status', 'V) Pending CTS')
                                  ->where('site_master_file_records.region','Western Region')
                                  ->whereNull('build_master_file_records.toc_submitted') 
                                  ->get()->toArray();

 $count_nrc_V_Pending_CTS_western_region = count($V_Pending_CTS_nrc_western_region);
 $western_region_V_Pending_CTS_final_nrc_total = 0;
  foreach($V_Pending_CTS_nrc_western_region as $western_region_nrc){
       $po_nrc_western = $western_region_nrc->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $western_region_V_Pending_CTS_final_nrc_total += (int)$new_po_nrc_western;
 }


 // sum of nrc for eastern region,western region and northen region
$V_Pending_CTS_total_sum_of_po_nrc = $eeastern_region_V_Pending_CTS_final_nrc_total + $north_region_V_Pending_CTS_nrc_final_total + $western_region_V_Pending_CTS_final_nrc_total;
//count mrc and nrc record
$count_V_Pending_CTS[] = array($count_mrc_V_Pending_CTS_northen_region,$count_mrc_V_Pending_CTS_western_region,$count_mrc_V_Pending_CTS_eastern_region,$count_nrc_V_Pending_CTS_northen_region,$count_nrc_V_Pending_CTS_western_region,$count_nrc_V_Pending_CTS_eastern_region);
$V_Pending_CTS_record[] = array("easterRegionmrc" => $eeastern_region_V_Pending_CTS_final_total,"northregionmrc" => $north_region_V_Pending_CTS_final_total,"westernregionmrc" => $western_region_V_Pending_CTS_final_total,"mrctotal" =>$V_Pending_CTS_total_sum_of_po_mrc,"easterRegionnrc" =>$eeastern_region_V_Pending_CTS_final_nrc_total,"northregionrc" =>$north_region_V_Pending_CTS_nrc_final_total,"westernregionnrc" =>$western_region_V_Pending_CTS_final_nrc_total,"nrctotal" =>$V_Pending_CTS_total_sum_of_po_nrc);  
//ends here 
$view =  view('admin/main-dashboard/dashboard', compact('new_sale_record','new_in_planning_record','In_Survey_record','In_Planning_record',
'Landlord_Approval_record','Permissions_record','Financial_Approval_record','New_In_Build_record','In_Build_record',
'TOC_P1_Submitted_L2_record','On_Hold_record','Return_to_Sales_record','V_Pending_CTS_record','count_sale_record','count_new_in_planning','count_In_Planning',
'count_In_Survey','count_Landlord_Approval','count_Permissions','count_Financial_Approval','count_New_In_Build','count_In_Build','count_TOC_P1_Submitted_L2',
'count_On_Hold','count_Return_to_Sales','count_V_Pending_CTS'));
 return $view; 
       }


//get data according to month
public function toc_monthy_dashboard(Request $request){
  //check year
  $currentYear = date('Y');
  if($request->year == '2023'){
      $currentYear = '2023';
  } elseif($request->year == '2024'){
      $currentYear = date('Y');
  }

  $all_result = DB::table('build_master_file_records')
              ->select('build_master_file_records.toc_submitted','build_master_file_records.service_id','build_master_file_records.actual_build_completion_date',
              'site_master_file_records.project_status','site_master_file_records.type',
              'site_master_file_records.date_new',
              'build_master_file_records.planned_build_completion_date',
              'build_master_file_records.revised_build_co_date',
              'planning_master_file_records.revised_planned_wp2_date',
              'planning_master_file_records.planned_wp2_released_date','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.po_nrc')
              ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
              ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
              ->get()->toArray(); 
              
  $new_current_date =  Carbon::now();
  $jan_record_final_total_northen = 0;
  $count_jan_mrc_north_region = 0;

  $jan_record_final_total_eastern = 0;
  $count_jan_mrc_eastern_region = 0;

  $jan_record_final_total_western = 0;
  $count_jan_mrc_western_region = 0;

  $count_jan_nrc_north_region = 0;
  $jan_nrc_record_final_total_northen = 0;

  $count_jan_nrc_eastern_region = 0;
  $jan_nrc_record_final_total_eastern = 0;

  $count_jan_nrc_western_region = 0;
  $jan_nrc_record_final_total_western = 0;

  $feb_record_final_total_northen = 0;
  $count_feb_mrc_north_region = 0;

  $feb_record_final_total_eastern = 0;
  $count_feb_mrc_eastern_region = 0;

  $feb_record_final_total_western = 0;
  $count_feb_mrc_western_region = 0;

  $count_feb_nrc_north_region = 0;
  $feb_nrc_record_final_total_northen = 0;

  $count_feb_nrc_eastern_region = 0;
  $feb_nrc_record_final_total_eastern = 0;

  $count_feb_nrc_western_region = 0;
  $feb_nrc_record_final_total_western = 0;

  $march_record_final_total_northen = 0;
  $count_march_mrc_north_region = 0;

  $march_record_final_total_eastern = 0;
  $count_march_mrc_eastern_region = 0;

  $march_record_final_total_western = 0;
  $count_march_mrc_western_region = 0;

  $count_march_nrc_north_region = 0;
  $march_nrc_record_final_total_northen = 0;

  $count_march_nrc_eastern_region = 0;
  $march_nrc_record_final_total_eastern = 0;

  $count_march_nrc_western_region = 0;
  $march_nrc_record_final_total_western = 0;

  $april_record_final_total_northen = 0;
  $count_april_mrc_north_region = 0;

  $april_record_final_total_eastern = 0;
  $count_april_mrc_eastern_region = 0;

  $april_record_final_total_western = 0;
  $count_april_mrc_western_region = 0;

  $count_april_nrc_north_region = 0;
  $april_nrc_record_final_total_northen = 0;

  $count_april_nrc_eastern_region = 0;
  $april_nrc_record_final_total_eastern = 0;

  $count_april_nrc_western_region = 0;
  $april_nrc_record_final_total_western = 0;

  $may_record_final_total_northen = 0;
  $count_may_mrc_north_region = 0;

  $may_record_final_total_eastern = 0;
  $count_may_mrc_eastern_region = 0;

  $may_record_final_total_western = 0;
  $count_may_mrc_western_region = 0;

  $count_may_nrc_north_region = 0;
  $may_nrc_record_final_total_northen = 0;

  $count_may_nrc_eastern_region = 0;
  $may_nrc_record_final_total_eastern = 0;

  $count_may_nrc_western_region = 0;
  $may_nrc_record_final_total_western = 0;

  $june_record_final_total_northen = 0;
  $count_june_mrc_north_region = 0;

  $june_record_final_total_eastern = 0;
  $count_june_mrc_eastern_region = 0;

  $june_record_final_total_western = 0;
  $count_june_mrc_western_region = 0;

  $count_june_nrc_north_region = 0;
  $june_nrc_record_final_total_northen = 0;

  $count_june_nrc_eastern_region = 0;
  $june_nrc_record_final_total_eastern = 0;

  $count_june_nrc_western_region = 0;
  $june_nrc_record_final_total_western = 0;

  $july_record_final_total_northen = 0;
  $count_july_mrc_north_region = 0;

  $july_record_final_total_eastern = 0;
  $count_july_mrc_eastern_region = 0;

  $july_record_final_total_western = 0;
  $count_july_mrc_western_region = 0;

  $count_july_nrc_north_region = 0;
  $july_nrc_record_final_total_northen = 0;

  $count_july_nrc_eastern_region = 0;
  $july_nrc_record_final_total_eastern = 0;

  $count_july_nrc_western_region = 0;
  $july_nrc_record_final_total_western = 0;

  $aug_record_final_total_northen = 0;
  $count_aug_mrc_north_region = 0;

  $aug_record_final_total_eastern = 0;
  $count_aug_mrc_eastern_region = 0;

  $aug_record_final_total_western = 0;
  $count_aug_mrc_western_region = 0;

  $count_aug_nrc_north_region = 0;
  $aug_nrc_record_final_total_northen = 0;

  $count_aug_nrc_eastern_region = 0;
  $aug_nrc_record_final_total_eastern = 0;

  $count_aug_nrc_western_region = 0;
  $aug_nrc_record_final_total_western = 0;
  
  $sep_record_final_total_northen = 0;
  $count_sep_mrc_north_region = 0;

  $sep_record_final_total_eastern = 0;
  $count_sep_mrc_eastern_region = 0;

  $sep_record_final_total_western = 0;
  $count_sep_mrc_western_region = 0;

  $count_sep_nrc_north_region = 0;
  $sep_nrc_record_final_total_northen = 0;

  $count_sep_nrc_eastern_region = 0;
  $sep_nrc_record_final_total_eastern = 0;

  $count_sep_nrc_western_region = 0;
  $sep_nrc_record_final_total_western = 0;

  $oct_record_final_total_northen = 0;
  $count_oct_mrc_north_region = 0;

  $oct_record_final_total_eastern = 0;
  $count_oct_mrc_eastern_region = 0;

  $oct_record_final_total_western = 0;
  $count_oct_mrc_western_region = 0;

  $count_oct_nrc_north_region = 0;
  $oct_nrc_record_final_total_northen = 0;

  $count_oct_nrc_eastern_region = 0;
  $oct_nrc_record_final_total_eastern = 0;

  $count_oct_nrc_western_region = 0;
  $oct_nrc_record_final_total_western = 0;

  $nov_record_final_total_northen = 0;
  $count_nov_mrc_north_region = 0;

  $nov_record_final_total_eastern = 0;
  $count_nov_mrc_eastern_region = 0;

  $nov_record_final_total_western = 0;
  $count_nov_mrc_western_region = 0;

  $count_nov_nrc_north_region = 0;
  $nov_nrc_record_final_total_northen = 0;

  $count_nov_nrc_eastern_region = 0;
  $nov_nrc_record_final_total_eastern = 0;

  $count_nov_nrc_western_region = 0;
  $nov_nrc_record_final_total_western = 0;

  $dec_record_final_total_northen = 0;
  $count_dec_mrc_north_region = 0;

  $dec_record_final_total_eastern = 0;
  $count_dec_mrc_eastern_region = 0;

  $dec_record_final_total_western = 0;
  $count_dec_mrc_western_region = 0;

  $count_dec_nrc_north_region = 0;
  $dec_nrc_record_final_total_northen = 0;

  $count_dec_nrc_eastern_region = 0;
  $dec_nrc_record_final_total_eastern = 0;

  $count_dec_nrc_western_region = 0;
  $dec_nrc_record_final_total_western = 0;

  foreach($all_result as $result){

    $project_duration = "";
    if($result->project_status == "Q) Cancelled"){
        $project_duration = 0;
    } else {
        if(isset($result->toc_submitted)){
            $date_toc_submitted = Carbon::parse($result->toc_submitted);
            $date_new = Carbon::parse($result->date_new);
            $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
            $project_duration = (int)$date_toc_submitted_diff+1;
        } else {

            $date_new = Carbon::parse($result->date_new);
            $date_new_diff = $new_current_date->diffInDays($date_new);
            $project_duration = (int)$date_new_diff+1;
        }
    }

    //For project Ageing
    $ageing = "";
    if($project_duration == 0){
        $ageing = "Cancelled";
    } elseif($project_duration < 30){
        $ageing = "Current";
    } elseif($project_duration > 30 AND $project_duration < 60){
        $ageing = "60 Days";
    } elseif($project_duration > 60 AND $project_duration < 91){
        $ageing = "90 days";
    } elseif($project_duration > 90 AND $project_duration < 121){
        $ageing = "120 days";
    } elseif($project_duration > 90 AND $project_duration < 121){
        $ageing = "More than 120 Days";
    } else {
        $ageing = "Query";
    }

    $planned_build_completion_date = '';
    if(!empty($result->planned_build_completion_date)){
      $planned_build_completion_date = Carbon::parse($result->planned_build_completion_date)->format('Y/m/d');
    }

    $project_type = $result->type;
    $BuildMasterFileController = new BuildMasterFileController();
    $planned_start_date = $BuildMasterFileController->change_planned_start_date($result->revised_planned_wp2_date,$result->planned_wp2_released_date);
    $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);
           
    // for show me the money
    $show_me_the_money = '';
    if($ageing == 'Cancelled'){
        $show_me_the_money = "";
    } elseif($ageing != 'Cancelled' && !empty($result->toc_submitted)){
        $show_me_the_money = Carbon::parse($result->toc_submitted)->format('Y/m/d');
    } elseif(empty($result->toc_submitted) && !empty($result->actual_build_completion_date)){
        $show_me_the_money = Carbon::parse($result->actual_build_completion_date)->format('Y/m/d');
    } elseif(empty($result->actual_build_completion_date) && !empty($planned_build_completion_date)){
        $show_me_the_money = Carbon::parse($planned_build_completion_date)->format('Y/m/d');
    } elseif(empty($planned_build_completion_date) && !empty($result->revised_build_co_date)){
        $show_me_the_money = Carbon::parse($result->revised_build_co_date)->format('Y/m/d');
    } elseif(empty($result->revised_build_co_date) && !empty($est_complition_date)){
        $show_me_the_money = Carbon::parse($est_complition_date)->format('Y/m/d');
    }

    //set variable name for loops
    $result_year = Carbon::parse($show_me_the_money)->format('Y');
    $result_month = Carbon::parse($show_me_the_money)->format('m');
    $result_region = $result->region;
    //Condition for set array according to month
    //for jan month
    $jan_mrc_month = "01";
    $jan_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $jan_mrc_month AND $result_region == $jan_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $jan_record_final_total_northen += (int)$new_po_mrc_north;
      $count_jan_mrc_north_region++;
    }    

    //for eastern region
    $jan_mrc_month = "01";
    $jan_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $jan_mrc_month AND $result_region == $jan_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $jan_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_jan_mrc_eastern_region++;
    } 

     //for eastern region
     $jan_mrc_month = "01";
     $jan_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $jan_mrc_month AND $result_region == $jan_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $jan_record_final_total_western += (int)$new_po_mrc_western;
       $count_jan_mrc_western_region++;
     } 

     //for nrc
     $jan_nrc_month = "01";
     $jan_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $jan_nrc_month AND $result_region == $jan_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $jan_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_jan_nrc_north_region++;
    }    

    //for eastern region
    $jan_nrc_month = "01";
    $jan_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $jan_nrc_month AND $result_region == $jan_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $jan_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_jan_nrc_eastern_region++;
    } 

     //for eastern region
     $jan_nrc_month = "01";
     $jan_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $jan_nrc_month AND $result_region == $jan_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $jan_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_jan_nrc_western_region++;
     } 

     // jan code ends here 
     
     //feb code start here
     $feb_mrc_month = "02";
    $feb_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $feb_mrc_month AND $result_region == $feb_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $feb_record_final_total_northen += (int)$new_po_mrc_north;
      $count_feb_mrc_north_region++;
    }    

    //for eastern region
    $feb_mrc_month = "02";
    $feb_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $feb_mrc_month AND $result_region == $feb_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $feb_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_feb_mrc_eastern_region++;
    } 

     //for eastern region
     $feb_mrc_month = "02";
     $feb_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $feb_mrc_month AND $result_region == $feb_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $feb_record_final_total_western += (int)$new_po_mrc_western;
       $count_feb_mrc_western_region++;
     } 

     //for nrc
     $feb_nrc_month = "02";
    $feb_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $feb_nrc_month AND $result_region == $feb_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $feb_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_feb_nrc_north_region++;
    }    

    //for eastern region
    $feb_nrc_month = "02";
    $feb_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $feb_nrc_month AND $result_region == $feb_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $feb_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_feb_nrc_eastern_region++;
    } 

     //for eastern region
     $feb_nrc_month = "02";
     $feb_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $feb_nrc_month AND $result_region == $feb_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $feb_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_feb_nrc_western_region++;
     } 

     //march code start here
     $march_mrc_month = "03";
    $march_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $march_mrc_month AND $result_region == $march_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $march_record_final_total_northen += (int)$new_po_mrc_north;
      $count_march_mrc_north_region++;
    }    

    //for eastern region
    $march_mrc_month = "03";
    $march_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $march_mrc_month AND $result_region == $march_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $march_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_march_mrc_eastern_region++;
    } 

     //for eastern region
     $march_mrc_month = "03";
     $march_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $march_mrc_month AND $result_region == $march_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $march_record_final_total_western += (int)$new_po_mrc_western;
       $count_march_mrc_western_region++;
     } 

     //for nrc
     $march_nrc_month = "03";
    $march_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $march_nrc_month AND $result_region == $march_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $march_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_march_nrc_north_region++;
    }    

    //for eastern region
    $march_nrc_month = "03";
    $march_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $march_nrc_month AND $result_region == $march_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $march_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_march_nrc_eastern_region++;
    } 

     //for eastern region
     $march_nrc_month = "03";
     $march_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $march_nrc_month AND $result_region == $march_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $march_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_march_nrc_western_region++;
     } 

     // april code start here
     $april_mrc_month = "04";
    $april_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $april_mrc_month AND $result_region == $april_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $april_record_final_total_northen += (int)$new_po_mrc_north;
      $count_april_mrc_north_region++;
    }    

    //for eastern region
    $april_mrc_month = "04";
    $april_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $april_mrc_month AND $result_region == $april_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $april_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_april_mrc_eastern_region++;
    } 

     //for eastern region
     $april_mrc_month = "04";
     $april_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $april_mrc_month AND $result_region == $april_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $april_record_final_total_western += (int)$new_po_mrc_western;
       $count_april_mrc_western_region++;
     } 

     //for nrc
     $april_nrc_month = "04";
    $april_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $april_nrc_month AND $result_region == $april_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $april_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_april_nrc_north_region++;
    }    

    //for eastern region
    $april_nrc_month = "04";
    $april_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $april_nrc_month AND $result_region == $april_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $april_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_april_nrc_eastern_region++;
    } 

     //for eastern region
     $april_nrc_month = "04";
     $april_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $april_nrc_month AND $result_region == $april_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $april_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_april_nrc_western_region++;
     } 
    
     // may
     $may_mrc_month = "05";
    $may_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $may_mrc_month AND $result_region == $may_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $may_record_final_total_northen += (int)$new_po_mrc_north;
      $count_may_mrc_north_region++;
    }    

    //for eastern region
    $may_mrc_month = "05";
    $may_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $may_mrc_month AND $result_region == $may_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $may_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_may_mrc_eastern_region++;
    } 

     //for eastern region
     $may_mrc_month = "05";
     $may_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $may_mrc_month AND $result_region == $may_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $may_record_final_total_western += (int)$new_po_mrc_western;
       $count_may_mrc_western_region++;
     } 

     //for nrc
     $may_nrc_month = "05";
    $may_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $may_nrc_month AND $result_region == $may_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $may_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_may_nrc_north_region++;
    }    

    //for eastern region
    $may_nrc_month = "05";
    $may_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $may_nrc_month AND $result_region == $may_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $may_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_may_nrc_eastern_region++;
    } 

     //for eastern region
     $may_nrc_month = "05";
     $may_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $may_nrc_month AND $result_region == $may_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $may_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_may_nrc_western_region++;
     } 

     $june_mrc_month = "06";
     $june_mrc_north_region = "Northern Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $june_mrc_month AND $result_region == $june_mrc_north_region){
       $po_mrc_north = $result->po_mrc;
       $r_po_mrc_north = str_replace("R","",$po_mrc_north);
       $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
       $june_record_final_total_northen += (int)$new_po_mrc_north;
       $count_june_mrc_north_region++;
     }    
 
     //for eastern region
     $june_mrc_month = "06";
     $june_mrc_eastern_region = "Eastern Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $june_mrc_month AND $result_region == $june_mrc_eastern_region){
       $po_mrc_eastern = $result->po_mrc;
       $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
       $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
       $june_record_final_total_eastern += (int)$new_po_mrc_eastern;
       $count_june_mrc_eastern_region++;
     } 
 
      //for eastern region
      $june_mrc_month = "06";
      $june_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $june_mrc_month AND $result_region == $june_mrc_western_region){
        $po_mrc_western = $result->po_mrc;
        $r_po_mrc_western = str_replace("R","",$po_mrc_western);
        $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
        $june_record_final_total_western += (int)$new_po_mrc_western;
        $count_june_mrc_western_region++;
      } 
 
      //for nrc
      $june_nrc_month = "06";
     $june_nrc_north_region = "Northern Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $june_nrc_month AND $result_region == $june_nrc_north_region){
       $po_nrc_north = $result->po_nrc;
       $r_po_nrc_north = str_replace("R","",$po_nrc_north);
       $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
       $june_nrc_record_final_total_northen += (int)$new_po_nrc_north;
       $count_june_nrc_north_region++;
     }    
 
     //for eastern region
     $june_nrc_month = "06";
     $june_nrc_eastern_region = "Eastern Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $june_nrc_month AND $result_region == $june_nrc_eastern_region){
       $po_nrc_eastern = $result->po_nrc;
       $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
       $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
       $june_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
       $count_june_nrc_eastern_region++;
     } 
 
      //for eastern region
      $june_nrc_month = "06";
      $june_nrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $june_nrc_month AND $result_region == $june_nrc_western_region){
        $po_nrc_western = $result->po_nrc;
        $r_po_nrc_western = str_replace("R","",$po_nrc_western);
        $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
        $june_nrc_record_final_total_western += (int)$new_po_nrc_western;
        $count_june_nrc_western_region++;
      } 

      //july start here
      $july_mrc_month = "07";
    $july_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $july_mrc_month AND $result_region == $july_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $july_record_final_total_northen += (int)$new_po_mrc_north;
      $count_july_mrc_north_region++;
    }    

    //for eastern region
    $july_mrc_month = "07";
    $july_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $july_mrc_month AND $result_region == $july_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $july_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_july_mrc_eastern_region++;
    } 

     //for eastern region
     $july_mrc_month = "07";
     $july_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $july_mrc_month AND $result_region == $july_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $july_record_final_total_western += (int)$new_po_mrc_western;
       $count_july_mrc_western_region++;
     } 

     //for nrc
     $july_nrc_month = "07";
    $july_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $july_nrc_month AND $result_region == $july_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $july_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_july_nrc_north_region++;
    }    

    //for eastern region
    $july_nrc_month = "07";
    $july_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $july_nrc_month AND $result_region == $july_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $july_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_july_nrc_eastern_region++;
    } 

     //for eastern region
     $july_nrc_month = "07";
     $july_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $july_nrc_month AND $result_region == $july_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $july_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_july_nrc_western_region++;
     } 
 
     //aug start here
     $aug_mrc_month = "08";
    $aug_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $aug_mrc_month AND $result_region == $aug_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $aug_record_final_total_northen += (int)$new_po_mrc_north;
      $count_aug_mrc_north_region++;
    }    

    //for eastern region
    $aug_mrc_month = "08";
    $aug_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $aug_mrc_month AND $result_region == $aug_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $aug_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_aug_mrc_eastern_region++;
    } 

     //for eastern region
     $aug_mrc_month = "08";
     $aug_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $aug_mrc_month AND $result_region == $aug_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $aug_record_final_total_western += (int)$new_po_mrc_western;
       $count_aug_mrc_western_region++;
     } 

     //for nrc
     $aug_nrc_month = "08";
    $aug_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $aug_nrc_month AND $result_region == $aug_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $aug_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_aug_nrc_north_region++;
    }    

    //for eastern region
    $aug_nrc_month = "08";
    $aug_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $aug_nrc_month AND $result_region == $aug_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $aug_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_aug_nrc_eastern_region++;
    } 

     //for eastern region
     $aug_nrc_month = "08";
     $aug_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $aug_nrc_month AND $result_region == $aug_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $aug_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_aug_nrc_western_region++;
     } 

     //september
     $sep_mrc_month = "09";
    $sep_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $sep_mrc_month AND $result_region == $sep_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $sep_record_final_total_northen += (int)$new_po_mrc_north;
      $count_sep_mrc_north_region++;
    }    

    //for eastern region
    $sep_mrc_month = "09";
    $sep_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $sep_mrc_month AND $result_region == $sep_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $sep_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_sep_mrc_eastern_region++;
    } 

     //for eastern region
     $sep_mrc_month = "09";
     $sep_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $sep_mrc_month AND $result_region == $sep_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $sep_record_final_total_western += (int)$new_po_mrc_western;
       $count_sep_mrc_western_region++;
     } 

     //for nrc
     $sep_nrc_month = "09";
    $sep_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $sep_nrc_month AND $result_region == $sep_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $sep_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_sep_nrc_north_region++;
    }    

    //for eastern region
    $sep_nrc_month = "09";
    $sep_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $sep_nrc_month AND $result_region == $sep_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $sep_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_sep_nrc_eastern_region++;
    } 

     //for eastern region
     $sep_nrc_month = "09";
     $sep_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $sep_nrc_month AND $result_region == $sep_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $sep_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_sep_nrc_western_region++;
     } 

     //oct
     $oct_mrc_month = "10";
    $oct_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $oct_mrc_month AND $result_region == $oct_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $oct_record_final_total_northen += (int)$new_po_mrc_north;
      $count_oct_mrc_north_region++;
    }    

    //for eastern region
    $oct_mrc_month = "10";
    $oct_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $oct_mrc_month AND $result_region == $oct_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $oct_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_oct_mrc_eastern_region++;
    } 

     //for eastern region
     $oct_mrc_month = "10";
     $oct_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $oct_mrc_month AND $result_region == $oct_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $oct_record_final_total_western += (int)$new_po_mrc_western;
       $count_oct_mrc_western_region++;
     } 

     //for nrc
     $oct_nrc_month = "10";
    $oct_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $oct_nrc_month AND $result_region == $oct_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $oct_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_oct_nrc_north_region++;
    }    

    //for eastern region
    $oct_nrc_month = "10";
    $oct_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $oct_nrc_month AND $result_region == $oct_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $oct_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_oct_nrc_eastern_region++;
    } 

     //for eastern region
     $oct_nrc_month = "10";
     $oct_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $oct_nrc_month AND $result_region == $oct_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $oct_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_oct_nrc_western_region++;
     } 

     //nov
     $nov_mrc_month = "11";
    $nov_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $nov_mrc_month AND $result_region == $nov_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $nov_record_final_total_northen += (int)$new_po_mrc_north;
      $count_nov_mrc_north_region++;
    }    

    //for eastern region
    $nov_mrc_month = "11";
    $nov_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $nov_mrc_month AND $result_region == $nov_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $nov_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_nov_mrc_eastern_region++;
    } 

     //for eastern region
     $nov_mrc_month = "11";
     $nov_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $nov_mrc_month AND $result_region == $nov_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $nov_record_final_total_western += (int)$new_po_mrc_western;
       $count_nov_mrc_western_region++;
     } 

     //for nrc
     $nov_nrc_month = "11";
    $nov_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $nov_nrc_month AND $result_region == $nov_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $nov_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_nov_nrc_north_region++;
    }    

    //for eastern region
    $nov_nrc_month = "11";
    $nov_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $nov_nrc_month AND $result_region == $nov_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $nov_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_nov_nrc_eastern_region++;
    } 

     //for eastern region
     $nov_nrc_month = "11";
     $nov_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $nov_nrc_month AND $result_region == $nov_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $nov_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_nov_nrc_western_region++;
     } 

     //dec
     $dec_mrc_month = "12";
    $dec_mrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $dec_mrc_month AND $result_region == $dec_mrc_north_region){
      $po_mrc_north = $result->po_mrc;
      $r_po_mrc_north = str_replace("R","",$po_mrc_north);
      $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
      $dec_record_final_total_northen += (int)$new_po_mrc_north;
      $count_dec_mrc_north_region++;
    }    

    //for eastern region
    $dec_mrc_month = "12";
    $dec_mrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $dec_mrc_month AND $result_region == $dec_mrc_eastern_region){
      $po_mrc_eastern = $result->po_mrc;
      $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
      $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
      $dec_record_final_total_eastern += (int)$new_po_mrc_eastern;
      $count_dec_mrc_eastern_region++;
    } 

     //for eastern region
     $dec_mrc_month = "12";
     $dec_mrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $dec_mrc_month AND $result_region == $dec_mrc_western_region){
       $po_mrc_western = $result->po_mrc;
       $r_po_mrc_western = str_replace("R","",$po_mrc_western);
       $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
       $dec_record_final_total_western += (int)$new_po_mrc_western;
       $count_dec_mrc_western_region++;
     } 

     //for nrc
     $dec_nrc_month = "12";
    $dec_nrc_north_region = "Northern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $dec_nrc_month AND $result_region == $dec_nrc_north_region){
      $po_nrc_north = $result->po_nrc;
      $r_po_nrc_north = str_replace("R","",$po_nrc_north);
      $new_po_nrc_north = str_replace(",","",$r_po_nrc_north);  
      $dec_nrc_record_final_total_northen += (int)$new_po_nrc_north;
      $count_dec_nrc_north_region++;
    }    

    //for eastern region
    $dec_nrc_month = "12";
    $dec_nrc_eastern_region = "Eastern Region";

    //Set static variable
    if($result_year == $currentYear AND $result_month == $dec_nrc_month AND $result_region == $dec_nrc_eastern_region){
      $po_nrc_eastern = $result->po_nrc;
      $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
      $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
      $dec_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
      $count_dec_nrc_eastern_region++;
    } 

     //for eastern region
     $dec_nrc_month = "12";
     $dec_nrc_western_region = "Western Region";
 
     //Set static variable
     if($result_year == $currentYear AND $result_month == $dec_nrc_month AND $result_region == $dec_nrc_western_region){
       $po_nrc_western = $result->po_nrc;
       $r_po_nrc_western = str_replace("R","",$po_nrc_western);
       $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
       $dec_nrc_record_final_total_western += (int)$new_po_nrc_western;
       $count_dec_nrc_western_region++;
     } 

 
  }

  //sum of jan total mrc
  $jan_total_mrc = $jan_record_final_total_eastern + $jan_record_final_total_northen + $jan_record_final_total_western;
  $total_jan_count[] = array($count_jan_mrc_eastern_region,$count_jan_mrc_north_region,$count_jan_mrc_western_region);

  //sum of jan total mrc
  $jan_total_nrc = $jan_nrc_record_final_total_eastern + $jan_nrc_record_final_total_northen + $jan_nrc_record_final_total_western;
  $jan_total_record[] = array("jan_eastern_mrc" => $jan_record_final_total_eastern,"jan_northen_mrc" =>$jan_record_final_total_northen,"jan_western_mrc"
  =>$jan_record_final_total_western,"jan_eastern_nrc" => $jan_nrc_record_final_total_eastern,"jan_northen_nrc" =>$jan_nrc_record_final_total_northen,
  "jan_western_nrc" => $jan_nrc_record_final_total_western,"jan_total_mrc" => $jan_total_mrc, "jan_total_nrc" => $jan_total_nrc);
  // jan end here


  //feb start here
  //sum of feb total mrc
  $feb_total_mrc = $feb_record_final_total_eastern + $feb_record_final_total_northen + $feb_record_final_total_western;
  $total_feb_count[] = array($count_feb_mrc_eastern_region,$count_feb_mrc_north_region,$count_feb_mrc_western_region);
  //sum of feb total mrc
  $feb_total_nrc = $feb_nrc_record_final_total_eastern + $feb_nrc_record_final_total_northen + $feb_nrc_record_final_total_western;
  $feb_total_record[] = array("feb_eastern_mrc" => $feb_record_final_total_eastern,"feb_northen_mrc" =>$feb_record_final_total_northen,"feb_western_mrc"
  =>$feb_record_final_total_western,"feb_eastern_nrc" => $feb_nrc_record_final_total_eastern,"feb_northen_nrc" =>$feb_nrc_record_final_total_northen,
  "feb_western_nrc" => $feb_nrc_record_final_total_western,"feb_total_mrc" => $feb_total_mrc, "feb_total_nrc" => $feb_total_nrc);
  // feb end here  

  //march
  //sum of march total mrc
  $march_total_mrc = $march_record_final_total_eastern + $march_record_final_total_northen + $march_record_final_total_western;
  $total_march_count[] = array($count_march_mrc_eastern_region,$count_march_mrc_north_region,$count_march_mrc_western_region);

  //sum of march total mrc
  $march_total_nrc = $march_nrc_record_final_total_eastern + $march_nrc_record_final_total_northen + $march_nrc_record_final_total_western;
  $march_total_record[] = array("march_eastern_mrc" => $march_record_final_total_eastern,"march_northen_mrc" =>$march_record_final_total_northen,"march_western_mrc"
  =>$march_record_final_total_western,"march_eastern_nrc" => $march_nrc_record_final_total_eastern,"march_northen_nrc" =>$march_nrc_record_final_total_northen,
  "march_western_nrc" => $march_nrc_record_final_total_western,"march_total_mrc" => $march_total_mrc, "march_total_nrc" => $march_total_nrc);
  //march code end here

  //april
  //sum of april total mrc
  $april_total_mrc = $april_record_final_total_eastern + $april_record_final_total_northen + $april_record_final_total_western;
  $total_april_count[] = array($count_april_mrc_eastern_region,$count_april_mrc_north_region,$count_april_mrc_western_region);
  //sum of april total mrc
  $april_total_nrc = $april_nrc_record_final_total_eastern + $april_nrc_record_final_total_northen + $april_nrc_record_final_total_western;
  $april_total_record[] = array("april_eastern_mrc" => $april_record_final_total_eastern,"april_northen_mrc" =>$april_record_final_total_northen,"april_western_mrc"
  =>$april_record_final_total_western,"april_eastern_nrc" => $april_nrc_record_final_total_eastern,"april_northen_nrc" =>$april_nrc_record_final_total_northen,
  "april_western_nrc" => $april_nrc_record_final_total_western,"april_total_mrc" => $april_total_mrc, "april_total_nrc" => $april_total_nrc);
   
  //sum of may total mrc
  $may_total_mrc = $may_record_final_total_eastern + $may_record_final_total_northen + $may_record_final_total_western;
  $total_may_count[] = array($count_may_mrc_eastern_region,$count_may_mrc_north_region,$count_may_mrc_western_region);
  //sum of may total mrc
  $may_total_nrc = $may_nrc_record_final_total_eastern + $may_nrc_record_final_total_northen + $may_nrc_record_final_total_western;
  $may_total_record[] = array("may_eastern_mrc" => $may_record_final_total_eastern,"may_northen_mrc" =>$may_record_final_total_northen,"may_western_mrc"
  =>$may_record_final_total_western,"may_eastern_nrc" => $may_nrc_record_final_total_eastern,"may_northen_nrc" =>$may_nrc_record_final_total_northen,
  "may_western_nrc" => $may_nrc_record_final_total_western,"may_total_mrc" => $may_total_mrc, "may_total_nrc" => $may_total_nrc);
  // May code ends here

  //sum of june total mrc
  $june_total_mrc = $june_record_final_total_eastern + $june_record_final_total_northen + $june_record_final_total_western;
  $total_june_count[] = array($count_june_mrc_eastern_region,$count_june_mrc_north_region,$count_june_mrc_western_region);
  //sum of june total mrc
  $june_total_nrc = $june_nrc_record_final_total_eastern + $june_nrc_record_final_total_northen + $june_nrc_record_final_total_western;
  $june_total_record[] = array("june_eastern_mrc" => $june_record_final_total_eastern,"june_northen_mrc" =>$june_record_final_total_northen,"june_western_mrc"
  =>$june_record_final_total_western,"june_eastern_nrc" => $june_nrc_record_final_total_eastern,"june_northen_nrc" =>$june_nrc_record_final_total_northen,
  "june_western_nrc" => $june_nrc_record_final_total_western,"june_total_mrc" => $june_total_mrc, "june_total_nrc" => $june_total_nrc);
  // june code end here

  //sum of july total mrc
  $july_total_mrc = $july_record_final_total_eastern + $july_record_final_total_northen + $july_record_final_total_western;
  $total_july_count[] = array($count_july_mrc_eastern_region,$count_july_mrc_north_region,$count_july_mrc_western_region);
  //sum of july total mrc
  $july_total_nrc = $july_nrc_record_final_total_eastern + $july_nrc_record_final_total_northen + $july_nrc_record_final_total_western;
  $july_total_record[] = array("july_eastern_mrc" => $july_record_final_total_eastern,"july_northen_mrc" =>$july_record_final_total_northen,"july_western_mrc"
  =>$july_record_final_total_western,"july_eastern_nrc" => $july_nrc_record_final_total_eastern,"july_northen_nrc" =>$july_nrc_record_final_total_northen,
  "july_western_nrc" => $july_nrc_record_final_total_western,"july_total_mrc" => $july_total_mrc, "july_total_nrc" => $july_total_nrc);
  // july code end here
  //sum of aug total mrc
  $aug_total_mrc = $aug_record_final_total_eastern + $aug_record_final_total_northen + $aug_record_final_total_western;
  $total_aug_count[] = array($count_aug_mrc_eastern_region,$count_aug_mrc_north_region,$count_aug_mrc_western_region);
  //sum of aug total mrc
  $aug_total_nrc = $aug_nrc_record_final_total_eastern + $aug_nrc_record_final_total_northen + $aug_nrc_record_final_total_western;
  $aug_total_record[] = array("aug_eastern_mrc" => $aug_record_final_total_eastern,"aug_northen_mrc" =>$aug_record_final_total_northen,"aug_western_mrc"
  =>$aug_record_final_total_western,"aug_eastern_nrc" => $aug_nrc_record_final_total_eastern,"aug_northen_nrc" =>$aug_nrc_record_final_total_northen,
  "aug_western_nrc" => $aug_nrc_record_final_total_western,"aug_total_mrc" => $aug_total_mrc, "aug_total_nrc" => $aug_total_nrc);
  // aug code end here
  //sum of sep total mrc
  $sep_total_mrc = $sep_record_final_total_eastern + $sep_record_final_total_northen + $sep_record_final_total_western;
  $total_sep_count[] = array($count_sep_mrc_eastern_region,$count_sep_mrc_north_region,$count_sep_mrc_western_region);
  //sum of sep total mrc
  $sep_total_nrc = $sep_nrc_record_final_total_eastern + $sep_nrc_record_final_total_northen + $sep_nrc_record_final_total_western;
  $sep_total_record[] = array("sep_eastern_mrc" => $sep_record_final_total_eastern,"sep_northen_mrc" =>$sep_record_final_total_northen,"sep_western_mrc"
  =>$sep_record_final_total_western,"sep_eastern_nrc" => $sep_nrc_record_final_total_eastern,"sep_northen_nrc" =>$sep_nrc_record_final_total_northen,
  "sep_western_nrc" => $sep_nrc_record_final_total_western,"sep_total_mrc" => $sep_total_mrc, "sep_total_nrc" => $sep_total_nrc);
  // sep code end here
  //sum of oct total mrc
  $oct_total_mrc = $oct_record_final_total_eastern + $oct_record_final_total_northen + $oct_record_final_total_western;
  $total_oct_count[] = array($count_oct_mrc_eastern_region,$count_oct_mrc_north_region,$count_oct_mrc_western_region);
  //sum of oct total mrc
  $oct_total_nrc = $oct_nrc_record_final_total_eastern + $oct_nrc_record_final_total_northen + $oct_nrc_record_final_total_western;
  $oct_total_record[] = array("oct_eastern_mrc" => $oct_record_final_total_eastern,"oct_northen_mrc" =>$oct_record_final_total_northen,"oct_western_mrc"
  =>$oct_record_final_total_western,"oct_eastern_nrc" => $oct_nrc_record_final_total_eastern,"oct_northen_nrc" =>$oct_nrc_record_final_total_northen,
  "oct_western_nrc" => $oct_nrc_record_final_total_western,"oct_total_mrc" => $oct_total_mrc, "oct_total_nrc" => $oct_total_nrc);
  // oct code end here
  //sum of nov total mrc
  $nov_total_mrc = $nov_record_final_total_eastern + $nov_record_final_total_northen + $nov_record_final_total_western;
  $total_nov_count[] = array($count_nov_mrc_eastern_region,$count_nov_mrc_north_region,$count_nov_mrc_western_region);
  //sum of nov total mrc
  $nov_total_nrc = $nov_nrc_record_final_total_eastern + $nov_nrc_record_final_total_northen + $nov_nrc_record_final_total_western;
  $nov_total_record[] = array("nov_eastern_mrc" => $nov_record_final_total_eastern,"nov_northen_mrc" =>$nov_record_final_total_northen,"nov_western_mrc"
  =>$nov_record_final_total_western,"nov_eastern_nrc" => $nov_nrc_record_final_total_eastern,"nov_northen_nrc" =>$nov_nrc_record_final_total_northen,
  "nov_western_nrc" => $nov_nrc_record_final_total_western,"nov_total_mrc" => $nov_total_mrc, "nov_total_nrc" => $nov_total_nrc);
  // nov code end here
  //sum of dec total mrc
  $dec_total_mrc = $dec_record_final_total_eastern + $dec_record_final_total_northen + $dec_record_final_total_western;
  $total_dec_count[] = array($count_dec_mrc_eastern_region,$count_dec_mrc_north_region,$count_dec_mrc_western_region);
  //sum of dec total mrc
  $dec_total_nrc = $dec_nrc_record_final_total_eastern + $dec_nrc_record_final_total_northen + $dec_nrc_record_final_total_western;
  $dec_total_record[] = array("dec_eastern_mrc" => $dec_record_final_total_eastern,"dec_northen_mrc" =>$dec_record_final_total_northen,"dec_western_mrc"
  =>$dec_record_final_total_western,"dec_eastern_nrc" => $dec_nrc_record_final_total_eastern,"dec_northen_nrc" =>$dec_nrc_record_final_total_northen,
  "dec_western_nrc" => $dec_nrc_record_final_total_western,"dec_total_mrc" => $dec_total_mrc, "dec_total_nrc" => $dec_total_nrc);
  // dec code end here

  
  
    $view =  view('admin/main-dashboard/monthly-dashboard', compact('feb_total_record','jan_total_record','march_total_record','april_total_record','may_total_record','june_total_record',
    'july_total_record','aug_total_record','total_july_count','total_june_count','total_may_count','total_april_count','total_march_count',
    'total_jan_count','total_feb_count','total_aug_count','total_sep_count','sep_total_record','total_oct_count',
    'oct_total_record','total_nov_count','nov_total_record','total_dec_count','dec_total_record'));
    return $view;
  }

  public function toc_recieved_monthy_dashboard(Request $request){

    //check year
    $currentYear = date('Y');
    if($request->year == '2023'){
      $currentYear = '2023';
    } elseif($request->year == '2024'){
      $currentYear = date('Y');
    }

     //jan start here

     $jan_mrc_record_northen_region =   DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Northern Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', '1')
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray(); 
     //echo "<pre>"; print_r($jan_mrc_record_northen_region);exit;  
     $count_jan_mrc_north_region = count($jan_mrc_record_northen_region);
     $jan_record_final_total_northen = 0;
      foreach($jan_mrc_record_northen_region as $jan_north_region_mrc){
           $po_mrc_north = $jan_north_region_mrc->po_mrc;
           $r_po_mrc_north = str_replace("R","",$po_mrc_north);
           $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
           $jan_record_final_total_northen += (int)$new_po_mrc_north;
      }
       
     $jan_mrc_record_eastern_region =  DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '1')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();

     $count_jan_mrc_eastern_region = count($jan_mrc_record_eastern_region); 
     $jan_record_final_total_eastern = 0;
       foreach($jan_mrc_record_eastern_region as $jan_eastern_region_mrc){
             $po_mrc_eastern = $jan_eastern_region_mrc->po_mrc;
             $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
             $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
             $jan_record_final_total_eastern += (int)$new_po_mrc_eastern;
      }  

     $jan_mrc_record_western_region =  DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '1')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
     
     $count_jan_mrc_western_region = count($jan_mrc_record_western_region);  
     $jan_record_final_total_western= 0;
       foreach($jan_mrc_record_western_region as $jan_western_region_mrc){
             $po_mrc_western = $jan_western_region_mrc->po_mrc;
             $r_po_mrc_western = str_replace("R","",$po_mrc_western);
             $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
             $jan_record_final_total_western += (int)$new_po_mrc_western;
      }  

     //sum of jan total mrc
     $jan_total_mrc = $jan_record_final_total_eastern + $jan_record_final_total_northen + $jan_record_final_total_western;
     //total jan count
     $total_jan_count[] = array($count_jan_mrc_eastern_region,$count_jan_mrc_north_region,$count_jan_mrc_western_region);

      $jan_nrc_record_western_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Western Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', '1')
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();
      
       $jan_nrc_record_final_total_western= 0;
       foreach($jan_nrc_record_western_region as $jan_western_region_nrc){
             $po_nrc_western = $jan_western_region_nrc->po_nrc;
             $r_po_nrc_western = str_replace("R","",$po_nrc_western);
             $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
             $jan_nrc_record_final_total_western += (int)$new_po_nrc_western;
      }
      
      $jan_nrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '1')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
      
       $jan_nrc_record_final_total_eastern= 0;
      foreach($jan_nrc_record_eastern_region as $jan_eastern_region_nrc){
            $po_nrc_eastern = $jan_eastern_region_nrc->po_nrc;
            $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
            $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
            $jan_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
     }  

     $jan_nrc_record_northen_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', '1')
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();
     
       $jan_nrc_record_final_total_northen= 0;
      foreach($jan_nrc_record_northen_region as $jan_northen_region_nrc){
            $po_nrc_northen = $jan_northen_region_nrc->po_nrc;
            $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
            $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
            $jan_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
     } 

     //sum of jan total mrc
     $jan_total_nrc = $jan_nrc_record_final_total_eastern + $jan_nrc_record_final_total_northen + $jan_nrc_record_final_total_western;
     $jan_total_record[] = array("jan_eastern_mrc" => $jan_record_final_total_eastern,"jan_northen_mrc" =>$jan_record_final_total_northen,"jan_western_mrc"
     =>$jan_record_final_total_western,"jan_eastern_nrc" => $jan_nrc_record_final_total_eastern,"jan_northen_nrc" =>$jan_nrc_record_final_total_northen,
     "jan_western_nrc" => $jan_nrc_record_final_total_western,"jan_total_mrc" => $jan_total_mrc, "jan_total_nrc" => $jan_total_nrc);
    // jan end here

    // feb code start here
     $feb_mrc_record_northen_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', '2')
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();
     
     //echo "<pre>"; print_r($feb_mrc_record_northen_region);exit;  
     $count_feb_mrc_north_region = count($feb_mrc_record_northen_region);
     $feb_record_final_total_northen = 0;
      foreach($feb_mrc_record_northen_region as $feb_north_region_mrc){
           $po_mrc_north = $feb_north_region_mrc->po_mrc;
           $r_po_mrc_north = str_replace("R","",$po_mrc_north);
           $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
           $feb_record_final_total_northen += (int)$new_po_mrc_north;
      }
       
     $feb_mrc_record_eastern_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Eastern Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', '2')
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();
     
     $count_feb_mrc_eastern_region = count($feb_mrc_record_eastern_region); 
     $feb_record_final_total_eastern = 0;
       foreach($feb_mrc_record_eastern_region as $feb_eastern_region_mrc){
             $po_mrc_eastern = $feb_eastern_region_mrc->po_mrc;
             $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
             $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
             $feb_record_final_total_eastern += (int)$new_po_mrc_eastern;
      }  

     $feb_mrc_record_western_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '2')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();

     $count_feb_mrc_western_region = count($feb_mrc_record_western_region);  
     $feb_record_final_total_western= 0;
       foreach($feb_mrc_record_western_region as $feb_western_region_mrc){
             $po_mrc_western = $feb_western_region_mrc->po_mrc;
             $r_po_mrc_western = str_replace("R","",$po_mrc_western);
             $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
             $feb_record_final_total_western += (int)$new_po_mrc_western;
      }  

     //sum of feb total mrc
     $feb_total_mrc = $feb_record_final_total_eastern + $feb_record_final_total_northen + $feb_record_final_total_western;
     //total feb count
     $total_feb_count[] = array($count_feb_mrc_eastern_region,$count_feb_mrc_north_region,$count_feb_mrc_western_region);

      $feb_nrc_record_western_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Western Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', '2')
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();
      
       $feb_nrc_record_final_total_western= 0;
       foreach($feb_nrc_record_western_region as $feb_western_region_nrc){
             $po_nrc_western = $feb_western_region_nrc->po_nrc;
             $r_po_nrc_western = str_replace("R","",$po_nrc_western);
             $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
             $feb_nrc_record_final_total_western += (int)$new_po_nrc_western;
      }
      
      $feb_nrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '2')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();

       $feb_nrc_record_final_total_eastern= 0;
      foreach($feb_nrc_record_eastern_region as $feb_eastern_region_nrc){
            $po_nrc_eastern = $feb_eastern_region_nrc->po_nrc;
            $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
            $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
            $feb_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
     }  

     $feb_nrc_record_northen_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Northern Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', '2')
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();

      $feb_nrc_record_final_total_northen= 0;
      foreach($feb_nrc_record_northen_region as $feb_northen_region_nrc){
            $po_nrc_northen = $feb_northen_region_nrc->po_nrc;
            $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
            $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
            $feb_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
     } 

     //sum of feb total mrc
     $feb_total_nrc = $feb_nrc_record_final_total_eastern + $feb_nrc_record_final_total_northen + $feb_nrc_record_final_total_western;
     $feb_total_record[] = array("feb_eastern_mrc" => $feb_record_final_total_eastern,"feb_northen_mrc" =>$feb_record_final_total_northen,"feb_western_mrc"
     =>$feb_record_final_total_western,"feb_eastern_nrc" => $feb_nrc_record_final_total_eastern,"feb_northen_nrc" =>$feb_nrc_record_final_total_northen,
     "feb_western_nrc" => $feb_nrc_record_final_total_western,"feb_total_mrc" => $feb_total_mrc, "feb_total_nrc" => $feb_total_nrc);

     // feb code ends here
    //march start here
    $march_mrc_record_northen_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Northern Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', '3')
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
    
    //echo "<pre>"; print_r($march_mrc_record_northen_region);exit;  
    $count_march_mrc_north_region = count($march_mrc_record_northen_region);
    $march_record_final_total_northen = 0;
     foreach($march_mrc_record_northen_region as $march_north_region_mrc){
          $po_mrc_north = $march_north_region_mrc->po_mrc;
          $r_po_mrc_north = str_replace("R","",$po_mrc_north);
          $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
          $march_record_final_total_northen += (int)$new_po_mrc_north;
     }
      
    $march_mrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '3')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();

    $count_march_mrc_eastern_region = count($march_mrc_record_eastern_region); 
    $march_record_final_total_eastern = 0;
      foreach($march_mrc_record_eastern_region as $march_eastern_region_mrc){
            $po_mrc_eastern = $march_eastern_region_mrc->po_mrc;
            $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
            $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
            $march_record_final_total_eastern += (int)$new_po_mrc_eastern;
     }  

    $march_mrc_record_western_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Western Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', '3')
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
    
    $count_march_mrc_western_region = count($march_mrc_record_western_region);  
    $march_record_final_total_western= 0;
      foreach($march_mrc_record_western_region as $march_western_region_mrc){
            $po_mrc_western = $march_western_region_mrc->po_mrc;
            $r_po_mrc_western = str_replace("R","",$po_mrc_western);
            $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
            $march_record_final_total_western += (int)$new_po_mrc_western;
     }  

    //sum of march total mrc
    $march_total_mrc = $march_record_final_total_eastern + $march_record_final_total_northen + $march_record_final_total_western;
    //total march count
    $total_march_count[] = array($count_march_mrc_eastern_region,$count_march_mrc_north_region,$count_march_mrc_western_region);

     $march_nrc_record_western_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '3')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
     
     
      $march_nrc_record_final_total_western= 0;
      foreach($march_nrc_record_western_region as $march_western_region_nrc){
            $po_nrc_western = $march_western_region_nrc->po_nrc;
            $r_po_nrc_western = str_replace("R","",$po_nrc_western);
            $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
            $march_nrc_record_final_total_western += (int)$new_po_nrc_western;
     }
     
     $march_nrc_record_eastern_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Eastern Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', '3')
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
     
     
      $march_nrc_record_final_total_eastern= 0;
     foreach($march_nrc_record_eastern_region as $march_eastern_region_nrc){
           $po_nrc_eastern = $march_eastern_region_nrc->po_nrc;
           $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
           $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
           $march_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
    }  

    $march_nrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '3')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
      $march_nrc_record_final_total_northen= 0;
     foreach($march_nrc_record_northen_region as $march_northen_region_nrc){
           $po_nrc_northen = $march_northen_region_nrc->po_nrc;
           $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
           $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
           $march_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
    } 

    //sum of march total mrc
    $march_total_nrc = $march_nrc_record_final_total_eastern + $march_nrc_record_final_total_northen + $march_nrc_record_final_total_western;
    $march_total_record[] = array("march_eastern_mrc" => $march_record_final_total_eastern,"march_northen_mrc" =>$march_record_final_total_northen,"march_western_mrc"
    =>$march_record_final_total_western,"march_eastern_nrc" => $march_nrc_record_final_total_eastern,"march_northen_nrc" =>$march_nrc_record_final_total_northen,
    "march_western_nrc" => $march_nrc_record_final_total_western,"march_total_mrc" => $march_total_mrc, "march_total_nrc" => $march_total_nrc);

    //march code end here

    //april start here
    $april_mrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '4')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();


    $count_april_mrc_north_region = count($april_mrc_record_northen_region);  
    $april_record_final_total_northen = 0;
    foreach($april_mrc_record_northen_region as $april_north_region_mrc){
        $po_mrc_north = $april_north_region_mrc->po_mrc;
        $r_po_mrc_north = str_replace("R","",$po_mrc_north);
        $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
        $april_record_final_total_northen += (int)$new_po_mrc_north;
    }

    $april_mrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '4')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    $count_april_mrc_eastern_region = count($april_mrc_record_eastern_region); 
    $april_record_final_total_eastern = 0;
    foreach($april_mrc_record_eastern_region as $april_eastern_region_mrc){
        $po_mrc_eastern = $april_eastern_region_mrc->po_mrc;
        $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
        $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
        $april_record_final_total_eastern += (int)$new_po_mrc_eastern;
    }  

    $april_mrc_record_western_region =  DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '4')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    $count_april_mrc_western_region = count($april_mrc_record_western_region); 
    $april_record_final_total_western= 0;
    foreach($april_mrc_record_western_region as $april_western_region_mrc){
        $po_mrc_western = $april_western_region_mrc->po_mrc;
        $r_po_mrc_western = str_replace("R","",$po_mrc_western);
        $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
        $april_record_final_total_western += (int)$new_po_mrc_western;
    }  

    //sum of april total mrc
    $april_total_mrc = $april_record_final_total_eastern + $april_record_final_total_northen + $april_record_final_total_western;
   //total april count
   $total_april_count[] = array($count_april_mrc_eastern_region,$count_april_mrc_north_region,$count_april_mrc_western_region);

    $april_nrc_record_western_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Western Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', '4')
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
    
    $april_nrc_record_final_total_western= 0;
    foreach($april_nrc_record_western_region as $april_western_region_nrc){
        $po_nrc_western = $april_western_region_nrc->po_nrc;
        $r_po_nrc_western = str_replace("R","",$po_nrc_western);
        $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
        $april_nrc_record_final_total_western += (int)$new_po_nrc_western;
    }

    $april_nrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '4')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $april_nrc_record_final_total_eastern= 0;
    foreach($april_nrc_record_eastern_region as $april_eastern_region_nrc){
        $po_nrc_eastern = $april_eastern_region_nrc->po_nrc;
        $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
        $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
        $april_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
    }  

    $april_nrc_record_northen_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Northern Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', '4')
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
    
    $april_nrc_record_final_total_northen= 0;
    foreach($april_nrc_record_northen_region as $april_northen_region_nrc){
        $po_nrc_northen = $april_northen_region_nrc->po_nrc;
        $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
        $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
        $april_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
    } 

    //sum of april total mrc
    $april_total_nrc = $april_nrc_record_final_total_eastern + $april_nrc_record_final_total_northen + $april_nrc_record_final_total_western;
    $april_total_record[] = array("april_eastern_mrc" => $april_record_final_total_eastern,"april_northen_mrc" =>$april_record_final_total_northen,"april_western_mrc"
    =>$april_record_final_total_western,"april_eastern_nrc" => $april_nrc_record_final_total_eastern,"april_northen_nrc" =>$april_nrc_record_final_total_northen,
    "april_western_nrc" => $april_nrc_record_final_total_western,"april_total_mrc" => $april_total_mrc, "april_total_nrc" => $april_total_nrc);

    //april code end here
    //may start here
    $may_mrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '5')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();

    //echo "<pre>"; print_r($may_mrc_record_northen_region);exit;
    $count_may_mrc_north_region = count($may_mrc_record_northen_region);   
    $may_record_final_total_northen = 0;
    foreach($may_mrc_record_northen_region as $may_north_region_mrc){
        $po_mrc_north = $may_north_region_mrc->po_mrc;
        $r_po_mrc_north = str_replace("R","",$po_mrc_north);
        $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
        $may_record_final_total_northen += (int)$new_po_mrc_north;
    }
    
    $may_mrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '5')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $count_may_mrc_eastern_region = count($may_mrc_record_eastern_region);   
    $may_record_final_total_eastern = 0;
    foreach($may_mrc_record_eastern_region as $may_eastern_region_mrc){
            $po_mrc_eastern = $may_eastern_region_mrc->po_mrc;
            $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
            $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
            $may_record_final_total_eastern += (int)$new_po_mrc_eastern;
    }  

    $may_mrc_record_western_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '5')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $count_may_mrc_western_region = count($may_mrc_record_western_region); 
    $may_record_final_total_western= 0;
    foreach($may_mrc_record_western_region as $may_western_region_mrc){
            $po_mrc_western = $may_western_region_mrc->po_mrc;
            $r_po_mrc_western = str_replace("R","",$po_mrc_western);
            $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
            $may_record_final_total_western += (int)$new_po_mrc_western;
    }  

    //sum of may total mrc
    $may_total_mrc = $may_record_final_total_eastern + $may_record_final_total_northen + $may_record_final_total_western;
    // toatl april mrc
    $total_may_count[] = array($count_may_mrc_eastern_region,$count_may_mrc_north_region,$count_may_mrc_western_region);

    $may_nrc_record_western_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '5')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    $may_nrc_record_final_total_western= 0;
    foreach($may_nrc_record_western_region as $may_western_region_nrc){
            $po_nrc_western = $may_western_region_nrc->po_nrc;
            $r_po_nrc_western = str_replace("R","",$po_nrc_western);
            $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
            $may_nrc_record_final_total_western += (int)$new_po_nrc_western;
    }
    
    $may_nrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '5')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $may_nrc_record_final_total_eastern= 0;
    foreach($may_nrc_record_eastern_region as $may_eastern_region_nrc){
        $po_nrc_eastern = $may_eastern_region_nrc->po_nrc;
        $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
        $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
        $may_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
    }  

    $may_nrc_record_northen_region =  DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', '5')
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $may_nrc_record_final_total_northen= 0;
    foreach($may_nrc_record_northen_region as $may_northen_region_nrc){
        $po_nrc_northen = $may_northen_region_nrc->po_nrc;
        $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
        $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
        $may_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
    } 

    //sum of may total mrc
    $may_total_nrc = $may_nrc_record_final_total_eastern + $may_nrc_record_final_total_northen + $may_nrc_record_final_total_western;
    $may_total_record[] = array("may_eastern_mrc" => $may_record_final_total_eastern,"may_northen_mrc" =>$may_record_final_total_northen,"may_western_mrc"
    =>$may_record_final_total_western,"may_eastern_nrc" => $may_nrc_record_final_total_eastern,"may_northen_nrc" =>$may_nrc_record_final_total_northen,
    "may_western_nrc" => $may_nrc_record_final_total_western,"may_total_mrc" => $may_total_mrc, "may_total_nrc" => $may_total_nrc);

    // may code end here
    //june start here
    $june_mrc_record_northen_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Northern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 6)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();
                                          
    //echo "<pre>"; print_r($june_mrc_record_northen_region);exit; 
    $count_june_mrc_north_region = count($june_mrc_record_northen_region);  
    $june_record_final_total_northen = 0;
    foreach($june_mrc_record_northen_region as $june_north_region_mrc){
        $po_mrc_north = $june_north_region_mrc->po_mrc;
        $r_po_mrc_north = str_replace("R","",$po_mrc_north);
        $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
        $june_record_final_total_northen += (int)$new_po_mrc_north;
    }
    
    $june_mrc_record_eastern_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Eastern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 6)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();
    
    
    $count_june_mrc_eastern_region = count($june_mrc_record_eastern_region); 
    $june_record_final_total_eastern = 0;
    foreach($june_mrc_record_eastern_region as $june_eastern_region_mrc){
            $po_mrc_eastern = $june_eastern_region_mrc->po_mrc;
            $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
            $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
            $june_record_final_total_eastern += (int)$new_po_mrc_eastern;
    }  

    $june_mrc_record_western_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Western Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', 6)
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
    
    $count_june_mrc_western_region = count($june_mrc_record_western_region); 
    $june_record_final_total_western= 0;
    foreach($june_mrc_record_western_region as $june_western_region_mrc){
            $po_mrc_western = $june_western_region_mrc->po_mrc;
            $r_po_mrc_western = str_replace("R","",$po_mrc_western);
            $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
            $june_record_final_total_western += (int)$new_po_mrc_western;
    }  

    //sum of june total mrc
    $june_total_mrc = $june_record_final_total_eastern + $june_record_final_total_northen + $june_record_final_total_western;
    //total june mrc
    $total_june_count[] = array($count_june_mrc_eastern_region,$count_june_mrc_north_region,$count_june_mrc_western_region);

    $june_nrc_record_western_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 6)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $june_nrc_record_final_total_western= 0;
    foreach($june_nrc_record_western_region as $june_western_region_nrc){
            $po_nrc_western = $june_western_region_nrc->po_nrc;
            $r_po_nrc_western = str_replace("R","",$po_nrc_western);
            $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
            $june_nrc_record_final_total_western += (int)$new_po_nrc_western;
    }
    
    $june_nrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 6)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $june_nrc_record_final_total_eastern= 0;
    foreach($june_nrc_record_eastern_region as $june_eastern_region_nrc){
        $po_nrc_eastern = $june_eastern_region_nrc->po_nrc;
        $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
        $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
        $june_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
    }  

    $june_nrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 6)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $june_nrc_record_final_total_northen= 0;
    foreach($june_nrc_record_northen_region as $june_northen_region_nrc){
        $po_nrc_northen = $june_northen_region_nrc->po_nrc;
        $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
        $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
        $june_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
    } 

    //sum of june total mrc
    $june_total_nrc = $june_nrc_record_final_total_eastern + $june_nrc_record_final_total_northen + $june_nrc_record_final_total_western;
    $june_total_record[] = array("june_eastern_mrc" => $june_record_final_total_eastern,"june_northen_mrc" =>$june_record_final_total_northen,"june_western_mrc"
    =>$june_record_final_total_western,"june_eastern_nrc" => $june_nrc_record_final_total_eastern,"june_northen_nrc" =>$june_nrc_record_final_total_northen,
    "june_western_nrc" => $june_nrc_record_final_total_western,"june_total_mrc" => $june_total_mrc, "june_total_nrc" => $june_total_nrc);

     // june code ends here

    //july start here
    $july_mrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 7)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    //echo "<pre>"; print_r($july_mrc_record_northen_region);exit;  
    $count_july_mrc_north_region = count($july_mrc_record_northen_region); 
    $july_record_final_total_northen = 0;
    foreach($july_mrc_record_northen_region as $july_north_region_mrc){
        $po_mrc_north = $july_north_region_mrc->po_mrc;
        $r_po_mrc_north = str_replace("R","",$po_mrc_north);
        $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
        $july_record_final_total_northen += (int)$new_po_mrc_north;
    }
    
    $july_mrc_record_eastern_region = DB::table('build_master_file_records')
                              ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                              ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                              ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                              ->where('site_master_file_records.region','Eastern Region')
                              ->whereYear('toc_received', $currentYear)
                              ->whereMonth('toc_received', 7)
                              ->whereNotNull('build_master_file_records.toc_received') 
                              ->get()->toArray();

    $count_july_mrc_eastern_region = count($july_mrc_record_eastern_region); 
    $july_record_final_total_eastern = 0;
    foreach($july_mrc_record_eastern_region as $july_eastern_region_mrc){
            $po_mrc_eastern = $july_eastern_region_mrc->po_mrc;
            $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
            $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
            $july_record_final_total_eastern += (int)$new_po_mrc_eastern;
    }  

    $july_mrc_record_western_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Western Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 7)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    $count_july_mrc_western_region = count($july_mrc_record_western_region);
    $july_record_final_total_western= 0;
    foreach($july_mrc_record_western_region as $july_western_region_mrc){
            $po_mrc_western = $july_western_region_mrc->po_mrc;
            $r_po_mrc_western = str_replace("R","",$po_mrc_western);
            $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
            $july_record_final_total_western += (int)$new_po_mrc_western;
    }  

    //sum of july total mrc
    $july_total_mrc = $july_record_final_total_eastern + $july_record_final_total_northen + $july_record_final_total_western;
    
    //total july mrc
    $total_july_count[] = array($count_july_mrc_eastern_region,$count_july_mrc_north_region,$count_july_mrc_western_region);
    //echo "<pre>"; print_r($total_july_count);exit;
    $july_nrc_record_western_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Western Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', 7)
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
    
    $july_nrc_record_final_total_western= 0;
    foreach($july_nrc_record_western_region as $july_western_region_nrc){
            $po_nrc_western = $july_western_region_nrc->po_nrc;
            $r_po_nrc_western = str_replace("R","",$po_nrc_western);
            $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
            $july_nrc_record_final_total_western += (int)$new_po_nrc_western;
    }
    
    $july_nrc_record_eastern_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Eastern Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', 7)
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();

    
    
    $july_nrc_record_final_total_eastern= 0;
    foreach($july_nrc_record_eastern_region as $july_eastern_region_nrc){
        $po_nrc_eastern = $july_eastern_region_nrc->po_nrc;
        $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
        $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
        $july_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
    }  

    $july_nrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 7)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();

    
    $july_nrc_record_final_total_northen= 0;
    foreach($july_nrc_record_northen_region as $july_northen_region_nrc){
        $po_nrc_northen = $july_northen_region_nrc->po_nrc;
        $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
        $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
        $july_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
    } 

    //sum of july total mrc
    $july_total_nrc = $july_nrc_record_final_total_eastern + $july_nrc_record_final_total_northen + $july_nrc_record_final_total_western;
    $july_total_record[] = array("july_eastern_mrc" => $july_record_final_total_eastern,"july_northen_mrc" =>$july_record_final_total_northen,"july_western_mrc"
    =>$july_record_final_total_western,"july_eastern_nrc" => $july_nrc_record_final_total_eastern,"july_northen_nrc" =>$july_nrc_record_final_total_northen,
    "july_western_nrc" => $july_nrc_record_final_total_western,"july_total_mrc" => $july_total_mrc, "july_total_nrc" => $july_total_nrc); 
   
            //aug start here
            $aug_mrc_record_northen_region = DB::table('build_master_file_records')
                                            ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                            ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->where('site_master_file_records.region','Northern Region')
                                            ->whereYear('toc_received', $currentYear)
                                            ->whereMonth('toc_received', 8)
                                            ->whereNotNull('build_master_file_records.toc_received') 
                                            ->get()->toArray();
            
            //echo "<pre>"; print_r($aug_mrc_record_northen_region);exit;  
            $count_aug_mrc_north_region = count($aug_mrc_record_northen_region); 
            $aug_record_final_total_northen = 0;
            foreach($aug_mrc_record_northen_region as $aug_north_region_mrc){
                $po_mrc_north = $aug_north_region_mrc->po_mrc;
                $r_po_mrc_north = str_replace("R","",$po_mrc_north);
                $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
                $aug_record_final_total_northen += (int)$new_po_mrc_north;
            }
            
            $aug_mrc_record_eastern_region = DB::table('build_master_file_records')
                                                  ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                                  ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                  ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                  ->where('site_master_file_records.region','Eastern Region')
                                                  ->whereYear('toc_received', $currentYear)
                                                  ->whereMonth('toc_received', 8)
                                                  ->whereNotNull('build_master_file_records.toc_received') 
                                                  ->get()->toArray();
  
            $count_aug_mrc_eastern_region = count($aug_mrc_record_eastern_region); 
            //print_r($aug_mrc_record_eastern_region);exit;
            $aug_record_final_total_eastern = 0;
            foreach($aug_mrc_record_eastern_region as $aug_eastern_region_mrc){
                    $po_mrc_eastern = $aug_eastern_region_mrc->po_mrc;
                    $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
                    $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
                    $aug_record_final_total_eastern += (int)$new_po_mrc_eastern;
            }  
  
            $aug_mrc_record_western_region = DB::table('build_master_file_records')
                                                ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                                ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                ->where('site_master_file_records.region','Western Region')
                                                ->whereYear('toc_received', $currentYear)
                                                ->whereMonth('toc_received', 8)
                                                ->whereNotNull('build_master_file_records.toc_received') 
                                                ->get()->toArray();
            
            $count_aug_mrc_western_region = count($aug_mrc_record_western_region);
            $aug_record_final_total_western= 0;
            foreach($aug_mrc_record_western_region as $aug_western_region_mrc){
                    $po_mrc_western = $aug_western_region_mrc->po_mrc;
                    $r_po_mrc_western = str_replace("R","",$po_mrc_western);
                    $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
                    $aug_record_final_total_western += (int)$new_po_mrc_western;
            }  
  
            //sum of aug total mrc
            $aug_total_mrc = $aug_record_final_total_eastern + $aug_record_final_total_northen + $aug_record_final_total_western;
            
            //total aug mrc
            $total_aug_count[] = array($count_aug_mrc_eastern_region,$count_aug_mrc_north_region,$count_aug_mrc_western_region);
            //echo "<pre>"; print_r($total_aug_count);exit;
            $aug_nrc_record_western_region = DB::table('build_master_file_records')
                                              ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                              ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->where('site_master_file_records.region','Western Region')
                                              ->whereYear('toc_received', $currentYear)
                                              ->whereMonth('toc_received', 8)
                                              ->whereNotNull('build_master_file_records.toc_received') 
                                              ->get()->toArray();
              
            
            $aug_nrc_record_final_total_western= 0;
            foreach($aug_nrc_record_western_region as $aug_western_region_nrc){
                    $po_nrc_western = $aug_western_region_nrc->po_nrc;
                    $r_po_nrc_western = str_replace("R","",$po_nrc_western);
                    $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
                    $aug_nrc_record_final_total_western += (int)$new_po_nrc_western;
            }
            
            $aug_nrc_record_eastern_region = DB::table('build_master_file_records')
                                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                    ->where('site_master_file_records.region','Eastern Region')
                                                    ->whereYear('toc_received', $currentYear)
                                                    ->whereMonth('toc_received', 8)
                                                    ->whereNotNull('build_master_file_records.toc_received') 
                                                    ->get()->toArray();

            $aug_nrc_record_final_total_eastern= 0;
            foreach($aug_nrc_record_eastern_region as $aug_eastern_region_nrc){
                $po_nrc_eastern = $aug_eastern_region_nrc->po_nrc;
                $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
                $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
                $aug_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
            }  
  
            $aug_nrc_record_northen_region = DB::table('build_master_file_records')
                                                ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                                ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                                ->where('site_master_file_records.region','Northern Region')
                                                ->whereYear('toc_received', $currentYear)
                                                ->whereMonth('toc_received', 8)
                                                ->whereNotNull('build_master_file_records.toc_received') 
                                                ->get()->toArray();
            
          
            $aug_nrc_record_final_total_northen= 0;
            foreach($aug_nrc_record_northen_region as $aug_northen_region_nrc){
                $po_nrc_northen = $aug_northen_region_nrc->po_nrc;
                $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
                $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
                $aug_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
            } 
  
            //sum of aug total mrc
            $aug_total_nrc = $aug_nrc_record_final_total_eastern + $aug_nrc_record_final_total_northen + $aug_nrc_record_final_total_western;
            $aug_total_record[] = array("aug_eastern_mrc" => $aug_record_final_total_eastern,"aug_northen_mrc" =>$aug_record_final_total_northen,"aug_western_mrc"
            =>$aug_record_final_total_western,"aug_eastern_nrc" => $aug_nrc_record_final_total_eastern,"aug_northen_nrc" =>$aug_nrc_record_final_total_northen,
            "aug_western_nrc" => $aug_nrc_record_final_total_western,"aug_total_mrc" => $aug_total_mrc, "aug_total_nrc" => $aug_total_nrc);
  
            //sep start here
          $sep_mrc_record_northen_region = DB::table('build_master_file_records')
                                            ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                            ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->where('site_master_file_records.region','Northern Region')
                                            ->whereYear('toc_received', $currentYear)
                                            ->whereMonth('toc_received', 9)
                                            ->whereNotNull('build_master_file_records.toc_received') 
                                            ->get()->toArray();
          
        
          //echo "<pre>"; print_r($sep_mrc_record_northen_region);exit;  
          $count_sep_mrc_north_region = count($sep_mrc_record_northen_region); 
          $sep_record_final_total_northen = 0;
          foreach($sep_mrc_record_northen_region as $sep_north_region_mrc){
              $po_mrc_north = $sep_north_region_mrc->po_mrc;
              $r_po_mrc_north = str_replace("R","",$po_mrc_north);
              $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
              $sep_record_final_total_northen += (int)$new_po_mrc_north;
          }

          $sep_mrc_record_eastern_region =  DB::table('build_master_file_records')
                                            ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                            ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->where('site_master_file_records.region','Eastern Region')
                                            ->whereYear('toc_received', $currentYear)
                                            ->whereMonth('toc_received', 9)
                                            ->whereNotNull('build_master_file_records.toc_received') 
                                            ->get()->toArray();

          
          $count_sep_mrc_eastern_region = count($sep_mrc_record_eastern_region); 
          $sep_record_final_total_eastern = 0;
          foreach($sep_mrc_record_eastern_region as $sep_eastern_region_mrc){
                  $po_mrc_eastern = $sep_eastern_region_mrc->po_mrc;
                  $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
                  $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
                  $sep_record_final_total_eastern += (int)$new_po_mrc_eastern;
          }  

          $sep_mrc_record_western_region = DB::table('build_master_file_records')
                                              ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                              ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->where('site_master_file_records.region','Western Region')
                                              ->whereYear('toc_received', $currentYear)
                                              ->whereMonth('toc_received', 9)
                                              ->whereNotNull('build_master_file_records.toc_received') 
                                              ->get()->toArray();
          

          $count_sep_mrc_western_region = count($sep_mrc_record_western_region);
          $sep_record_final_total_western= 0;
          foreach($sep_mrc_record_western_region as $sep_western_region_mrc){
                  $po_mrc_western = $sep_western_region_mrc->po_mrc;
                  $r_po_mrc_western = str_replace("R","",$po_mrc_western);
                  $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
                  $sep_record_final_total_western += (int)$new_po_mrc_western;
          }  

          //sum of sep total mrc
          $sep_total_mrc = $sep_record_final_total_eastern + $sep_record_final_total_northen + $sep_record_final_total_western;

          //total sep mrc
          $total_sep_count[] = array($count_sep_mrc_eastern_region,$count_sep_mrc_north_region,$count_sep_mrc_western_region);
          //echo "<pre>"; print_r($total_sep_count);exit;
          $sep_nrc_record_western_region = DB::table('build_master_file_records')
                                            ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                            ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->where('site_master_file_records.region','Western Region')
                                            ->whereYear('toc_received', $currentYear)
                                            ->whereMonth('toc_received', 9)
                                            ->whereNotNull('build_master_file_records.toc_received') 
                                            ->get()->toArray();

          $sep_nrc_record_final_total_western= 0;
          foreach($sep_nrc_record_western_region as $sep_western_region_nrc){
                  $po_nrc_western = $sep_western_region_nrc->po_nrc;
                  $r_po_nrc_western = str_replace("R","",$po_nrc_western);
                  $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
                  $sep_nrc_record_final_total_western += (int)$new_po_nrc_western;
          }

          $sep_nrc_record_eastern_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Eastern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 9)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();
          
          $sep_nrc_record_final_total_eastern= 0;
          foreach($sep_nrc_record_eastern_region as $sep_eastern_region_nrc){
              $po_nrc_eastern = $sep_eastern_region_nrc->po_nrc;
              $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
              $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
              $sep_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
          }  

          $sep_nrc_record_northen_region = DB::table('build_master_file_records')
                                              ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                              ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->where('site_master_file_records.region','Northern Region')
                                              ->whereYear('toc_received', $currentYear)
                                              ->whereMonth('toc_received', 9)
                                              ->whereNotNull('build_master_file_records.toc_received') 
                                              ->get()->toArray();
          

          $sep_nrc_record_final_total_northen= 0;
          foreach($sep_nrc_record_northen_region as $sep_northen_region_nrc){
              $po_nrc_northen = $sep_northen_region_nrc->po_nrc;
              $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
              $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
              $sep_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
          } 

          //sum of sep total mrc
          $sep_total_nrc = $sep_nrc_record_final_total_eastern + $sep_nrc_record_final_total_northen + $sep_nrc_record_final_total_western;
          $sep_total_record[] = array("sep_eastern_mrc" => $sep_record_final_total_eastern,"sep_northen_mrc" =>$sep_record_final_total_northen,"sep_western_mrc"
          =>$sep_record_final_total_western,"sep_eastern_nrc" => $sep_nrc_record_final_total_eastern,"sep_northen_nrc" =>$sep_nrc_record_final_total_northen,
          "sep_western_nrc" => $sep_nrc_record_final_total_western,"sep_total_mrc" => $sep_total_mrc, "sep_total_nrc" => $sep_total_nrc);

          //sep code end here
          $oct_mrc_record_northen_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Northern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 10)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();

          //echo "<pre>"; print_r($oct_mrc_record_northen_region);exit;  
          $count_oct_mrc_north_region = count($oct_mrc_record_northen_region); 
          $oct_record_final_total_northen = 0;
          foreach($oct_mrc_record_northen_region as $oct_north_region_mrc){
              $po_mrc_north = $oct_north_region_mrc->po_mrc;
              $r_po_mrc_north = str_replace("R","",$po_mrc_north);
              $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
              $oct_record_final_total_northen += (int)$new_po_mrc_north;
          }

          $oct_mrc_record_eastern_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Eastern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 10)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();

          $count_oct_mrc_eastern_region = count($oct_mrc_record_eastern_region); 
          $oct_record_final_total_eastern = 0;
          foreach($oct_mrc_record_eastern_region as $oct_eastern_region_mrc){
                  $po_mrc_eastern = $oct_eastern_region_mrc->po_mrc;
                  $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
                  $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
                  $oct_record_final_total_eastern += (int)$new_po_mrc_eastern;
          }  

          $oct_mrc_record_western_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Western Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 10)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();
          
          $count_oct_mrc_western_region = count($oct_mrc_record_western_region);
          $oct_record_final_total_western= 0;
          foreach($oct_mrc_record_western_region as $oct_western_region_mrc){
                  $po_mrc_western = $oct_western_region_mrc->po_mrc;
                  $r_po_mrc_western = str_replace("R","",$po_mrc_western);
                  $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
                  $oct_record_final_total_western += (int)$new_po_mrc_western;
          }  

          //sum of oct total mrc
          $oct_total_mrc = $oct_record_final_total_eastern + $oct_record_final_total_northen + $oct_record_final_total_western;

          //total oct mrc
          $total_oct_count[] = array($count_oct_mrc_eastern_region,$count_oct_mrc_north_region,$count_oct_mrc_western_region);
          //echo "<pre>"; print_r($total_oct_count);exit;
          $oct_nrc_record_western_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Western Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 10)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();

          $oct_nrc_record_final_total_western= 0;
          foreach($oct_nrc_record_western_region as $oct_western_region_nrc){
                  $po_nrc_western = $oct_western_region_nrc->po_nrc;
                  $r_po_nrc_western = str_replace("R","",$po_nrc_western);
                  $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
                  $oct_nrc_record_final_total_western += (int)$new_po_nrc_western;
          }

          $oct_nrc_record_eastern_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Eastern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 10)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();
          
          
          $oct_nrc_record_final_total_eastern= 0;
          foreach($oct_nrc_record_eastern_region as $oct_eastern_region_nrc){
              $po_nrc_eastern = $oct_eastern_region_nrc->po_nrc;
              $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
              $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
              $oct_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
          }  

          $oct_nrc_record_northen_region = DB::table('build_master_file_records')
                                              ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                              ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                              ->where('site_master_file_records.region','Northern Region')
                                              ->whereYear('toc_received', $currentYear)
                                              ->whereMonth('toc_received', 10)
                                              ->whereNotNull('build_master_file_records.toc_received') 
                                              ->get()->toArray();

          $oct_nrc_record_final_total_northen= 0;
          foreach($oct_nrc_record_northen_region as $oct_northen_region_nrc){
              $po_nrc_northen = $oct_northen_region_nrc->po_nrc;
              $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
              $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
              $oct_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
          } 

          //sum of oct total mrc
          $oct_total_nrc = $oct_nrc_record_final_total_eastern + $oct_nrc_record_final_total_northen + $oct_nrc_record_final_total_western;
          $oct_total_record[] = array("oct_eastern_mrc" => $oct_record_final_total_eastern,"oct_northen_mrc" =>$oct_record_final_total_northen,"oct_western_mrc"
          =>$oct_record_final_total_western,"oct_eastern_nrc" => $oct_nrc_record_final_total_eastern,"oct_northen_nrc" =>$oct_nrc_record_final_total_northen,
          "oct_western_nrc" => $oct_nrc_record_final_total_western,"oct_total_mrc" => $oct_total_mrc, "oct_total_nrc" => $oct_total_nrc);

          //oct code end here

          //nov start
          $nov_mrc_record_northen_region = DB::table('build_master_file_records')
                                            ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                            ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                            ->where('site_master_file_records.region','Northern Region')
                                            ->whereYear('toc_received', $currentYear)
                                            ->whereMonth('toc_received', 11)
                                            ->whereNotNull('build_master_file_records.toc_received') 
                                            ->get()->toArray();

      //echo "<pre>"; print_r($nov_mrc_record_northen_region);exit;  
      $count_nov_mrc_north_region = count($nov_mrc_record_northen_region); 
      $nov_record_final_total_northen = 0;
      foreach($nov_mrc_record_northen_region as $nov_north_region_mrc){
          $po_mrc_north = $nov_north_region_mrc->po_mrc;
          $r_po_mrc_north = str_replace("R","",$po_mrc_north);
          $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
          $nov_record_final_total_northen += (int)$new_po_mrc_north;
      }

      $nov_mrc_record_eastern_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Eastern Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', 11)
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();

      $count_nov_mrc_eastern_region = count($nov_mrc_record_eastern_region); 
      $nov_record_final_total_eastern = 0;
      foreach($nov_mrc_record_eastern_region as $nov_eastern_region_mrc){
              $po_mrc_eastern = $nov_eastern_region_mrc->po_mrc;
              $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
              $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
              $nov_record_final_total_eastern += (int)$new_po_mrc_eastern;
      }  

    $nov_mrc_record_western_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Western Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', 11)
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();
    

    $count_nov_mrc_western_region = count($nov_mrc_record_western_region);
    $nov_record_final_total_western= 0;
    foreach($nov_mrc_record_western_region as $nov_western_region_mrc){
            $po_mrc_western = $nov_western_region_mrc->po_mrc;
            $r_po_mrc_western = str_replace("R","",$po_mrc_western);
            $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
            $nov_record_final_total_western += (int)$new_po_mrc_western;
    }  

    //sum of nov total mrc
    $nov_total_mrc = $nov_record_final_total_eastern + $nov_record_final_total_northen + $nov_record_final_total_western;

    //total nov mrc
    $total_nov_count[] = array($count_nov_mrc_eastern_region,$count_nov_mrc_north_region,$count_nov_mrc_western_region);
    //echo "<pre>"; print_r($total_nov_count);exit;
    $nov_nrc_record_western_region = DB::table('build_master_file_records')
                                    ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                    ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                    ->where('site_master_file_records.region','Western Region')
                                    ->whereYear('toc_received', $currentYear)
                                    ->whereMonth('toc_received', 11)
                                    ->whereNotNull('build_master_file_records.toc_received') 
                                    ->get()->toArray();
    
    $nov_nrc_record_final_total_western= 0;
    foreach($nov_nrc_record_western_region as $nov_western_region_nrc){
            $po_nrc_western = $nov_western_region_nrc->po_nrc;
            $r_po_nrc_western = str_replace("R","",$po_nrc_western);
            $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
            $nov_nrc_record_final_total_western += (int)$new_po_nrc_western;
    }

    $nov_nrc_record_eastern_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Eastern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 11)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();

    $nov_nrc_record_final_total_eastern= 0;
    foreach($nov_nrc_record_eastern_region as $nov_eastern_region_nrc){
        $po_nrc_eastern = $nov_eastern_region_nrc->po_nrc;
        $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
        $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
        $nov_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
    }  

    $nov_nrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 11)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    

    $nov_nrc_record_final_total_northen= 0;
    foreach($nov_nrc_record_northen_region as $nov_northen_region_nrc){
        $po_nrc_northen = $nov_northen_region_nrc->po_nrc;
        $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
        $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
        $nov_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
    } 

    //sum of nov total mrc
    $nov_total_nrc = $nov_nrc_record_final_total_eastern + $nov_nrc_record_final_total_northen + $nov_nrc_record_final_total_western;
    $nov_total_record[] = array("nov_eastern_mrc" => $nov_record_final_total_eastern,"nov_northen_mrc" =>$nov_record_final_total_northen,"nov_western_mrc"
    =>$nov_record_final_total_western,"nov_eastern_nrc" => $nov_nrc_record_final_total_eastern,"nov_northen_nrc" =>$nov_nrc_record_final_total_northen,
    "nov_western_nrc" => $nov_nrc_record_final_total_western,"nov_total_mrc" => $nov_total_mrc, "nov_total_nrc" => $nov_total_nrc);

    //nov code end here

    //dec start here
    $dec_mrc_record_northen_region = DB::table('build_master_file_records')
                                          ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                          ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                          ->where('site_master_file_records.region','Northern Region')
                                          ->whereYear('toc_received', $currentYear)
                                          ->whereMonth('toc_received', 12)
                                          ->whereNotNull('build_master_file_records.toc_received') 
                                          ->get()->toArray();

    //echo "<pre>"; print_r($dec_mrc_record_northen_region);exit;  
    $count_dec_mrc_north_region = count($dec_mrc_record_northen_region); 
    $dec_record_final_total_northen = 0;
    foreach($dec_mrc_record_northen_region as $dec_north_region_mrc){
        $po_mrc_north = $dec_north_region_mrc->po_mrc;
        $r_po_mrc_north = str_replace("R","",$po_mrc_north);
        $new_po_mrc_north = str_replace(",","",$r_po_mrc_north);  
        $dec_record_final_total_northen += (int)$new_po_mrc_north;
    }

    $dec_mrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 12)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
  
    $count_dec_mrc_eastern_region = count($dec_mrc_record_eastern_region); 
    $dec_record_final_total_eastern = 0;
    foreach($dec_mrc_record_eastern_region as $dec_eastern_region_mrc){
            $po_mrc_eastern = $dec_eastern_region_mrc->po_mrc;
            $r_po_mrc_eastern = str_replace("R","",$po_mrc_eastern);
            $new_po_mrc_eastern = str_replace(",","",$r_po_mrc_eastern);  
            $dec_record_final_total_eastern += (int)$new_po_mrc_eastern;
    }  

    $dec_mrc_record_western_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_mrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Western Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', 12)
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();
    
    
    $count_dec_mrc_western_region = count($dec_mrc_record_western_region);
    $dec_record_final_total_western= 0;
    foreach($dec_mrc_record_western_region as $dec_western_region_mrc){
            $po_mrc_western = $dec_western_region_mrc->po_mrc;
            $r_po_mrc_western = str_replace("R","",$po_mrc_western);
            $new_po_mrc_western = str_replace(",","",$r_po_mrc_western);  
            $dec_record_final_total_western += (int)$new_po_mrc_western;
    }  

    //sum of dec total mrc
    $dec_total_mrc = $dec_record_final_total_eastern + $dec_record_final_total_northen + $dec_record_final_total_western;

    //total dec mrc
    $total_dec_count[] = array($count_dec_mrc_eastern_region,$count_dec_mrc_north_region,$count_dec_mrc_western_region);
    //echo "<pre>"; print_r($total_dec_count);exit;
    $dec_nrc_record_western_region = DB::table('build_master_file_records')
                                        ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                        ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                        ->where('site_master_file_records.region','Western Region')
                                        ->whereYear('toc_received', $currentYear)
                                        ->whereMonth('toc_received', 12)
                                        ->whereNotNull('build_master_file_records.toc_received') 
                                        ->get()->toArray();

    
    $dec_nrc_record_final_total_western= 0;
    foreach($dec_nrc_record_western_region as $dec_western_region_nrc){
            $po_nrc_western = $dec_western_region_nrc->po_nrc;
            $r_po_nrc_western = str_replace("R","",$po_nrc_western);
            $new_po_nrc_western = str_replace(",","",$r_po_nrc_western);  
            $dec_nrc_record_final_total_western += (int)$new_po_nrc_western;
    }

    $dec_nrc_record_eastern_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Eastern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 12)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    
    $dec_nrc_record_final_total_eastern= 0;
    foreach($dec_nrc_record_eastern_region as $dec_eastern_region_nrc){
        $po_nrc_eastern = $dec_eastern_region_nrc->po_nrc;
        $r_po_nrc_eastern = str_replace("R","",$po_nrc_eastern);
        $new_po_nrc_eastern = str_replace(",","",$r_po_nrc_eastern);  
        $dec_nrc_record_final_total_eastern += (int)$new_po_nrc_eastern;
    }  

    $dec_nrc_record_northen_region = DB::table('build_master_file_records')
                                      ->select('build_master_file_records.service_id','build_master_file_records.toc_received','build_master_file_records.region','site_master_file_records.po_nrc','site_master_file_records.service_id')
                                      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
                                      ->where('site_master_file_records.region','Northern Region')
                                      ->whereYear('toc_received', $currentYear)
                                      ->whereMonth('toc_received', 12)
                                      ->whereNotNull('build_master_file_records.toc_received') 
                                      ->get()->toArray();
    
    $dec_nrc_record_final_total_northen= 0;
    foreach($dec_nrc_record_northen_region as $dec_northen_region_nrc){
        $po_nrc_northen = $dec_northen_region_nrc->po_nrc;
        $r_po_nrc_northen = str_replace("R","",$po_nrc_northen);
        $new_po_nrc_northen = str_replace(",","",$r_po_nrc_northen);  
        $dec_nrc_record_final_total_northen += (int)$new_po_nrc_northen;
    } 

    //sum of dec total mrc
    $dec_total_nrc = $dec_nrc_record_final_total_eastern + $dec_nrc_record_final_total_northen + $dec_nrc_record_final_total_western;
    $dec_total_record[] = array("dec_eastern_mrc" => $dec_record_final_total_eastern,"dec_northen_mrc" =>$dec_record_final_total_northen,"dec_western_mrc"
    =>$dec_record_final_total_western,"dec_eastern_nrc" => $dec_nrc_record_final_total_eastern,"dec_northen_nrc" =>$dec_nrc_record_final_total_northen,
    "dec_western_nrc" => $dec_nrc_record_final_total_western,"dec_total_mrc" => $dec_total_mrc, "dec_total_nrc" => $dec_total_nrc);

    //dec code end here
            $view =  view('admin/main-dashboard/datenew-monthly-dashboard', compact('feb_total_record','jan_total_record','march_total_record','april_total_record','may_total_record',
            'june_total_record','july_total_record','aug_total_record','total_july_count','total_aug_count','total_june_count','total_may_count','total_april_count','total_march_count',
            'total_jan_count','total_feb_count','sep_total_record','oct_total_record','nov_total_record','dec_total_record','total_sep_count',
            'total_oct_count','total_nov_count','total_dec_count'));
            return $view;
}

//function for big deals dashboard
public function big_deal_dashboard(Request $request){

  //check year
  $currentYear = date('Y');
  if($request->year == '2023'){
      $currentYear = '2023';
  } elseif($request->year == '2024'){
      $currentYear = date('Y');
  }

  $all_result = DB::table('build_master_file_records')
      ->select('build_master_file_records.toc_submitted','site_master_file_records.service_id','build_master_file_records.actual_build_completion_date',
      'site_master_file_records.type',
      'site_master_file_records.project_status',
      'site_master_file_records.date_new',
      'site_master_file_records.client_name',
      'build_master_file_records.planned_build_completion_date',
      'build_master_file_records.revised_build_co_date',
      'planning_master_file_records.revised_planned_wp2_date',
      'planning_master_file_records.planned_wp2_released_date','site_master_file_records.region','site_master_file_records.po_mrc')
      ->join('site_master_file_records', 'site_master_file_records.service_id', '=', 'build_master_file_records.service_id')
      ->join('planning_master_file_records', 'planning_master_file_records.service_id', '=', 'build_master_file_records.service_id')
      ->whereNotIn('site_master_file_records.project_status', ['K) TOC P1 Submitted-L2','L) TOC P2 Received-L2','N) TOC P2 Submitted',
      'O) TOC P2 Received','Q) Cancelled','T) Complete','U) Terminated'])
      ->get();
      $all_result = $all_result->map(function ($record) {
        if (isset($record->po_mrc)) {
            // Remove non-numeric characters and cast to numeric
            $po_mrc_numeric = preg_replace('/[^0-9.]/', '', $record->po_mrc);
            $po_mrc_numeric = (float)$po_mrc_numeric;
            $record->po_mrc = $po_mrc_numeric;
        }
        return $record;
    })->filter(function ($record) {
        // Filter records where po_mrc is greater than or equal to 7000
        return isset($record->po_mrc) && $record->po_mrc >= 7000;
    })->toArray();

      
  //echo "<pre>";print_r($all_result);exit;

    $new_current_date =  Carbon::now();

    $jan_record_final_total_northen = 0;
    $count_jan_mrc_north_region = 0;
  
    $jan_record_final_total_eastern = 0;
    $count_jan_mrc_eastern_region = 0;
  
    $jan_record_final_total_western = 0;
    $count_jan_mrc_western_region = 0;


    $feb_record_final_total_northen = 0;
    $count_feb_mrc_north_region = 0;
  
    $feb_record_final_total_eastern = 0;
    $count_feb_mrc_eastern_region = 0;
  
    $feb_record_final_total_western = 0;
    $count_feb_mrc_western_region = 0;

    $march_record_final_total_northen = 0;
    $count_march_mrc_north_region = 0;
  
    $march_record_final_total_eastern = 0;
    $count_march_mrc_eastern_region = 0;
  
    $march_record_final_total_western = 0;
    $count_march_mrc_western_region = 0;

    $april_record_final_total_northen = 0;
    $count_april_mrc_north_region = 0;
  
    $april_record_final_total_eastern = 0;
    $count_april_mrc_eastern_region = 0;
  
    $april_record_final_total_western = 0;
    $count_april_mrc_western_region = 0;

    $may_record_final_total_northen = 0;
    $count_may_mrc_north_region = 0;
  
    $may_record_final_total_eastern = 0;
    $count_may_mrc_eastern_region = 0;
  
    $may_record_final_total_western = 0;
    $count_may_mrc_western_region = 0;

    $june_record_final_total_northen = 0;
    $count_june_mrc_north_region = 0;
  
    $june_record_final_total_eastern = 0;
    $count_june_mrc_eastern_region = 0;
  
    $june_record_final_total_western = 0;
    $count_june_mrc_western_region = 0;

    $july_record_final_total_northen = 0;
    $count_july_mrc_north_region = 0;
  
    $july_record_final_total_eastern = 0;
    $count_july_mrc_eastern_region = 0;
  
    $july_record_final_total_western = 0;
    $count_july_mrc_western_region = 0;

    $aug_record_final_total_northen = 0;
    $count_aug_mrc_north_region = 0;
  
    $aug_record_final_total_eastern = 0;
    $count_aug_mrc_eastern_region = 0;
  
    $aug_record_final_total_western = 0;
    $count_aug_mrc_western_region = 0;

    $sep_record_final_total_northen = 0;
    $count_sep_mrc_north_region = 0;
  
    $sep_record_final_total_eastern = 0;
    $count_sep_mrc_eastern_region = 0;
  
    $sep_record_final_total_western = 0;
    $count_sep_mrc_western_region = 0;

    $oct_record_final_total_northen = 0;
    $count_oct_mrc_north_region = 0;
  
    $oct_record_final_total_eastern = 0;
    $count_oct_mrc_eastern_region = 0;
  
    $oct_record_final_total_western = 0;
    $count_oct_mrc_western_region = 0;

    $nov_record_final_total_northen = 0;
    $count_nov_mrc_north_region = 0;
  
    $nov_record_final_total_eastern = 0;
    $count_nov_mrc_eastern_region = 0;
  
    $nov_record_final_total_western = 0;
    $count_nov_mrc_western_region = 0;

    $dec_record_final_total_northen = 0;
    $count_dec_mrc_north_region = 0;
  
    $dec_record_final_total_eastern = 0;
    $count_dec_mrc_eastern_region = 0;
  
    $dec_record_final_total_western = 0;
    $count_dec_mrc_western_region = 0;


    $total_all_show_me_the_money_record = [];
    foreach($all_result as $result){

      $project_duration = "";
      if($result->project_status == "Q) Cancelled"){
          $project_duration = 0;
      } else {
          if(isset($result->toc_submitted)){
              $date_toc_submitted = Carbon::parse($result->toc_submitted);
              $date_new = Carbon::parse($result->date_new);
              $date_toc_submitted_diff = $date_toc_submitted->diffInDays($date_new);
              $project_duration = (int)$date_toc_submitted_diff+1;
          } else {

              $date_new = Carbon::parse($result->date_new);
              $date_new_diff = $new_current_date->diffInDays($date_new);
              $project_duration = (int)$date_new_diff+1;
          }
      }

      //For project Ageing
      $ageing = "";
      if($project_duration == 0){
          $ageing = "Cancelled";
      } elseif($project_duration < 30){
          $ageing = "Current";
      } elseif($project_duration > 30 AND $project_duration < 60){
          $ageing = "60 Days";
      } elseif($project_duration > 60 AND $project_duration < 91){
          $ageing = "90 days";
      } elseif($project_duration > 90 AND $project_duration < 121){
          $ageing = "120 days";
      } elseif($project_duration > 90 AND $project_duration < 121){
          $ageing = "More than 120 Days";
      } else {
          $ageing = "Query";
      }

      $planned_build_completion_date = '';
      if(!empty($result->planned_build_completion_date)){
        $planned_build_completion_date = Carbon::parse($result->planned_build_completion_date)->format('Y/m/d');
      }

      $project_type = $result->type;
      $BuildMasterFileController = new BuildMasterFileController();
      $planned_start_date = $BuildMasterFileController->change_planned_start_date($result->revised_planned_wp2_date,$result->planned_wp2_released_date);
      $est_complition_date = $BuildMasterFileController->calculate_est_complition_date($project_type,$planned_start_date);
            
      // for show me the money
      $show_me_the_money = '';
      if($ageing == 'Cancelled'){
          $show_me_the_money = "";
      } elseif($ageing != 'Cancelled' && !empty($result->toc_submitted)){
          $show_me_the_money = Carbon::parse($result->toc_submitted)->format('Y/m/d');
      } elseif(empty($result->toc_submitted) && !empty($result->actual_build_completion_date)){
          $show_me_the_money = Carbon::parse($result->actual_build_completion_date)->format('Y/m/d');
      } elseif(empty($result->actual_build_completion_date) && !empty($planned_build_completion_date)){
          $show_me_the_money = Carbon::parse($planned_build_completion_date)->format('Y/m/d');
      } elseif(empty($planned_build_completion_date) && !empty($result->revised_build_co_date)){
          $show_me_the_money = Carbon::parse($result->revised_build_co_date)->format('Y/m/d');
      } elseif(empty($result->revised_build_co_date) && !empty($est_complition_date)){
          $show_me_the_money = Carbon::parse($est_complition_date)->format('Y/m/d');
      }
      
      //set variable name for loops
      $result_year = Carbon::parse($show_me_the_money)->format('Y');
      $result_month = Carbon::parse($show_me_the_money)->format('m');
      $result_region = $result->region;
      //Condition for set array according to month

    
      //for jan month
      //list of all record in show me thw money
        if($result_year == $currentYear){

         $total_all_show_me_the_money_record[]  = array('po_mrc' => $result->po_mrc,
          'client_name' => $result->client_name,
          'service_id' => $result->service_id,
          'region' => $result->region,
          'project_status' => $result->project_status,  
          'show_me_the_money' => $show_me_the_money) ;
          
       }
   
      $jan_mrc_month = "01";
      $jan_mrc_north_region = "Northern Region";


      //Set static variable
      if($result_year == $currentYear AND $result_month == $jan_mrc_month AND $result_region == $jan_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $jan_record_final_total_northen += (int)$po_mrc_north;
        $count_jan_mrc_north_region++;
      }  
    
          //for eastern region
      $jan_mrc_month = "01";
      $jan_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $jan_mrc_month AND $result_region == $jan_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc;
        $jan_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_jan_mrc_eastern_region++;
      } 

      //for eastern region
      $jan_mrc_month = "01";
      $jan_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $jan_mrc_month AND $result_region == $jan_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $jan_record_final_total_western += (int)$po_mrc_western;
        $count_jan_mrc_western_region++;
      } 

      //for feb month
      $feb_mrc_month = "02";
      $feb_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $feb_mrc_month AND $result_region == $feb_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $feb_record_final_total_northen += (int)$po_mrc_north;
        $count_feb_mrc_north_region++;
      }  
    
          //for eastern region
      $feb_mrc_month = "02";
      $feb_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $feb_mrc_month AND $result_region == $feb_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $feb_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_feb_mrc_eastern_region++;
      } 

      //for eastern region
      $feb_mrc_month = "02";
      $feb_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $feb_mrc_month AND $result_region == $feb_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $feb_record_final_total_western += (int)$po_mrc_western;
        $count_feb_mrc_western_region++;
      }

      // for march month
      $march_mrc_month = "03";
      $march_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $march_mrc_month AND $result_region == $march_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $march_record_final_total_northen += (int)$po_mrc_north;
        $count_march_mrc_north_region++;
      }  
    
          //for eastern region
      $march_mrc_month = "03";
      $march_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $march_mrc_month AND $result_region == $march_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $march_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_march_mrc_eastern_region++;
      } 

      //for eastern region
      $march_mrc_month = "03";
      $march_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $march_mrc_month AND $result_region == $march_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $march_record_final_total_western += (int)$po_mrc_western;
        $count_march_mrc_western_region++;
      }

      //for april month
      $april_mrc_month = "04";
      $april_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $april_mrc_month AND $result_region == $april_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $april_record_final_total_northen += (int)$po_mrc_north;
        $count_april_mrc_north_region++;
      }  
    
          //for eastern region
      $april_mrc_month = "04";
      $april_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $april_mrc_month AND $result_region == $april_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $big_deals_service_ids[] = $result->service_id;
        $show_me_the_money_big_deal[] = $show_me_the_money;
        $april_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_april_mrc_eastern_region++;
      } 

      //for eastern region
      $april_mrc_month = "04";
      $april_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $april_mrc_month AND $result_region == $april_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $april_record_final_total_western += (int)$po_mrc_western;
        $count_april_mrc_western_region++;
      }

      //for may
      $may_mrc_month = "05";
      $may_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $may_mrc_month AND $result_region == $may_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $may_record_final_total_northen += (int)$po_mrc_north;
        $count_may_mrc_north_region++;
      }  
    
          //for eastern region
      $may_mrc_month = "05";
      $may_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $may_mrc_month AND $result_region == $may_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $may_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_may_mrc_eastern_region++;
      } 

      //for eastern region
      $may_mrc_month = "05";
      $may_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $may_mrc_month AND $result_region == $may_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $may_record_final_total_western += (int)$po_mrc_western;
        $count_may_mrc_western_region++;
      }

      //for june
      $june_mrc_month = "06";
      $june_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $june_mrc_month AND $result_region == $june_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $june_record_final_total_northen += (int)$po_mrc_north;
        $count_june_mrc_north_region++;
      }  
    
          //for eastern region
      $june_mrc_month = "06";
      $june_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $june_mrc_month AND $result_region == $june_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $june_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_june_mrc_eastern_region++;
      } 

      //for eastern region
      $june_mrc_month = "06";
      $june_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $june_mrc_month AND $result_region == $june_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $june_record_final_total_western += (int)$po_mrc_western;
        $count_june_mrc_western_region++;
      }

      //for july
      $july_mrc_month = "07";
      $july_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $july_mrc_month AND $result_region == $july_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $july_record_final_total_northen += (int)$po_mrc_north;
        $count_july_mrc_north_region++;
      }  
    
          //for eastern region
      $july_mrc_month = "07";
      $july_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $july_mrc_month AND $result_region == $july_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $july_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_july_mrc_eastern_region++;
      } 

      //for eastern region
      $july_mrc_month = "07";
      $july_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $july_mrc_month AND $result_region == $july_mrc_western_region){
        $po_mrc_western = $result->po_mrc;
        $july_record_final_total_western += (int)$po_mrc_western;
        $count_july_mrc_western_region++;
      }

      // for august
      $aug_mrc_month = "08";
      $aug_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $aug_mrc_month AND $result_region == $aug_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $aug_record_final_total_northen += (int)$po_mrc_north;
        $count_aug_mrc_north_region++;
      }  
    
          //for eastern region
      $aug_mrc_month = "08";
      $aug_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $aug_mrc_month AND $result_region == $aug_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $aug_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_aug_mrc_eastern_region++;
      } 

      //for eastern region
      $aug_mrc_month = "08";
      $aug_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $aug_mrc_month AND $result_region == $aug_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $aug_record_final_total_western += (int)$po_mrc_western;
        $count_aug_mrc_western_region++;
      }

      // for sep
      $sep_mrc_month = "09";
      $sep_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $sep_mrc_month AND $result_region == $sep_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $sep_record_final_total_northen += (int)$po_mrc_north;
        $count_sep_mrc_north_region++;
      }  
    
      //for eastern region
      $sep_mrc_month = "09";
      $sep_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $sep_mrc_month AND $result_region == $sep_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $sep_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_sep_mrc_eastern_region++;
      } 

      //for eastern region
      $sep_mrc_month = "09";
      $sep_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $sep_mrc_month AND $result_region == $sep_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $sep_record_final_total_western += (int)$po_mrc_western;
        $count_sep_mrc_western_region++;
      }

      //for october
      $oct_mrc_month = "10";
      $oct_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $oct_mrc_month AND $result_region == $oct_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $oct_record_final_total_northen += (int)$po_mrc_north;
        $count_oct_mrc_north_region++;
      }  
    
          //for eastern region
      $oct_mrc_month = "10";
      $oct_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $oct_mrc_month AND $result_region == $oct_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $oct_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_oct_mrc_eastern_region++;
      } 

      //for eastern region
      $oct_mrc_month = "10";
      $oct_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $oct_mrc_month AND $result_region == $oct_mrc_western_region){
        $po_mrc_western = $result->po_mrc;
        $oct_record_final_total_western += (int)$po_mrc_western;
        $count_oct_mrc_western_region++;
      }

      // for nov
      $nov_mrc_month = "11";
      $nov_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $nov_mrc_month AND $result_region == $nov_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $nov_record_final_total_northen += (int)$po_mrc_north;
        $count_nov_mrc_north_region++;
      }  
    
          //for eastern region
      $nov_mrc_month = "11";
      $nov_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $nov_mrc_month AND $result_region == $nov_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $nov_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_nov_mrc_eastern_region++;
      } 

      //for eastern region
      $nov_mrc_month = "11";
      $nov_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $nov_mrc_month AND $result_region == $nov_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $nov_record_final_total_western += (int)$po_mrc_western;
        $count_nov_mrc_western_region++;
      }

      $dec_mrc_month = "12";
      $dec_mrc_north_region = "Northern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $dec_mrc_month AND $result_region == $dec_mrc_north_region){
        $po_mrc_north = $result->po_mrc;
        $dec_record_final_total_northen += (int)$po_mrc_north;
        $count_dec_mrc_north_region++;
      }  
    
          //for eastern region
      $dec_mrc_month = "12";
      $dec_mrc_eastern_region = "Eastern Region";

      //Set static variable
      if($result_year == $currentYear AND $result_month == $dec_mrc_month AND $result_region == $dec_mrc_eastern_region){
        $po_mrc_eastern = $result->po_mrc; 
        $dec_record_final_total_eastern += (int)$po_mrc_eastern;
        $count_dec_mrc_eastern_region++;
      } 

      //for eastern region
      $dec_mrc_month = "12";
      $dec_mrc_western_region = "Western Region";
  
      //Set static variable
      if($result_year == $currentYear AND $result_month == $dec_mrc_month AND $result_region == $dec_mrc_western_region){
        $po_mrc_western = $result->po_mrc; 
        $dec_record_final_total_western += (int)$po_mrc_western;
        $count_dec_mrc_western_region++;
      }

    }

     //sum of jan total mrc
    $jan_total_mrc = $jan_record_final_total_eastern + $jan_record_final_total_northen + $jan_record_final_total_western;
    $total_jan_count[] = array($count_jan_mrc_north_region,$count_jan_mrc_eastern_region,$count_jan_mrc_western_region);

    //sum of jan total mrc
    $jan_total_record[] = array("jan_eastern_mrc" => $jan_record_final_total_eastern,"jan_northen_mrc" =>$jan_record_final_total_northen,"jan_western_mrc"
    =>$jan_record_final_total_western,"jan_total_mrc" => $jan_total_mrc);

    //sum of feb total mrc
    $feb_total_mrc = $feb_record_final_total_eastern + $feb_record_final_total_northen + $feb_record_final_total_western;
    $total_feb_count[] = array($count_feb_mrc_north_region,$count_feb_mrc_eastern_region,$count_feb_mrc_western_region);

    //sum of feb total mrc
    $feb_total_record[] = array("feb_eastern_mrc" => $feb_record_final_total_eastern,"feb_northen_mrc" =>$feb_record_final_total_northen,"feb_western_mrc"
        =>$feb_record_final_total_western,"feb_total_mrc" => $feb_total_mrc);

      //sum of march total mrc
      $march_total_mrc = $march_record_final_total_eastern + $march_record_final_total_northen + $march_record_final_total_western;
      $total_march_count[] = array($count_march_mrc_north_region,$count_march_mrc_eastern_region,$count_march_mrc_western_region);

      //sum of march total mrc
      $march_total_record[] = array("march_eastern_mrc" => $march_record_final_total_eastern,"march_northen_mrc" =>$march_record_final_total_northen,"march_western_mrc"
          =>$march_record_final_total_western,"march_total_mrc" => $march_total_mrc);  

      //sum of april total mrc
      $april_total_mrc = $april_record_final_total_eastern + $april_record_final_total_northen + $april_record_final_total_western;
      $total_april_count[] = array($count_april_mrc_north_region,$count_april_mrc_eastern_region,$count_april_mrc_western_region);

      //sum of april total mrc
      $april_total_record[] = array("april_eastern_mrc" => $april_record_final_total_eastern,"april_northen_mrc" =>$april_record_final_total_northen,"april_western_mrc"
          =>$april_record_final_total_western,"april_total_mrc" => $april_total_mrc);

      //sum of may total mrc
      $may_total_mrc = $may_record_final_total_eastern + $may_record_final_total_northen + $may_record_final_total_western;
      $total_may_count[] = array($count_may_mrc_north_region,$count_may_mrc_eastern_region,$count_may_mrc_western_region);

      //sum of may total mrc
      $may_total_record[] = array("may_eastern_mrc" => $may_record_final_total_eastern,"may_northen_mrc" =>$may_record_final_total_northen,"may_western_mrc"
          =>$may_record_final_total_western,"may_total_mrc" => $may_total_mrc);  

        //sum of june total mrc
      $june_total_mrc = $june_record_final_total_eastern + $june_record_final_total_northen + $june_record_final_total_western;
      $total_june_count[] = array($count_june_mrc_north_region,$count_june_mrc_eastern_region,$count_june_mrc_western_region);

      //sum of june total mrc
      $june_total_record[] = array("june_eastern_mrc" => $june_record_final_total_eastern,"june_northen_mrc" =>$june_record_final_total_northen,"june_western_mrc"
          =>$june_record_final_total_western,"june_total_mrc" => $june_total_mrc);  

      //sum of july total mrc
      $july_total_mrc = $july_record_final_total_eastern + $july_record_final_total_northen + $july_record_final_total_western;
      $total_july_count[] = array($count_july_mrc_north_region,$count_july_mrc_eastern_region,$count_july_mrc_western_region);

      //sum of july total mrc
      $july_total_record[] = array("july_eastern_mrc" => $july_record_final_total_eastern,"july_northen_mrc" =>$july_record_final_total_northen,"july_western_mrc"
        =>$july_record_final_total_western,"july_total_mrc" => $july_total_mrc); 
        
      //sum of aug total mrc
      $aug_total_mrc = $aug_record_final_total_eastern + $aug_record_final_total_northen + $aug_record_final_total_western;
      $total_aug_count[] = array($count_aug_mrc_north_region,$count_aug_mrc_eastern_region,$count_aug_mrc_western_region);

      //sum of aug total mrc
      $aug_total_record[] = array("aug_eastern_mrc" => $aug_record_final_total_eastern,"aug_northen_mrc" =>$aug_record_final_total_northen,"aug_western_mrc"
        =>$aug_record_final_total_western,"aug_total_mrc" => $aug_total_mrc); 
        
      //sum of sep total mrc
      $sep_total_mrc = $sep_record_final_total_eastern + $sep_record_final_total_northen + $sep_record_final_total_western;
      $total_sep_count[] = array($count_sep_mrc_north_region,$count_sep_mrc_eastern_region,$count_sep_mrc_western_region);

      //sum of sep total mrc
      $sep_total_record[] = array("sep_eastern_mrc" => $sep_record_final_total_eastern,"sep_northen_mrc" =>$sep_record_final_total_northen,"sep_western_mrc"
        =>$sep_record_final_total_western,"sep_total_mrc" => $sep_total_mrc);  

      //sum of oct total mrc
       $oct_total_mrc = $oct_record_final_total_eastern + $oct_record_final_total_northen + $oct_record_final_total_western;
       $total_oct_count[] = array($count_oct_mrc_north_region,$count_oct_mrc_eastern_region,$count_oct_mrc_western_region);

       //sum of oct total mrc
       $oct_total_record[] = array("oct_eastern_mrc" => $oct_record_final_total_eastern,"oct_northen_mrc" =>$oct_record_final_total_northen,"oct_western_mrc"
        =>$oct_record_final_total_western,"oct_total_mrc" => $oct_total_mrc);
        
        //sum of nov total mrc
       $nov_total_mrc = $nov_record_final_total_eastern + $nov_record_final_total_northen + $nov_record_final_total_western;
       $total_nov_count[] = array($count_nov_mrc_north_region,$count_nov_mrc_eastern_region,$count_nov_mrc_western_region);

       //sum of nov total mrc
        $nov_total_record[] = array("nov_eastern_mrc" => $nov_record_final_total_eastern,"nov_northen_mrc" =>$nov_record_final_total_northen,"nov_western_mrc"
        =>$nov_record_final_total_western,"nov_total_mrc" => $nov_total_mrc);

            //sum of dec total mrc
       $dec_total_mrc = $dec_record_final_total_eastern + $dec_record_final_total_northen + $dec_record_final_total_western;
       $total_dec_count[] = array($count_dec_mrc_north_region,$count_dec_mrc_eastern_region,$count_dec_mrc_western_region);

       //sum of dec total mrc
       $dec_total_record[] = array("dec_eastern_mrc" => $dec_record_final_total_eastern,"dec_northen_mrc" =>$dec_record_final_total_northen,"dec_western_mrc"
        =>$dec_record_final_total_western,"dec_total_mrc" => $dec_total_mrc);
      
     

 
        //echo "<pre>";print_r($total_dd);exit;
        return view('admin.main-dashboard.big-deals',compact('jan_total_record','total_jan_count','feb_total_record','total_feb_count','march_total_record','total_march_count',
        'total_april_count','april_total_record','total_may_count','may_total_record','total_june_count','june_total_record','total_july_count','july_total_record',
        'total_aug_count','aug_total_record','total_sep_count','sep_total_record','total_oct_count','oct_total_record','total_nov_count','nov_total_record',
        'total_dec_count','dec_total_record','total_all_show_me_the_money_record'));
    }

}


