<?php

namespace App\Imports;

use App\Models\SiteMasterFile;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\PlanningMasterFile;
use App\Models\PermissionMasterFile;
use App\Models\BuildMasterFile;

use Carbon\Carbon;

class ImportSiteMasterFile implements ToCollection, WithHeadingRow
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
        $service_id = $row['service_id'];
		//echo $service_id;exit;
		
        $circuit_id = $row['circuit_id'];
        $project_id = $row['project_id'];
        $date_new = null;
        if($row['datenew']){
            $date_new = Carbon::parse($row['datenew']);
        }
        $project_status = $row['project_status'];
        $order_ref_no = $row['order_ref_no'];
        $order_date = null;
        if($row['order_date']){
            $order_date = Carbon::parse($row['order_date']);
        }
        $expected_delivery_date = null;
        if($row['expected_delivery_date']){
            $expected_delivery_date = Carbon::parse($row['expected_delivery_date']);
        }
        $province = $row['province'];
        $metro_area = $row['metro_area'];
        $client_name = $row['client_name'];
        $service_type = $row['service_type'];
        $client_ring = $row['client_ring'];
        $client_code = $row['client_code'];
        $rate_mbit_s = $row['rate_mbit_s'];
        $site_a = $row['site_a'];
        $site_b = $row['site_b'];
        $date_po_order_rx = null;
        if($row['date_po_order_rx']){
            $date_po_order_rx = Carbon::parse($row['date_po_order_rx']);
        }
        $po_mrc = $row['po_mrc'];
        $po_nrc = $row['po_nrc'];
        $service_manager = $row['service_manager'];
        $client_quotation_ref = $row['client_quotation_ref'];
        $account_manager_name = $row['account_manager_name'];
        //Meta values
        $physical_address_site_a = $row['physical_address_site_a'];
        $gps_co_ordinates_site_a_x = $row['gps_co_ordinates_site_a_x'];
        $gps_co_ordinates_site_a_y = $row['gps_co_ordinates_site_a_y'];
        $contact_name_site_a = $row['contact_name_site_a'];
        $work_number_site_a = $row['work_number_site_a'];
        $mobile_number_site_a = $row['mobile_number_site_a'];
        $email_address_site_a = $row['email_address_site_a'];
        $physical_address_site_b = $row['physical_address_site_b'];
        $gps_co_ordinates_site_b_x = $row['gps_co_ordinates_site_b_x'];
        $gps_co_ordinates_site_b_y = $row['gps_co_ordinates_site_b_y'];
        $contact_name_site_b = $row['contact_name_site_b'];
        $work_number_site_b = $row['work_number_site_b'];
        $mobile_number_site_b = $row['mobile_number_site_b'];
        $email_address_site_b = $row['email_address_site_b'];
        $description = $row['description'];
        $lease_term_in_months = $row['lease_term_in_months'];
        $crossconnect = $row['crossconnect'];
        $technical_hands = $row['technical_hands'];
        $core_network_colocation_facilities = $row['core_network_colocation_facilities'];
        $rack_space_18u = $row['rack_space_18u'];
        $rack_space_9u_core_access_active = $row['rack_space_9u_core_access_active'];
        $rack_space_9u_core_access_passive = $row['rack_space_9u_core_access_passive'];
        $rack_space_1u_passive = $row['rack_space_1u_passive'];
        $order_quantity_primary_link_pair_2_strand = $row['order_quantity_primary_link_pair_2_strand'];
        $inclusive_of_a_redundant_link_1_pair = $row['inclusive_of_a_redundant_link_1_pair'];
        $sla = $row['sla'];
        $sla_premium = $row['sla_premium'];
        $sla_type = $row['sla_type'];
        $monthly_lease_charges = $row['monthly_lease_charges'];
        $non_recurring = $row['non_recurring'];
        $monthly_lease_charges_2 = $row['monthly_lease_charges_2'];
        $landlord_name_site_b = $row['landlord_name_site_b'];
        $managing_agent_site_b = $row['managing_agent_site_b'];
        $landlord_name_site_a = $row['landlord_name_site_a'];
        $landlord_contact_number_a = $row['landlord_contact_number_a'];
        $managing_agent_site_a = $row['managing_agent_site_a'];
        $landlord_contact_number_b = $row['landlord_contact_number_b'];
        $la_invoice = $row['la_invoice'];
        $strands = $row['strands'];
        $type = $row['type'];
        $service_delivery_status = $row['service_delivery_status'];
        $llc_received = $row['llc_received'];
        $client_po_num = $row['client_po_num'];
        $vodacom_vcw = $row['vodacom_vcw'];
        $service_delivery_comments = $row['service_delivery_comments'];
        $kam_name = $row['kam_name'];
        $order_type = $row['order_type'];
        $shc_status = $row['shc_status'];
        $sch_date = $row['sch_date'];
        $dc_to_dc = $row['dc_to_dc'];
        $feasibility_ref_nr = $row['feasibility_ref_nr'];
        $network_types = $row['network_types'];
        $sales_comments = $row['sales_comments'];
        $special_build_nrc = $row['special_build_nrc'];
        $return_to_sales = $row['return_to_sales'];
        $estimated_enterprise_usage = $row['estimated_enterprise_usage'];
        $termination_date = $row['termination_date'];
        $port_type = $row['port_type'];
        $port_location = $row['port_location'];
        $port_number = $row['port_number'];
        $penalty_charges = $row['penalty_charges'];
        $cancellation_date = $row['cancellation_date'];
        $thrd_party_nrc = $row['3rd_party_nrc'];
        $thrd_party_mrc = $row['3rd_party_mrc'];
        $thrd_party_provider = $row['3rd_party_provider'];
        $transmission_project = $row['transmission_project'];
        $request_type = $row['request_type'];
        $po_number = $row['po_number'];
        $planned_build_date = null;
        if($row['planned_build_date']){
            $planned_build_date = Carbon::parse($row['planned_build_date']);
        }
        $data_reg_db = $row['data_reg_db'];

        //Insert query 
        $insert_master_file_record = SiteMasterFile::Where('service_id',$service_id)->Where('circuit_id',$service_id)->whereNull('date_new')->update([
        	'project_id'  => $project_id,
        	'date_new'  => $date_new,
        	'project_status'  => $project_status,
        	'order_ref_number'  => $order_ref_no,
        	'order_date'  => $order_date,
        	'expected_delivery_date'  => $expected_delivery_date,
        	'province'  => $province,
        	'metro_area'  => $metro_area,
        	'client_name'  => $client_name,
        	'service_type'  => $service_type,
        	'client_ring'  => $client_ring,
        	'client_code'  => $client_code,
        	'rate_mbit_s'  => $rate_mbit_s,
        	'site_a'  => $site_a,
        	'site_b'  => $site_b,
        	'date_po_order_rx'  => $date_po_order_rx,
        	'po_mrc'  => $po_mrc,
        	'po_nrc'  => $po_nrc,
        	'service_manager'  => $service_manager,
        	'client_quotation_ref'  => $client_quotation_ref,
        	'account_manager_name'  => $account_manager_name,
        	"physical_address_site_a" =>  $physical_address_site_a, 
            "gps_co_ordinates_site_a_x" => $gps_co_ordinates_site_a_x,
            "gps_co_ordinates_site_a_y" => $gps_co_ordinates_site_a_y,
            "contact_name_site_a" => $contact_name_site_a,
            "work_number_site_a" => $work_number_site_a,
            "mobile_number_site_a" => $mobile_number_site_a,
            "email_address_site_a" => $email_address_site_a,
            "physical_address_site_b" => $physical_address_site_b,
            "gps_co_ordinates_site_b_x" => $gps_co_ordinates_site_b_x,
            "gps_co_ordinates_site_b_y" => $gps_co_ordinates_site_b_y,
            "contact_name_site_b" => $contact_name_site_b,
            "work_number_site_b" => $work_number_site_b,
            "mobile_number_site_b" => $mobile_number_site_b,
            "email_address_site_b" => $email_address_site_b,
            "description" => $description,
            "lease_term_in_months" => $lease_term_in_months,
            "crossconnect" => $crossconnect,
            "technical_hands" => $technical_hands,
            "core_network_colocation_facilities" => $core_network_colocation_facilities,
            "rack_space_18u" => $rack_space_18u,
            "rack_space_9u_core_access_active" => $rack_space_9u_core_access_active,
            "rack_space_9u_core_access_passive" => $rack_space_9u_core_access_passive,
            "rack_space_1u_passive" => $rack_space_1u_passive,
            "order_quantity_primary_link_pair_2_strand" =>  $order_quantity_primary_link_pair_2_strand,
            "inclusive_of_a_redundant_link_1_pair" => $inclusive_of_a_redundant_link_1_pair,
            "sla" => $sla,
            "sla_premium" => $sla_premium,
            "sla_type" => $sla_type,
            "monthly_lease_charges" => $monthly_lease_charges,
            "non_recurring" => $non_recurring,
            "monthly_lease_charges_2" => $monthly_lease_charges_2,
            "landlord_name_site_b" => $landlord_name_site_b,
            "managing_agent_site_b" => $managing_agent_site_b,
            "landlord_name_site_a" => $landlord_name_site_a,
            "landlord_contact_number_a" => $landlord_contact_number_a,
            "managing_agent_site_a" => $managing_agent_site_a,
            "landlord_contact_number_b" => $landlord_contact_number_b,
            "la_invoice" => $la_invoice,
            "strands" => $strands,
            "type" => $type,
            "service_delivery_status" => $service_delivery_status,
            "llc_received" => $llc_received,
            "client_po_num" => $client_po_num,
            "vodacom_vcw" => $vodacom_vcw,
            "service_delivery_comments" => $service_delivery_comments,
            "kam_name" => $kam_name,
            "order_type" => $order_type,
            "shc_status" => $shc_status,
            "sch_date" => $sch_date,
            "dc_to_dc" => $dc_to_dc,
            "feasibility_ref_nr" => $feasibility_ref_nr,
            "network_types" => $network_types,
            "sales_comments" => $sales_comments,
            "special_build_nrc" => $special_build_nrc,
            "return_to_sales" => $return_to_sales,
            "estimated_enterprise_usage" => $estimated_enterprise_usage,
            "termination_date" => $termination_date,
            "port_type" => $port_type,
            "port_location" => $port_location,
            "port_number" => $port_number,
            "penalty_charges" => $penalty_charges,
            "cancellation_date" => $cancellation_date,
            "thrd_party_nrc" => $thrd_party_nrc,
            "thrd_party_mrc" => $thrd_party_mrc,
            "thrd_party_provider" => $thrd_party_provider,
            "transmission_project" => $transmission_project,
            "request_type" => $request_type,
            "po_number" => $po_number,
        	'created_at'  => $current_date_time,
        	'updated_at'  => $current_date_time,
        	'planned_build_date' => $planned_build_date,
        	'data_reg_db' => $data_reg_db,      	
       ]);
	}
        //check if record in inserted or not
        /* if($insert_master_file_record){
            //Insert Planning Query
            $insert_planning =  PlanningMasterFile::create([
                'service_id' => $service_id,
                'circuit_id' => $circuit_id,
                'datenew' => $date_new,
            ]);
            
            //Insert permission Query
            $insert_permission =  PermissionMasterFile::create([
                'service_id' => $service_id,
                'circuit_id' => $circuit_id,
                'datenew' => $date_new,
            ]);
            
            //Insert build Query
            $insert_permission =  BuildMasterFile::create([
                'service_id' => $service_id,
                'circuit_id' => $circuit_id,
                'datenew' => $date_new,
            ]);
         }*/
    }
}
