<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;


class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceType::create(['name' => 'Agua']);
        ServiceType::create(['name' => 'Luz']);
        ServiceType::create(['name' => 'Gas']);
        ServiceType::create(['name' => 'Internet']);
        ServiceType::create(['name' => 'Televisión']);
    }
}
