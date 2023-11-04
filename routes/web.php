<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\DasboardController;

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

/**
 * welcome laravel framework
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [DasboardController::class, 'getDataDasboard'])->name('home')->middleware('auth');

Route::get('/students_search', [StudentController::class, 'getSearchResult'])->name('search')->middleware('auth');

Route::get('/admin/profile', [LoginController::class, 'showProfile'])->name('admin.profile')->middleware('auth');;

Route::prefix('admin')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('admin.index');
    Route::post('/login', [LoginController::class, 'customLogin'])->name('admin.login');
    Route::post('/create', [LoginController::class, 'customRegistration'])->name('admin.create');
    Route::get('/logout', [LoginController::class, 'signOut'])->name('admin.logout');
    Route::post('/update', [LoginController::class, 'updateProfile'])->name('admin.update');
    Route::get('/change_pw', [LoginController::class, 'changePasswordIndex'])->name('admin.change_password');
    Route::post('/changed_pw', [LoginController::class, 'changePassword'])->name('admin.changed_pw');
    Route::post('/reset_pw', [LoginController::class, 'resetPassword'])->name('admin.reset_password');
});

Route::group(['middleware' => ['auth', 'permission']], function () {

    /**
     * Student Routes
     */
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/store', [StudentController::class, 'store'])->name('students.store');
        Route::post('/excel', [StudentController::class, 'exportExcel'])->name('students.export');
        Route::post('/pdf', [StudentController::class, 'exportPdf'])->name('students.pdf');
        Route::get('/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::post('/update', [StudentController::class, 'update'])->name('students.update');
        Route::post('/delete', [StudentController::class, 'destroy'])->name('students.delete');
    });

    /**
     * User Routes
     */
    Route::group(['prefix' => 'users_list'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/create', [UsersController::class, 'store'])->name('users.store');
        Route::get('/{user}/show', [UsersController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::patch('/{user}/update', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('users.destroy');
    });

    /**
     * User Permissions
     */
    Route::group(['prefix' => 'users_permissions'], function () {
        Route::get('/', [PermissionsController::class, 'index'])->name('permissions.index');
        Route::get('/create', [PermissionsController::class, 'create'])->name('permissions.create');
        Route::post('/create', [PermissionsController::class, 'store'])->name('permissions.store');
        Route::get('/{permission}/show', [PermissionsController::class, 'show'])->name('permissions.show');
        Route::get('/{permission}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
        Route::patch('/{permission}/update', [PermissionsController::class, 'update'])->name('permissions.update');
        Route::delete('/{permission}/delete', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
    });

    /**
     * User Roles
     */
    Route::group(['prefix' => 'users_roles'], function () {
        Route::get('/', [RolesController::class, 'index'])->name('roles.index');
        Route::get('/create', [RolesController::class, 'create'])->name('roles.create');
        Route::post('/create', [RolesController::class, 'store'])->name('roles.store');
        Route::get('/{role}/show', [RolesController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RolesController::class, 'edit'])->name('roles.edit');
        Route::patch('/{role}/update', [RolesController::class, 'update'])->name('roles.update');
        Route::delete('/{role}/delete', [RolesController::class, 'destroy'])->name('roles.destroy');
    });
});
