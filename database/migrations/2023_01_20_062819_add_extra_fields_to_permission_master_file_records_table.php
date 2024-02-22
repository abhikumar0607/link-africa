<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToPermissionMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission_master_file_records', function (Blueprint $table) {
             $table->text('telkom_date_submitted')->nullable();
             $table->text('telkom_date_received')->nullable();
             $table->text('telkom_lead_time')->nullable();
             $table->text('sasol_date_submitted')->nullable();
             $table->text('sasol_date_received')->nullable();
             $table->text('sasol_lead_time')->nullable();
             $table->text('transnet_date_submitted')->nullable();
             $table->text('transnet_date_received')->nullable();
             $table->text('transnet_lead_time')->nullable();
             $table->text('neotel_date_submitted')->nullable();
             $table->text('neotel_date_received')->nullable();
             $table->text('neotel_lead_time')->nullable();
             $table->text('dfa_date_submitted')->nullable();
             $table->text('dfa_date_received')->nullable();
             $table->text('dfa_lead_time')->nullable();
             $table->text('mtn_date_submitted')->nullable();
             $table->text('mtn_date_received')->nullable();
             $table->text('mtn_lead_time')->nullable();
             $table->text('sanral_date_submitted')->nullable();
             $table->text('sanral_date_received')->nullable();
             $table->text('sanral_lead_time')->nullable();
             $table->text('dept_of_transport_date_submitted')->nullable();
             $table->text('dept_of_transport_date_received')->nullable();
             $table->text('dept_of_transport_lead_time')->nullable();
             $table->text('water_sanitation_date_submitted')->nullable();
             $table->text('water_sanitation_date_received')->nullable();
             $table->text('water_sanitation_lead_time')->nullable();
             $table->text('ethekwini_transport_date_submitted')->nullable();
             $table->text('ethekwini_transport_date_received')->nullable();
             $table->text('ethekwini_transport_lead_time')->nullable();
             $table->text('roads_date_submitted')->nullable();
             $table->text('roads_date_received')->nullable();
             $table->text('roads_lead_time')->nullable();
             $table->text('electricity_date_submitted')->nullable();
             $table->text('electricity_date_received')->nullable();
             $table->text('electricity_lead_time')->nullable();
             $table->text('coastal_stormwater_catchment_date_submitted')->nullable();
             $table->text('coastal_stormwater_catchment_date_received')->nullable();
             $table->text('coastal_stormwater_catchment_lead_time')->nullable();
             $table->text('development_planning_date_submitted')->nullable();
             $table->text('development_planning_date_received')->nullable();
             $table->text('development_planning_lead_time')->nullable();
             $table->text('traffic_signals_date_submitted')->nullable();
             $table->text('traffic_signals_date_received')->nullable();
             $table->text('traffic_signals_lead_time')->nullable();
             $table->text('enviromental_management_date_submitted')->nullable();
             $table->text('enviromental_management_date_received')->nullable();
             $table->text('enviromental_management_lead_time')->nullable();
             $table->text('transportation_planning_date_submitted')->nullable();
             $table->text('transportation_planning_date_received')->nullable();
             $table->text('transportation_planning_lead_time')->nullable();
             $table->text('technical_services_date_submitted')->nullable();
             $table->text('technical_services_date_received')->nullable();
             $table->text('technical_services_lead_time')->nullable();
             $table->text('sembcorp_siza_water_date_submitted')->nullable();
             $table->text('sembcorp_siza_water_date_received')->nullable();
             $table->text('sembcorp_siza_water_lead_time')->nullable();
             $table->text('legal_services_date_submitted')->nullable();
             $table->text('legal_services_date_received')->nullable();
             $table->text('legal_services_lead_time')->nullable();
             $table->text('eskom_date_submitted')->nullable();
             $table->text('eskom_date_received')->nullable();
             $table->text('eskom_lead_time')->nullable();
             $table->text('parks_date_submitted')->nullable();
             $table->text('parks_date_received')->nullable();
             $table->text('parks_lead_time')->nullable();
             $table->text('site_owner')->nullable();
             $table->text('external_la_wl_num')->nullable();
             $table->text('permissions_comments')->nullable();
             $table->text('mat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_master_file_records', function (Blueprint $table) {
            //
        });
    }
}
