<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_services', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->string('qty')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('remarks')->nullable();
            $table->softDeletes();
            $table->foreignId('flight_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_list_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('flight_services');
    }
}
