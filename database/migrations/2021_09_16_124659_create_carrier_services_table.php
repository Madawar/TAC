<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrierServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_services', function (Blueprint $table) {
            $table->id();
            $table->boolean('service_type');
            $table->integer('carrier_id');
            $table->integer('service_id')->nullable();
            $table->string('handling_service')->nullable();
            $table->string('aircraft_type')->nullable();
            $table->string('flight_type')->nullable();
            $table->string('free_hrs')->nullable();
            $table->double('charge');
            $table->softDeletes();
            //$table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');;
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
        Schema::dropIfExists('carrier_services');
    }
}
