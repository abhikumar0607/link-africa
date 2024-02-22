<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('gps_co_ordinates')->nullable();
            $table->string('gps_co_ordinates2')->nullable();
            $table->string('work_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('landlord_name')->nullable();
            $table->string('managing_agent')->nullable();
            $table->string('landlord_contact_number')->nullable();
            $table->string('site_type')->nullable()->default('site_a');
            $table->string('module_type')->nullable()->default('sale');
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
        Schema::dropIfExists('_sites');
    }
}
