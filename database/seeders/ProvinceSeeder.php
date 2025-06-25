<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $data = array(
            array('province_id' => '1','province_name' => 'آذربایجان شرقی'),
            array('province_id' => '2','province_name' => 'آذربایجان غربی'),
            array('province_id' => '3','province_name' => 'اردبيل'),
            array('province_id' => '4','province_name' => 'اصفهان'),
            array('province_id' => '5','province_name' => 'البرز'),
            array('province_id' => '6','province_name' => 'ايلام'),
            array('province_id' => '7','province_name' => 'بوشهر'),
            array('province_id' => '8','province_name' => 'تهران'),
            array('province_id' => '9','province_name' => 'چهارمحال و بختیاری'),
            array('province_id' => '10','province_name' => 'خراسان جنوبی'),
            array('province_id' => '11','province_name' => 'خراسان رضوی'),
            array('province_id' => '12','province_name' => 'خراسان شمالی'),
            array('province_id' => '13','province_name' => 'خوزستان'),
            array('province_id' => '14','province_name' => 'زنجان'),
            array('province_id' => '15','province_name' => 'سمنان'),
            array('province_id' => '16','province_name' => 'سیستان و بلوچستان'),
            array('province_id' => '17','province_name' => 'فارس'),
            array('province_id' => '18','province_name' => 'قزوين'),
            array('province_id' => '19','province_name' => 'قم'),
            array('province_id' => '20','province_name' => 'كردستان'),
            array('province_id' => '21','province_name' => 'كرمان'),
            array('province_id' => '22','province_name' => 'كرمانشاه'),
            array('province_id' => '23','province_name' => 'کهگیلویه و بویراحمد'),
            array('province_id' => '24','province_name' => 'گلستان'),
            array('province_id' => '25','province_name' => 'گيلان'),
            array('province_id' => '26','province_name' => 'لرستان'),
            array('province_id' => '27','province_name' => 'مازندران'),
            array('province_id' => '28','province_name' => 'مرکزی'),
            array('province_id' => '29','province_name' => 'هرمزگان'),
            array('province_id' => '30','province_name' => 'همدان'),
            array('province_id' => '31','province_name' => 'يزد')
        );
        foreach($data as $value){
            DB::table('province')->insert([
                'province_id' => $value['province_id'],
                'province_name' => $value['province_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
