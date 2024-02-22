<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteMasterFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_master_file_records', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->nullable();
            $table->string('circuit_id')->nullable();
            $table->string('project_id')->nullable();
            $table->dateTime('date_new')->nullable();
            $table->string('project_status')->nullable();
            $table->string('order_ref_number')->nullable();
            $table->dateTime('order_date')->nullable();
            $table->dateTime('expected_delivery_date')->nullable();
            $table->string('province')->nullable();
            $table->string('metro_area')->nullable();
            $table->string('client_name')->nullable();
            $table->string('service_type')->nullable();
            $table->string('client_ring')->nullable();
            $table->string('client_code')->nullable();
            $table->string('rate_mbit_s')->nullable();
            $table->string('site_a')->nullable();
            $table->string('site_b')->nullable();
            $table->dateTime('date_po_order_rx')->nullable();
            $table->string('po_mrc')->nullable();
            $table->string('po_nrc')->nullable();
            $table->string('service_manager')->nullable();
            $table->string('client_quotation_ref')->nullable();
            $table->string('account_manager_name')->nullable();
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
        Schema::dropIfExists('site_master_file_records');
    }
}
