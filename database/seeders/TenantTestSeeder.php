<?php

namespace Database\Seeders;
use App\Models\Books;
use Illuminate\Database\Seeder;


class TenantTestSeeder extends Seeder
{
    public function run(): void
    {
        Books::factory(50)->create();
    }
}
