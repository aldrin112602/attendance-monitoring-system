<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    //

    // return all admins

    public function index() {
        $admins = User::where( 'role', 1 )->orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'admin.administrator', compact( 'admins' ) );
    }

    public function getFaculty() {
        $faculty = User::where( 'role', 2 )->orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'admin.faculty', compact( 'faculty' ) );
    }

}
