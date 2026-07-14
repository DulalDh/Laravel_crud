<?php

namespace App\Models;

use App\Models\Scopes\ShowOnlyActive;
use App\Observers\CustomerObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([CustomerObserver::class])]

class customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone'];

    public function scopeActive($query)
    {
        $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        $query->where('status', 'inactive');
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new ShowOnlyActive());
    // }

    public function customer_detail(): HasOne
    {
        return $this->hasOne(CustomerDetail::class);

    }
}
