<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Read admin credentials from .env (with safe defaults)
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
        $adminName = env('ADMIN_NAME', 'Local Admin');
        $adminPhone = env('ADMIN_PHONE', '08000000000');
        $adminPassword = env('ADMIN_PASSWORD', '@security');

        // Check if admin already exists
        $existingAdmin = User::where('email', $adminEmail)
            ->orWhere('phone_number', $adminPhone)
            ->first();

        if (!$existingAdmin) {
            User::create([
                'full_name'    => $adminName,
                'email'        => $adminEmail,
                'phone_number' => $adminPhone,
                'password'     => Hash::make($adminPassword),
                'role'         => 'admin',
            ]);

            $this->command->info("✅ Admin user created successfully!");
        } else {
            $this->command->warn("⚠️ Admin user already exists, skipping seeding.");
        }
    }
}
