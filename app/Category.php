<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = [
		'name', 'parent_id'
	];

    public function parent(){
    	return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children(){
    	return $this->hasMany('App\Category', 'parent_id');
    }
}
