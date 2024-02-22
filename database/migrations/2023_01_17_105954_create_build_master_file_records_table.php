<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_master_file_records', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->nullable();
            $table->string('circuit_id')->nullable();
            $table->dateTime('datenew')->nullable();
            $table->string('build_status')->nullable();
            $table->string('build_duration')->nullable();
            $table->dateTime('planned_start_date')->nullable();
            $table->dateTime('revised_build_start_date')->nullable();
            $table->dateTime('revised_build_co_date')->nullable();
            $table->dateTime('actual_build_completion_date')->nullable();
            $table->string('isp_contractor')->nullable();
            $table->string('osp_contractor')->nullable();
            $table->string('project_leader')->nullable();
            $table->string('build_completion')->nullable();
            $table->dateTime('toc_submitted')->nullable();
            $table->dateTime('toc_received')->nullable(); 
            $table->string('otoc')->nullable();
            $table->string('potoc')->nullable();
            $table->longText('comments')->nullable();  
            $table->dateTime('po_requested')->nullable();
            $table->dateTime('po_received')->nullable();
            $table->string('isp_a_project_leader')->nullable();
            $table->string('isp_a_civil_contractor')->nullable();
            $table->string('isp_a_jetting_contractor')->nullable();
            $table->string('isp_a_re_instatement_contractor')->nullable();
            $table->string('isp_a_drilling_contractor')->nullable();
            $table->string('isp_a_floating_contractor')->nullable();
            $table->string('isp_a_focus_contractor')->nullable();
            $table->string('isp_b_project_leader')->nullable();
            $table->string('isp_b_civil_contractor')->nullable();
            $table->string('isp_b_jetting_contractor')->nullable();
            $table->string('isp_b_re_instatement_contractor')->nullable();
            $table->string('isp_b_drilling_contractor')->nullable();
            $table->string('isp_b_floating_contractor')->nullable();
            $table->string('isp_b_focus_contractor')->nullable();
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
        Schema::dropIfExists('build_master_file_records');
    }
}
