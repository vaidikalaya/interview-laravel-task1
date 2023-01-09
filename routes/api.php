<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EmployeeController};

Route::group(['middleware' => 'auth:sanctum'], function (){

    Route::get('get-employee-data/{id}',[EmployeeController::class,'getEmployeeData']);

});
