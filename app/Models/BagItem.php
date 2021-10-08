<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagItem extends Model
{
    use HasFactory;

    protected $table = 'bag_items';

	public $timestamps = false;

    protected $fillable = [
		'bag_id',
		'product_id',
		'size_id',
		'quantity'
    ];
}
