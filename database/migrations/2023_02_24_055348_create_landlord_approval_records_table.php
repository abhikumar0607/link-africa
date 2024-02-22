<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordApprovalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlord_approval_records', function (Blueprint $table) {
            $table->id();
            $table->string('landlord_approval_status')->nullable();
            $table->dateTime('landlord_date_received_from')->nullable();
            $table->dateTime('date_submit_for_landlord')->nullable();
            $table->dateTime('date_landlord_approval')->nullable();
            $table->dateTime('landlord_date_on_hold')->nullable();
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
        Schema::dropIfExists('landlord_approval_records');
    }
}
