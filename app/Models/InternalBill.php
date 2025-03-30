<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'general_bill_id',
        'sub_property_id',
        'amount',
        'price',
        'payment_status',
        'proof_of_payment',
    ];

    public function generalBill()
    {
        return $this->belongsTo(GeneralBill::class);
    }

    public function subProperty()
    {
        return $this->belongsTo(SubProperty::class);
    }
}
