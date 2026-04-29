<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;

Route::prefix('exam')->group(function () {
    Route::post('/join', [ExamController::class, 'join']);
    Route::post('/log', [ExamController::class, 'logActivity']);
    Route::post('/exit', [ExamController::class, 'validateExit']);
});
