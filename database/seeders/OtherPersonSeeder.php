<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class OtherPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $variables = [
            'names' => [
                "امیر", "مهدی", "رضا", "حسین", "علی", "محمد", "علی‌رضا", "سجاد", "فرزاد", "محسن",
                "سینا", "یوسف", "ایمان", "حامد", "شهرام", "پویا", "مسعود", "مهرداد", "نادر", "کیوان",
                "کامران", "سپهر", "یاسر", "رامین", "مجتبی", "احسان", "آرش", "میلاد", "پژمان", "شایان",
                "حمید", "کاوه", "بهنام", "امید", "صادق", "بهزاد", "سیامک", "راغب", "کیان", "دانیال",
                "مرتضی", "فرشید", "آبتین", "فرهاد", "شاهین", "نیما", "سمیرا", "زهرا", "فاطمه", "نسرین"
            ],
            'words' => ["خط", "شب", "صف", "آب", "آخر", "نان", "آتش", "نمک", "باغ", "میز", "مهد", "بدل", "برق", "ملت", "ملک", "ملل", "مشک", "صندلی", "ابزار", "پل", "پیچ", "محل", "گوشی", "کلمه", "تیم", "هتل", "کامپیوتر", "دایره", "صوت", "سایت", "پایه", "هنر", "موسیقی", "نوازش", "ساختار", "علم", "مربع", "غذا", "قضا", "پرنده", "مدرسه", "نور", "پول", "برنامه", "لباس", "عطر", "طبیعت", "آسمان", "عدد", "دانه", "کمک", "آشیانه", "عدالت", "دریا", "موج", "ساحل", "درخت", "لیوان", "کاغذ", "پارو", "برف", "الماس", "خودرو", "ساز", "دیجیتال", "میوه", "مدار", "الکتریک", "قفل", "تصویر", "دوربین", "پوشاک", "رنگ", "صندوق", "کلید", "خیابان", "چای", "محفل", "ثروت", "فیلم", "سریال", "ماکت", "ژاکت", "اتوبوس", "بلیط", "دامنه", "شیر", "جنگل", "بانک", "جام", "جایزه", "کشاورز", "کنترل", "دکان", "اسکله", "لوازم", "آرایش", "پوستر", "نقاشی", "قلم", "گردو", "ساعت", "چرخ", "گلیم", "فرش", "مجله", "روزنامه", "تاکسی", "اپلیکیشن", "دفتر", "دفترچه", "سلول", "شن", "دارو", "قرص", "شهر", "دریاچه", "بالین", "بالش", "قهوه", "آلاچیق"],
            'lorem' => "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد."
        ];

        foreach (range(1, 2000) as $index) {
            $username = "091" . $faker->numberBetween(10000000, 90000000);
            DB::table('person')->insert([
                'person_name' => $variables['names'][rand(0, sizeof($variables['names']) - 1)],
                'person_last_name' => $variables['names'][rand(0, sizeof($variables['names']) - 1)]."ی",
                'person_national_code' => $faker->numberBetween(1000000000, 9000000000),
                'person_phone' => $username,
                'person_province_id' => $faker->numberBetween(1, 31),
                'person_role' => 'user',
                'person_image' => '/9j/4AAQSkZJRgABAQAAAQABAAD/4QAqRXhpZgAASUkqAAgAAAABADEBAgAHAAAAGgAAAAAAAABQaWNhc2EAAP/bAIQAAwICAwICAwMDAwQDAwQFCAUFBAQFCgcHBggMCgwMCwoLCw0OEhANDhEOCwsQFhARExQVFRUMDxcYFhQYEhQVFAEDBAQFBAUJBQUJFA0LDRQUFBQUFBQUFBQUFBQUEhMUFRUVEhEUFRQUFBMVEBMUFBUUFBQSExUQFBAPFBUQExUV/8AAEQgAIAAgAwERAAIRAQMRAf/EABkAAAIDAQAAAAAAAAAAAAAAAAQGBQcIAv/EACoQAAIBAwIEBgIDAAAAAAAAAAECAwQFERIhAAYTMQciI0FRcRRhFaHx/8QAGAEBAQEBAQAAAAAAAAAAAAAABAMCAQD/xAAuEQABAwMCBAQFBQAAAAAAAAABAgMRAAQhMUEFUWGhEiKRsRNxgdHwBhQVMvH/2gAMAwEAAhEDEQA/AMD1lHUVEC1bgxiKONQB6YYBdtBwBk7MSO5JO+eGrcUTBqzbI8JUPr8/zeoyOjq6oFY4Wj1bRhff53+sjiCnG0ZKqu2w+6YQiJqQk5XuNISRDJ5UGSyk5J/eAe4/vv78SReMyADV3OE3YQVKTEUQ1Oi2yOMwFKrqEtM82CV0gBQuwG4YknJ3A2wS3XnUKwBnnXrW2cA8SjGNI7028mcp1fN3M1JytQRR9WaoERqW3VQCVL5GQRk51DJ7Y78SuibRsuLGfvTLZbd0sNoPlE9u/P61ey3zw48IaPEdmNdMYemle6rOXOcdRY3byA4JAyWw2cjjVvwFd4jx3a8xPhEgeu/tyod1+ojbKCLVGJicT7jHfnSzBeKbnm7UD2yzda01FwWCaiaTpySDWoCCQYIMgbGcbbjfGCf+JRbOKWf6pEx039I19qcnjyn2AiYWrAPInAnbMjG/Wq48ZbZDa+bKyjtsAjt8NTNT04inEugJIdcWAdQCs5GWVdeksMgkmyWlONC4AhK5KRuBt96gq6QHBak+dAHiMAAmMmpXw152n5bljuMk73C4MiUqtO2vRTKR6YfGpVOFAAIC4GAMDjN8v9yUocMhPvoPTNb4cx8BC3ECCrbpuT1OM9NaeedPDpeeqOiqYqmpo5qWMxENGpRo03AfdTrRWIycfYJPCbTiigopdUPlkZ6a46bUC84SClPwknoRBkds9aOWG2eBvIFH+RW0f85NMKyKlpXMsrMofpySMD6YUOuEG7bEjuSC64mq/UWLfSIJ2666k9hT7PhCbNPx7gaGYPbTl7zWZOYLrLcrrV3KRy1VVzPO7Rk5JcknPvn7+f3whKg2gNp0GKOtsuOF1Yyc/wCUdPXyUJWSPTEceU6fLnb4xj34ohpK8LrbtwprLRxRtP4n362UjRUlVJDBIoMyochzqwGOe24+fcdu3BnuGMu+aJqzPHLhrymPSuq3xCul1ktiVYp7vS2lJxBRXGESQjrH1DhAhOXIcaiSpRcEjY3ZQi3QlIEhOxyM6/m1HfdcvHHFZSVxkGDA05jAxgZkyKVY3/HhASMMqY8zpqI/39/H3xI1dJAEiv/Z',
                'username' => $username,
                'password' => md5($username),
                'otp' => '12345',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
