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

    public static function getCategoriesForDropdown() {

        # Get all the categories
        $categories = Category::orderBy('name', 'ASC')->get();

        # Organize the categories into an array where the key = category id and value = category name
        $categoriesForDropdown = [];
        foreach($categories as $category) {
            $categoriesForDropdown[$category->id] = $category->name;
        }

        return $categoriesForDropdown;
    }
}
