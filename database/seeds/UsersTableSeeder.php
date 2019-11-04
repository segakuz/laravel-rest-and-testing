<?php

use App\User;
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
        //
        User::truncate();

        $password = Hash::make('toptal');

        User::create([
            'name' => 'administrator',
            'email' => 'admin@test.com',
            'password' => $password,
        ]);

        factory(User::class, 10)->create();
    }
}
