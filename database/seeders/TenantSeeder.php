<?php

namespace Database\Seeders;

use App\Mail\SendTenantCreatedMail;
use App\Models\Tenant;
use App\Models\User;
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
        dd($tenant);
        $randomPassword = Str::random(8);
        User::create([
           'name' => $tenant->name." Admin",
            'email' => $tenant->email,
            'password' => $randomPassword,
        ]);
        Mail::to($tenant->email)->queue(new SendTenantCreatedMail($tenant,$randomPassword));
    }
}
