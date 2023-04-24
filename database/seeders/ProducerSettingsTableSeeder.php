<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProducerSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('producer_settings')->delete();
        
        \DB::table('producer_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'currency' => '0',
                'currency_symbol' => '',
                'producer_revenue' => 0,
                'admin_revenue' => 0,
                'per_view_revenue' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}