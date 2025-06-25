<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('fraction_name' => 'فراکسیون انقلاب اسلامی'),
            array('fraction_name' => 'فراکسیون مستقلین ولایی'),
            array('fraction_name' => 'فراکسیون گام دوم انقلاب'),
            array('fraction_name' => 'فراکسیون دیپلماسی بین المللی و منافع ملی'),
            array('fraction_name' => 'فراکسیون دفاع و اقتدار ملی'),
            array('fraction_name' => 'فراکسیون محور مقاومت و آزادسازی قدس شریف'),
            array('fraction_name' => 'فراکسیون نظارت بر اجرای قوانین'),
            array('fraction_name' => ' فراکسیون اقدام پیش دستانه علیه تهدیدات آمریکا'),
            array('fraction_name' => 'فراکسیون شهید دیالمه'),
            array('fraction_name' => 'فراکسیون امنیت پایدار و روابط خارجی پویا'),
            array('fraction_name' => 'فراکسیون راهبردی'),
            array('fraction_name' => 'فراکسیون حقوقی و پیشبرد قوانین'),
            array('fraction_name' => 'فراکسیون حقوق بشر و شهروندی مجلس'),
            array('fraction_name' => 'فراکسیون حمایت از صنعت و صنعتگران'),
            array('fraction_name' => 'فراکسیون اقتصاد دانش بنیان'),
            array('fraction_name' => 'فراکسیون مناطق آزاد صنعتی- تجاری'),
            array('fraction_name' => 'فراکسیون توسعه متوازن کشور'),
            array('fraction_name' => 'فراکسیون تعاون مجلس'),
            array('fraction_name' => 'فراکسیون جهاد سازندگی و پیشرفت'),
            array('fraction_name' => 'فراکسیون کارآفرینان مجلس'),
            array('fraction_name' => 'فراکسیون محرومیت‌زدایی و گروه‌های جهادی'),
            array('fraction_name' => 'فراکسیون مناطق محروم و شهرهای کمتر توسعه‌یافته'),
            array('fraction_name' => 'فراکسیون تسهیل تجارت داخلی و خارجی'),
            array('fraction_name' => 'فراکسیون حمایت از سرمایه‌گذاری داخلی و خارجی'),
            array('fraction_name' => 'فراکسیون اقتصاد دریامحور'),
            array('fraction_name' => 'فراکسیون توسعه پایدار و تامین مالی'),
            array('fraction_name' => 'فراکسیون اقتصاد سفر و زیارت'),
            array('fraction_name' => 'فراکسیون مبارزه با فساد'),
            array('fraction_name' => 'فراکسیون مقابله با خشکسالی'),
            array('fraction_name' => 'فراکسیون محیط زیست'),
            array('fraction_name' => 'فراکسیون مقابله با آسیب‌های اجتماعی'),
            array('fraction_name' => 'فراکسیون مجمع خیرین و امور خیریه'),
            array('fraction_name' => 'فراکسیون دیپلماسی سلامت و سبک زندگی سالم'),
            array('fraction_name' => 'فراکسیون طب سنتی'),
            array('fraction_name' => 'فراکسیون هلال احمر'),
            array('fraction_name' => 'فراکسیون سازمان‌های مردم نهاد'),
            array('fraction_name' => 'فراکسیون سلامت سالمندان'),
            array('fraction_name' => 'فراکسیون مدیریت شهری'),
            array('fraction_name' => 'فراکسیون کارگری'),
            array('fraction_name' => 'فراکسیون زنان'),
            array('fraction_name' => 'فراکسیون روحانیت'),
            array('fraction_name' => 'فراکسیون اصناف'),
            array('fraction_name' => 'فراکسیون فرهنگیان'),
            array('fraction_name' => 'فراکسیون دانشگاهیان'),
            array('fraction_name' => 'فراکسیون اهل سنت'),
            array('fraction_name' => 'فراکسیسون امور عشایری'),
            array('fraction_name' => 'فراکسیون ایثارگران'),
            array('fraction_name' => 'فراکسیون مرزنشینان'),
            array('fraction_name' => 'فراکسیون قرآن و عترت و نماز'),
            array('fraction_name' => 'فراکسیون ورزش'),
            array('fraction_name' => 'فراکسیون امر به معروف و نهی از منکر'),
            array('fraction_name' => 'فراکسیون حج و زیارت'),
            array('fraction_name' => 'فراکسیون مهدویت و تمدن سازی'),
            array('fraction_name' => 'فراکسیون دیپلماسی فرهنگی'),
            array('fraction_name' => 'فراکسیون توسعه زیرساختهای فرهنگی، سیاحتی و نمایشگاه‌ها'),
            array('fraction_name' => 'فراکسیون فرهنگ ایثار و شهادت'),
            array('fraction_name' => 'فراکسیون گردشگری، زیارت و میراث فرهنگی'),
            array('fraction_name' => 'فراکسیون دانشگاه آزاد اسلامی')
        );
        foreach($data as $value){
            DB::table('fraction')->insert([
                'fraction_name' => $value['fraction_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
