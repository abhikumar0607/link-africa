<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToSiteMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('site_master_file_records', function (Blueprint $table) {
            $table->text('physical_address_site_a')->nullable();
            $table->text('gps_co_ordinates_site_a_x')->nullable();
            $table->text('gps_co_ordinates_site_a_y')->nullable();
            $table->text('contact_name_site_a')->nullable();
            $table->text('work_number_site_a')->nullable();
            $table->text('mobile_number_site_a')->nullable();
            $table->text('email_address_site_a')->nullable();
            $table->text('physical_address_site_b')->nullable();
            $table->text('gps_co_ordinates_site_b_x')->nullable();
            $table->text('gps_co_ordinates_site_b_y')->nullable();
            $table->text('contact_name_site_b')->nullable();
            $table->text('work_number_site_b')->nullable();
            $table->text('mobile_number_site_b')->nullable();
            $table->text('email_address_site_b')->nullable();
            $table->longText('description')->nullable();
            $table->text('lease_term_in_months')->nullable();
            $table->text('crossconnect')->nullable();
            $table->text('technical_hands')->nullable();
            $table->text('core_network_colocation_facilities')->nullable();
            $table->text('rack_space_18u')->nullable();
            $table->text('rack_space_9u_core_access_active')->nullable();
            $table->text('rack_space_9u_core_access_passive')->nullable();
            $table->text('rack_space_1u_passive')->nullable();
            $table->text('order_quantity_primary_link_pair_2_strand')->nullable();
            $table->text('inclusive_of_a_redundant_link_1_pair')->nullable();
            $table->text('sla')->nullable();
            $table->text('sla_premium')->nullable();
            $table->text('sla_type')->nullable();
            $table->text('monthly_lease_charges')->nullable();
            $table->text('non_recurring')->nullable();
            $table->text('monthly_lease_charges_2')->nullable();
            $table->text('landlord_name_site_b')->nullable();
            $table->text('managing_agent_site_b')->nullable();
            $table->text('landlord_name_site_a')->nullable();
            $table->text('landlord_contact_number_a')->nullable();
            $table->text('managing_agent_site_a')->nullable();
            $table->text('landlord_contact_number_b')->nullable();
            $table->text('la_invoice')->nullable();
            $table->text('strands')->nullable();
            $table->text('type')->nullable();
            $table->text('service_delivery_status')->nullable();
            $table->text('llc_received')->nullable();
            $table->text('client_po_num')->nullable();
            $table->text('vodacom_vcw')->nullable();
            $table->text('service_delivery_comments')->nullable();
            $table->text('kam_name')->nullable();
            $table->text('order_type')->nullable();
            $table->text('shc_status')->nullable();
            $table->text('sch_date')->nullable();
            $table->text('dc_to_dc')->nullable();
            $table->text('feasibility_ref_nr')->nullable();
            $table->text('network_types')->nullable();
            $table->text('sales_comments')->nullable();
            $table->text('special_build_nrc')->nullable();
            $table->text('return_to_sales')->nullable();
            $table->text('estimated_enterprise_usage')->nullable();
            $table->text('termination_date')->nullable();
            $table->text('port_type')->nullable();
            $table->text('port_location')->nullable();
            $table->text('port_number')->nullable();
            $table->text('penalty_charges')->nullable();
            $table->text('cancellation_date')->nullable();
            $table->string('thrd_party_nrc')->nullable();
            $table->string('thrd_party_mrc')->nullable();
            $table->string('thrd_party_provider')->nullable();
            $table->text('transmission_project')->nullable();
            $table->text('request_type')->nullable();
            $table->text('po_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_master_file_records', function (Blueprint $table) {
            //
        });
    }
}
