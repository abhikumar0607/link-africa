<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_leads', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_intiated')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('kam')->nullable();
            $table->string('segment')->nullable();
            $table->string('province')->nullable();
            $table->string('site_name')->nullable();
            $table->string('lease_term_months')->nullable();
            $table->dateTime('expected_close_month')->nullable();
            $table->string('product')->nullable();
            $table->string('estimated_mrc')->nullable();
            $table->dateTime('expected_invoice_month')->nullable();
            $table->string('sales_stage')->nullable();
            $table->string('estimated_nrc')->nullable();
            $table->dateTime('actual_closing_date')->nullable();
            $table->string('probability')->nullable();
            $table->dateTime('actual_invoice_date')->nullable();
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('sale_leads');
    }
}
