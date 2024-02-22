<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandlordApproval;
use App\Models\SiteMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\PlanningMasterFile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Helper;

class LandlordApprovalController extends Controller
{
    //function for submit landlord approval
    public function landlord_approval_update(Request $request, $id){

        //echo $request['landlord_date_received_from_site_a'];exit;
        $planning_status = $request['planning_status'];
     
        $project_status = $request['project_status'];
        $landlord_approval_status = $request['landlord_approval_status'];
         //echo $landlord_approval_status;exit;
        $circuit_id = $request['circuit_id'];
        $service_id = $request['service_id'];
        //$landlord_approval_status = $request['landlord_approval_status'];
        $landlord_date_received_from = $request['landlord_date_received_from'];
        $date_submit_for_landlord = $request['date_submit_for_landlord'];
        $date_landlord_approval = $request['date_landlord_approval'];
        $landlord_date_on_hold = $request['landlord_date_on_hold'];   
        $update_master_file_record = LandlordApproval::updateOrCreate([
            'circuit_id' => $circuit_id,
            'service_id' => $service_id, 
        ],
        [
            'landlord_approval_status' => $landlord_approval_status,
            'circuit_id' => $circuit_id,
            'service_id' => $service_id,
            'landlord_date_received_from' => $landlord_date_received_from,
            'date_submit_for_landlord' => $date_submit_for_landlord,
            'date_landlord_approval' => $date_landlord_approval,        
            'landlord_date_on_hold' => $landlord_date_on_hold,
            'landlord_date_received_from_site_a' => $request['landlord_date_received_from_site_a'],
            'date_submit_for_landlord_site_a' => $request['date_submit_for_landlord_site_a'],
            'date_landlord_approval_site_a' => $request['date_landlord_approval_site_a'],
            'landlord_date_on_hold_site_a' => $request['landlord_date_on_hold_site_a'],
        ]
        );
        //print_r($update_master_file_record);exit;
         //Check if data is updated or not
         if($update_master_file_record){       
                       
            if($landlord_approval_status == 'F) Not Required'){
                $new_project_status = 'D) In-Planning';
            } elseif($landlord_approval_status == 'E) Approved'){
                $new_project_status = 'D) In-Planning';
            } elseif($planning_status == 'E) Submit for Landlord Approval'  AND  $landlord_approval_status == 'C) Submit for Landlord Approval'){
                $new_project_status = 'E) Landlord-Approval';
            } else{
                $new_project_status = $project_status;  
            }

            //check sales status
            $sales_status = 'A) New Sales';
            if($landlord_approval_status == 'J) Data Fix'){
                $sales_status = 'F) Data Fix';
            } 
                $update_record = SiteMasterFile::where('circuit_id',$circuit_id)->update([
                    'project_status' => $new_project_status,
                    'sales_status' => $sales_status,
                ]);
            //call another function
            $this->update_single_landlord_approval($request,$circuit_id);
               //Call Manage History Helper
               $module_type = "Planning";
               $fieldsStr = '';
               $valuesStr = ''; 
               $page_name = url()->previous();
               Helper::submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr);
            return back()->with('success','Record Updated Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

         // common function for update landlordapproval survey single page
         public function update_single_landlord_approval($request,$circuit_id){
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
