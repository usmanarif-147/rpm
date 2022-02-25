<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')
                ->constrained('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('make');
            $table->string('model');
            $table->string('license');
            $table->string('resident_name');
            $table->string('apartment_no');
            $table->string('email');
            $table->dateTime('valid_till');
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
        Schema::dropIfExists('vehicles');
    }
}
