<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
        public function run()
        {
            User::updateOrCreate(
                ['email' => 'ahmad@gmail.com'], // check this email
                [
                    'full_name' => 'ahmad nuhu',
                    'phone_number' => '08012345679',
                    'password' => Hash::make('password123'),
                ]
            );
        }

}
