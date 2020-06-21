<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumPageTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'album_page_texts';

        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->unsigned();
            $table->integer('font_id')->unsigned();
            $table->text('text');
            $table->integer('font_size');
            $table->boolean('bold');
            $table->boolean('italic');
            $table->boolean('underlined');
            $table->integer('width');
            $table->integer('height');
            $table->integer('x_position');
            $table->integer('y_position');
            $table->integer('rotation');
            $table->timestamps();
        });

        Schema::table($tableName, function (Blueprint $table) {
            $table->foreign('page_id')
            ->references('id')->on('album_pages')
            ->onDelete('cascade');
            $table->foreign('font_id')
            ->references('id')->on('fonts')
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
        Schema::dropIfExists('album_page_texts');
    }
}
