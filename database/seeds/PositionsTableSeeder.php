<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'name' => 'Vratar',
            'created_at' => Carbon::now()         
        ]);
        DB::table('positions')->insert([
            'name' => 'Centralni branič',
            'created_at' => Carbon::now()         
        ]);
        DB::table('positions')->insert([
            'name' => 'Bočni branič',
            'created_at' => Carbon::now()         
        ]);
        DB::table('positions')->insert([
            'name' => 'Centralni vezni',
            'created_at' => Carbon::now()         
        ]);
        DB::table('positions')->insert([
            'name' => 'Krilni vezni',
            'created_at' => Carbon::now()         
        ]);
        DB::table('positions')->insert([
            'name' => 'Napadač',
            'created_at' => Carbon::now()         
        ]);
        
    }
}
