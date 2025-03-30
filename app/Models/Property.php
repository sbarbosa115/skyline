<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'landlord_id',
        'has_sub_properties',
    ];

    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    public function subProperties()
    {
        return $this->hasMany(SubProperty::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
