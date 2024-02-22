<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageSaRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_sa_regions', function (Blueprint $table) {
            $table->id();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->string('province_code')->nullable();
            $table->string('munic_name')->nullable();
            $table->string('namecode')->nullable();
            $table->string('map_title')->nullable();
            $table->string('district')->nullable();
            $table->string('district_n')->nullable();
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
        Schema::dropIfExists('manage_sa_regions');
    }
}
