<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        /* Base styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f9;
        }

        /* Container styling */
        .container {
            text-align: center;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }

        /* Heading styles */
        h1 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        /* Button styling */
        .toggle-ajax-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .toggle-ajax-btn:hover {
            background-color: #0056b3;
        }

        /* Image styling */
        #videoFeed {
            max-width: 100%;
            height: auto;
            margin-top: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: block;
        }
    </style>
</head>
<body>
    <script>
        // Variable to control whether AJAX is running
        let ajaxRunning = true;
        let intervalId;

        // Function to start AJAX polling
        function startAjax() {
            intervalId = setInterval(function() {
                if (ajaxRunning) {
                    $.ajax({
                        url: 'http://127.0.0.1:5000/send_sentence', // The Flask API route
                        method: 'POST', // POST request
                        data: new FormData(), // Send the empty FormData object
                        processData: false, // Don't process the data (important for form-data)
                        contentType: false, // Don't set content type (important for form-data)
                        success: function(response) {
                            $('#message').text(response.message); // Adjust if your API returns a different structure
                        },
                        error: function() {
                            $('#message').text('Failed to load data.');
                        }
                    });
                }
            }, 1000); // 1000 ms = 1 second
        }

        // Function to stop AJAX polling
        function stopAjax() {
            clearInterval(intervalId);
            $('#message').text(""); // Adjust if your API returns
        }

        $(document).ready(function() {
            // Start the AJAX polling by default
            startAjax();

            // Toggle AJAX polling when the button is clicked
            $('#toggle-ajax').click(function() {
                ajaxRunning = !ajaxRunning;
                if (ajaxRunning) {
                    startAjax();
                    $(this).text('Stop AJAX');
                } else {
                    stopAjax();
                    $(this).text('Start AJAX');
                }
            });
            $('#clear-sentence').click(function() {
                $.ajax({
                    url: 'http://127.0.0.1:5000/clear_sentence', // The Flask API route
                    method: 'POST', // POST request
                    data: new FormData(), // Send the empty FormData object
                    processData: false, // Don't process the data (important for form-data)
                    contentType: false, // Don't set content type (important for form-data)
                    success: function(response) {

                    },
                    error: function() {
                        
                    }
                });
            });
        });

    </script>
    <div class="container">
        <h1>SIBI Translation Video Feed</h1>

        @php
            $displayStyle = Session::get('image_visible', true) ? 'block' : 'none';
        @endphp

        <img id="videoFeed" src="http://localhost:5000/video_feed" alt="Video Feed" style="display: {{ $displayStyle }}; width: 640px; height: 480px;">

        <div id="data-container">
            <p>Translation: </p>
            <p id="message">Loading...</p>
        </div>

        <!-- Form to toggle image visibility -->
        <form action="{{ route('toggle-image') }}" method="POST">
            @csrf <!-- Include CSRF token for security -->
            <button type="submit" class="toggle-ajax-btn">
                {{ Session::get('image_visible', true) ? 'Hide Image' : 'Show Image' }}
            </button>
        </form>

        <!-- Button to toggle AJAX -->
        <button id="toggle-ajax" class="toggle-ajax-btn">Stop AJAX</button>
        <button id="clear-sentence" class="toggle-ajax-btn">Clear Sentence</button>
    </div>
</body>
</html>
