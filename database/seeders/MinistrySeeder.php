<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('ministry_name' => 'وزارت آموزش و پرورش'),
            array('ministry_name' => 'وزارت ارتباطات و فناوری اطلاعات'),
            array('ministry_name' => 'وزارت اطلاعات'),
            array('ministry_name' => 'وزارت امور اقتصادی و دارایی'),
            array('ministry_name' => 'وزارت امور خارجه'),
            array('ministry_name' => 'وزارت بهداشت، درمان و آموزش پزشکی'),
            array('ministry_name' => 'وزارت تعاون، کار و رفاه اجتماعی'),
            array('ministry_name' => 'وزارت جهاد کشاورزی'),
            array('ministry_name' => 'وزارت دادگستری'),
            array('ministry_name' => 'وزارت دفاع و پشتیبانی نیروهای مسلح'),
            array('ministry_name' => 'وزارت راه و شهرسازی'),
            array('ministry_name' => 'وزارت علوم، تحقیقات و فناوری'),
            array('ministry_name' => 'وزارت فرهنگ و ارشاد اسلامی'),
            array('ministry_name' => 'وزارت کشور'),
            array('ministry_name' => 'وزارت میراث فرهنگی، گردشگری و صنایع دستی'),
            array('ministry_name' => 'وزارت نفت'),
            array('ministry_name' => 'وزارت نیرو'),
            array('ministry_name' => 'وزارت ورزش و جوانان')
        );
        foreach($data as $value){
            DB::table('ministry')->insert([
                'ministry_name' => $value['ministry_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
