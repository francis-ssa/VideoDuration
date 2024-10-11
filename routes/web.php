<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('videos');
})->name('videos');

Route::get('/scorm', [VideoController::class, 'index'])->name('scorm');
Route::post('/scorm', [VideoController::class, 'storeUserData'])->name('storeUserData');
