<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaPopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('la_pops', function (Blueprint $table) {
            $table->id();
            $table->string('pop_id')->nullable();
            $table->string('area')->nullable();
			$table->dateTime('isp_plan_date')->nullable();
            $table->string('area_name')->nullable();
            $table->dateTime('sumission_permission')->nullable();
            $table->string('pop_type')->nullable();
            $table->dateTime('date_approved_from_permission')->nullable();
            $table->string('pop_name')->nullable();
            $table->dateTime('boq_release_date')->nullable();
            $table->string('pop_address')->nullable();
            $table->longText('comments')->nullable();
            $table->string('lat')->nullable();
            $table->string('pop_status')->nullable();
            $table->string('long')->nullable();
            $table->string('land_lord_name')->nullable();
            $table->string('planning_progress_status')->nullable();
            $table->string('land_lord_contact')->nullable();
            $table->string('isp_capacity_planner')->nullable();
			$table->dateTime('survey_date')->nullable();
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
        Schema::dropIfExists('la_pops');
    }
}
