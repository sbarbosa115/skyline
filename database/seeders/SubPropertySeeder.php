<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\SubProperty;
use App\Models\User;
use Illuminate\Database\Seeder;


class SubPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property1 = Property::where('name', 'Property 1')->first();

        SubProperty::create([
            "unit_number" => "101",
            "property_id" => $property1->id,
        ]);

        SubProperty::create([
            "unit_number" => "102",
            "property_id" => $property1->id,
        ]);

        SubProperty::create([
            "unit_number" => "103",
            "property_id" => $property1->id,
        ]);

        $property2 = Property::where('name', 'Property 1')->first();

        SubProperty::create([
            "unit_number" => "101",
            "property_id" => $property2->id,
        ]);

        SubProperty::create([
            "unit_number" => "102",
            "property_id" => $property2->id,
        ]);
    }
}
