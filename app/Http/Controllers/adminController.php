<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function ageGroups() {
        return view('admin_panel.age_groups');
        
    }

    public function attributes() {
        return view('admin_panel.attributes');
        
    }

    public function formAttributes() {
        return view('admin_panel.form_attributes');
        
    }

    public function addFormAttributes() {
        return view('admin_panel.add_form_attribute');
        
    }
}
