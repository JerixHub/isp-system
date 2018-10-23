<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnitMeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$units = array(
            [
                'name'          => 'Unit',
                'abbrev'        => 'U',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
            ],
    		[
	        	'name'			=> 'Feet',
	        	'abbrev'		=> 'ft',
	        	'created_at'	=> \Carbon\Carbon::now(),
	        	'updated_at'	=> \Carbon\Carbon::now()
        	],
        	[
	        	'name'			=> 'Dozens',
	        	'abbrev'		=> 'dz',
	        	'created_at'	=> \Carbon\Carbon::now(),
	        	'updated_at'	=> \Carbon\Carbon::now()
        	],
        	[
	        	'name'			=> 'Kilograms',
	        	'abbrev'		=> 'kg',
	        	'created_at'	=> \Carbon\Carbon::now(),
	        	'updated_at'	=> \Carbon\Carbon::now()
        	],
        	[
	        	'name'			=> 'Centimeters',
	        	'abbrev'		=> 'cm',
	        	'created_at'	=> \Carbon\Carbon::now(),
	        	'updated_at'	=> \Carbon\Carbon::now()
        	],
        	[
	        	'name'			=> 'Meters',
	        	'abbrev'		=> 'M',
	        	'created_at'	=> \Carbon\Carbon::now(),
	        	'updated_at'	=> \Carbon\Carbon::now()
        	]
    	);

    	foreach ($units as $unit) {
    		DB::table('unit_measures')->insert($unit);
    	}

        
    }
}
