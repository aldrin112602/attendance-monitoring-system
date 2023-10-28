<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    //

    // return all admins

    public function index() {
        $admins = User::where( 'role', 1 )->orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'admin.administrator', compact( 'admins' ) );
    }

    public function getFaculty() {
        $faculty = User::where( 'role', 0 )->orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'admin.faculty', compact( 'faculty' ) );
    }

    public function editFaculty( $id ) {
        $faculty = User::find( $id );
        if ( !$faculty || $faculty->role != 0 ) {
            return redirect()->route( 'admin.faculty' )->with( 'error', 'Record not found for editing' );
        }
        return view( 'admin.faculty.edit', compact( 'faculty' ) );
    }

    public function editAdmin( $id ) {
        $admin = User::find( $id );
        if ( !$admin || $admin->role != 1 ) {
            return redirect()->route( 'admin.administrator' )->with( 'error', 'Record not found for editing' );
            ;
        }
        return view( 'admin.admin.edit', compact( 'admin' ) );
    }

    public function updateProfileFaculty( Request $request, $id ) {
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
        $profileImage->move(public_path('storage/profile-photos'), $profileImageName);
        $user->profile_photo_path = 'profile-photos/'.$profileImageName;
    }

    $user->save();

    return redirect()->route('admin.faculty')->with('success', 'Record updated successfully' );
    }

    public function updateProfileAdmin( Request $request, $id ) {
        // Validate the form data
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users, email, ' . $id,
            'newPassword' => 'nullable|min:6',
            'profile' => 'nullable|image|mimes:jpeg, png, jpg, gif|max:2048',
        ] );

        // Update the user's profile information
        $user = User::find( $id );
        $user->name = $request->input( 'name' );
        $user->email = $request->input( 'email' );

        if ( $request->has( 'newPassword' ) ) {
            $user->password = Hash::make( $request->input( 'newPassword' ) );
        }

        if ( $request->hasFile( 'profile' ) ) {
            $profileImage = $request->file( 'profile' );
            $profileImageName = time() . '.' . $profileImage->extension();
            $profileImage->move( public_path( 'storage/profile-photos' ), $profileImageName );
            $user->profile_photo_path = 'profile-photos/'.$profileImageName;
        }

        $user->save();

        return redirect()->route( 'admin.administrator' )->with( 'success', 'Record updated successfully' );
    }

    public function addAdmin() {
        return view( 'admin.admin.create' );
    }

    public function addFaculty() {
        return view( 'admin.faculty.create' );
    }

    public function addFacultyPost( Request $request ) {
        // Validate the form data
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ] );

        // Create a new user and insert data into the database
        User::create( [
            'name' => $request->input( 'name' ),
            'email' => $request->input( 'email' ),
            'password' => Hash::make( $request->input( 'password' ) ),
            'role' => 0
        ] );

        if ( $request->hasFile( 'profile' ) ) {
            $profileImage = $request->file( 'profile' );
            $profileImageName = time() . '.' . $profileImage->extension();
            $profileImage->move( public_path( 'storage/profile-photos' ), $profileImageName );
            $profile_photo_path = 'profile-photos/'.$profileImageName;

            // Update the user's profile_image field with the filename
        User::where('email', $request->input('email'))
            ->update(['profile_photo_path' => $profile_photo_path]);
    }

    return redirect()->route('admin.faculty')->with('success', 'Record added successfully' );

        }

        public function delete($id) {
            $id = intval( $id );
            $user = User::find( $id );
            if ( $user ) {
                $user->delete();
                return redirect()->route('admin.administrator')->with('success','Record deleted successfully' );
            }
            return redirect()->route('admin.administrator')->with('error','Record not found for deletion');
        }

        public function deleteFaculty($id) {
            $id = intval( $id );
            $user = User::find( $id );
            if ( $user ) {
                $user->delete();
                return redirect()->route('admin.faculty')->with('success','Record deleted successfully' );
            }
            return redirect()->route('admin.faculty')->with('error','Record not found for deletion');
        }


        public function userFaculty() {
            $user = Auth::user();
            if ($user->status === 'inactive') {
                $user->status = 'active';
                $user->save();
            }

            return view('dashboard' );
        }


        public function deactivateUser(Request $request) {
            $user = Auth::user();
            if ($user->status === 'active') {
                $user->status = 'inactive';
                $user->save();

                $user->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('success', 'Logout successfully');
            }

        }

    }
