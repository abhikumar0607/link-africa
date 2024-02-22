<?php

namespace App\Imports;

use App\Models\BuildMasterFile;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;

class ImportBuildMasterFile implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(collection $rows)
    {
		foreach($rows as $row){
        $current_date_time = Carbon::now();
        $service_id= $row['service_id'];
        $circuit_id = $row['circuit_id'];
        $datenew = null;
        if($row['datenew']){
           $datenew = Carbon::parse($row['datenew']);
        }
        $build_status = $row['build_status'];
        $build_duration = $row['build_duration'];
        $planned_start_date = null;
        if($row['planned_start_date']){
           $planned_start_date = Carbon::parse($row['planned_start_date']);
        }
        $revised_build_start_date = null;
        if($row['revised_build_start_date']){
           $revised_build_start_date = Carbon::parse($row['revised_build_start_date']);
        }
        $revised_build_co_date = null;
        if($row['revised_build_co_date']){
           $revised_build_co_date = Carbon::parse($row['revised_build_co_date']);
        }
        $actual_build_completion_date = null;
        if($row['actual_build_completion_date']){
            $actual_build_completion_date = Carbon::parse($row['actual_build_completion_date']);
        }
        
        $isp_contractor = $row['isp_contractor'];
        $osp_contractor = $row['osp_contractor'];
        $project_leader = $row['project_leader'];
        $build_completion = $row['build_completion'];
        $toc_submitted = null;
        if($row['toc_submitted']){
            $toc_submitted = Carbon::parse($row['toc_submitted']);
        }
        $toc_received = null;
        if($row['toc_received']){
            $toc_received = Carbon::parse($row['toc_received']);
        }
        $otoc = $row['otoc'];
        $potoc = $row['potoc'];
        $comments = $row['comments'];
        $po_requested = null;
        if($row['po_requested']){
            $po_requested = Carbon::parse($row['po_requested']);
        }
        $po_received = null;
        if($row['po_received']){
            $po_received = Carbon::parse($row['po_received']);
        }
        $isp_a_project_leader = $row['isp_a_project_leader'];
        $isp_a_civil_contractor = $row['isp_a_civil_contractor'];
        $isp_a_jetting_contractor = $row['isp_a_jetting_contractor'];
        $isp_a_re_instatement_contractor = $row['isp_a_re_instatement_contractor'];
        $isp_a_drilling_contractor = $row['isp_a_drilling_contractor'];
        $isp_a_floating_contractor = $row['isp_a_floating_contractor'];
        $isp_a_focus_contractor = $row['isp_a_focus_contractor'];
        $isp_b_project_leader = $row['isp_b_project_leader'];
        $isp_b_civil_contractor = $row['isp_b_civil_contractor'];
        $isp_b_jetting_contractor = $row['isp_b_jetting_contractor'];
        $isp_b_re_instatement_contractor = $row['isp_b_re_instatement_contractor'];
        $isp_b_drilling_contractor = $row['isp_b_drilling_contractor'];
        $isp_b_floating_contractor = $row['isp_b_floating_contractor'];
        $isp_b_focus_contractor = $row['isp_b_focus_contractor'];
        //Meta values
        $osp_project_leader = $row['osp_project_leader'];
        $osp_civil_contractor = $row['osp_civil_contractor'];
        $osp_jetting_contractor = $row['osp_jetting_contractor'];
        $osp_re_instatement_contractor = $row['osp_re_instatement_contractor'];
        $osp_drilling_contractor = $row['osp_drilling_contractor'];
        $osp_focus_contractor = $row['osp_focus_contractor'];
        $splicing_team = $row['splicing_team'];
        $name = $row['name'];
        $province = $row['province'];
        $build_planned_completion_dates = $row['build_planned_completion_dates'];
        $osp_asbuild_submission = $row['osp_asbuild_submission'];
        $isp_asbuild_submission = $row['isp_asbuild_submission'];
        $osp_asbuild_received = $row['osp_asbuild_received'];
        $isp_asbuild_received = $row['isp_asbuild_received'];
        $vo_submitted = $row['vo_submitted'];
        $vo_received = $row['vo_received'];
        $vo_po_requested = $row['vo_po_requested'];
        $vo_po_received = $row['vo_po_received'];
        $vo_submitted2 = $row['vo_submitted2'];
        $vo_received2 = $row['vo_received2'];
        $vo_po_requested2 = $row['vo_po_requested2'];
        $vo_po_received2 = $row['vo_po_received2'];
        $vo_submitted3 = $row['vo_submitted3'];
        $vo_received3 = $row['vo_received3'];
        $vo_po_requested3 = $row['vo_po_requested3'];
        $vo_po_received3 = $row['vo_po_received3'];
        $vo_submitted4 = $row['vo_submitted4'];
        $vo_received4 = $row['vo_received4'];
        $vo_po_requested4 = $row['vo_po_requested4'];
        $vo_po_received4 = $row['vo_po_received4'];
        $build_osp_status = $row['build_osp_status'];
        $qa_requested = $row['qa_requested'];
        $fac_submitted = $row['fac_submitted'];
        $fac_received = $row['fac_received'];
        $actual_osp_build_distance_trench = $row['actual_osp_build_distance_trench'];
        $actual_osp_build_distance_3rd_party_ducts = $row['actual_osp_build_distance_3rd_party_ducts'];
        $actual_osp_build_la_existing_duct = $row['actual_osp_build_la_existing_duct'];
        $actual_osp_build_la_existing_network = $row['actual_osp_build_la_existing_network'];
        $actual_osp_build_distance_focus = $row['actual_osp_build_distance_focus'];
        $actual_osp_build_in_building_conduits = $row['actual_osp_build_in_building_conduits'];
        $actual_osp_110_sleeves_build = $row['actual_osp_110_sleeves_build'];
        $actual_osp_drilling_distance_build = $row['actual_osp_drilling_distance_build'];
        $actual_osp_micro_duct_distance_build = $row['actual_osp_micro_duct_distance_build'];
        $actual_ops_build_total_distance = $row['actual_ops_build_total_distance'];
        $actual_build_completion = $row['actual_build_completion'];
        $actual_osp_mh_500_x_500_build = $row['actual_osp_mh_500_x_500_build'];
        $actual_osp_mh_1000_x_500_build = $row['actual_osp_mh_1000_x_500_build'];
        $osp_asb_trench = $row['osp_asb_trench'];
        $osp_asb_3rd_party_ducts = $row['osp_asb_3rd_party_ducts'];
        $osp_asb_la_existing_duct = $row['osp_asb_la_existing_duct'];
        $osp_asb_existing_network = $row['osp_asb_existing_network'];
        $osp_asb_distance_focus = $row['osp_asb_distance_focus'];
        $osp_asb_in_building_conduits = $row['osp_asb_in_building_conduits'];
        $isp_a_asb_trench = $row['isp_a_asb_trench'];
        $isp_a_asb_3rd_party_ducts = $row['isp_a_asb_3rd_party_ducts'];
        $isp_a_asb_la_existing_duct = $row['isp_a_asb_la_existing_duct'];
        $isp_a_asb_existing_network = $row['isp_a_asb_existing_network'];
        $isp_a_asb_distance_focus = $row['isp_a_asb_distance_focus'];
        $isp_a_asb_in_building_conduits = $row['isp_a_asb_in_building_conduits'];
        $isp_b_asb_trench = $row['isp_b_asb_trench'];
        $isp_b_asb_3rd_party_ducts = $row['isp_b_asb_3rd_party_ducts'];
        $isp_b_asb_la_existing_duct = $row['isp_b_asb_la_existing_duct'];
        $isp_b_asb_existing_network = $row['isp_b_asb_existing_network'];
        $isp_b_asb_distance_focus = $row['isp_b_asb_distance_focus'];
        $isp_b_asb_in_building_conduits = $row['isp_b_asb_in_building_conduits'];
        $otdr_distance = $row['otdr_distance'];
        $final_sectional_date = $row['final_sectional_date'];
        //$mat = $row['mat'];
        //$dmi = $row['dmi'];
        $osp_floating_contractor = $row['osp_floating_contractor'];
        
       
        //Insert query
        $insert_master_file_record = BuildMasterFile::Where('service_id',$service_id)->Where('circuit_id',$service_id)->whereNull('datenew')->whereNull('build_status')->update([
            'circuit_id'  => $service_id,
            'datenew'  => $datenew,
            'build_status'  => $build_status,
            'build_duration'  => $build_duration,
            'planned_start_date'  => $planned_start_date,
            'revised_build_start_date'  => $revised_build_start_date,
            'revised_build_co_date'  => $revised_build_co_date,
            'actual_build_completion_date'  => $actual_build_completion_date,
            'isp_contractor'  => $isp_contractor,
            'osp_contractor'  => $osp_contractor,
            'project_leader'  => $project_leader,
            'build_completion'  => $build_completion,
            'toc_submitted'  => $toc_submitted,
            'toc_received'  => $toc_received,
            'otoc'  => $otoc,
            'potoc'  => $potoc,
            'comments'  => $comments,
            'po_requested'  => $po_requested,
            'po_received'  => $po_received,
            'isp_a_project_leader'  => $isp_a_project_leader,
            'isp_a_civil_contractor'  => $isp_a_civil_contractor,
            'isp_a_jetting_contractor'  => $isp_a_jetting_contractor,
            'isp_a_drilling_contractor'  => $isp_a_drilling_contractor,
            'isp_a_floating_contractor'  => $isp_a_floating_contractor,
            'isp_a_focus_contractor'  => $isp_a_focus_contractor,
            'isp_b_project_leader'  => $isp_b_project_leader,
            'isp_b_civil_contractor'  => $isp_b_civil_contractor,
            'isp_b_jetting_contractor'  => $isp_b_jetting_contractor,
            'isp_b_re_instatement_contractor'  => $isp_b_re_instatement_contractor,
            'isp_b_drilling_contractor'  => $isp_b_drilling_contractor,
            'isp_b_floating_contractor'  => $isp_b_floating_contractor,
            'isp_b_focus_contractor'  => $isp_b_focus_contractor,
        	'created_at'  => $current_date_time,
        	'updated_at'  => $current_date_time,
        	"osp_project_leader" =>  $osp_project_leader, 
            "osp_civil_contractor" => $osp_civil_contractor,
            "osp_jetting_contractor" => $osp_jetting_contractor,
            "osp_re_instatement_contractor" => $osp_re_instatement_contractor,
            "osp_drilling_contractor" => $osp_drilling_contractor,
            "osp_focus_contractor" => $osp_focus_contractor,
            "splicing_team" => $splicing_team,
            "name" => $name,
            "province" => $province,
            "build_planned_completion_dates" => $build_planned_completion_dates,
            "osp_asbuild_submission" => $osp_asbuild_submission,
            "isp_asbuild_submission" => $isp_asbuild_submission,
            "osp_asbuild_received" => $osp_asbuild_received,
            "isp_asbuild_received" => $isp_asbuild_received,
            "vo_submitted" => $vo_submitted,
            "vo_received" => $vo_received,
            "vo_po_requested" => $vo_po_requested,
            "vo_po_received" => $vo_po_received,
            "vo_submitted2" => $vo_submitted2,
            "vo_received2" => $vo_received2,
            "vo_po_requested2" => $vo_po_requested2,
            "vo_po_received2" => $vo_po_received2,
            "vo_submitted3" => $vo_submitted3,
            "vo_received3" => $vo_received3,
            "vo_po_requested3" => $vo_po_requested3,
            "vo_po_received3" => $vo_po_received3,
            "vo_submitted4" => $vo_submitted4,
            "vo_received4" => $vo_received4,
            "vo_po_requested4" => $vo_po_requested4,
            "vo_po_received4" => $vo_po_received4,
            "build_osp_status" => $build_osp_status,
            "qa_requested" => $qa_requested,
            "fac_submitted" => $fac_submitted,
            "fac_received" => $fac_received,
            "actual_osp_build_distance_trench" => $actual_osp_build_distance_trench,
            "actual_osp_build_distance_3rd_party_ducts" => $actual_osp_build_distance_3rd_party_ducts,
            "actual_osp_build_la_existing_duct" => $actual_osp_build_la_existing_duct,
            "actual_osp_build_la_existing_network" => $actual_osp_build_la_existing_network,
            "actual_osp_build_distance_focus" => $actual_osp_build_distance_focus,
            "actual_osp_build_in_building_conduits" => $actual_osp_build_in_building_conduits,
            "actual_osp_110_sleeves_build" => $actual_osp_110_sleeves_build,
            "actual_osp_drilling_distance_build" => $actual_osp_drilling_distance_build,
            "actual_osp_micro_duct_distance_build" => $actual_osp_micro_duct_distance_build,
            "actual_ops_build_total_distance" => $actual_ops_build_total_distance,
            "actual_build_completion" => $actual_build_completion,
            "actual_osp_mh_500_x_500_build" => $actual_osp_mh_500_x_500_build,
            "actual_osp_mh_1000_x_500_build" => $actual_osp_mh_1000_x_500_build,
            "osp_asb_trench" => $osp_asb_trench,
            "osp_asb_3rd_party_ducts" => $osp_asb_3rd_party_ducts,
            "osp_asb_la_existing_duct" => $osp_asb_la_existing_duct,
            "osp_asb_existing_network" => $osp_asb_existing_network,
            "osp_asb_distance_focus" => $osp_asb_distance_focus,
            "osp_asb_in_building_conduits" => $osp_asb_in_building_conduits,
            "isp_a_asb_trench" => $isp_a_asb_trench,
            "isp_a_asb_3rd_party_ducts" => $isp_a_asb_3rd_party_ducts,
            "isp_a_asb_la_existing_duct" => $isp_a_asb_la_existing_duct,
            "isp_a_asb_existing_network" => $isp_a_asb_existing_network,
            "isp_a_asb_distance_focus" => $isp_a_asb_distance_focus,
            "isp_a_asb_in_building_conduits" => $isp_a_asb_in_building_conduits,
            "isp_b_asb_trench" => $isp_b_asb_trench,
            "isp_b_asb_3rd_party_ducts" => $isp_b_asb_3rd_party_ducts,
            "isp_b_asb_la_existing_duct" => $isp_b_asb_la_existing_duct,
            "isp_b_asb_existing_network" => $isp_b_asb_existing_network,
            "isp_b_asb_distance_focus" => $isp_b_asb_distance_focus,
            "isp_b_asb_in_building_conduits" => $isp_b_asb_in_building_conduits,
            "otdr_distance" => $otdr_distance,
            //"mat" => $mat
            //"DMI" => $dmi, 
            "osp_floating_contractor" => $osp_floating_contractor,
       ]);
		}
        //check if record in inserted or not
        if($insert_master_file_record){
           return  $insert_master_file_record;
        }
    }
}
