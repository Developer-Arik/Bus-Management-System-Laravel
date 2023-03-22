<?php

namespace App\Http\Controllers;

use App\Models\BookedSeat;
use App\Models\Bus;
use App\Models\Point;
use App\Models\Scedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SceduleController extends Controller
{
    function index(){
        $bus = Scedule::all();

        return view('admin.pages.scedule',[
            "bus" => $bus,
            "length" => sizeof($bus)
        ]);
    }

    function addIndex(){
        $points = Point::all();

        $bus = Bus::all();

        return view('admin.pages.add-scedule',[
            "points" => $points,
            "bus" => $bus
        ]);
    }

    function add(Request $request){
        $request->validate([
            "departure" => "required",
            "destination" => "required",
            "time" => "required",
            "bus" => "required",
            "fare" => "required"
        ]);

        Scedule::create([
            "departure_id" => $request->departure,
            "destination_id" => $request->destination,
            "departure_time" => Carbon::parse($request->time),
            "bus_id" => $request->bus,
            "seat_fare" => $request->fare
        ]);

        return redirect()->route('admin.scedule');
    }

    function delete($id){
        Scedule::where('id',$id)->first()->delete();

        return redirect()->back();
    }
    function load(Request $request){
        $request->validate([
            "from" => "required",
            "to" => "required",
            "doj" => "required|date"
        ]);

        if(Carbon::parse($request->doj)->isBefore(Carbon::now()->format('d-m-Y'))){
            return response([
                "message" => "Past scedule can't be book"
            ],422);
        }elseif(Carbon::parse($request->doj)->isAfter(Carbon::now()->addDays(30))){
            return response([
                "message" => "Trip can't be book before 30 Days"
            ],422);
        }

        $trips = [];
        $trip_details = Scedule::where('departure_id',$request->from)->where('destination_id',$request->to)->get();

        for ($i=0; $i < sizeof($trip_details); $i++) {
            $trip = $trip_details[$i];
            $booked_seats = 0;

            if(Carbon::parse(Carbon::parse($request->doj.$trip['departure_time']))->isAfter(Carbon::now())){
                for ($j=0; $j < sizeof(BookedSeat::all()); $j++){
                    $seat = BookedSeat::all()[$j];
                    if($seat->booking->scedule_id==$trip['id'] && Carbon::parse($seat->booking->date)==Carbon::parse($request->doj)){
                        if($seat->booking->payment->status==false && Carbon::now()->isBefore(Carbon::parse($seat->booking->expires_at))){
                            $booked_seats++;
                        }
                        if($seat->booking->payment->status==true){
                            $booked_seats++;
                        }
                    }
                }

                array_push($trips,[
                    "id" => $trip['id'],
                    "departure" => $trip->departure->name,
                    "destination" => $trip->destination->name,
                    "fare" => $trip->seat_fare,
                    "departure_time" => Carbon::parse($trip['departure_time'])->format('g:i A'),
                    "bus" => [
                        "name" => $trip->bus->name,
                        "seats" => [
                            "seat_list" => $trip->bus->seats,
                            "seat_count" => sizeof($trip->bus->seats)-$booked_seats
                        ]
                    ]
                ]);
            }
        }

        if(sizeof($trips)>0){
            return $trips;
        }else{
            return response([
                "message" => "No Trips Found"
            ],404);
        }
    }
    function loadSingleScedule(Request $request){
        $scedule = Scedule::where('id',$request->id)->first();
        $doj = $request->doj;
        $seats = [];
        $booked_seats = [];

        for ($i=0; $i < sizeof(BookedSeat::all()); $i++) {
            $seat = BookedSeat::all()[$i];
            if($seat->booking->scedule_id==$request->id && Carbon::parse($seat->booking->date)==Carbon::parse($doj)){
                if($seat->booking->payment->status==false && Carbon::now()->isBefore(Carbon::parse($seat->booking->expires_at))){
                    array_push($booked_seats,$seat->seat_id);
                }
                if($seat->booking->payment->status==true){
                    array_push($booked_seats,$seat->seat_id);
                }
            }
        }

        for ($i=0; $i < sizeOf($scedule->bus->seats); $i++) {
            $seat = $scedule->bus->seats[$i];
            array_push($seats,[
                "id" => $scedule->bus->seats[$i]->id,
                "seat_no" => $scedule->bus->seats[$i]->seat_no,
                "xaxis" => $scedule->bus->seats[$i]->xaxis,
                "yaxis" => $scedule->bus->seats[$i]->yaxis,
                "scedule_id" => $scedule->id,
                "status" => array_search($seat->id,$booked_seats)!==false ? 1 : 0
            ]);
        }

        $scedule = [
            "id" => $scedule->id,
            "departure" => $scedule->departure->name,
            "destination" => $scedule->destination->name,
            "departure_time" => Carbon::parse($scedule->departure_time)->format('g:i A'),
            "fare" => $scedule->seat_fare,
            "bus" => [
                "seats" => $seats,
                "seat_count" => sizeof($scedule->bus->seats)
            ]
        ];

        return $scedule;
    }
}
