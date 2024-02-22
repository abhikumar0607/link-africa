<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraaFieldsToSupportTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->string('ticket_status')->nullable();
            $table->string('requester')->nullable();
            $table->string('requester_email_address')->nullable();
            $table->string('depaertment')->nullable();
            $table->string('location')->nullable();
            $table->string('priority')->nullable();
            $table->string('impact')->nullable();
            $table->string('service')->nullable();
            $table->string('category')->nullable();
            $table->string('assignement_group')->nullable();
            $table->string('assigne')->nullable();
            $table->string('external_vendor')->nullable();
            $table->string('external_reference')->nullable();
            $table->string('resolution_date')->nullable();
            $table->Text('resolution_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            //
        });
    }
}
