<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert(
            [
                'com_name'=>'com_name1',
                'com_name_short'=>'com_name_short1',
                'create_date' => NOW(),
    
            ],
            [
                'com_name'=>'com_name2',
                'com_name_short'=>'com_name_short2',
                'create_date' => NOW(),
    
            ],
            [
                'com_name'=>'com_name3',
                'com_name_short'=>'com_name_short3',
                'create_date' => NOW(),
    
            ],
        );
    }
}
