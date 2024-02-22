<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtrasFieldsToPermissionMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission_master_file_records', function (Blueprint $table) {
            $table->dateTime('eku_water_and_sanitation_date_submitted')->nullable();
            $table->dateTime('eku_water_and_sanitation_date_received')->nullable();
			$table->string('eku_water_and_sanitation_lead_time')->nullable();
			$table->dateTime('eku_roads_and_stormwater_date_submitted')->nullable();
            $table->dateTime('eku_roads_and_stormwater_date_received')->nullable();
			$table->string('eku_roads_and_stormwater_lead_time')->nullable();
			$table->dateTime('eku_electricity_date_submitted')->nullable();
            $table->dateTime('eku_electricity_date_received')->nullable();
			$table->string('eku_electricity_lead_time')->nullable();
			$table->dateTime('eku_metro_parks_date_submitted')->nullable();
            $table->dateTime('eku_metro_parks_date_received')->nullable();
			$table->string('eku_metro_parks_lead_time')->nullable();
			$table->dateTime('eku_ict_department_date_submitted')->nullable();
            $table->dateTime('eku_ict_department_date_received')->nullable();
			$table->string('eku_ict_department_lead_time')->nullable();
			$table->dateTime('eku_eskom_date_submitted')->nullable();
            $table->dateTime('eku_eskom_date_received')->nullable();
			$table->string('eku_eskom_lead_time')->nullable();
			$table->dateTime('eku_transnet_date_submitted')->nullable();
            $table->dateTime('eku_transnet_date_received')->nullable();
			$table->string('eku_transnet_lead_time')->nullable();
			$table->dateTime('eku_rand_water_date_submitted')->nullable();
            $table->dateTime('eku_rand_water_date_received')->nullable();
			$table->string('eku_rand_water_lead_time')->nullable();
			$table->dateTime('eku_telkom_date_submitted')->nullable();
            $table->dateTime('eku_telkom_date_received')->nullable();
			$table->string('eku_telkom_lead_time')->nullable();
			$table->dateTime('eku_neotel_date_submitted')->nullable();
            $table->dateTime('eku_neotel_date_received')->nullable();
			$table->string('eku_neotel_lead_time')->nullable();
			$table->dateTime('eku_dark_fibre_africa_date_submitted')->nullable();
            $table->dateTime('eku_dark_fibre_africa_date_received')->nullable();
			$table->string('eku_dark_fibre_africa_lead_time')->nullable();
			$table->dateTime('eku_mtn_date_submitted')->nullable();
            $table->dateTime('eku_mtn_date_received')->nullable();
			$table->string('eku_mtn_lead_time')->nullable();
			$table->dateTime('eku_vodacom_date_submitted')->nullable();
            $table->dateTime('eku_vodacom_date_received')->nullable();
			$table->string('eku_vodacom_lead_time')->nullable();
			$table->dateTime('eku_metro_fibre_networx_date_submitted')->nullable();
            $table->dateTime('eku_metro_fibre_networx_date_received')->nullable();
			$table->string('eku_metro_fibre_networx_lead_time')->nullable();
			$table->dateTime('coj_sanral_date_submitted')->nullable();
            $table->dateTime('coj_sanral_date_received')->nullable();
			$table->string('coj_sanral_lead_time')->nullable();
			$table->dateTime('coj_gautrans_date_submitted')->nullable();
            $table->dateTime('coj_gautrans_date_received')->nullable();
			$table->string('coj_gautrans_lead_time')->nullable();
			$table->dateTime('coj_prasa_date_submitted')->nullable();
            $table->dateTime('coj_prasa_date_received')->nullable();
			$table->string('coj_prasa_lead_time')->nullable();
			$table->dateTime('coj_water_date_submitted')->nullable();
            $table->dateTime('coj_water_date_received')->nullable();
			$table->string('coj_water_lead_time')->nullable();
			$table->dateTime('coj_jra_stormwater_date_submitted')->nullable();
            $table->dateTime('coj_jra_stormwater_date_received')->nullable();
			$table->string('coj_jra_stormwater_lead_time')->nullable();
			$table->dateTime('coj_randwater_date_submitted')->nullable();
            $table->dateTime('coj_randwater_date_received')->nullable();
			$table->string('coj_randwater_lead_time')->nullable();
			$table->dateTime('coj_city_power_date_submitted')->nullable();
            $table->dateTime('coj_city_power_date_received')->nullable();
			$table->string('coj_city_power_lead_time')->nullable();
			$table->dateTime('coj_eskom_date_submitted')->nullable();
            $table->dateTime('coj_eskom_date_received')->nullable();
			$table->string('coj_eskom_lead_time')->nullable();
			$table->dateTime('coj_citiconnect_date_submitted')->nullable();
            $table->dateTime('coj_citiconnect_date_received')->nullable();
			$table->string('coj_citiconnect_lead_time')->nullable();
			$table->dateTime('coj_city_parks_date_submitted')->nullable();
            $table->dateTime('coj_city_parks_date_received')->nullable();
			$table->string('coj_city_parks_lead_time')->nullable();
			$table->dateTime('coj_sasol_gas_date_submitted')->nullable();
            $table->dateTime('coj_sasol_gas_date_received')->nullable();
			$table->string('coj_sasol_gas_lead_time')->nullable();
			$table->dateTime('coj_egoli_gas_date_submitted')->nullable();
            $table->dateTime('coj_egoli_gas_date_received')->nullable();
			$table->string('coj_egoli_gas_lead_time')->nullable();
			$table->dateTime('coj_neotel_date_submitted')->nullable();
            $table->dateTime('coj_neotel_date_received')->nullable();
			$table->string('coj_neotel_lead_time')->nullable();
			$table->dateTime('coj_mtn_date_submitted')->nullable();
            $table->dateTime('coj_mtn_date_received')->nullable();
			$table->string('coj_mtn_lead_time')->nullable();
			$table->dateTime('coj_telkom_date_submitted')->nullable();
            $table->dateTime('coj_telkom_date_received')->nullable();
			$table->string('coj_telkom_lead_time')->nullable();
			$table->string('coj_total_number')->nullable();
			$table->string('eku_total_number')->nullable();
			$table->dateTime('eku_sanral_date_submitted')->nullable();
            $table->dateTime('eku_sanral_date_received')->nullable();
			$table->string('eku_sanral_lead_time')->nullable();
			$table->dateTime('eku_prasa_date_submitted')->nullable();
            $table->dateTime('eku_prasa_date_received')->nullable();
			$table->string('eku_prasa_lead_time')->nullable();
			$table->string('coj_surburb')->nullable();
			$table->string('coj_region')->nullable();
			$table->string('coj_street_name')->nullable();
			$table->string('coj_renewal')->nullable();
			$table->string('eku_surburb')->nullable();
			$table->string('eku_region')->nullable();
			$table->string('eku_street_name')->nullable();
			$table->string('eku_renewal')->nullable();
			$table->string('DMI')->nullable();
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
