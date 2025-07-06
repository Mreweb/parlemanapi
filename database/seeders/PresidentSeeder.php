<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('president_name' => 'محمود احمدی ‌نژاد'),
            array('president_name' => 'حسن روحانی'),
            array('president_name' => 'شهید آیت الله رئیسی'),
            array('president_name' => 'مسعود پزشکیان')
        );
        foreach($data as $value){
            DB::table('president')->insert([
                'president_name' => $value['president_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
