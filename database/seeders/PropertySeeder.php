<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;


class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessor = User::where('email', 'lessor@example.com')->first();
        $property1 = Property::create(['name' => 'Property 1', 'description' => 'Description 1', 'landlord_id' => $lessor->id]);
        $property2 = Property::create(['name' => 'Property 2', 'description' => 'Description 2', 'landlord_id' => $lessor->id]);
    }
}
