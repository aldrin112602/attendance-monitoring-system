<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index() {
        $admins = User::where('role', 1)->orderBy('id','desc')->paginate(10);
        return view('admin.administrator', compact('admins'));
    }
}
