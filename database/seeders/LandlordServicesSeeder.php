<?php

namespace Database\Seeders;

use App\Models\LandlordServices;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\LandlordServicesFactory;
use Illuminate\Database\Seeder;

class LandlordServicesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LandlordServices::factory(5)->create();
    }
}
