<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
			$table->foreignId('size_id')
				->constrained('sizes')
				->onUpdate('cascade')
				->onDelete('restrict');

			$table->foreignId('product_id')
				->constrained('products')
				->onUpdate('cascade')
				->onDelete('cascade');

			$table->double('chest', 8, 2);
			$table->double('shoulder', 8, 2);
			$table->double('length', 8, 2);
			$table->double('sleeve', 8, 2);
			$table->double('waist', 8, 2);
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
        Schema::dropIfExists('product_sizes');
    }
}
