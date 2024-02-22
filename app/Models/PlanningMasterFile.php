<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningMasterFile extends Model
{
    use HasFactory;
    
    protected $table = 'planning_master_file_records';

    protected $fillable = [ 
        'file_id', 'service_id', 'circuit_id', 'datenew', 'planning_status', 'rx_in_planning', 'planning_wp2_wl_submission', 'planned_wp2_released_date', 'revised_planned_wp2_date', 'wp2_approval_requested', 'wp2_approval_received', 'isp_a_wp2_approval_received', 'isp_a_wp2_approval_requested', 'isp_b_wp2_approval_received', 'isp_b_wp2_approval_requested', 'osp_planners', 'isp_planners', 'surveyors', 'isp_distance', 'osp_planners2', 'isp_planners2', 'surveyors2', 'site_a_id', 'site_a_status', 'site_a_survey_date', 'site_a_isp_submission', 'site_a_comment', 'site_b_id', 'site_b_status', 'site_b_survey_date', 'site_b_isp_submission', 'site_b_comment','comment','cost_pm','province','labour_cost_osp','material_cost_osp','total_boq_value_osp','labour_cost_vo_osp','material_cost_vo_osp','total_boq_value_vo_osp','labour_cost_vo_isp_a','material_cost_vo_isp_a','total_boq_value_vo_isp_a','labour_cost_vo_isp_b','material_cost_vo_isp_b','total_boq_value_vo_isp_b','total_project_cost','osp_status_panning','osp_distance_trench','osp_distance_3rd_party_ducts','osp_la_existing_duct','osp_la_existing_network','osp_distance_focus','osp_in_buildin_conduits','ops_total_distance','isp_a_distance_trench','isp_a_distance_3rd_party_ducts','isp_a_la_existing_duct','isp_a_la_existing_network','isp_a_distance_focus','isp_a_in_buildin_conduits','isp_a_total_distance','isp_b_distance_trench','isp_b_distance_3rd_party_ducts','isp_b_la_existing_duct','isp_b_la_existing_network','isp_b_distance_focus','isp_b_in_buildin_conduits','isp_b_total_distance','labour_cost_isp_a','material_cost_isp_a','total_boq_value_isp_a','labour_cost_isp_b','material_cost_isp_b','total_boq_value_isp_b','link_dependency','DMI','mat','update_type','region'];
    
   
    //fuction for get permission record list
    public function permission_record(){
        return $this->belongsTo(PermissionMasterFile::class,'circuit_id','circuit_id'); 
    }
    
    //fuction for get sitemaster record list
    public function site_master_record(){
        return $this->belongsTo(SiteMasterFile::class,'circuit_id','circuit_id'); 
    }
    
     //fuction for get build record list
    public function build_record(){
        return $this->belongsTo(BuildMasterFile::class,'circuit_id','circuit_id'); 
    }
    
     //fuction for get department comment list
    public function department_record(){
        return $this->belongsTo(DepartmentComment::class,'circuit_id','circuit_id'); 
    }

     //fuction for get landlord approval list
     public function landlord_record(){
        return $this->belongsTo(LandlordApproval::class,'circuit_id','circuit_id'); 
    }

      //fuction for get landlord approval list
      public function site_survey_record(){
        return $this->belongsTo(SiteSurveyStatus::class,'circuit_id','circuit_id'); 
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
