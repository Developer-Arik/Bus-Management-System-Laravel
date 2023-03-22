<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    function aboutPage(){
        $about = DB::table('informations')->where('title','about')->first()->description;

        return view('pages.about',[
            "about" => $about
        ]);
    }

    function aboutIndex(){
        $about = DB::table('informations')->where('title','about')->first()->description;
        return view('admin.pages.info-about',[
            "about" => $about
        ]);
    }

    function aboutUpd(Request $request){
        $page = $request->page;

        DB::table('informations')->where('title','about')->update([
            "description" => $page
        ]);

        return redirect()->back();
    }

    function faq(){
        return view('pages.faq',[
            "all" => Faq::all()
        ]);
    }
}
