<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')
				->constrained('users')
				->onUpdate('cascade')
				->onDelete('restrict');

			$table->foreignId('address_id')
				->constrained('addresses')
				->onUpdate('cascade')
				->onDelete('restrict');

			$table->foreignId('payment_id')
				->constrained('payments')
				->onUpdate('cascade')
				->onDelete('restrict');

			$table->double('total', 8, 2);
			$table->string('delivery_method', 45);
			$table->date('order_date');
			$table->date('delivery_date');
			$table->date('real_delivery_date');
			$table->string('tracking_code', 45);
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
        Schema::dropIfExists('orders');
    }
}
