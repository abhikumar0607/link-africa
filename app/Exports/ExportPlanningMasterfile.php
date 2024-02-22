<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\PlanningMasterFile;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportPlanningMasterfile implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'service_id',
            'circuit_id',
            'datenew',
            'planning_status',
            'rx_in_planning',
            'planning_wp2_wl_submission',
            'planned_wp2_released_date',
            'revised_planned_wp2_date',
            'wp2_approval_requested',
            'wp2_approval_received',
            'isp_a_wp2_approval_received',
            'isp_a_wp2_approval_requested',
            'isp_b_wp2_approval_received',
            'isp_b_wp2_approval_requested',
            'osp_planners',
            'isp_planners',
            'surveyors',
            'isp_distance',
            'osp_planners2',
            'isp_planners2',
            'surveyors2',
            'site_a_id',
            'site_a_status',
            'site_a_survey_date',
            'site_a_isp_submission',
            'site_a_comment',
            'site_b_id',
            'site_b_status',
            'site_b_survey_date',
            'site_b_isp_submission',
            'site_b_comment',
            'comment',
            'cost_pm',
            'province',
            'labour_cost_osp',
            'material_cost_osp',
            'total_boq_value_osp',
            'labour_cost_vo_osp',
            'material_cost_vo_osp',
            'total_boq_value_vo_osp',
            'labour_cost_vo_isp_a',
            'material_cost_vo_isp_a',
            'total_boq_value_vo_isp_a',
            'labour_cost_vo_isp_b',
            'material_cost_vo_isp_b',
            'total_boq_value_vo_isp_b',
            'total_project_cost',
            'osp_status_panning',
            'osp_distance_trench',
            'osp_distance_3rd_party_ducts',
            'osp_la_existing_duct',
            'osp_la_existing_network',
            'osp_distance_focus',
            'osp_in_buildin_conduits',
            'ops_total_distance',
            'isp_a_distance_trench',
            'isp_a_distance_3rd_party_ducts',
            'isp_a_la_existing_duct',
            'isp_a_la_existing_network',
            'isp_a_distance_focus',
            'isp_a_in_buildin_conduits',
            'isp_a_total_distance',
            'isp_b_distance_trench',
            'isp_b_distance_3rd_party_ducts',
            'isp_b_la_existing_duct',
            'isp_b_la_existing_network',
            'isp_b_distance_focus',
            'isp_b_in_buildin_conduits',
            'isp_b_total_distance',
            'labour_cost_isp_a',
            'material_cost_isp_a',
            'total_boq_value_isp_a',
            'labour_cost_isp_b',
            'material_cost_isp_b',
            'total_boq_value_isp_b',
            'link_dependency',
            'mat',
            'DMI',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $records = PlanningMasterFile::get();
        $all_records = [];
        foreach ($records as $key => $value) {
            $all_records[] = [
                'service_id' => $value->service_id,
                'circuit_id'=> $value->circuit_id,
                'datenew'=> $value->datenew,
                'planning_status'=> $value->planning_status,
                'rx_in_planning'=> $value->rx_in_planning,
                'planning_wp2_wl_submission'=> $value->planning_wp2_wl_submission,
                'planned_wp2_released_date'=> $value->planned_wp2_released_date,
                'revised_planned_wp2_date'=> $value->revised_planned_wp2_date,
                'wp2_approval_requested'=> $value->wp2_approval_requested,
                'wp2_approval_received'=> $value->wp2_approval_received,
                'isp_a_wp2_approval_received'=> $value->isp_a_wp2_approval_received,
                'isp_a_wp2_approval_requested'=> $value->isp_a_wp2_approval_requested,
                'isp_b_wp2_approval_received'=> $value->isp_b_wp2_approval_received,
                'isp_b_wp2_approval_requested'=> $value->isp_b_wp2_approval_requested,
                'osp_planners'=> $value->osp_planners,
                'isp_planners'=> $value->isp_planners,
                'surveyors'=> $value->surveyors,
                'isp_distance'=> $value->isp_distance,
                'osp_planners2'=> $value->osp_planners2,
                'isp_planners2'=> $value->isp_planners2,
                'surveyors2'=> $value->surveyors2,
                'site_a_id'=> $value->site_a_id,
                'site_a_status'=> $value->site_a_status,
                'site_a_survey_date'=> $value->site_a_survey_date,
                'site_a_isp_submission'=> $value->site_a_isp_submission,
                'site_a_comment'=> $value->site_a_comment,
                'site_b_id'=> $value->site_b_id,
                'site_b_status'=> $value->site_b_status,
                'site_b_survey_date'=> $value->site_b_survey_date,
                'site_b_isp_submission'=> $value->site_b_isp_submission,
                'site_b_comment'=> $value->site_b_comment,
                'comment'=> $value->comment,
                'cost_pm'=> $value->cost_pm,
                'province'=> $value->province,
                'labour_cost_osp'=> $value->labour_cost_osp,
                'material_cost_osp'=> $value->material_cost_osp,
                'total_boq_value_osp'=> $value->total_boq_value_osp,
                'labour_cost_vo_osp'=> $value->labour_cost_vo_osp,
                'material_cost_vo_osp'=> $value->material_cost_vo_osp,
                'total_boq_value_vo_osp'=> $value->total_boq_value_vo_osp,
                'labour_cost_vo_isp_a'=> $value->labour_cost_vo_isp_a,
                'material_cost_vo_isp_a'=> $value->material_cost_vo_isp_a,
                'total_boq_value_vo_isp_a'=> $value->total_boq_value_vo_isp_a,
                'labour_cost_vo_isp_b'=> $value->labour_cost_vo_isp_b,
                'material_cost_vo_isp_b'=> $value->material_cost_vo_isp_b,
                'total_boq_value_vo_isp_b'=> $value->total_boq_value_vo_isp_b,
                'total_project_cost'=> $value->total_project_cost,
                'osp_status_panning'=> $value->osp_status_panning,
                'osp_distance_trench'=> $value->osp_distance_trench,
                'osp_distance_3rd_party_ducts'=> $value->osp_distance_3rd_party_ducts,
                'osp_la_existing_duct'=> $value->osp_la_existing_duct,
                'osp_la_existing_network'=> $value->osp_la_existing_network,
                'osp_distance_focus'=> $value->osp_distance_focus,
                'osp_in_buildin_conduits'=> $value->osp_in_buildin_conduits,
                'ops_total_distance'=> $value->ops_total_distance,
                'isp_a_distance_trench'=> $value->isp_a_distance_trench,
                'isp_a_distance_3rd_party_ducts'=> $value->isp_a_distance_3rd_party_ducts,
                'isp_a_la_existing_duct'=> $value->isp_a_la_existing_duct,
                'isp_a_la_existing_network'=> $value->isp_a_la_existing_network,
                'isp_a_distance_focus'=> $value->isp_a_distance_focus,
                'isp_a_in_buildin_conduits'=> $value->isp_a_in_buildin_conduits,
                'isp_a_total_distance'=> $value->isp_a_total_distance,
                'isp_b_distance_trench'=> $value->isp_b_distance_trench,
                'isp_b_distance_3rd_party_ducts'=> $value->isp_b_distance_3rd_party_ducts,
                'isp_b_la_existing_duct'=> $value->isp_b_la_existing_duct,
                'isp_b_la_existing_network'=> $value->isp_b_la_existing_network,
                'isp_b_distance_focus'=> $value->isp_b_distance_focus,
                'isp_b_in_buildin_conduits'=> $value->isp_b_in_buildin_conduits,
                'isp_b_total_distance'=> $value->isp_b_total_distance,
                'labour_cost_isp_a'=> $value->labour_cost_isp_a,
                'material_cost_isp_a'=> $value->material_cost_isp_a,
                'total_boq_value_isp_a'=> $value->total_boq_value_isp_a,
                'labour_cost_isp_b'=> $value->labour_cost_isp_b,
                'material_cost_isp_b'=> $value->material_cost_isp_b,
                'total_boq_value_isp_b'=> $value->total_boq_value_isp_b,
                'link_dependency'=> $value->link_dependency,
                'mat'=> $value->mat,
                'DMI'=> $value->DMI,
            ];
        }
        return collect($all_records);
    }
}
