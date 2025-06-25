<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run(): void{
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CommissionSeeder::class);
        $this->call(FractionSeeder::class);
        $this->call(MinistrySeeder::class);
        $this->call(ParlemanPeriodSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(PresidentSeeder::class);
        $this->call(OtherPersonSeeder::class);
        $this->call(GovPeriodSeeder::class);
    }
}
