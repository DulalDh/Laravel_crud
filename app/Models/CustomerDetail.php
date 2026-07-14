<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerDetail extends Model
{
    public function customer(): BelongsTo
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
}
