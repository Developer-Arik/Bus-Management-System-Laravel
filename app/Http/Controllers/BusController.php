<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Http\Request;

class BusController extends Controller
{
    function index(){
        $bus = Bus::all();

        return view('admin.pages.bus',["length" => sizeof($bus),"bus" => $bus]);
    }

    function add(Request $request){
        $request->validate([
            "name" => "required|unique:buses,name",
            "seats" => 'required|json'
        ]);

        $data = [
            "name" => $request->name,
            "seat_plan" => (array) json_decode($request->seats,true)
        ];

        if(!sizeof($data['seat_plan'])){
            return redirect()->back()->withErrors([
                "seats" => "Seat is required to create a bus"
            ])->withInput();
        }

        $bus = Bus::create([
            "name" => $data['name']
        ]);

        // dd((array) $data['seat_plan']);

        for ($i=0; $i < sizeof($data['seat_plan']); $i++){
            $seat = (array) $data['seat_plan'][$i];

            Seat::create([
                "bus_id" => $bus->id,
                "seat_no" => $seat['seatNo'],
                "xaxis" => $seat['xaxis'],
                "yaxis" => $seat['yaxis']
            ]);
        }

        return redirect('admin/bus');
    }

    function view($id){
        $data = Bus::where('id',$id)->first();

        if($data){
            return view('admin.pages.view-bus',[
                "bus" => $data
            ]);
        }else{
            return abort(404);
        }
    }

    function seats(Request $request){
        $id = $request->route('id');
        $data = Bus::where('id',$id)->first();
        if(!$data){
            return abort(404);
        }
        $markedSeats = $request->marked;
        $seats = [];

        for ($i=0; $i < sizeof($data->seats); $i++) {
            $xaxis = $data->seats[$i]->xaxis;
            $yaxis = $data->seats[$i]->yaxis;
            array_push($seats,[
                "seatNo" => $data->seats[$i]->seat_no,
                "xaxis" => $xaxis,
                "yaxis" => $yaxis,
                "marked" => array_search($data->seats[$i]->seat_no,$markedSeats)!==false ? true : false
            ]);
        }

        return $seats;
    }

    function delete($id){
        Bus::where('id',$id)->delete();
        Seat::where('bus_id',$id)->delete();

        return redirect()->back();
    }
}
