<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,EmployeeController};

Route::get('/', function () {
    return view('welcome');
});

Route::post('/auth/register',[EmployeeController::class,'register'])->name('auth.register');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/read-file', [HomeController::class, 'readWriteXMLFile']);
Route::post('/upload-image',[HomeController::class,'uploadImage'])->name('upload-image');