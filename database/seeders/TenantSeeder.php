<?php

namespace Database\Seeders;

use App\Enum\UserType;
use App\Mail\SendTenantCreatedMail;
use App\Models\Books;
use App\Models\Tenant;
use App\Models\User;
use App\Tasks\SwitchTenantDatabaseCustomTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::current();
        $randomPassword = Str::random(8);

        User::create([
           'name' => $tenant->name." Admin",
            'email' => $tenant->email,
            'password' => $randomPassword,
            'type'=>UserType::ADMIN
        ]);
        Books::factory(50)->create();
        Mail::to($tenant->email)->queue(new SendTenantCreatedMail($tenant,$randomPassword));
    }
}
