<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class FlaskController extends Controller
{
    public function toggleImage(Request $request)
    {
        // Retrieve current visibility state from session (default: true)
        $isVisible = Session::get('image_visible', true);

        // Toggle visibility state
        $newVisibility = !$isVisible;

        // Store the new visibility state in the session
        Session::put('image_visible', $newVisibility);

        // Redirect back to the welcome page
        return redirect()->back();
    }
    public function runNotebook()
    {
        // Path to your .ipynb file
        $notebookPath = 'LoadActionH5.ipynb';

        // Command to execute the notebook
        // Ensure that jupyter is in your PATH or use full path to the jupyter command
        $command = "jupyter nbconvert --to notebook --execute --inplace --allow-errors \"$notebookPath\"";

        // Execute the command
        exec($command, $output, $return_var);

        // Check the result
        if ($return_var !== 0) {
            return response()->json(['error' => 'Failed to execute the notebook.', 'output' => $output], 500);
        }

        return response()->json(['message' => 'Notebook executed successfully!', 'output' => $output]);
    }
}
