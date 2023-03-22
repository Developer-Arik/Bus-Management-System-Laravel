<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Point;
use App\Models\Bus;

class Scedule extends Model
{
    use HasFactory;

    protected $table = "scedule";

    protected $fillable = ['departure_id','destination_id','departure_time','bus_id','seat_fare'];

    public function departure(){
        return $this->hasOne(Point::class,'id','departure_id');
    }

    public function destination(){
        return $this->hasOne(Point::class,'id','destination_id');
    }
    public function bus(){
        return $this->hasOne(Bus::class,'id','bus_id');
    }
}
