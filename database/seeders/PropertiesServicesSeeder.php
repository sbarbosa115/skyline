<?php

namespace Database\Seeders;

use App\Models\PropertiesService;
use App\Models\Property;
use App\Models\ServiceType;
use App\Models\SharedService;
use App\Models\SubProperty;
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
    $subProperty4 = SubProperty::where('property_id', $property2->id)->where('unit_number', '104')->first();

    $electricity = ServiceType::where('name', 'Luz')->first();
    $water = ServiceType::where('name', 'Agua')->first();
    $gas = ServiceType::where('name', 'Gas')->first();
    $internet = ServiceType::where('name', 'Internet')->first();

    $propertiesServices = [
      // Property 1
      [
        "propertyService" => [
          'property_id' => $property1->id,
          'service_type_id' => $electricity->id,
          'name' => 'Luz',
          'is_shared' => false,
        ],
        "sub_properties" => [],
      ],
      [
        "propertyService" => [
          'property_id' => $property1->id,
          'service_type_id' => $water->id,
          'name' => 'Agua',
          'is_shared' => false,
        ],
        "sub_properties" => [],
      ],
      [
        "propertyService" => [
          'property_id' => $property1->id,
          'service_type_id' => $gas->id,
          'name' => 'Gas',
          'is_shared' => false,
        ],
        "sub_properties" => [],
      ],

      // Property 2
      [
        "propertyService" => [
          'property_id' => $property2->id,
          'service_type_id' => $electricity->id,
          'name' => 'Luz',
          'is_shared' => false,
        ],
        "sub_properties" => [],
      ],
      [
        "propertyService" => [
          'property_id' => $property2->id,
          'service_type_id' => $water->id,
          'name' => 'Agua 1',
          'is_shared' => true,
        ],
        "sub_properties" => [$subProperty1->id, $subProperty2->id],
      ],
      [
        "propertyService" => [
          'property_id' => $property2->id,
          'service_type_id' => $water->id,
          'name' => 'Agua 2',
          'is_shared' => true,
        ],
        "sub_properties" => [$subProperty3->id, $subProperty4->id],
      ],
      [
        "propertyService" => [
          'property_id' => $property2->id,
          'service_type_id' => $gas->id,
          'name' => 'Gas',
          'is_shared' => true,
        ],
        "sub_properties" => [],
      ],
      [
        "propertyService" => [
          'property_id' => $property2->id,
          'service_type_id' => $internet->id,
          'name' => 'Internet',
          'is_shared' => true,
        ],
        "sub_properties" => [$subProperty2->id, $subProperty3->id, $subProperty4->id],
      ],

      // Property 3
      [
        "propertyService" => [
          'property_id' => $property3->id,
          'service_type_id' => $electricity->id,
          'name' => 'Luz',
          'is_shared' => true,
        ],
        "sub_properties" => [],
      ],
      [
        "propertyService" => [
          'property_id' => $property3->id,
          'service_type_id' => $water->id,
          'name' => 'Agua',
          'is_shared' => true,
        ],
        "sub_properties" => [],
      ],
      [
        "propertyService" => [
          'property_id' => $property3->id,
          'service_type_id' => $gas->id,
          'name' => 'Gas',
          'is_shared' => false,
        ],
        "sub_properties" => [],
      ],
    ];

    foreach ($propertiesServices as $data) {
      $newPropertiesService = PropertiesService::create($data['propertyService']);

      if (count($data['sub_properties']) > 0) {
        foreach ($data['sub_properties'] as $subPropertyId) {
          SharedService::create([
            'properties_service_id' => $newPropertiesService->id,
            'sub_property_id' => $subPropertyId,
          ]);
        }
      }
    }
  }
}
