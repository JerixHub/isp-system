<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('countries')->insert([
        // 	'name'			=> 'Unassigned',
        // 	'created_at'	=> \Carbon\Carbon::now(),
        // 	'updated_at'	=> \Carbon\Carbon::now()
        // ]);

    	$path = storage_path() . '/country.json';
        $json = File::get($path);
        $json_data = json_decode($json,true);
        foreach ($json_data as $key => $value) {
            $currencies = $value['currencies'];
            $currency_symbol;
            foreach ($currencies as $currency) {
                if(empty($currency['symbol'])){
                    $currency_symbol = $currency['code'];
                }else{
                    $currency_symbol = $currency['symbol'];
                }
            }
        	DB::table('countries')->insert(
        		[
        			'code'			=>$value['alpha3Code'],
        			'name'			=>$value['name'],
                    'symbol'        =>$currency_symbol,
        			'created_at'	=> \Carbon\Carbon::now(),
        			'updated_at'	=> \Carbon\Carbon::now()
        		]
        	);
        }
    }
}
