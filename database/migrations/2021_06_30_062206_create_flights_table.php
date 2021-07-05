<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_no');
            $table->string('origin');
            $table->string('destination');
            $table->string('flight_type');
            $table->string('aircraft_type');
            $table->string('aircraft_registration')->nullable();
            $table->string('turnaround_type');
            $table->date('flight_date');
            $table->dateTime('arrival')->nullable();
            $table->dateTime('departure')->nullable();
            $table->dateTime('STA');
            $table->dateTime('STD');
            $table->integer('delay_code')->nullable();
            $table->string('remarks')->nullable();
            $table->string('serial')->nullable();
            $table->boolean('loaded')->nullable();
            $table->softDeletes();
            $table->foreignId('flight_schedule_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('carrier_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('flights');
    }
}
