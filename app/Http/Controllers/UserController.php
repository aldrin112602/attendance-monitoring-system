<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function editFaculty( $id ) {
        $faculty = User::where( 'id', $id )->first();
        return view( 'admin.faculty.edit', compact( 'faculty' ) );
    }

    public function updateProfile( Request $request, $id ) {
        // Validate the form data
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'newPassword' => 'nullable|min:6',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ] );

        // Update the user's profile information
    $user = User::find($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    
    if ($request->has('newPassword')) {
        $user->password = Hash::make($request->input('newPassword'));
    }

    if ($request->hasFile('profile')) {
        $profileImage = $request->file('profile');
        $profileImageName = time() . '.' . $profileImage->extension();
        $profileImage->move(public_path('profile-images'), $profileImageName);
        $user->profile_image = $profileImageName;
    }

    $user->save();

    return redirect()->route('admin.faculty')->with('success', 'Faculty updated successfully' );
    }

}
