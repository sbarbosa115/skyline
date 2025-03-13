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
        "tenant_id",
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
