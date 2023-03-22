<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    function index(){
        $bus = Point::all();
        return view('admin.pages.point',["bus" => $bus,"length" => sizeof($bus)]);
    }
    function add(Request $request){
        $request->validate([
            'name' => 'required|unique:points,name'
        ]);

        Point::create([
            "name" => $request->name
        ]);

        return redirect()->route('admin.point');
    }
    public function delete($id)
    {
        Point::where('id',$id)->delete();

        return redirect()->back();
    }
}
