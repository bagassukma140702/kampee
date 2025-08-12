<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Asrori',
                'password' => Hash::make('password'), // Ganti ke password aman di production
                'role' => 'admin',
            ]
        );

        // Dummy users
        $users = [
            ['name' => 'Nanami', 'email' => 'user@gmail.com'],
            ['name' => 'Yuta', 'email' => 'yuta@gmail.com'],
            ['name' => 'Maki', 'email' => 'maki@gmail.com'],
            ['name' => 'Inumaki', 'email' => 'inumaki@gmail.com'],
            ['name' => 'Panda', 'email' => 'panda@gmail.com'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password'), // sama semua password-nya
                    'role' => 'user',
                ]
            );
        }
    }
}
