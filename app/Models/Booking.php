<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table="bookings";

    protected $fillable = [
        "user_id","scedule_id","date","email","pnr","by_counter","expires_at"
    ];

    function seats(){
        return $this->hasMany(BookedSeat::class,'booking_id');
    }

    function scedule(){
        return $this->belongsTo(Scedule::class,'scedule_id');
    }

    function payment(){
        return $this->hasOne(Payment::class,'booking_id');
    }

}
