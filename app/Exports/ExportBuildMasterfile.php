<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\BuildMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportBuildMasterfile implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'service_id',
            'circuit_id',
            'datenew',
            'build_status',
            'build_duration',
            'planned_start_date',
            'revised_build_start_date',
            'revised_build_co_date',
            'actual_build_completion_date',
            'isp_contractor',
            'osp_contractor',
            'project_leader',
            'build_completion',
            'toc_submitted',
            'toc_received',
            'otoc',
            'potoc',
            'comments',
            'po_requested',
            'po_received',
            'isp_a_project_leader',
            'isp_a_civil_contractor',
            'isp_a_jetting_contractor',
            'isp_a_re_instatement_contractor',
            'isp_a_drilling_contractor',
            'isp_a_floating_contractor',
            'isp_a_focus_contractor',
            'isp_b_project_leader',
            'isp_b_civil_contractor',
            'isp_b_jetting_contractor',
            'isp_b_re_instatement_contractor',
            'isp_b_drilling_contractor',
            'isp_b_floating_contractor',
            'isp_b_focus_contractor',
            'osp_project_leader',
            'osp_civil_contractor',
            'osp_jetting_contractor',
            'osp_re_instatement_contractor',
            'osp_drilling_contractor',
            'osp_focus_contractor',
            'splicing_team',
            'name',
            'province',
            'build_planned_completion_dates',
            'osp_asbuild_submission',
            'isp_asbuild_submission',
            'osp_asbuild_received',
            'isp_asbuild_received',
            'vo_submitted',
            'vo_received',
            'vo_po_requested',
            'vo_po_received',
            'vo_submitted2',
            'vo_received2',
            'vo_po_requested2',
            'vo_po_received2',
            'vo_submitted3',
            'vo_received3',
            'vo_po_requested3',
            'vo_po_received3',
            'vo_submitted4',
            'vo_received4',
            'vo_po_requested4',
            'vo_po_received4',
            'build_osp_status',
            'qa_requested',
            'fac_submitted',
            'fac_received',
            'actual_osp_build_distance_trench',
            'actual_osp_build_distance_3rd_party_ducts',
            'actual_osp_build_la_existing_duct',
            'actual_osp_build_la_existing_network',
            'actual_osp_build_distance_focus',
            'actual_osp_build_in_building_conduits',
            'actual_osp_110_sleeves_build',
            'actual_osp_drilling_distance_build',
            'actual_osp_micro_duct_distance_build',
            'actual_ops_build_total_distance',
            'actual_build_completion',
            'actual_osp_mh_500_x_500_build',
            'actual_osp_mh_1000_x_500_build',
            'osp_asb_trench',
            'osp_asb_3rd_party_ducts',
            'osp_asb_la_existing_duct',
            'osp_asb_existing_network',
            'osp_asb_distance_focus',
            'osp_asb_in_building_conduits',
            'isp_a_asb_trench',
            'isp_a_asb_3rd_party_ducts',
            'isp_a_asb_la_existing_duct',
            'isp_a_asb_existing_network',
            'isp_a_asb_distance_focus',
            'isp_a_asb_in_building_conduits',
            'isp_b_asb_trench',
            'isp_b_asb_3rd_party_ducts',
            'isp_b_asb_la_existing_duct',
            'isp_b_asb_existing_network',
            'isp_b_asb_distance_focus',
            'isp_b_asb_in_building_conduits',
            'otdr_distance',
            'final_sectional_date',
            'mat',
            'DMI',
            'osp_floating_contractor',
            'build_percantage',
            'Submitted_to_customer',
            'toc_received_date_recieved',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $records =  BuildMasterFile::get();
        $all_records = [];
        foreach ($records as $key => $value) {
            $all_records[] = [
                'service_id' => $value->service_id,
                'circuit_id' => $value->circuit_id,
                'datenew' => $value->datenew,
                'build_status' => $value->build_status,
                'build_duration' => $value->build_duration,
                'planned_start_date' =>  $value->planned_start_date,
                'revised_build_start_date' =>  $value->revised_build_start_date,
                'revised_build_co_date' =>  $value->revised_build_co_date,
                'actual_build_completion_date' => $value->actual_build_completion_date,
                'isp_contractor' =>  $value->isp_contractor,
                'osp_contractor' => $value->osp_contractor,
                'project_leader' => $value->project_leader,
                'build_completion' => $value->build_completion,
                'toc_submitted' => $value->toc_submitted,
                'toc_received' => $value->toc_received,
                'otoc' => $value->otoc,
                'potoc' => $value->potoc,
                'comments' => $value->comments,
                'po_requested' => $value->po_requested,
                'po_received' => $value->po_received,
                'isp_a_project_leader' => $value->isp_a_project_leader,
                'isp_a_civil_contractor' => $value->isp_a_civil_contractor,
                'isp_a_jetting_contractor' => $value->isp_a_jetting_contractor,
                'isp_a_re_instatement_contractor' => $value->isp_a_re_instatement_contractor,
                'isp_a_drilling_contractor' => $value->isp_a_drilling_contractor,
                'isp_a_floating_contractor' => $value->isp_a_floating_contractor,
                'isp_a_focus_contractor' => $value->isp_a_focus_contractor,
                'isp_b_project_leader' => $value->isp_b_project_leader,
                'isp_b_civil_contractor' => $value->isp_b_civil_contractor,
                'isp_b_jetting_contractor' => $value->isp_b_jetting_contractor,
                'isp_b_re_instatement_contractor' => $value->isp_b_re_instatement_contractor,
                'isp_b_drilling_contractor' => $value->isp_b_drilling_contractor,
                'isp_b_floating_contractor' => $value->isp_b_floating_contractor,
                'isp_b_focus_contractor' => $value->isp_b_focus_contractor,
                'osp_project_leader' => $value->osp_project_leader,
                'osp_civil_contractor' => $value->osp_civil_contractor,
                'osp_jetting_contractor' => $value->osp_jetting_contractor,
                'osp_re_instatement_contractor' => $value->osp_re_instatement_contractor,
                'osp_drilling_contractor' => $value->osp_drilling_contractor,
                'osp_focus_contractor' => $value->osp_focus_contractor,
                'splicing_team' => $value->splicing_team,
                'name' => $value->name,
                'province' => $value->province,
                'build_planned_completion_dates' => $value->build_planned_completion_dates,
                'osp_asbuild_submission' => $value->osp_asbuild_submission,
                'isp_asbuild_submission' => $value->isp_asbuild_submission,
                'osp_asbuild_received' => $value->osp_asbuild_received,
                'isp_asbuild_received' => $value->isp_asbuild_received,
                'vo_submitted' => $value->vo_submitted,
                'vo_received' => $value->vo_received,
                'vo_po_requested' => $value->vo_po_requested,
                'vo_po_received' => $value->vo_po_received,
                'vo_submitted2' => $value->vo_submitted2,
                'vo_received2' => $value->vo_received2,
                'vo_po_requested2' => $value->vo_po_requested2,
                'vo_po_received2' => $value->vo_po_received2,
                'vo_submitted3' => $value->vo_submitted3,
                'vo_received3' => $value->vo_received3,
                'vo_po_requested3' => $value->vo_po_requested3,
                'vo_po_received3' => $value->vo_po_received3,
                'vo_submitted4' => $value->vo_submitted4,
                'vo_received4' => $value->vo_received4,
                'vo_po_requested4' => $value->vo_po_requested4,
                'vo_po_received4' => $value->vo_po_received4,
                'build_osp_status' => $value->build_osp_status,
                'qa_requested' =>  $value->qa_requested,
                'fac_submitted' => $value->fac_submitted,
                'fac_received' => $value->fac_received,
                'actual_osp_build_distance_trench' => $value->actual_osp_build_distance_trench,
                'actual_osp_build_distance_3rd_party_ducts' => $value->actual_osp_build_distance_3rd_party_ducts,
                'actual_osp_build_la_existing_duct' => $value->actual_osp_build_la_existing_duct,
                'actual_osp_build_la_existing_network' => $value->actual_osp_build_la_existing_network,
                'actual_osp_build_distance_focus' => $value->actual_osp_build_distance_focus,
                'actual_osp_build_in_building_conduits' => $value->actual_osp_build_in_building_conduits,
                'actual_osp_110_sleeves_build' => $value->actual_osp_110_sleeves_build,
                'actual_osp_drilling_distance_build' => $value->actual_osp_drilling_distance_build,
                'actual_osp_micro_duct_distance_build' => $value->actual_osp_micro_duct_distance_build,
                'actual_ops_build_total_distance' => $value->actual_ops_build_total_distance,
                'actual_build_completion' => $value->actual_build_completion,
                'actual_osp_mh_500_x_500_build' => $value->actual_osp_mh_500_x_500_build,
                'actual_osp_mh_1000_x_500_build' => $value->actual_osp_mh_1000_x_500_build,
                'osp_asb_trench' => $value->osp_asb_trench,
                'osp_asb_3rd_party_ducts' => $value->osp_asb_3rd_party_ducts,
                'osp_asb_la_existing_duct' => $value->osp_asb_la_existing_duct,
                'osp_asb_existing_network' => $value->osp_asb_existing_network,
                'osp_asb_distance_focus' => $value->osp_asb_distance_focus,
                'osp_asb_in_building_conduits' => $value->osp_asb_in_building_conduits,
                'isp_a_asb_trench' => $value->isp_a_asb_trench,
                'isp_a_asb_3rd_party_ducts' => $value->isp_a_asb_3rd_party_ducts,
                'isp_a_asb_la_existing_duct' => $value->isp_a_asb_la_existing_duct,
                'isp_a_asb_existing_network' => $value->isp_a_asb_existing_network,
                'isp_a_asb_distance_focus' => $value->isp_a_asb_distance_focus,
                'isp_a_asb_in_building_conduits' => $value->isp_a_asb_in_building_conduits,
                'isp_b_asb_trench' => $value->isp_b_asb_trench,
                'isp_b_asb_3rd_party_ducts' => $value->isp_b_asb_3rd_party_ducts,
                'isp_b_asb_la_existing_duct' => $value->isp_b_asb_la_existing_duct,
                'isp_b_asb_existing_network' => $value->isp_b_asb_existing_network,
                'isp_b_asb_distance_focus' => $value->isp_b_asb_distance_focus,
                'isp_b_asb_in_building_conduits' => $value->isp_b_asb_in_building_conduits,
                'otdr_distance' => $value->otdr_distance,
                'final_sectional_date' => $value->final_sectional_date,
                'mat' => $value->mat,
                'DMI' => $value->DMI,
                'osp_floating_contractor' => $value->osp_floating_contractor,
                'build_percantage' => $value->build_percantage,
                'Submitted_to_customer' => $value->Submitted_to_customer,
                'toc_received_date_recieved' => $value->toc_received_date_recieved,
            ];
        }
        return collect($all_records);
    }
}