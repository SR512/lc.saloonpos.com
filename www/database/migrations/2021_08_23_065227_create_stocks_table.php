<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_size_id');
            $table->string('quantity')->nullable();
            $table->string('min_quantity')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('price')->nullable();
            $table->string('purchased_date')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            //$table->foreign('attribute_size_id')->references('id')->on('attribute_size')->onDelete('cascade');

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
        Schema::dropIfExists('stocks');
    }
}
