<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::delete('/deleteCustomer/{email}', [\App\Http\Controllers\CustomersController::class,'deleteCustomer']);
