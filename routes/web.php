<?php

use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobInterviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobApplicationController::class, 'index']);
Route::resource('/jobApplication', JobApplicationController::class);
Route::put('/jobApplication/{jobApplication}/status', [JobApplicationController::class, 'updateStatus']);
Route::get('/jobApplication/{jobApplication}/cv', [JobApplicationController::class, 'getCV']);
Route::resource('/jobInterview', JobInterviewController::class);
