<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    function adminIndex(){
        $faqs = Faq::all();

        return view('admin.pages.faq',[
            "faqs" => $faqs
        ]);
    }

    function create(Request $request){
        $request->validate([
            "title" => "required",
            "description" => "required"
        ]);

        $created = Faq::create([
            "title" => $request->title,
            "description" => $request->description
        ]);

        if($created){
            return response([
                "all" => Faq::all(),
            ],200);
        }

        return response([
            "error" => "Server Request Error"
        ],500);
    }

    function edit(Request $request){
        $request->validate([
            "title" => "required",
            "description" => "required"
        ]);

        $faq = Faq::where('id',$request->id);

        $faq->update([
            "title" => $request->title,
            "description" => $request->description
        ]);

        if($faq){
            return response([
                "all" => Faq::all(),
            ],200);
        }

        return response([
            "error" => "Server Request Error"
        ],500);
    }

    function delete(Request $request){
        $faq = Faq::where('id',$request->id);

        $faq->delete();

        if($faq){
            return response([
                "all" => Faq::all(),
            ],200);
        }

        return response([
            "error" => "Server Request Error"
        ],500);
    }
}
