<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_comments', function (Blueprint $table) {
            $table->id();
            $table->string('circuit_id')->nullable();
            $table->string('service_id')->nullable();
            $table->longText('planning_comment')->nullable();
            $table->longText('build_comment')->nullable();
            $table->longText('permission_comment')->nullable();
            $table->longText('service_delivery_comment')->nullable();
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
        Schema::dropIfExists('department_comments');
    }
}
