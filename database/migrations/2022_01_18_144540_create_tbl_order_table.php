<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->increments('order_id');

            $table->integer('customer_id')->unsigned();
            $table  ->foreign('customer_id')
                    ->references('customer_id')
                    ->on('tbl_customer')
                    ->onDelete('cascade');

            $table->integer('shipping_id')->unsigned();
            $table  ->foreign('shipping_id')
                    ->references('shipping_id')
                    ->on('tbl_shipping')
                    ->onDelete('cascade');

            $table->integer('payment_id')->unsigned();
            $table  ->foreign('payment_id')
                    ->references('payment_id')
                    ->on('tbl_payment')
                    ->onDelete('cascade');

            $table->string('order_total');
            $table->string('order_status');
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
        Schema::dropIfExists('tbl_order');
    }
}
