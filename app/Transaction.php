<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function category() {
		# Transaction belongs to Category
		# Define an inverse one-to-many relationship.
		return $this->belongsTo('App\Category');
	}
}
