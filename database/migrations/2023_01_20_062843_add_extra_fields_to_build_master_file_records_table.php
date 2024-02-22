<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToBuildMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('build_master_file_records', function (Blueprint $table) {
            $table->string('osp_project_leader')->nullable(); 
            $table->string('osp_civil_contractor')->nullable();
            $table->string('osp_jetting_contractor')->nullable();
            $table->text('osp_re_instatement_contractor')->nullable();
            $table->string('osp_drilling_contractor')->nullable();
            $table->string('osp_focus_contractor')->nullable();
            $table->string('splicing_team')->nullable();
            $table->string('name')->nullable();
            $table->string('province')->nullable();
            $table->text('build_planned_completion_dates')->nullable();
            $table->string('osp_asbuild_submission')->nullable();
            $table->string('isp_asbuild_submission')->nullable();
            $table->string('osp_asbuild_received')->nullable();
            $table->string('isp_asbuild_received')->nullable();
            $table->string('vo_submitted')->nullable();
            $table->string('vo_received')->nullable();
            $table->string('vo_po_requested')->nullable();
            $table->string('vo_po_received')->nullable();
            $table->string('vo_submitted2')->nullable();
            $table->string('vo_received2')->nullable();
            $table->string('vo_po_requested2')->nullable();
            $table->string('vo_po_received2')->nullable();
            $table->string('vo_submitted3')->nullable();
            $table->string('vo_received3')->nullable();
            $table->string('vo_po_requested3')->nullable();
            $table->string('vo_po_received3')->nullable();
            $table->string('vo_submitted4')->nullable();
            $table->string('vo_received4')->nullable();
            $table->string('vo_po_requested4')->nullable();
            $table->string('vo_po_received4')->nullable();
            $table->string('build_osp_status')->nullable();
            $table->string('qa_requested')->nullable();
            $table->string('fac_submitted')->nullable();
            $table->string('fac_received')->nullable();
            $table->text('actual_osp_build_distance_trench')->nullable();
            $table->text('actual_osp_build_distance_3rd_party_ducts')->nullable();
            $table->text('actual_osp_build_la_existing_duct')->nullable();
            $table->text('actual_osp_build_la_existing_network')->nullable();
            $table->text('actual_osp_build_distance_focus')->nullable();
            $table->text('actual_osp_build_in_building_conduits')->nullable();
            $table->text('actual_osp_110_sleeves_build')->nullable();
            $table->text('actual_osp_drilling_distance_build')->nullable();
            $table->text('actual_osp_micro_duct_distance_build')->nullable();
            $table->text('actual_ops_build_total_distance')->nullable();
            $table->text('actual_build_completion')->nullable();
            $table->text('actual_osp_mh_500_x_500_build')->nullable();
            $table->text('actual_osp_mh_1000_x_500_build')->nullable();
            $table->text('osp_asb_trench')->nullable();
            $table->text('osp_asb_3rd_party_ducts')->nullable();
            $table->text('osp_asb_la_existing_duct')->nullable();
            $table->text('osp_asb_existing_network')->nullable();
            $table->text('osp_asb_distance_focus')->nullable();
            $table->text('osp_asb_in_building_conduits')->nullable();
            $table->text('isp_a_asb_trench')->nullable();
            $table->text('isp_a_asb_3rd_party_ducts')->nullable();
            $table->text('isp_a_asb_la_existing_duct')->nullable();
            $table->text('isp_a_asb_existing_network')->nullable();
            $table->text('isp_a_asb_distance_focus')->nullable();
            $table->text('isp_a_asb_in_building_conduits')->nullable();
            $table->text('isp_b_asb_trench')->nullable();
            $table->text('isp_b_asb_3rd_party_ducts')->nullable();
            $table->text('isp_b_asb_la_existing_duct')->nullable();
            $table->text('isp_b_asb_existing_network')->nullable();
            $table->text('isp_b_asb_distance_focus')->nullable();
            $table->text('isp_b_asb_in_building_conduits')->nullable();
            $table->text('otdr_distance')->nullable();
            $table->text('final_sectional_date')->nullable();
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
        Schema::table('build_master_file_records', function (Blueprint $table) {
            //
        });
    }
}
