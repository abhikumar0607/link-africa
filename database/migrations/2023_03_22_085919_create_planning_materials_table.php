<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_materials', function (Blueprint $table) {
            $table->id();
            $table->string('stock_code')->nullable();
            $table->longText('description')->nullable();
            $table->string('unit_measurement')->nullable();
            $table->string('list_price')->nullable();
            $table->string('stock_code_description')->nullable();
            $table->string('catergory')->nullable();
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
        Schema::dropIfExists('planning_materials');
    }
}
