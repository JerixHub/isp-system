<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
		'name',
		'sale_price',
		'cost_price',
		'description',
		'unit_measure',
		'is_active',
		'product_type',
		'barcode',
		'category_id'
	];

	public function suppliers()
	{
		return $this->belongsToMany('App\Supplier', 'product_supplier', 'product_id', 'supplier_id');
	}

	public function unit_measure()
	{
		return $this->belongsTo('App\UnitMeasure');
	}
}
