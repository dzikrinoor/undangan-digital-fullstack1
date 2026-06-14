<?php

use App\Http\Controllers\Api\RsvpController;
use Illuminate\Support\Facades\Route;

Route::post('/rsvp', [RsvpController::class, 'store']);
Route::get('/rsvp', [RsvpController::class, 'index']);