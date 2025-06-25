<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('gov_period_name' => 'دولت اول'),
            array('gov_period_name' => 'دولت دوم'),
            array('gov_period_name' => 'دولت سوم'),
            array('gov_period_name' => 'دولت چهارم'),
            array('gov_period_name' => 'دولت پنجم'),
            array('gov_period_name' => 'دولت ششم'),
            array('gov_period_name' => 'دولت هفتم'),
            array('gov_period_name' => 'دولت هشتم'),
            array('gov_period_name' => 'دولت نهم'),
            array('gov_period_name' => 'دولت دهم'),
            array('gov_period_name' => 'دولت یازدهم'),
            array('gov_period_name' => 'دولت دوازدهم')
        );
        foreach($data as $value){
            DB::table('gov_period')->insert([
                'gov_period_name' => $value['gov_period_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
