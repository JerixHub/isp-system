<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert(
        	[
        		'name'				=> 'Coca-Cola',
        		'address'			=> '20/F San Miguel Properties Centre, Ortigas Center, Pasig City, Metro Manila, Philippines',
        		'contact_number' 	=> '+63(2)6899263',
        		'contact_person'	=> 'John Doe'
        	]
        );
    }
}
