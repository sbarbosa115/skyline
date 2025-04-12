<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_property_id',
        'amount',
        'price',
        'payment_status',
        'image_payment_path',
    ];

    public function subProperty()
    {
        return $this->belongsTo(SubProperty::class);
    }
}
