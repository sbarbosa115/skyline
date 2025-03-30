<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesService extends Model
{
    use HasFactory;

    protected $table = 'properties_services';

    protected $fillable = [
        'property_id',
        'service_type_id',
        'name',
        'is_shared',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function sharedServices()
    {
        return $this->hasMany(SharedService::class);
    }
}
