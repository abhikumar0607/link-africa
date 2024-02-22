<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningSiteSurveyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_site_survey_records', function (Blueprint $table) {
            $table->id();
            $table->string('circuit_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('site_survey_status')->nullable();
            $table->dateTime('survey_date_received_from')->nullable();
            $table->dateTime('date_site_survey')->nullable();
            $table->dateTime('survey_date_on_hold')->nullable();
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
        Schema::dropIfExists('planning_site_survey_records');
    }
}
