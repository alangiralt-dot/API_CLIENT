<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;

// rutes públiques
Route::get('/', function () {
    return redirect()->route('orders.showOrderDetails.current');
});
Route::get('/comandes/current', function (Request $request) {
    return (new OrderController())->showOrderDetails($request, 'current');
})->name('orders.showOrderDetails.current');