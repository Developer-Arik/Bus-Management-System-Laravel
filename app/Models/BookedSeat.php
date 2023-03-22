<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        "booking_id","seat_id"
    ];

    protected $table = "booked_seats";

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id');
    }

    public function seat(){
        return $this->belongsTo(Seat::class,'seat_id');
    }

}
