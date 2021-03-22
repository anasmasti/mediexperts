<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use DB;
=======
use Illuminate\Support\Facades\DB;
>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
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
