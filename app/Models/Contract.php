<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'property_id',
        'sub_property_id',
        'lessor_id',
        'lessee_id',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function subProperty()
    {
        return $this->belongsTo(SubProperty::class);
    }

    public function lessor()
    {
        return $this->belongsTo(User::class, 'lessor_id');
    }

    public function lessee()
    {
        return $this->belongsTo(User::class, 'lessee_id');
    }
}
