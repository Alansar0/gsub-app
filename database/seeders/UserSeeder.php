<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
        public function run()
        {
            User::updateOrCreate(
                ['phone_number' => '08012345679'], // check this email
                [
                    'full_name' => 'ahmad nuhu',
                    'email' => 'ahmad@gmail.com',
                    'password' => Hash::make('password123'),
                ]
            );
        }

}
