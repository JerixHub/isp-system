<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	'name'			=> 'Unassigned',
        	'created_at'	=> \Carbon\Carbon::now(),
        	'updated_at'	=> \Carbon\Carbon::now()
        ]);
    }
}
