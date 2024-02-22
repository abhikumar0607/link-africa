<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsForReportToSiteMasterFileRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_master_file_records', function (Blueprint $table) {
            $table->string('qty')->nullable();
            $table->string('year')->nullable();
            $table->string('sd_status')->nullable();
            $table->string('week')->nullable();
            $table->string('resources')->nullable();
            $table->Text('comments')->nullable();
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
