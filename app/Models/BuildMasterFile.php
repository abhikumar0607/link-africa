<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildMasterFile extends Model
{
    use HasFactory;
    
    protected $table = 'build_master_file_records';

    protected $fillable = [ 
        'service_id', 'circuit_id', 'datenew', 'build_status', 'build_duration', 'planned_start_date', 'revised_build_start_date', 'revised_build_co_date', 'actual_build_completion_date', 'isp_contractor', 'osp_contractor', 'project_leader', 'build_completion', 'toc_submitted', 'toc_received', 'otoc', 'potoc', 'comments', 'po_requested', 'po_received', 'isp_a_project_leader', 'isp_a_civil_contractor', 'isp_a_jetting_contractor', 'isp_a_re_instatement_contractor', 'isp_a_drilling_contractor', 'isp_a_floating_contractor', 'isp_a_focus_contractor', 'isp_b_project_leader', 'isp_b_civil_contractor', 'isp_b_jetting_contractor', 'isp_b_re_instatement_contractor', 'isp_b_drilling_contractor', 'isp_b_floating_contractor', 'isp_b_focus_contractor', 'osp_project_leader', 'osp_civil_contractor', 'osp_jetting_contractor', 'osp_re_instatement_contractor', 'osp_drilling_contractor', 'osp_focus_contractor', 'splicing_team', 'name', 'province', 'build_planned_completion_dates', 'osp_asbuild_submission', 'isp_asbuild_submission', 'osp_asbuild_received', 'isp_asbuild_received', 'vo_submitted', 'vo_received', 'vo_po_requested', 'vo_po_received', 'vo_submitted2', 'vo_received2', 'vo_po_requested2', 'vo_po_received2', 'vo_submitted3', 'vo_received3', 'vo_po_requested3', 'vo_po_received3', 'vo_submitted4', 'vo_received4', 'vo_po_requested4', 'vo_po_received4', 'build_osp_status', 'qa_requested', 'fac_submitted', 'fac_received', 'actual_osp_build_distance_trench', 'actual_osp_build_distance_3rd_party_ducts', 'actual_osp_build_la_existing_duct', 'actual_osp_build_la_existing_network', 'actual_osp_build_distance_focus', 'actual_osp_build_in_building_conduits', 'actual_osp_110_sleeves_build', 'actual_osp_drilling_distance_build', 'actual_osp_micro_duct_distance_build', 'actual_ops_build_total_distance', 'actual_build_completion', 'actual_osp_mh_500_x_500_build', 'actual_osp_mh_1000_x_500_build', 'osp_asb_trench', 'osp_asb_3rd_party_ducts', 'osp_asb_la_existing_duct', 'osp_asb_existing_network', 'osp_asb_distance_focus', 'osp_asb_in_building_conduits', 'isp_a_asb_trench', 'isp_a_asb_3rd_party_ducts', 'isp_a_asb_la_existing_duct', 'isp_a_asb_existing_network', 'isp_a_asb_distance_focus', 'isp_a_asb_in_building_conduits', 'isp_b_asb_trench', 'isp_b_asb_3rd_party_ducts', 'isp_b_asb_la_existing_duct', 'isp_b_asb_existing_network', 'isp_b_asb_distance_focus', 'isp_b_asb_in_building_conduits', 'otdr_distance', 'final_sectional_date', 'mat','DMI','osp_floating_contractor','build_percantage','Submitted_to_customer','toc_received_date_recieved','region'
    ];
    
    // function for get site master 
    public function site_master_record(){
       return $this->belongsTo(SiteMasterFile::class,'circuit_id','circuit_id');  
    }
    
    //fuction for get permission record list
    public function permission_record(){
        return $this->belongsTo(PermissionMasterFile::class,'circuit_id','circuit_id'); 
    }
    
      //fuction for get build record list
    public function planning_record(){
        return $this->belongsTo(PlanningMasterFile::class,'circuit_id','circuit_id'); 
    }
    
    //fuction for get department comment list
    public function department_record(){
        return $this->belongsTo(DepartmentComment::class,'circuit_id','circuit_id'); 
    }

     //fuction for get isp a record
     public function planning_isp_a_records(){
        return $this->hasMany(PlanningMaterialIspA::class,'circuit_id','circuit_id')->with('planning_material_record'); 
    }

    //fuction for get isp b record
    public function planning_isp_b_records(){
        return $this->hasMany(PlanningMaterialIspB::class,'circuit_id','circuit_id')->with('planning_material_record'); 
    }

    //fuction for get osp record
    public function planning_osp_records(){
        return $this->hasMany(PlanningMaterialOsp::class,'circuit_id','circuit_id')->with('planning_material_record'); 
    }

    //fuction for get attachment record
    public function attachment_record(){
        return $this->hasMany(SiteAttachment::class,'circuit_id','circuit_id'); 
    }
}
