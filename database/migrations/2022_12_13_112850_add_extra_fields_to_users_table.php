<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->after('remember_token')->nullable();
            $table->string('avatar')->default('default_user.png')->after('mobile')->nullable();
            $table->enum('user_type', ['Super_Admin','Admin','Customer','Subscriber'])->default('Customer')->after('avatar')->nullable();
            $table->enum('user_status', ['Pending', 'Verified', 'Active'])->default('Pending')->after('user_type')->nullable();
            $table->string('first_name')->after('user_status')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('online_status')->after('last_name')->nullable();
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
