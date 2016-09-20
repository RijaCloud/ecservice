<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
           'name' => 'Rija Cloud',
           'email' => 'r.andrian@gmx.com',
           'password' => Hash::make('tarashi'),
           'created_at' => date('Y-m-d')
        ]);

    }
}
