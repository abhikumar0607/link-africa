<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_master_file_records', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->nullable();
            $table->string('circuit_id')->nullable();
            $table->dateTime('datenew')->nullable();
            $table->string('permissions_status')->nullable();
            $table->dateTime('site_a_lla_submitted')->nullable();
            $table->string('site_a_lla_estimated')->nullable();
            $table->dateTime('site_a_lla_received')->nullable();
            $table->dateTime('site_b_lla_submitted')->nullable();
            $table->dateTime('site_b_lla_estimated')->nullable();
            $table->dateTime('site_b_lla_received')->nullable();
            $table->dateTime('wayleaves_submitted')->nullable();
            $table->string('wayleaves_estimated')->nullable();
            $table->dateTime('wayleaves_received')->nullable();
            $table->string('wayleaves_status')->nullable();
            $table->string('resource')->nullable();
            $table->dateTime('wl_planned_submitted_date')->nullable();
            $table->string('province')->nullable();
            $table->string('osp_status_permissions')->nullable();
            $table->string('isp_a_b_status')->nullable();
            $table->string('existing_wl_ref_no')->nullable();
            $table->dateTime('exepected_wl_received_date')->nullable();
            $table->string('total_number_of_responses_oustanding')->nullable();
            $table->dateTime('final_wl_submission_date')->nullable();
            $table->dateTime('wl_expiry_date')->nullable();
            $table->string('wl_osp_status')->nullable();
            $table->dateTime('stormwater_rou_date_submitted')->nullable();
            $table->dateTime('stormwater_rou_date_received')->nullable();
            $table->string('stormwater_rou_lead_time')->nullable();
            $table->dateTime('sewer_rou_date_submitted')->nullable();
            $table->dateTime('sewer_rou_date_received')->nullable();
            $table->string('sewer_rou_lead_time')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_master_file_records');
    }
}
