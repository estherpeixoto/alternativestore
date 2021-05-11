<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
			$table->foreignId('order_id')
				->constrained('orders')
				->onUpdate('cascade')
				->onDelete('cascade');

			$table->foreignId('product_id')
				->constrained('products')
				->onUpdate('cascade')
				->onDelete('restrict');

			$table->integer('quantity')->unsigned();
			$table->double('price', 8, 2);
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
        Schema::dropIfExists('order_items');
    }
}
