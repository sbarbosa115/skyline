<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrderNote extends Model
{
    protected $fillable = [
        'work_order_id',
        'description'
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
