<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionMasterFile extends Model
{
    use HasFactory;
    
    protected $table = 'permission_master_file_records';

    protected $fillable = [ 
        'service_id', 'circuit_id', 'datenew', 'permissions_status', 'site_a_lla_submitted', 'site_a_lla_estimated', 'site_a_lla_received', 'site_b_lla_submitted', 'site_b_lla_estimated', 'site_b_lla_received', 'wayleaves_submitted', 'wayleaves_estimated', 'wayleaves_received', 'wayleaves_status', 'resource', 'wl_planned_submitted_date', 'province', 'osp_status_permissions', 'isp_a_b_status', 'existing_wl_ref_no', 'exepected_wl_received_date', 'total_number_of_responses_oustanding', 'final_wl_submission_date', 'wl_expiry_date', 'wl_osp_status', 'stormwater_rou_date_submitted', 'stormwater_rou_date_received', 'stormwater_rou_lead_time', 'sewer_rou_date_submitted', 'sewer_rou_date_received', 'sewer_rou_lead_time','telkom_date_submitted','telkom_date_received','telkom_lead_time','sasol_date_submitted','sasol_date_received','sasol_lead_time','transnet_date_submitted','transnet_date_received','transnet_lead_time','neotel_date_submitted','neotel_date_received','neotel_lead_time','dfa_date_submitted','dfa_date_received','dfa_lead_time','mtn_date_submitted','mtn_date_received','mtn_lead_time','sanral_date_submitted','sanral_date_received','sanral_lead_time','dept_of_transport_date_submitted','dept_of_transport_date_received','dept_of_transport_lead_time','water_sanitation_date_submitted','water_sanitation_date_received','water_sanitation_lead_time','ethekwini_transport_date_submitted','ethekwini_transport_date_received','ethekwini_transport_lead_time','roads_date_submitted','roads_date_received','roads_lead_time','electricity_date_submitted','electricity_date_received','electricity_lead_time','coastal_stormwater_catchment_date_submitted','coastal_stormwater_catchment_date_received','coastal_stormwater_catchment_lead_time','development_planning_date_submitted','development_planning_date_received','development_planning_lead_time','traffic_signals_date_submitted','traffic_signals_date_received','traffic_signals_lead_time','enviromental_management_date_submitted','enviromental_management_date_received','enviromental_management_lead_time','transportation_planning_date_submitted','transportation_planning_date_received','transportation_planning_lead_time','technical_services_date_submitted','technical_services_date_received','technical_services_lead_time','sembcorp_siza_water_date_submitted','sembcorp_siza_water_date_received','sembcorp_siza_water_lead_time','legal_services_date_submitted','legal_services_date_received','legal_services_lead_time','eskom_date_submitted','eskom_date_received','eskom_lead_time','parks_date_submitted','parks_date_received','parks_lead_time','site_owner','external_la_wl_num','permissions_comments','mat','eku_water_and_sanitation_date_submitted', 'eku_water_and_sanitation_date_received','eku_water_and_sanitation_lead_time','eku_roads_and_stormwater_date_submitted','eku_roads_and_stormwater_date_received','eku_roads_and_stormwater_lead_time','eku_electricity_date_submitted','eku_electricity_date_received','eku_electricity_lead_time','eku_metro_parks_date_submitted','eku_metro_parks_date_received','eku_metro_parks_lead_time','eku_ict_department_date_submitted','eku_ict_department_date_received','eku_ict_department_lead_time','eku_eskom_date_submitted','eku_eskom_date_received','eku_eskom_lead_time','eku_transnet_date_submitted','eku_transnet_date_received','eku_transnet_lead_time','eku_rand_water_date_submitted','eku_rand_water_date_received','eku_rand_water_lead_time','eku_telkom_date_submitted','eku_telkom_date_received','eku_telkom_lead_time','eku_neotel_date_submitted','eku_neotel_date_received','eku_neotel_lead_time','eku_dark_fibre_africa_date_submitted','eku_dark_fibre_africa_date_received','eku_dark_fibre_africa_lead_time','eku_mtn_date_submitted','eku_mtn_date_received','eku_mtn_lead_time','eku_vodacom_date_submitted','eku_vodacom_date_received','eku_vodacom_lead_time','eku_metro_fibre_networx_date_submitted','eku_metro_fibre_networx_date_received','eku_metro_fibre_networx_lead_time','coj_sanral_date_submitted','coj_sanral_date_received','coj_sanral_lead_time','coj_gautrans_date_submitted','coj_gautrans_date_received','coj_gautrans_lead_time','coj_prasa_date_submitted','coj_prasa_date_received','coj_prasa_lead_time','coj_water_date_submitted','coj_water_date_received','coj_water_lead_time','coj_jra_stormwater_date_submitted','coj_jra_stormwater_date_received','coj_jra_stormwater_lead_time','coj_randwater_date_submitted','coj_randwater_date_received','coj_randwater_lead_time','coj_city_power_date_submitted','coj_city_power_date_received','coj_city_power_lead_time','coj_eskom_date_submitted','coj_eskom_date_received','coj_eskom_lead_time','coj_citiconnect_date_submitted','coj_citiconnect_date_received','coj_citiconnect_lead_time','coj_city_parks_date_submitted','coj_city_parks_date_received','coj_city_parks_lead_time','coj_sasol_gas_date_submitted','coj_sasol_gas_date_received','coj_sasol_gas_lead_time','coj_egoli_gas_date_submitted','coj_egoli_gas_date_received','coj_egoli_gas_lead_time','coj_transnet_date_submitted','coj_transnet_date_received','coj_transnet_lead_time','coj_dfa_date_submitted','coj_dfa_date_received','coj_dfa_lead_time','coj_neotel_date_submitted','coj_neotel_date_received','coj_neotel_lead_time','coj_mtn_date_submitted','coj_mtn_date_received','coj_mtn_lead_time','coj_telkom_date_submitted','coj_telkom_date_received','coj_telkom_lead_time','coj_total_number','eku_total_number','eku_sanral_date_submitted','eku_sanral_date_received','eku_sanral_lead_time','eku_prasa_date_submitted','eku_prasa_date_received','eku_prasa_lead_time','coj_surburb','coj_region','coj_street_name','coj_renewal','eku_surburb','eku_region','eku_street_name','eku_renewal','DMI','osp_status_panning','region'];
    
    // function for get site master data with permission
    public function site_master_record(){
        return $this->belongsTo(SiteMasterFile::class,'circuit_id','circuit_id'); 
    }
    
     // function for get planning master data with permission
    public function planning_record(){
        return $this->belongsTo(PlanningMasterFile::class,'circuit_id','circuit_id'); 
    }
    
     // function for get build master data with permission
    public function build_record(){
        return $this->belongsTo(BuildMasterFile::class,'circuit_id','circuit_id'); 
    }
    
     // function for get build master data with permission
    public function department_comments(){
        return $this->belongsTo(DepartmentComment::class,'circuit_id','circuit_id'); 
    }
    
      // function for get landlord data with permission
      public function landlord_record(){
        return $this->belongsTo(LandlordApproval::class,'circuit_id','circuit_id'); 
    }

    //fuction for get attachment record
    public function attachment_record(){
        return $this->hasMany(SiteAttachment::class,'circuit_id','circuit_id'); 
    }
}
