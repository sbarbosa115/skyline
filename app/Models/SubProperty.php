<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        "unit_number",
        "property_id",
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
