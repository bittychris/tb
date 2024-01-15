<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;

class indexController extends Controller
{
    //
    public function index()
    {     
        return view('index');   
    }
}