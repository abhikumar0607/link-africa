<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_master_file_records', function (Blueprint $table) {
            $table->id();
            $table->string('file_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('circuit_id')->nullable();
            $table->dateTime('datenew')->nullable();
            $table->string('planning_status')->nullable();
            $table->dateTime('rx_in_planning')->nullable();
            $table->dateTime('planning_wp2_wl_submission')->nullable();
            $table->dateTime('planned_wp2_released_date')->nullable();
            $table->dateTime('revised_planned_wp2_date')->nullable();
            $table->dateTime('wp2_approval_requested')->nullable();
            $table->dateTime('wp2_approval_received')->nullable();
            $table->dateTime('isp_a_wp2_approval_received')->nullable();
            $table->dateTime('isp_a_wp2_approval_requested')->nullable();
            $table->dateTime('isp_b_wp2_approval_received')->nullable();
            $table->dateTime('isp_b_wp2_approval_requested')->nullable();
            $table->string('osp_planners')->nullable();
            $table->string('isp_planners')->nullable();
            $table->string('surveyors')->nullable();
            $table->string('isp_distance')->nullable();
            $table->string('osp_planners2')->nullable();
            $table->string('isp_planners2')->nullable();
            $table->string('surveyors2')->nullable();
            $table->string('site_a_id')->nullable();
            $table->string('site_a_status')->nullable();
            $table->dateTime('site_a_survey_date')->nullable();
            $table->dateTime('site_a_isp_submission')->nullable();
            $table->longText('site_a_comment')->nullable();
            $table->string('site_b_id')->nullable();
            $table->string('site_b_status')->nullable();
            $table->dateTime('site_b_survey_date')->nullable();
            $table->dateTime('site_b_isp_submission')->nullable();
            $table->string('site_b_comment')->nullable();
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
        Schema::dropIfExists('planning_master_file_records');
    }
}
