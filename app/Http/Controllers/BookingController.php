<?php

namespace App\Http\Controllers;

use App\Mail\SendCounterEmail;
use App\Models\Booking;
use App\Models\Point;
use App\Models\Scedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BookedSeat;
use App\Models\Otp;
use App\Models\Payment;
use App\Models\Seat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    function all(){
        $data = [];
        $all = Booking::where('user_id',Auth::user()->id)->where('by_counter',false)->get();
        for ($i=0; $i < sizeof($all); $i++) {
            $dt = json_decode((string) $all[$i]);
            $dt = Booking::where('id',$dt->id)->first();
            $seats = [];

            for ($j=0; $j < sizeof($dt->seats); $j++){
                array_push($seats,$dt->seats[$j]->seat->seat_no);
            }
            if($dt->payment->status!=true && Carbon::now()->isBefore(Carbon::parse($dt->expires_at))){
                array_push($data,[
                    "id" => $dt->id,
                    "pnr" => $dt->pnr,
                    "seats" => join(',',$seats),
                    "bus" => $dt->scedule->bus->name,
                    "time" => Carbon::parse($dt->scedule->departure_time)->format('h:i A'),
                    "date" => Carbon::parse($dt->date)->format('d M,Y'),
                    "paid" => $dt->payment->status===1 ? true : false
                ]);
            }
            if($dt->payment->status==true){
                array_push($data,[
                    "id" => $dt->id,
                    "pnr" => $dt->pnr,
                    "seats" => join(',',$seats),
                    "bus" => $dt->scedule->bus->name,
                    "time" => Carbon::parse($dt->scedule->departure_time)->format('h:i A'),
                    "date" => Carbon::parse($dt->date)->format('d M,Y'),
                    "paid" => $dt->payment->status===1 ? true : false
                ]);
            }
        }

        return view('pages.booking',["all" => $data]);
    }

    function index(){
        return view('admin.pages.booking',["points" => Point::all()]);
    }

    function bookingIndex(Request $request){
        $id = $request->route('id');
        $doj = $request->route('doj');
        $scedule = ["from" => Scedule::where('id',$id)->first()->departure->name,
            "to" => Scedule::where('id',$id)->first()->destination->name,
            "time" => Carbon::parse(Scedule::where('id',$id)->first()->departure_time)->format('h:i A'),
            "bus" => Scedule::where('id',$id)->first()->bus->name,
        ];

        return view('admin.pages.book-seat',[
            "id" => $id,
            "scedule" => $scedule,
            "doj" => $doj,
            "fare" => Scedule::where('id',$id)->first()->seat_fare
        ]);
    }

    public function bookSeatfromCounterVerifyOTP(Request $request){
        $request->validate([
            "email" => "required|email"
        ]);

        $email = $request->email;
        $otp = rand(1234,9999);

        if($otp){
            Otp::create(["email" => $email,"otp" => $otp,"attempt" => 'bookSeatfromCounter',"expires_at" => Carbon::now()->addMinutes(2)]);

            Mail::to($email)->send(new SendCounterEmail($otp));

            return response([
                "message" => "An email has been sent to email $email"
            ],200);
        }

        return response([
            "message" => "Something went wrong"
        ]);
    }

    function bookSeatfromCounter(Request $request){
        $request->validate([
            "email" => "required|email",
            "otp" => "required"
        ]);

        $seats = [];
        $busId = Scedule::where('id',$request->scedule_id)->first()->bus->id;
        $seat_fare = Scedule::where('id',$request->scedule_id)->first()->seat_fare;

        for ($i=0; $i < sizeof($request->seats); $i++) {
            $seat = Seat::where('seat_no',$request->seats[$i])->where('bus_id',$busId)->first();
            array_push($seats,$seat);
        }

        $otp = Otp::where('otp',$request->otp)->where('email',$request->email)->where('attempt','bookSeatfromCounter')->first();

        if($otp){
            if(Carbon::now()->isBefore(Carbon::parse($otp->expires_at))){
                $booking = Booking::create([
                    "user_id" => Auth::guard('admin')->user()->id,
                    "by_counter" => true,
                    "scedule_id" => $request->scedule_id,
                    "date" => $request->doj,
                    "email" => $request->email,
                    "pnr" => '',
                    "expires_at" => Carbon::now()->addMinutes(5)
                ]);

                $booking->update([
                    "pnr" => $booking->id.str_replace("-","",$request->doj).$booking->user_id
                ]);

                for ($i=0; $i < sizeof($seats); $i++) {
                    BookedSeat::create([
                        "booking_id" => $booking->id,
                        "seat_id" => $seats[$i]->id
                    ]);
                }

                Payment::create([
                    "method" => "cash",
                    "booking_id" => $booking->id,
                    "status" => true,
                    "ammount" => sizeof($seats)*($seat_fare)
                ]);

                $otp->update([
                    "expires_at" => Carbon::now()
                ]);

                return [
                    "message" => "Seats booked succesfully"
                ];
            }else{
                return response([
                    "message" => "Otp code expired"
                ],401);
            }
        }

        return response([
            "message" => "Otp Incorrect"
        ],401);
    }

    function searchByPNR(Request $request){
        $pnr = $request->pnr;
        $booking = Booking::where('pnr',$pnr)->first();
        $seats = [];

        if($booking){
            for ($i=0; $i < sizeof($booking->seats); $i++){
                $seat = $booking->seats[$i];
                array_push($seats,Seat::where('id',$seat->seat_id)->first()->seat_no);
            }

            $data = [
                "id" => $booking->id,
                "pnr" => $booking->pnr,
                "departure" => $booking->scedule->departure->name,
                "destination" => $booking->scedule->destination->name,
                "bus" => $booking->scedule->bus->name,
                "date" => Carbon::parse($booking->date)->format('d')." ".Carbon::parse($booking->date)->format('M').",".Carbon::parse($booking->date)->year,
                "time" => Carbon::parse($booking->scedule->departure_time)->format("h:i A"),
                "email" => $booking->email,
                "seats" => $seats,
                "paid" => $booking->payment->status==true ? true : false,
                "busID" => $booking->scedule->bus->id
            ];

            return response()->json($data,200);
        }

        return response([
            "message" => "No Booking Record found by PNR ".$pnr
        ],404);
    }
    function bookSeatOnline(Request $request){
        $data = (array) json_decode($request->seat_json);

        if(Auth::user()){
            $booking = Booking::create([
                "user_id" => Auth::user()->id,
                "by_counter" => false,
                "scedule_id" => $data["sceduleId"],
                "date" => $data["date"],
                "email" => Auth::user()->email,
                "pnr" => ''
            ]);

            $booking->update([
                "pnr" => $booking->id.str_replace("-","",$booking->date).$booking->user_id,
                "expires_at" => Carbon::now()->addMinutes(5)
            ]);

            for ($i=0; $i < sizeof($data["seat_list"]); $i++) {
                $seat = (array) $data["seat_list"][$i];

                BookedSeat::create([
                    "booking_id" => $booking->id,
                    "seat_id" => $seat["id"]
                ]);
            }

            Payment::create([
                "method" => "",
                "booking_id" => $booking->id,
                "status" => false,
                "ammount" => sizeof($data["seat_list"])*$booking->scedule->seat_fare
            ]);

            return redirect()->route('singleBooking',$booking->pnr);
        }

        return redirect('/login');
    }
    function singleBooking(Request $request){
        $pnr = $request->route('pnr');
        $dt = Booking::where('pnr',$pnr)->first();
        $data = [];
        if($dt){
            $seats = [];

            for ($j=0; $j < sizeof($dt->seats); $j++){
                array_push($seats,$dt->seats[$j]->seat->seat_no);
            }

            if($dt->payment->status!=true && $dt->by_counter==false && Carbon::now()->isBefore(Carbon::parse($dt->expires_at))){
                $data = [
                    "id" => $dt->id,
                    "pnr" => $dt->pnr,
                    "seats" => join(',',$seats),
                    "bus" => $dt->scedule->bus->name,
                    "time" => Carbon::parse($dt->scedule->departure_time)->format('h:i A'),
                    "date" => Carbon::parse($dt->date)->format('d M,Y'),
                    "paid" => $dt->payment->status===1 ? true : false,
                    "ammount" => $dt->payment->ammount,
                    "service_charge" => 30*sizeof($dt->seats),
                    "departure" => $dt->scedule->departure->name,
                    "destination" => $dt->scedule->destination->name
                ];

                return view('pages.pay-booking',[
                    "item" => $data,
                    "seats" => json_encode($seats),
                    "busId" => $dt->scedule->bus->id
                ]);
            }
            if($dt->payment->status==true){
                $data = [
                    "id" => $dt->id,
                    "pnr" => $dt->pnr,
                    "seats" => join(',',$seats),
                    "bus" => $dt->scedule->bus->name,
                    "time" => Carbon::parse($dt->scedule->departure_time)->format('h:i A'),
                    "date" => Carbon::parse($dt->date)->format('d M,Y'),
                    "paid" => $dt->payment->status===1 ? true : false,
                    "ammount" => $dt->payment->ammount,
                    "service_charge" => 30*sizeof($dt->seats),
                    "departure" => $dt->scedule->departure->name,
                    "destination" => $dt->scedule->destination->name
                ];

                return view('pages.pay-booking',[
                    "item" => $data,
                    "seats" => json_encode($seats),
                    "busId" => $dt->scedule->bus->id
                ]);
            }
        }
        return abort(404);
    }
}
