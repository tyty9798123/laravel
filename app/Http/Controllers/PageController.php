<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    function pb(Request $request){
            $number = $request->input("number");

        return view('pb', [
            "number" => $number
        ]);
    }
}
