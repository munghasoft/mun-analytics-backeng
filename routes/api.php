<?php
use App\Http\Controllers\Api\StudentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/students', [StudentController::class, 'store']);
Route::post('/fee_structure', [\App\Http\Controllers\Api\FeeStructureController::class, 'store']);
Route::post('/payments', [\App\Http\Controllers\Api\PaymentController::class, 'store']);


Route::get('/fee_structure', [\App\Http\Controllers\Api\FeeStructureController::class, 'index']);
Route::get('/students', [\App\Http\Controllers\Api\StudentController::class, 'index']);

