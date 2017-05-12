<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::firstOrCreate([
            'email' => 'Jimmy@dundyak.me',
            'name' => 'Jimmy TestUser',
            'password' => \Hash::make('helloworld')
            ]);

        $user = \App\User::firstOrCreate([
            'email' => 'Victoria@dundyak.me',
            'name' => 'Victoria TestUser',
            'password' => \Hash::make('helloworld')
        ]);
    }
}
