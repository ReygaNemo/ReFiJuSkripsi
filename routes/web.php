<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlaskController;
use Illuminate\Support\Facades\Http;
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

Route::post('/send-message-to-flask', function () {
    // Send POST request to Flask server
    $response = Http::post('http://127.0.0.1:5000/send-message', [
        'message' => 'Hello world',
    ]);

    return $response->json();
});

