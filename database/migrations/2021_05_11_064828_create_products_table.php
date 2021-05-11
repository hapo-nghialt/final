<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->text('title');
            $table->text('status');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('image-1')->nullable();
            $table->string('image-2')->nullable();
            $table->string('image-3')->nullable();
            $table->string('image-4')->nullable();
            $table->string('image-5')->nullable();
            $table->string('image-6')->nullable();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->tinyInteger('show_status');
            $table->tinyInteger('bought_status');
            $table->text('address');
            $table->integer('price');
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
