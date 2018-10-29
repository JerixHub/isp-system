<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'			=> 'admin',
        	'email'			=> 'admin@admin.com',
            'country_id'    => 177,
        	'password'		=> bcrypt('password'),
        	'role'			=> 'admin',
            'business_name' => 'jericcompany',
        	'created_at'	=> \Carbon\Carbon::now(),
        	'updated_at'	=> \Carbon\Carbon::now()
        ]);
    }
}
