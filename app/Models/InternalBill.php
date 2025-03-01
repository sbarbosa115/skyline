<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalBill extends Model
{
    use HasFactory;

    public function subProperty()
    {
        return $this->belongsTo(SubProperty::class);
    }
}
