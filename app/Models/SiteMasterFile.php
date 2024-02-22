<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DepartmentComment;

class SiteMasterFile extends Model
{
    use HasFactory;
    
    protected $table = 'site_master_file_records';

    protected $fillable = [ 
        'service_id', 'circuit_id', 'project_id', 'date_new', 'project_status', 'order_ref_number', 'order_date', 'expected_delivery_date', 'province', 'metro_area', 'client_name', 'service_type', 'client_ring', 'client_code', 'rate_mbit_s', 'site_a', 'site_b', 'date_po_order_rx', 'po_mrc', 'po_nrc', 'service_manager', 'client_quotation_ref', 'account_manager_name', 'physical_address_site_a', 'gps_co_ordinates_site_a_x', 'gps_co_ordinates_site_a_y', 'contact_name_site_a', 'work_number_site_a', 'mobile_number_site_a', 'email_address_site_a', 'physical_address_site_b', 'gps_co_ordinates_site_b_x', 'gps_co_ordinates_site_b_y', 'contact_name_site_b', 'work_number_site_b', 'mobile_number_site_b', 'email_address_site_b', 'description', 'lease_term_in_months', 'crossconnect', 'technical_hands', 'core_network_colocation_facilities', 'rack_space_18u', 'rack_space_9u_core_access_active', 'rack_space_9u_core_access_passive', 'rack_space_1u_passive', 'order_quantity_primary_link_pair_2_strand', 'inclusive_of_a_redundant_link_1_pair', 'sla', 'sla_premium', 'sla_type', 'monthly_lease_charges', 'non_recurring', 'monthly_lease_charges_2', 'landlord_name_site_b', 'managing_agent_site_b', 'landlord_name_site_a', 'landlord_contact_number_a', 'managing_agent_site_a', 'landlord_contact_number_b', 'la_invoice', 'strands', 'type', 'service_delivery_status', 'llc_received', 'client_po_num', 'vodacom_vcw', 'service_delivery_comments', 'kam_name', 'order_type', 'shc_status', 'sch_date', 'dc_to_dc', 'feasibility_ref_nr', 'network_types', 'sales_comments', 'special_build_nrc', 'return_to_sales', 'estimated_enterprise_usage', 'termination_date', 'port_type', 'port_location', 'port_number', 'penalty_charges', 'cancellation_date', 'thrd_party_nrc', 'thrd_party_mrc', 'thrd_party_provider', 'transmission_project', 'request_type', 'po_number','planned_build_date','data_reg_db','region','qty','year','sd_status','week','resources','comments','cts_date','received_cts_date','sales_status'
    ];


    //function for get data with relation
    public function department_comment()
    {
        return $this->belongsTo(DepartmentComment::class,'circuit_id','circuit_id');
    }
    
    //function for get data with planning table related
     public function planning_record()
    {
        return $this->belongsTo(PlanningMasterFile::class,'circuit_id','circuit_id');
    }
    
     //function for get data with permission table related
     public function permission_record()
    {
        return $this->belongsTo(PermissionMasterFile::class,'circuit_id','circuit_id');
    }
    
     //function for get data with build table related
     public function build_record()
    {
        return $this->belongsTo(BuildMasterFile::class,'circuit_id','circuit_id');
    }
	
	   //fuction for get landlord approval list
      public function landlord_record(){
        return $this->belongsTo(LandlordApproval::class,'circuit_id','circuit_id'); 
    }

      //fuction for get landlord approval list
      public function site_survey_record(){
        return $this->belongsTo(SiteSurveyStatus::class,'circuit_id','circuit_id'); 
    }

      //fuction for get attachment record
      public function attachment_record(){
        return $this->hasMany(SiteAttachment::class,'circuit_id','circuit_id'); 
    }
}
