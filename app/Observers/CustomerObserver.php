<?php

namespace App\Observers;

use App\Models\customer;

class CustomerObserver
{
    public function creating(customer $customer): void
    {
        $customer->created_by = 'Dulal DH';
    }

    /**
     * Handle the customer "created" event.
     */
    public function created(customer $customer): void
    {
        //
    }

    /**
     * Handle the customer "updated" event.
     */
    public function updated(customer $customer): void
    {
        //
    }

    /**
     * Handle the customer "deleted" event.
     */
    public function deleted(customer $customer): void
    {
        //
    }

    /**
     * Handle the customer "restored" event.
     */
    public function restored(customer $customer): void
    {
        //
    }

    /**
     * Handle the customer "force deleted" event.
     */
    public function forceDeleted(customer $customer): void
    {
        //
    }
}
