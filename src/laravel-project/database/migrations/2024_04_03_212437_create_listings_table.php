<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('inspector_id')->nullable();

            $table->string('title', 45);
            $table->string('description');
            $table->string('address');
            $table->dateTime('start');
            $table->dateTime('end');

            $table->string('contact_name', 45);
            $table->string('contact_phone');
            $table->string('contact_email');

            $table->timestamps();
            $table->softDeletes();


            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('inspector_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropForeign(['inspector_id']);
        });

        Schema::dropIfExists('listings');
    }
};
