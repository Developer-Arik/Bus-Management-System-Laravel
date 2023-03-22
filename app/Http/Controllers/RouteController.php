<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RouteController extends Controller
{
    function index(){
        $point = Point::all();

        return view('pages.index',["point" => $point]);
    }

    function search(Request $request){
        $from = Point::where('id',$request->from)->first();
        $to = Point::where('id',$request->to)->first();

        if(!$to || !$from){
            return abort(404);
        }

        $date = Carbon::parse($request->doj)->format('d')." ".Carbon::parse($request->doj)->format('M').",".Carbon::parse($request->doj)->year;

        return view('pages.search',["from" => $from->name,"to" => $to->name,"date" => $date]);
    }
}
