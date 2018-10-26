<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
        	[
        		'name'				=> 'Sample Product',
        		'sale_price'		=> 90,
        		'cost_price'		=> 75,
        		'description'		=> 'Sample description of product',
        		'unit_measure_id'	=> 1,
        		'is_active'			=> 'yes',
        		'product_type'		=> 'stockable',
        		'barcode'			=> '0123456789012',
        		'category_id'		=> 1,
        		'created_at'		=> \Carbon\Carbon::now(),
        		'updated_at'		=> \Carbon\Carbon::now()
        	]
        );
    }
}
