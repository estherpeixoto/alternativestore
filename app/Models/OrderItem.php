<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

	public $timestamps = true;

    protected $fillable = [
		'order_id',
		'product_id',
		'size_id',
		'quantity',
		'price',
		'total',
    ];
}
