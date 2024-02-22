<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFourFieldsToPermissionMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission_master_file_records', function (Blueprint $table) {
            $table->dateTime('overdue_a')->nullable();
            $table->dateTime('overdue_b')->nullable();
            $table->dateTime('lla_duration_site_a')->nullable();
            $table->dateTime('lla_duration_site_b')->nullable();
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
