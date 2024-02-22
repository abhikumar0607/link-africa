<?php

namespace App\Imports;

use App\Models\PlanningMasterFile;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;

class ImportPlanningMasterFile implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(collection $rows)
    {

        foreach ($rows as $row) 
        {
        $current_date_time = Carbon::now();
        $id = $row['id'];
        $service_id= $row['service_id'];
        $circuit_id = $row['circuit_id'];
        $datenew = null;
        if($row['datenew']){
            $datenew = Carbon::parse($row['datenew']);
        }
        $planning_status = $row['planning_status'];
        $rx_in_planning = null;
        if($row['rx_in_planning']){
            $rx_in_planning = Carbon::parse($row['rx_in_planning']);
        }
        $planning_wp2_wl_submission = null;
        if($row['planning_wp2_wl_submission']){
            $planning_wp2_wl_submission = Carbon::parse($row['planning_wp2_wl_submission']);
        }
        $planned_wp2_released_date = null;
        if($row['planned_wp2_released_date']){
            $planned_wp2_released_date = Carbon::parse($row['planned_wp2_released_date']);
        }
        $revised_planned_wp2_date = null;
        if($row['revised_planned_wp2_date']){
            $revised_planned_wp2_date = Carbon::parse($row['revised_planned_wp2_date']);
        }
        $wp2_approval_requested = null;
        if($row['wp2_approval_requested']){
            $wp2_approval_requested = Carbon::parse($row['wp2_approval_requested']);
        }
        $wp2_approval_received = null;
        if($row['wp2_approval_received']){
            $wp2_approval_received = Carbon::parse($row['wp2_approval_received']);
        }
        $isp_a_wp2_approval_received = null;
        if($row['isp_a_wp2_approval_received']){
            $isp_a_wp2_approval_received = Carbon::parse($row['isp_a_wp2_approval_received']);
        }
        $isp_a_wp2_approval_requested = null;
        if($row['isp_a_wp2_approval_requested']){
           $isp_a_wp2_approval_requested = Carbon::parse($row['isp_a_wp2_approval_requested']);
        }
        $isp_b_wp2_approval_received = null;
        if($row['isp_b_wp2_approval_received']){
           $isp_b_wp2_approval_received = Carbon::parse($row['isp_b_wp2_approval_received']);
        }
        $isp_b_wp2_approval_requested = null;
        if($row['isp_b_wp2_approval_requested']){
           $isp_b_wp2_approval_requested = Carbon::parse($row['isp_b_wp2_approval_requested']);
        }
        $osp_planners = $row['osp_planners'];
        $isp_planners = $row['isp_planners'];
        $surveyors = $row['surveyors'];
        $isp_distance = $row['isp_distance'];
        $osp_planners2 = $row['osp_planners2'];
        $isp_planners2 = $row['isp_planners2'];
        $surveyors2 = $row['surveyors2'];
        $site_a_id = $row['site_a_id'];
        $site_a_status = $row['site_a_status'];
        $site_a_survey_date = null;
        if($row['site_a_survey_date']){
           $site_a_survey_date = Carbon::parse($row['site_a_survey_date']);
        }
        $site_a_isp_submission = null;
        if($row['site_a_isp_submission']){
           $site_a_isp_submission = Carbon::parse($row['site_a_isp_submission']);
        }
        $site_a_comment = $row['site_a_comment'];
        $site_b_id = $row['site_b_id'];
        $site_b_status = $row['site_b_status'];
        $site_b_survey_date = null;
        if($row['site_b_survey_date']){
           $site_b_survey_date = Carbon::parse($row['site_b_survey_date']);
        }
        $site_b_isp_submission = null;
        if($row['site_b_isp_submission']){
           $site_b_isp_submission = Carbon::parse($row['site_b_isp_submission']);
        }
        $site_b_comment = $row['site_b_comment'];
        //Meta values
        $comment = $row['comment'];
        $cost_pm = $row['cost_pm'];
        $province = $row['province'];
        $labour_cost_osp = $row['labour_cost_osp'];
        $material_cost_osp = $row['material_cost_osp'];
        $total_boq_value_osp = $row['total_boq_value_osp'];
        $labour_cost_vo_osp = $row['labour_cost_vo_osp'];
        $material_cost_vo_osp = $row['material_cost_vo_osp'];
        $total_boq_value_vo_osp = $row['total_boq_value_vo_osp'];
        $labour_cost_vo_isp_a = $row['labour_cost_vo_isp_a'];
        $material_cost_vo_isp_a = $row['material_cost_vo_isp_a'];
        $total_boq_value_vo_isp_a = $row['total_boq_value_vo_isp_a'];
        $labour_cost_vo_isp_b = $row['labour_cost_vo_isp_b'];
        $material_cost_vo_isp_b = $row['material_cost_vo_isp_b'];
        $total_boq_value_vo_isp_b = $row['total_boq_value_vo_isp_b'];
        $total_project_cost = $row['total_project_cost'];
        $osp_status_panning = $row['osp_status_panning'];
        $osp_distance_trench = $row['osp_distance_trench'];
        $osp_distance_3rd_party_ducts = $row['osp_distance_3rd_party_ducts'];
        $osp_la_existing_duct = $row['osp_la_existing_duct'];
        $osp_la_existing_network = $row['osp_la_existing_network'];
        $osp_distance_focus = $row['osp_distance_focus'];
        $osp_in_buildin_conduits = $row['osp_in_buildin_conduits'];
        $ops_total_distance = $row['ops_total_distance'];
        $isp_a_distance_trench = $row['isp_a_distance_trench'];
        $isp_a_distance_3rd_party_ducts = $row['isp_a_distance_3rd_party_ducts'];
        $isp_a_la_existing_duct = $row['isp_a_la_existing_duct'];
        $isp_a_la_existing_network = $row['isp_a_la_existing_network'];
        $isp_a_distance_focus = $row['isp_a_distance_focus'];
        $isp_a_in_buildin_conduits = $row['isp_a_in_buildin_conduits'];
        $isp_a_total_distance = $row['isp_a_total_distance'];
        $isp_b_distance_trench = $row['isp_b_distance_trench'];
        $isp_b_distance_3rd_party_ducts = $row['isp_b_distance_3rd_party_ducts'];
        $isp_b_la_existing_duct = $row['isp_b_la_existing_duct'];
        $isp_b_la_existing_network = $row['isp_b_la_existing_network'];
        $isp_b_distance_focus = $row['isp_b_distance_focus'];
        $isp_b_in_buildin_conduits = $row['isp_b_in_buildin_conduits'];
        $isp_b_total_distance = $row['isp_b_total_distance'];
        $labour_cost_isp_a = $row['labour_cost_isp_a'];
        $material_cost_isp_a = $row['material_cost_isp_a'];
        $total_boq_value_isp_a = $row['total_boq_value_isp_a'];
        $labour_cost_isp_b = $row['labour_cost_isp_b'];
        $material_cost_isp_b = $row['material_cost_isp_b'];
        $total_boq_value_isp_b = $row['total_boq_value_isp_b'];
        $link_dependency = $row['link_dependency'];
        //$dmi = $row['dmi'];
        //$mat = $row['mat'];

        //Insert query
        
        $insert_master_file_record = PlanningMasterFile::Where('service_id',$service_id)->Where('circuit_id',$service_id)->whereNull('datenew')->whereNull('planning_status')->update([
                'datenew'  => $datenew,
                'planning_status'  => $planning_status,
                'rx_in_planning'  => $rx_in_planning,
                'planning_wp2_wl_submission'  => $planning_wp2_wl_submission,
                'planned_wp2_released_date'  => $planned_wp2_released_date,
                'revised_planned_wp2_date'  => $revised_planned_wp2_date,
                'wp2_approval_requested'  => $wp2_approval_requested,
                'wp2_approval_received'  => $wp2_approval_received,
                'isp_a_wp2_approval_received'  => $isp_a_wp2_approval_received,
                'isp_a_wp2_approval_requested'  => $isp_a_wp2_approval_requested,
                'isp_b_wp2_approval_received'  => $isp_b_wp2_approval_received,
                'isp_b_wp2_approval_requested'  => $isp_b_wp2_approval_requested,
                'osp_planners'  => $osp_planners,
                'isp_planners'  => $isp_planners,
                'surveyors'  => $surveyors,
                'isp_distance'  => $isp_distance,
                'osp_planners2'  => $osp_planners2,
                'isp_planners2'  => $isp_planners2,
                'surveyors2'  => $surveyors2,
                'site_a_id'  => $site_a_id,
                'site_a_status'  => $site_a_status,
                'site_a_survey_date'  => $site_a_survey_date,
                'site_a_isp_submission'  => $site_a_isp_submission,
                'site_a_comment'  => $site_a_comment,
                'site_b_id'  => $site_b_id,
                'site_b_status'  => $site_b_status,
                'site_b_survey_date'  => $site_b_survey_date,
                'site_b_isp_submission'  => $site_b_isp_submission,
                'site_b_comment'  => $site_b_comment,
            	'created_at'  => $current_date_time,
            	'updated_at'  => $current_date_time,
            	"comment" =>  $comment, 
                "cost_pm" => $cost_pm,
                "province" => $province,
                "labour_cost_osp" => $labour_cost_osp,
                "material_cost_osp" => $material_cost_osp,
                "total_boq_value_osp" => $total_boq_value_osp,
                "labour_cost_vo_osp" => $labour_cost_vo_osp,
                "material_cost_vo_osp" => $material_cost_vo_osp,
                "total_boq_value_vo_osp" => $total_boq_value_vo_osp,
                "labour_cost_vo_isp_a" => $labour_cost_vo_isp_a,
                "material_cost_vo_isp_a" => $material_cost_vo_isp_a,
                "total_boq_value_vo_isp_a" => $total_boq_value_vo_isp_a,
                "labour_cost_vo_isp_b" => $labour_cost_vo_isp_b,
                "material_cost_vo_isp_b" => $material_cost_vo_isp_b,
                "total_boq_value_vo_isp_b" => $total_boq_value_vo_isp_b,
                "total_project_cost" => $total_project_cost,
                "osp_status_panning" => $osp_status_panning,
                "osp_distance_trench" => $osp_distance_trench,
                "osp_distance_3rd_party_ducts" => $osp_distance_3rd_party_ducts,
                "osp_la_existing_duct" => $osp_la_existing_duct,
                "osp_la_existing_network" => $osp_la_existing_network,
                "osp_distance_focus" => $osp_distance_focus,
                "osp_in_buildin_conduits" => $osp_in_buildin_conduits,
                "ops_total_distance" => $ops_total_distance,
                "isp_a_distance_trench" => $isp_a_distance_trench,
                "isp_a_distance_3rd_party_ducts" => $isp_a_distance_3rd_party_ducts,
                "isp_a_la_existing_duct" => $isp_a_la_existing_duct,
                "isp_a_la_existing_network" => $isp_a_la_existing_network,
                "isp_a_distance_focus" => $isp_a_distance_focus,
                "isp_a_in_buildin_conduits" => $isp_a_in_buildin_conduits,
                "isp_a_total_distance" => $isp_a_total_distance,
                "isp_b_distance_trench" => $isp_b_distance_trench,
                "isp_b_distance_3rd_party_ducts" => $isp_b_distance_3rd_party_ducts,
                "isp_b_la_existing_duct" => $isp_b_la_existing_duct,
                "isp_b_la_existing_network" => $isp_b_la_existing_network,
                "isp_b_distance_focus" => $isp_b_distance_focus,
                "isp_b_in_buildin_conduits" => $isp_b_in_buildin_conduits,
                "isp_b_total_distance" => $isp_b_total_distance,
                "labour_cost_isp_a" => $labour_cost_isp_a,
                "material_cost_isp_a" => $material_cost_isp_a,
                "total_boq_value_isp_a" => $total_boq_value_isp_a,
                "labour_cost_isp_b" => $labour_cost_isp_b,
                "material_cost_isp_b" => $material_cost_isp_b,
                "total_boq_value_isp_b" => $total_boq_value_isp_b,
                "link_dependency" => $link_dependency,         
       ]);
    }
        //check if record in inserted or not
        if($insert_master_file_record){
           return  $insert_master_file_record;
        }

    }
}