<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrator',
            'created_at' => Carbon::now()         
        ]);
        DB::table('roles')->insert([
            'name' => 'Uprava',
            'created_at' => Carbon::now()         
        ]);
        DB::table('roles')->insert([
            'name' => 'Trener',
            'created_at' => Carbon::now()         
        ]);
    }
}
