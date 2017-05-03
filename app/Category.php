<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function transactions() {
		# Category has many Transactions
		# Define a one-to-many relationship.
		return $this->hasMany('App\Transaction');
	}
}
