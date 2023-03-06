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
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_code');
            $table->bigInteger('brand_id')->unsigned();
            $table->string('series');
            $table->integer('size')->nullable();
            $table->string('configuration')->nullable();
            $table->string('model');
            $table->string('sales_name')->nullable();
            $table->year('year');
            $table->integer('cylinder')->nullable();
            $table->string('type_of_drive');
            $table->string('engine_output')->nullable();
            $table->string('country');
            $table->string('primary_category');
            $table->string('secondary_category');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
        });

        Schema::dropIfExists('vehicles');
    }
}
