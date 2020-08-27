<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumOrderFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_order_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_order_id')->constrained();
            $table->foreignId('album_order_file_type_id')->constrained();
            $table->string('path')->unique();
            $table->integer('sequence');
            $table->timestamps();

            $table->unique(['album_order_id', 'album_order_file_type_id', 'sequence'], 'uk_order_filetype_sequence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_order_files');
    }
}
