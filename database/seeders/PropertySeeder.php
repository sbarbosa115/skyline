<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;


class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $lessor1 = User::where('email', 'lessor1@example.com')->first();
        $lessor2 = User::where('email', 'lessor2@example.com')->first();
        $lessor3 = User::where('email', 'lessor3@example.com')->first();

        $properties = [
            ['name' => 'Property 1', 'description' => 'Description 1', 'landlord_id' => $lessor1->id, 'has_sub_properties' => false],
            ['name' => 'Property 2', 'description' => 'Description 2', 'landlord_id' => $lessor2->id, 'has_sub_properties' => true],
            ['name' => 'Property 3', 'description' => 'Description 3', 'landlord_id' => $lessor3->id, 'has_sub_properties' => true],
        ];

        foreach ($properties as $propertyData) {
            Property::create($propertyData);
        }
    }
}
