<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumPageBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'album_page_backgrounds';
        
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->unsigned();
            $table->integer('sequence');
            $table->integer('x_position');
            $table->integer('y_position');
            $table->integer('rotation');
            $table->timestamps();
        });

        Schema::table($tableName, function (Blueprint $table) {
            $table->foreign('page_id')
            ->references('id')->on('album_pages')
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
        Schema::dropIfExists('album_page_backgrounds');
    }
}
