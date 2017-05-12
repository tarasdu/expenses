<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function category() {

		return $this->belongsTo('App\Category');
	}

    public function tags()
    {

        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function user() {

        return $this->belongsTo('App\User');
    }
}
