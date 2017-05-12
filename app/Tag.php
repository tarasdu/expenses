<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function transactions() {
        return $this->belongsToMany('App\Transaction')->withTimestamps();
    }

    public function user() {

        return $this->belongsTo('App\User');
    }

}
