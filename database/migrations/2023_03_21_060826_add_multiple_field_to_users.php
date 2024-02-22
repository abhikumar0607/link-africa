<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleFieldToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('emp_code')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('company_rule')->nullable();
            $table->string('cost_centre')->nullable();
            $table->string('department')->nullable();
            $table->string('team')->nullable();
            $table->string('edit_form_access')->default('none')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
