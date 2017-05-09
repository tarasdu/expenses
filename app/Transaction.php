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

    public function tags()
    {
        # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
