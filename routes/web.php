<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::get('/home', [StudentController::class, 'getCountStudent'])->name('home')->middleware('auth');

Route::get('/students_search', [StudentController::class, 'getSearchResult'])->name('search')->middleware('auth');

Route::get('/admin/profile', [LoginController::class, 'showProfile'])->name('admin.profile')->middleware('auth');;

Route::prefix('admin')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('admin.index');
    Route::post('/login', [LoginController::class, 'customLogin'])->name('admin.login');
    Route::post('/create', [LoginController::class, 'customRegistration'])->name('admin.create');
    Route::get('/logout', [LoginController::class, 'signOut'])->name('admin.logout');
});

Route::prefix('students')->middleware('auth')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::get('/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/store', [StudentController::class, 'store'])->name('students.store');
    Route::post('/excel', [StudentController::class, 'exportExcel'])->name('students.export');
    Route::post('/pdf', [StudentController::class, 'exportPdf'])->name('students.pdf');
    Route::get('/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::post('/update', [StudentController::class, 'update'])->name('students.update');
    Route::post('/delete', [StudentController::class, 'destroy'])->name('students.delete');
});
