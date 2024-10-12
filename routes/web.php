<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlaskController;

Route::get('/call-flask', [FlaskController::class, 'callFlask']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-hello-world', function () {
    // Specify the full path to the Python script
    $output = shell_exec('python C:/Users/Reyga/OneDrive/Desktop/SkripsiiiCodeee/SkripCode/pyCode/Hello_World.py');
    return "Script output: " . $output;
});
Route::post('/toggle-image', [FlaskController::class, 'toggleImage'])->name('toggle-image');
Route::get('/run-notebook', [FlaskController::class, 'runNotebook']);
