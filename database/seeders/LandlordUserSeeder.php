<?php

namespace Database\Seeders;

use App\Enum\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandlordUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5);
        User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>'password',
            'type'=>UserType::LANDLORD
        ]);
    }
}
