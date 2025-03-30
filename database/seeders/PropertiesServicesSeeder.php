<?php

namespace Database\Seeders;

use App\Models\PropertiesService;
use App\Models\Property;
use App\Models\ServiceType;
use App\Models\SubProperty;
use App\Models\User;
use Illuminate\Database\Seeder;


class PropertiesServicesSeeder extends Seeder
{
    public function run(): void
    {
        $property1 = Property::where('name', 'Property 1')->first();
        $property2 = Property::where('name', 'Property 2')->first();
        $property3 = Property::where('name', 'Property 3')->first();

        $subProperty1 = SubProperty::where('property_id', $property2->id)->where('unit_number', '101')->first();
        $subProperty2 = SubProperty::where('property_id', $property2->id)->where('unit_number', '102')->first();
        $subProperty3 = SubProperty::where('property_id', $property2->id)->where('unit_number', '103')->first();

        $subProperty4 = SubProperty::where('property_id', $property3->id)->where('unit_number', '101')->first();
        $subProperty5 = SubProperty::where('property_id', $property3->id)->where('unit_number', '102')->first();

        $electricity = ServiceType::where('name', 'Luz')->first();
        $water = ServiceType::where('name', 'Agua')->first();
        $gas = ServiceType::where('name', 'Gas')->first();
        $internet = ServiceType::where('name', 'Internet')->first();

        $propertiesServices = [
            ['property_id' => $property1->id, 'service_type_id' => $electricity->id, 'is_shared' => false],
            ['property_id' => $property1->id, 'service_type_id' => $water->id, 'is_shared' => false],
            ['property_id' => $property1->id, 'service_type_id' => $gas->id, 'is_shared' => false],

            ['property_id' => $property2->id, 'service_type_id' => $electricity->id, 'is_shared' => false],
            ['property_id' => $property2->id, 'service_type_id' => $water->id, 'is_shared' => true],
            ['property_id' => $property2->id, 'service_type_id' => $gas->id, 'is_shared' => true],
            ['property_id' => $property2->id, 'service_type_id' => $internet->id, 'is_shared' => true],

            ['property_id' => $property3->id, 'service_type_id' => $electricity->id, 'is_shared' => true],
            ['property_id' => $property3->id, 'service_type_id' => $water->id, 'is_shared' => true],
            ['property_id' => $property3->id, 'service_type_id' => $gas->id, 'is_shared' => false],
        ];

        foreach ($propertiesServices as $propertiesService) {
          PropertiesService::create($propertiesService);
        }
    }
}
