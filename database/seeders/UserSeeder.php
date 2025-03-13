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
        $administrator = User::create(['name' => 'Administrator', 'email' => 'administrator@example.com', 'password' => bcrypt('12345678')]);
        $administrator->assignRole('Administrator');

        $lessor = User::create(['name' => 'Lessor', 'email' => 'lessor@example.com', 'password' => bcrypt('12345678')]);
        $lessor->assignRole('Lessor');
        
        $lessee = User::create(['name' => 'Lessee', 'email' => 'lessee@example.com', 'password' => bcrypt('12345678')]);
        $lessee->assignRole('Lessee');

        $reader = User::create(['name' => 'Reader', 'email' => 'reader@example.com', 'password' => bcrypt('12345678')]);
        $reader->assignRole('Reader');
    }
}
