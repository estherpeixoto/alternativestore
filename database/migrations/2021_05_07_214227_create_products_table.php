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
			$table->foreignId('category_id')
				->constrained('categories')
				->onUpdate('cascade')
				->onDelete('restrict');

			$table->string('title', 100);
			$table->text('description');
			$table->double('price', 8, 2);
			$table->enum('visibility', ['V', 'H']);
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
