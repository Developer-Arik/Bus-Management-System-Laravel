<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seat;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    function seats(){
        return $this->hasMany(Seat::class,'bus_id');
    }
}
