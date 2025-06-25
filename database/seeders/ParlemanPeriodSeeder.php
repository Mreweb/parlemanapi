<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParlemanPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('period_title' => 'دوره اول: ۱۳۵۹-۱۳۶۳'),
            array('period_title' => 'دوره دوم: ۱۳۶۳-۱۳۶۷'),
            array('period_title' => 'دوره سوم: ۱۳۶۷-۱۳۷۱'),
            array('period_title' => 'دوره چهارم: ۱۳۷۱-۱۳۷۵'),
            array('period_title' => 'دوره پنجم: ۱۳۷۵-۱۳۷۹'),
            array('period_title' => 'دوره ششم: ۱۳۷۹-۱۳۸۳'),
            array('period_title' => 'دوره هفتم: ۱۳۸۳-۱۳۸۷'),
            array('period_title' => 'دوره هشتم: ۱۳۸۷-۱۳۹۱'),
            array('period_title' => 'دوره نهم: ۱۳۹۱-۱۳۹۵'),
            array('period_title' => 'دوره دهم: ۱۳۹۵-۱۳۹۹'),
            array('period_title' => 'دوره یازدهم: ۱۳۹۹-۱۴۰۳'),
            array('period_title' => 'دوره دوازدهم: ۱۴۰۳-۱۴۰۷')
        );
        foreach($data as $value){
            DB::table('parleman_period')->insert([
                'period_title' => $value['period_title'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
