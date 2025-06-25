<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('commission_name' => 'کمیسیون امنیت ملی و سیاست خارجی'),
            array('commission_name' => 'کمیسیون برنامه و بودجه و محاسبات'),
            array('commission_name' => 'کمیسیون اجتماعی'),
            array('commission_name' => 'کمیسیون آموزش، تحقیقات و فناوری'),
            array('commission_name' => 'کمیسیون صنایع و معادن'),
            array('commission_name' => 'کمیسیون بهداشت، درمان و آموزش پزشکی'),
            array('commission_name' => 'کمیسیون اقتصادی'),
            array('commission_name' => 'کمیسیون عمران'),
            array('commission_name' => 'کمیسیون کشاورزی، آب، منابع طبیعی و محیط زیست'),
            array('commission_name' => 'کمیسیون انرژی')
        );
        foreach($data as $value){
            DB::table('commission')->insert([
                'commission_name' => $value['commission_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
