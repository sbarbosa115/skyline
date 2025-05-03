<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    public function run(): void
    {
        $property1 = Property::where('name', 'Property 1')->first();
        $lessor1 = User::where('email', 'lessor1@example.com')->first();
        $lessee1 = User::where('email', 'lessee1@example.com')->first();

        $property1->subProperties->each(function ($subProperty) use ($property1, $lessor1, $lessee1) {
            Contract::create([
                "property_id" => $property1->id,
                "sub_property_id" => $subProperty->id,
                "lessor_id" => $lessor1->id,
                "lessee_id" => $lessee1->id,
                "start_date" => now(),
                "end_date" => now()->addYear(),
                "status" => Contract::STATUS_ACTIVE,
            ]);
        });

        $property2 = Property::where('name', 'Property 2')->first();
        $lessor2 = User::where('email', 'lessor2@example.com')->first();
        $lessee2 = User::where('email', 'lessee2@example.com')->first();

        $property2->subProperties->each(function ($subProperty) use ($property2, $lessor2, $lessee2) {
            Contract::create([
                "property_id" => $property2->id,
                "sub_property_id" => $subProperty->id,
                "lessor_id" => $lessor2->id,
                "lessee_id" => $lessee2->id,
                "start_date" => now(),
                "end_date" => now()->addYear(),
                "status" => Contract::STATUS_ACTIVE,
            ]);
        });

        $property3 = Property::where('name', 'Property 3')->first();
        $lessor3 = User::where('email', 'lessor3@example.com')->first();
        $lessee3 = User::where('email', 'lessee3@example.com')->first();

        $property3->subProperties->each(function ($subProperty) use ($property3, $lessor3, $lessee3) {
            Contract::create([
                "property_id" => $property3->id,
                "sub_property_id" => $subProperty->id,
                "lessor_id" => $lessor3->id,
                "lessee_id" => $lessee3->id,
                "start_date" => now(),
                "end_date" => now()->addYear(),
                "status" => Contract::STATUS_ACTIVE,
            ]);
        });
    }
}
