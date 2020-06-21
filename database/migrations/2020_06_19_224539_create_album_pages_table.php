<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'album_pages';
        
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->integer('album_id')->unsigned();
            $table->integer('sequence');
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::table($tableName, function (Blueprint $table) {
            $table->foreign('album_id')
            ->references('id')->on('albums')
            ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_pages');
    }
}
