<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('payment', [PaymentController::class, 'get']);
Route::post('payment', [PaymentController::class, 'store']);
Route::delete('payment', [PaymentController::class, 'delete']);
