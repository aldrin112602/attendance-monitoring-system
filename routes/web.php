<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacultyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::post('/dashboard/deactivate', [UserController::class, 'deactivateUser'])->name('users.deactivate');

    // User role == 0
    Route::middleware(['role:0'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'userFaculty'])->name('dashboard');
        Route::get('/faculty/student', [FacultyController::class, 'studentView'])->name('faculty.student');
    });

    // User role == 1
    Route::middleware(['role:1'])->group(function () {
        Route::get('/admin', [UserController::class, 'admin'])->name('admin.dashboard');
        Route::post('/update-profile-faculty/{id}', [UserController::class, 'updateProfileFaculty'])->name('update.profile.faculty');

        Route::post('/update-profile-admin/{id}', [UserController::class, 'updateProfileAdmin'])->name('update.profile.admin');
        
        Route::get('/admin/faculty', [UserController::class, 'getFaculty'])->name('admin.faculty');
        Route::get('/admin/faculty/edit/{id}', [UserController::class, 'editFaculty'])->name('admin.faculty.edit');

        Route::get('/admin/admin/edit/{id}', [UserController::class, 'editAdmin'])->name('admin.admin.edit');
        

        Route::get('/admin/admin/create', [UserController::class, 'addAdmin'])->name('admin.admin.create');
        Route::post('/admin/admin/create', [UserController::class, 'addAdminPost'])->name('admin.admin.create.post');
        Route::post('/admin/delete/{id}', [UserController::class, 'delete'])->name('admin.delete');





        Route::get('/admin/faculty/create', [UserController::class, 'addFaculty'])->name('admin.faculty.create');
        Route::post('/admin/faculty/create', [UserController::class, 'addFacultyPost'])->name('admin.faculty.create.post');
        Route::post('/admin/delete/faculty/{id}', [UserController::class, 'deleteFaculty'])->name('admin.delete.faculty');




        Route::get('/admin/administrator', [UserController::class, 'index'])->name('admin.administrator');

        Route::get('/admin/message', function () {
            return view('admin.message');
        })->name('admin.message');
    });
});

