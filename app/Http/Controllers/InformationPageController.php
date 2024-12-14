<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationPageController extends Controller
{
    public function showAboutUs()
    {
        return view('AboutUs'); // Replace 'Translate' with the name of your view file if different
    }    public function showKamus()
    {
        return view('Kamus'); // Replace 'Translate' with the name of your view file if different
    }
}
