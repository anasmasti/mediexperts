<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{Client,Cabinet,Giac,Actionnaire};

class testController extends Controller
{
    //ADMIN PAGE
    function Dashboard() {
        return view('layouts.dashboard');
    }

    //TESTING
    function Testing() {
        return view('test');
    }

}
