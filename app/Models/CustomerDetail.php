<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'address',
        'dob',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
}
