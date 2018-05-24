<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@sk.com',
            'password' => Hash::make('secret'),
            'role_id' => 1,
            'created_at' => Carbon::now()         
        ]);
        DB::table('users')->insert([
            'first_name' => 'Šef',
            'last_name' => 'Uprava',
            'email' => 'uprava@sk.com',
            'password' => Hash::make('secret'),
            'role_id' => 2,
            'created_at' => Carbon::now()         
        ]);
        DB::table('users')->insert([
            'first_name' => 'Trener',
            'last_name' => 'Trenerković',
            'email' => 'trener@sk.com',
            'password' => Hash::make('secret'),
            'role_id' => 3,
            'created_at' => Carbon::now()         
        ]);
        DB::table('users')->insert([
            'first_name' => 'Jose',
            'last_name' => 'Mourinho',
            'email' => 'jm@sk.com',
            'password' => Hash::make('secret'),
            'role_id' => 3,
            'created_at' => Carbon::now()         
        ]);
        DB::table('users')->insert([
            'first_name' => 'Zoran',
            'last_name' => 'Mamić',
            'email' => 'zm@sk.com',
            'password' => Hash::make('secret'),
            'role_id' => 3,
            'created_at' => Carbon::now()         
        ]);
    }
}
