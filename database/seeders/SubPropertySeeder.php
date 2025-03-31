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
        $landlord1 = User::where('email', 'lessor1@example.com')->first();
        $landlord2 = User::where('email', 'lessor2@example.com')->first();
        $landlord3 = User::where('email', 'lessor3@example.com')->first();

        $property2 = Property::where('name', 'Property 2')->first();

        SubProperty::create([
            "unit_number" => "101",
            "property_id" => $property2->id,
            "landlord_id" => $landlord1->id,
        ]);

        SubProperty::create([
            "unit_number" => "102",
            "property_id" => $property2->id,
            "landlord_id" => $landlord2->id,
        ]);

        SubProperty::create([
            "unit_number" => "103",
            "property_id" => $property2->id,
            "landlord_id" => $landlord3->id,
        ]);

        SubProperty::create([
            "unit_number" => "104",
            "property_id" => $property2->id,
            "landlord_id" => $landlord3->id,
        ]);

        $property3 = Property::where('name', 'Property 3')->first();

        SubProperty::create([
            "unit_number" => "101",
            "property_id" => $property3->id,
            "landlord_id" => $property3->landlord->id,
        ]);

        SubProperty::create([
            "unit_number" => "102",
            "property_id" => $property3->id,
            "landlord_id" => $property3->landlord->id,
        ]);
    }
}
