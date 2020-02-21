<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class SessController extends Controller
{
    public function index()
    {
//        session(['name'=>'张三']);

//        dump(session('name'));

//        dump(session()->has('name'));


//        session()->flush();
//        dump(session()->has('name'));


//        session(['name'=>'张三']);
//        session()->flash('age',20);

        dump(session('name'));
        dump(session('age'));

    }
}
