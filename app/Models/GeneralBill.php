<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'sub_property_id',
        'service_type_id',
        'period_from',
        'period_to',
        'amount',
        'price',
        'payment_status',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
