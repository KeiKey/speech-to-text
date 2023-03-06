<?php

use App\Enums\ImportStatus;
use App\Enums\ImportType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('uploader_id')->unsigned();
            $table->string('file_name');
            $table->string('import_type')->comment(ImportType::toString());
            $table->string('status')->default(ImportStatus::default())->comment(ImportType::toString());
            $table->longText('result')->nullable();
            $table->timestamps();

            $table->foreign('uploader_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('imports', function (Blueprint $table) {
            $table->dropForeign(['uploader_id']);
        });

        Schema::dropIfExists('imports');
    }
}
