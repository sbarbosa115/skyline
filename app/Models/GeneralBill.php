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
        'image_path',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }


    #region functions
    public function calculateUnitPrice(): float
    {
        return round($this->price / $this->amount, 2);
    }
    #endregion
}
