<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'service_type_id',
        'period',
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
