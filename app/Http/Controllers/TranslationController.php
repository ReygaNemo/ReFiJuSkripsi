<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function showTranslation()
    {
        return view('Translate'); // Replace 'Translate' with the name of your view file if different
    }
    public function fetchTranslation()
    {
        try {
            $response = Http::post('http://127.0.0.1:5000/send_sentence');
            if ($response->successful()) {
                return response()->json(['message' => $response->json('message')]);
            }
            return response()->json(['message' => 'Failed to fetch translation.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    // Method to clear the sentence in Flask
    public function clearSentence()
    {
        try {
            $response = Http::post('http://127.0.0.1:5000/clear_sentence');
            if ($response->successful()) {
                return response()->json(['message' => $response->json('message')]);
            }
            return response()->json(['message' => 'Failed to clear sentence.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
