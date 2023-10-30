<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function studentView() {
        return view("faculty.student");
    }

    
}
