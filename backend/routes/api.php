<?php

use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamPdfController;
use App\Http\Controllers\Api\PackageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Exames
Route::get('/exams', [ExamController::class, 'index']);
Route::post('/exams', [ExamController::class, 'store']);

Route::post('/exams/pdf', [ExamPdfController::class, 'generate']);

// Pacotes
Route::get('/packages',   [PackageController::class, 'index']);
Route::post('/packages',  [PackageController::class, 'store']);
Route::delete('/packages/{id}', [PackageController::class, 'destroy']);
