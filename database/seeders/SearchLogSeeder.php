<?php

namespace Database\Seeders;

use App\Enum\UserType;
use App\Models\SearchLog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SearchLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SearchLog::factory(10)->create();
    }
}
