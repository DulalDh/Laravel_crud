<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    public function owner()
    {
        return $this->hasOneThrough(Owner::class, Car::class, 'mechanic_id', 'car_id', 'id', 'id');
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
