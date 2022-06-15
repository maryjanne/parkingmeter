<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_meters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('meter_no')->unique();
            $table->string('meter_type');
            $table->decimal('long', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->tinyInteger('status');
            $table->string('borough');
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
        Schema::dropIfExists('parking_meters');
    }
}
