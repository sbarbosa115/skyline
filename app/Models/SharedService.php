<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedService extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_service_id',
        'sub_property_id',
    ];

    public function propertyService()
    {
        return $this->belongsTo(PropertiesService::class);
    }

    public function subProperty()
    {
        return $this->belongsTo(SubProperty::class);
    }
}
