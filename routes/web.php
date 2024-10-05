<?php

use App\Http\Controllers\JitsiController;
use App\Http\Controllers\JitsiTokenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('generate_token');
});

Route::post('/generate-jitsi-token', [App\Http\Controllers\JitsiTokenController::class, 'generateToken']);


Route::get('/join-jitsi-room', [JitsiController::class, 'showForm']);