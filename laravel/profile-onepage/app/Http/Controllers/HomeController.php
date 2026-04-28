<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $data['name'] = "manusia biasa";
        $data['specialist'] = "Web & Mobile Developer";
        return view('welcome', $data);
    }
}
