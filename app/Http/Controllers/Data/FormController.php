<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Http\Resources\FormResource;

class FormController extends Controller
{
    public function index()
    {
        return FormResource::collection(Form::all());
    }
}
