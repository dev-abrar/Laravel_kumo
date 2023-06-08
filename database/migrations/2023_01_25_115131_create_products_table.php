<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->float('price');
            $table->float('discount')->default(0);
            $table->float('after_discount');
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('brand')->nullable();
            $table->string('short_desp');
            $table->longText('long_desp');
            $table->longText('aditional_info')->nullable();
            $table->string('preview')->nullable();
            $table->string('sku');
            $table->string('slug');
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
};
