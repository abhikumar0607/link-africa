<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSurveyStatus;
use App\Models\SiteMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\PlanningMasterFile;
use Carbon\Carbon;
use Helper;
class SiteSurveyStatusController extends Controller
{
    
      // Function for update site survey update approval
      public function site_survey_update(Request $request, $id){

        $site_survey_status = $request['site_survey_status'];
        $circuit_id = $request['circuit_id'];
        $service_id = $request['service_id'];
        $planning_status = $request['planning_status'];
        $landlord_approval_status = $request['landlord_approval_status'];
        $survey_date_received_from = $request['survey_date_received_from'];
        $survey_date_on_hold = $request['survey_date_on_hold'];
        $date_site_survey = $request['date_site_survey'];
        $project_status = $request['project_status'];

        $update_master_file_record = SiteSurveyStatus::updateOrCreate([
            'circuit_id' => $circuit_id,
            'service_id' => $service_id, 
        ],
        [
          'circuit_id' => $circuit_id,
          'service_id' => $service_id,
          'site_survey_status' => $site_survey_status,
          'survey_date_on_hold' => $survey_date_on_hold,
          'survey_date_received_from' => $survey_date_received_from,        
          'date_site_survey' => $date_site_survey,
          'survey_date_received_from_site_a' => $request['survey_date_received_from_site_a'],
          'date_site_survey_a' => $request['date_site_survey_a'],
          'survey_date_on_hold_site_a' => $request['survey_date_on_hold_site_a'],
        ]
        );
        //print_r($update_master_file_record);exit;
        
         //Check if data is updated or not
         if($update_master_file_record){    
          //call another function
          if($site_survey_status == 'C) Schedule Site Survey' AND $planning_status == 'B) WP1 Stage'){
            $new_project_status = 'C) In-Survey';
          } elseif($planning_status == 'D) WP2 Stage'  AND  $site_survey_status == 'E) Site Survey Completed'){
            $new_project_status = 'D) In-Planning';
          }  elseif($site_survey_status == 'F) Not Required' && $planning_status == 'D) WP2 Stage'){
            $new_project_status = 'D) In-Planning';
          } else {
            $new_project_status = $project_status;  
          }

          //check sales status
          $sales_status = 'A) New Sales';
          if($site_survey_status == 'J) Data Fix'){
            $sales_status = 'F) Data Fix';
          } 
            $update_record = SiteMasterFile::where('circuit_id',$circuit_id)->update([
                'project_status' => $new_project_status,
                'sales_status' => $sales_status,
            ]);

          $this->update_single_site_survey_status($request,$circuit_id);
             //Call Manage History Helper
             $fieldsStr = '';
             $valuesStr = ''; 
             $module_type = "Planning";
             $page_name = url()->previous();
             Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
            return back()->with('success','Record Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

     // common function for update site survey single page
     public function update_single_site_survey_status($request,$circuit_id){
        // echo "<pre>"; print_r($request->all()); exit;     
  
      //Get request for planning records
       $planning_record = [
                                  'site_a_status' => $request['site_a_status'],
                                  'site_b_status' => $request['site_b_status'],
                                  'comment' => $request['Comment'],               
                          ]; 
          
         //Get request for permission records
         $site_a_lla_submitted = null;
         if( $request['site_a_lla_submitted']){
         $site_a_lla_submitted = Carbon::parse($request['site_a_lla_submitted']);
         }
         $site_a_lla_received = null;
         if( $request['site_a_lla_received']){
         $site_a_lla_received = Carbon::parse($request['site_a_lla_received']);
         }
         $site_b_lla_submitted = null;
         if( $request['site_b_lla_submitted']){
         $site_b_lla_submitted = Carbon::parse($request['site_b_lla_submitted']);
         }
         $site_b_lla_received = null;
         if( $request['site_b_lla_received']){
         $site_b_lla_received = Carbon::parse($request['site_b_lla_received']);
         }
         $permission_record = [
                                 'site_a_lla_submitted' =>   $site_a_lla_submitted,
                                 'site_a_lla_received' =>  $site_a_lla_received,  
                                 'site_b_lla_submitted' =>  $site_b_lla_submitted, 
                                 'site_b_lla_received' =>  $site_b_lla_received,          
                              ];
                          


         //Update Planing
         $update_planning_master_file_record = PlanningMasterFile::Where('circuit_id', $circuit_id)->update($planning_record); 
         $update_permission_master_file_record = PermissionMasterFile::Where('circuit_id', $circuit_id)->update($permission_record);
     }
}
