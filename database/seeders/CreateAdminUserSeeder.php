<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $phone = env('ADMIN_PHONE', '08012345678');
        $password = env('ADMIN_PASSWORD', 'StrongPassword123!');
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $name = env('ADMIN_NAME', 'Super Admin');

        if (empty($phone) || empty($password)) {
            // Do nothing if not set (safe for production)
            return;
        }

        User::updateOrCreate(
            ['phone_number' => $phone],
            [
                'full_name' => $name,
                'email' => $email,
                'phone_number' => $phone,
                'password' => Hash::make($password),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ]
        );
    }
}
