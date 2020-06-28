<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumOrderDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_order_delivery_addresses', function (Blueprint $table) {
            $table->foreignId('album_order_id')->constrained();
            $table->primary('album_order_id');
            $table->string('zipcode', 9);
            $table->string('state', 2);
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->integer('address_number');
            $table->string('complement')->nullable();
            $table->string('receiver_name');
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
        Schema::dropIfExists('album_order_delivery_addresses');
    }
}
