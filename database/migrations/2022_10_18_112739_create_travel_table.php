<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leaving_city_id');
            $table->foreignId('going_city_id');
            $table->foreignId('travel_name_id')->constrained('travel_names')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('flight_type_id')->constrained('flight_types')->onDelete('cascade')->onUpdate('cascade');
            $table->time('Departure');
            $table->string('available');
            $table->string('price');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->datetime('travel_date');
            $table->string('flight_plate_number');
            $table->enum('status',[0,1])->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('travels');
    }
};
