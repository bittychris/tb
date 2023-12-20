<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormAttributeController extends Controller
{
    public function index()
    {
        return FormAttribute::all();
    }
}
