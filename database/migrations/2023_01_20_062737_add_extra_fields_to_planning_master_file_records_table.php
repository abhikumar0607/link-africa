<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToPlanningMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planning_master_file_records', function (Blueprint $table) {
           $table->string('comment')->nullable();
           $table->string('cost_pm')->nullable();
           $table->string('province')->nullable();
           $table->string('labour_cost_osp')->nullable();
           $table->string('material_cost_osp')->nullable();
           $table->string('total_boq_value_osp')->nullable();
           $table->string('labour_cost_vo_osp')->nullable();
           $table->string('material_cost_vo_osp')->nullable();
           $table->string('total_boq_value_vo_osp')->nullable();
           $table->string('labour_cost_vo_isp_a')->nullable();
           $table->string('material_cost_vo_isp_a')->nullable();
           $table->string('total_boq_value_vo_isp_a')->nullable();
           $table->string('labour_cost_vo_isp_b')->nullable();
           $table->string('material_cost_vo_isp_b')->nullable();
           $table->string('total_boq_value_vo_isp_b')->nullable();
           $table->string('total_project_cost')->nullable();
           $table->string('osp_status_panning')->nullable();
           $table->string('osp_distance_trench')->nullable();
           $table->string('osp_distance_3rd_party_ducts')->nullable();
           $table->string('osp_la_existing_duct')->nullable();
           $table->string('osp_la_existing_network')->nullable();
           $table->string('osp_distance_focus')->nullable();
           $table->string('osp_in_buildin_conduits')->nullable();
           $table->string('ops_total_distance')->nullable();
           $table->string('isp_a_distance_trench')->nullable();
           $table->string('isp_a_distance_3rd_party_ducts')->nullable();
           $table->string('isp_a_la_existing_duct')->nullable();
           $table->string('isp_a_la_existing_network')->nullable(); 
           $table->string('isp_a_distance_focus')->nullable();
           $table->string('isp_a_in_buildin_conduits')->nullable();
           $table->string('isp_a_total_distance')->nullable();
           $table->string('isp_b_distance_trench')->nullable();
           $table->string('isp_b_distance_3rd_party_ducts')->nullable();
           $table->string('isp_b_la_existing_duct')->nullable();
           $table->string('isp_b_la_existing_network')->nullable();
           $table->string('isp_b_distance_focus')->nullable();
           $table->string('isp_b_in_buildin_conduits')->nullable();
           $table->string('isp_b_total_distance')->nullable();
           $table->string('labour_cost_isp_a')->nullable();
           $table->string('material_cost_isp_a')->nullable();
           $table->string('total_boq_value_isp_a')->nullable();
           $table->string('labour_cost_isp_b')->nullable();
           $table->string('material_cost_isp_b')->nullable();
           $table->string('total_boq_value_isp_b')->nullable();
           $table->string('link_dependency')->nullable();
           $table->string('mat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planning_master_file_records', function (Blueprint $table) {
            //
        });
    }
}
