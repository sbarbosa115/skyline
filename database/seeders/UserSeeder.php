<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Administrator', 'email' => 'administrator@example.com', 'role' => 'Administrator'],
            ['name' => 'Lessor1', 'email' => 'lessor1@example.com', 'role' => 'Lessor'],
            ['name' => 'Lessee1', 'email' => 'lessee1@example.com', 'role' => 'Lessee'],
            ['name' => 'Reader1', 'email' => 'reader1@example.com', 'role' => 'Reader'],

            ['name' => 'Lessor2', 'email' => 'lessor2@example.com', 'role' => 'Lessor'],
            ['name' => 'Lessee2', 'email' => 'lessee2@example.com', 'role' => 'Lessee'],
            ['name' => 'Reader2', 'email' => 'reader2@example.com', 'role' => 'Reader'],
            
            ['name' => 'Lessor3', 'email' => 'lessor3@example.com', 'role' => 'Lessor'],
            ['name' => 'Lessee3', 'email' => 'lessee3@example.com', 'role' => 'Lessee'],
            ['name' => 'Reader3', 'email' => 'reader3@example.com', 'role' => 'Reader'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt('12345678'),
            ]);
            $user->assignRole($userData['role']);
        }
    }
}
