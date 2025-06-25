<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\LaravelPackageTools\Commands\Concerns\AskToStarRepoOnGitHub;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::table('person')->insert([
            'person_name' => 'محمدرضا',
            'person_last_name' => 'اسماعیلی',
            'person_national_code' => '4900354376',
            'person_phone' => '09120572107',
            'person_province_id' => '8',
            'person_role' => 'admin',
            'person_image' => '/9j/4AAQSkZJRgABAQAAAQABAAD/4QAqRXhpZgAASUkqAAgAAAABADEBAgAHAAAAGgAAAAAAAABQaWNhc2EAAP/bAIQAAwICAwICAwMDAwQDAwQFCAUFBAQFCgcHBggMCgwMCwoLCw0OEhANDhEOCwsQFhARExQVFRUMDxcYFhQYEhQVFAEDBAQFBAUJBQUJFA0LDRQUFBQUFBQUFBQUFBQUEhMUFRUVEhEUFRQUFBMVEBMUFBUUFBQSExUQFBAPFBUQExUV/8AAEQgAIAAgAwERAAIRAQMRAf/EABkAAAIDAQAAAAAAAAAAAAAAAAQGBQcIAv/EACoQAAIBAwIEBgIDAAAAAAAAAAECAwQFERIhAAYTMQciI0FRcRRhFaHx/8QAGAEBAQEBAQAAAAAAAAAAAAAABAMCAQD/xAAuEQABAwMCBAQFBQAAAAAAAAABAgMRAAQhMUEFUWGhEiKRsRNxgdHwBhQVMvH/2gAMAwEAAhEDEQA/AMD1lHUVEC1bgxiKONQB6YYBdtBwBk7MSO5JO+eGrcUTBqzbI8JUPr8/zeoyOjq6oFY4Wj1bRhff53+sjiCnG0ZKqu2w+6YQiJqQk5XuNISRDJ5UGSyk5J/eAe4/vv78SReMyADV3OE3YQVKTEUQ1Oi2yOMwFKrqEtM82CV0gBQuwG4YknJ3A2wS3XnUKwBnnXrW2cA8SjGNI7028mcp1fN3M1JytQRR9WaoERqW3VQCVL5GQRk51DJ7Y78SuibRsuLGfvTLZbd0sNoPlE9u/P61ey3zw48IaPEdmNdMYemle6rOXOcdRY3byA4JAyWw2cjjVvwFd4jx3a8xPhEgeu/tyod1+ojbKCLVGJicT7jHfnSzBeKbnm7UD2yzda01FwWCaiaTpySDWoCCQYIMgbGcbbjfGCf+JRbOKWf6pEx039I19qcnjyn2AiYWrAPInAnbMjG/Wq48ZbZDa+bKyjtsAjt8NTNT04inEugJIdcWAdQCs5GWVdeksMgkmyWlONC4AhK5KRuBt96gq6QHBak+dAHiMAAmMmpXw152n5bljuMk73C4MiUqtO2vRTKR6YfGpVOFAAIC4GAMDjN8v9yUocMhPvoPTNb4cx8BC3ECCrbpuT1OM9NaeedPDpeeqOiqYqmpo5qWMxENGpRo03AfdTrRWIycfYJPCbTiigopdUPlkZ6a46bUC84SClPwknoRBkds9aOWG2eBvIFH+RW0f85NMKyKlpXMsrMofpySMD6YUOuEG7bEjuSC64mq/UWLfSIJ2666k9hT7PhCbNPx7gaGYPbTl7zWZOYLrLcrrV3KRy1VVzPO7Rk5JcknPvn7+f3whKg2gNp0GKOtsuOF1Yyc/wCUdPXyUJWSPTEceU6fLnb4xj34ohpK8LrbtwprLRxRtP4n362UjRUlVJDBIoMyochzqwGOe24+fcdu3BnuGMu+aJqzPHLhrymPSuq3xCul1ktiVYp7vS2lJxBRXGESQjrH1DhAhOXIcaiSpRcEjY3ZQi3QlIEhOxyM6/m1HfdcvHHFZSVxkGDA05jAxgZkyKVY3/HhASMMqY8zpqI/39/H3xI1dJAEiv/Z',
            'username' => '09120572107',
            'password' => md5('09120572107'),
            'otp' => '12345',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
