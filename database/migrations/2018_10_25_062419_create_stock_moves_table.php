<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_moves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->float('quantity');
            $table->unsignedInteger('unit_measure_id');
            $table->foreign('unit_measure_id')->references('id')->on('unit_measures');
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
        Schema::dropIfExists('stock_moves');
    }
}
