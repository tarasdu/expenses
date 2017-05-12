<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['one-time', 'regular', 'credit card', 'loan repayment', 'loan'];

        foreach($tags as $tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->user_id = 1;
            $tag->save();
        }
    }
}
