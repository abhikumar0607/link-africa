<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtrassFieldsToPermissionMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission_master_file_records', function (Blueprint $table) {
           	$table->dateTime('coj_transnet_date_submitted')->nullable();
            $table->dateTime('coj_transnet_date_received')->nullable();
			$table->string('coj_transnet_lead_time')->nullable();
			$table->dateTime('coj_dfa_date_submitted')->nullable();
            $table->dateTime('coj_dfa_date_received')->nullable();
			$table->string('coj_dfa_lead_time')->nullable();
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
