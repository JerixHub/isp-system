<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
		'name', 'address', 'contact', 'contact_person'
	];

	public function products()
	{
		return $this->belongsToMany('App\Products', 'product_supplier', 'supplier_id', 'product_id');
	}
}
