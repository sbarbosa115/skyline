<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_property_id',
        'description',
        'status',
    ];

    public function subProperty()
    {
        return $this->belongsTo(SubProperty::class);
    }
}
