<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferralsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referrals')->delete();
        
        \DB::table('referrals')->insert(array (
            0 => 
            array (
                'id' => 1,
                'percentage' => '30',
                'created_at' => '2024-03-12 12:33:01',
                'updated_at' => '2024-03-12 12:33:01',
            ),
        ));
        
        
    }
}