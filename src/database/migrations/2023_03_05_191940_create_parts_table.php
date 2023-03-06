<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_code');
            $table->string('name');
            $table->tinyInteger('active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('part_vehicle', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('part_id')->unsigned();
            $table->bigInteger('vehicle_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('part_vehicle', function (Blueprint $table) {
            $table->dropForeign(['part_id']);
            $table->dropForeign(['vehicle_id']);
        });
        Schema::dropIfExists('part_vehicle');

        Schema::dropIfExists('parts');
    }
}
