<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('sale_price')->default(1.0);
            $table->float('cost_price')->default(1.0);
            $table->text('description')->nullable();
            $table->unsignedInteger('unit_measure')->nullable();
            $table->enum('is_active',['yes','no'])->default('yes');
            $table->enum('product_type',['stockable','consumable'])->default('stockable');
            $table->string('barcode')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('products');
    }
}
