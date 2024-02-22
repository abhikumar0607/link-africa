<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningMaterialsServiceIspBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_materials_service_isp_bs', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->nullable();
            $table->string('circuit_id')->nullable();
            $table->string('stock_code')->nullable();
            $table->string('quantity')->nullable();
            $table->string('isp_b_build_type')->nullable();
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
        Schema::dropIfExists('planning_materials_service_isp_bs');
    }
}
