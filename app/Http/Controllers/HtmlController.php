<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtmlController extends Controller
{
    public function index()
    {
        $data = ['id' => 1, 'name' => 'haha'];
        return view('index', compact('data'));
    }
}
