<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAllProductsView extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement(
			"CREATE VIEW all_products AS
			SELECT p.title, p.price, c.description AS category,
				(SELECT i.filename
				FROM alternative_store.product_images i
				WHERE i.product_id = p.id
				LIMIT 1) AS image
			FROM alternative_store.products p
			INNER JOIN alternative_store.categories c ON c.id = p.category_id
			WHERE p.visibility = 'V'"
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW all_products');
	}
}
