<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');

            $table->integer('category_id')->unsigned(); 
            $table->foreign('category_id')
                    ->references('category_id')
                    ->on('tbl_category_product')
                    ->onDelete('cascade');

            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')
                    ->references('brand_id')
                    ->on('tbl_brand_product')
                    ->onDelete('cascade');

            $table->text('product_desc');  
            $table->text('product_content');  
            $table->float('product_price'); 
            $table->string('product_image'); 
            $table->integer('product_status'); 
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
        Schema::dropIfExists('tbl_product');
    }
}
