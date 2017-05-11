<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function transactions() {

		return $this->hasMany('App\Transaction');
	}

    public static function getCategoriesForDropdown() {

        $categories = Category::orderBy('name', 'ASC')->get();

        $categoriesForDropdown = [];
        foreach($categories as $category) {
            $categoriesForDropdown[$category->id] = $category->name;
        }

        return $categoriesForDropdown;
    }
}
