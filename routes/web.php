<?php

use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobApplicationController::class, 'index']);
Route::resource('/jobApplication', JobApplicationController::class);
