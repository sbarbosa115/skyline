<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_property_id',
        'service_type_id',
        'period_from',
        'period_to',
        'amount',
        'price',
        'payment_status',
        'image_payment_path',
    ];

    public function subProperty()
    {
        return $this->belongsTo(SubProperty::class);
    }

    public function ServiceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
