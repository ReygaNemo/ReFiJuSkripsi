<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            overflow-x: hidden;
        }

        /* Container styling */
        .container {
            text-align: center;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            width: 90%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            box-sizing: border-box;
        }

        /* Heading styles */
        h1 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            width: 100%;
            text-align: center;
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
            width: 100%;
        }

        .toggle-ajax-btn:hover {
            background-color: #0056b3;
        }

        /* Flex container for video and message history */
        .video-container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            width: 100%;
        }

        /* Video styling */
        #videoFeed {
            max-width: 60%;
            height: auto;
            margin-top: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Message history box */
        #message-history {
            margin-top: 1rem;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            text-align: left;
            box-sizing: border-box;
            width: 35%;
            margin-left: 1rem;
        }

        .message-item {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            font-size: 0.9rem;
        }

        .message-item:last-child {
            border-bottom: none;
        }

        /* Responsive styling */
        @media screen and (max-width: 768px) {
            .container {
                padding: 1rem;
                width: 95%;
            }

            h1 {
                font-size: 1.5rem;
            }

            .toggle-ajax-btn {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            /* Adjust video size for smaller screens */
            #videoFeed {
                max-width: 100%;
            }

            /* Adjust history box for mobile */
            #message-history {
                max-height: 150px;
                width: 100%;
                margin-left: 0;
                margin-top: 1rem;
            }

            .video-container {
                flex-direction: column;
                align-items: center;
            }
        }

        @media screen and (max-width: 480px) {
            /* Adjust buttons for very small screens */
            .toggle-ajax-btn {
                font-size: 0.8rem;
                padding: 6px 12px;
            }

            h1 {
                font-size: 1.3rem;
            }

            /* Adjust video size for very small screens */
            #videoFeed {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <script>
        // Variable to control whether AJAX is running
        let ajaxRunning = true;
        let intervalId;
        let messageHistory = [];  // Array to store message history

        // Function to start AJAX polling
        function startAjax() {
            intervalId = setInterval(function() {
                if (ajaxRunning) {
                    $.ajax({
                        url: '{{ route('fetch.translation') }}', // Laravel route
                        method: 'POST',
                        data: new FormData(),
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#message').text(response.message);
                            //messageHistory.push(response.message); // Save the message to history
                            //updateMessageHistory();  // Update the message history display
                        },
                        error: function() {
                            $('#message').text('Failed to load data.');
                        }
                    });
                }
            }, 1000); // 1-second interval
        }

        // Function to stop AJAX polling
        function stopAjax() {
            clearInterval(intervalId);
            $('#message').text("");
        }

        // Function to update message history display
        function updateMessageHistory() {
            $('#message-history').empty();  // Clear the history box
            messageHistory.forEach(function(message) {
                $('#message-history').append('<div class="message-item">' + message + '</div>');
            });
        }

        // Function to save the message history (could be used to store in a backend or local storage)
        function saveMessageHistory() {
            // This example will simply log the history, but you can implement saving to local storage or server
            let message = $('#message').text();
    
            // Push the message into the messageHistory array
            messageHistory.push(message);
            // console.log('Saving message history:', messageHistory);
            updateMessageHistory();
            //alert('Message history saved!');
        }

        // Function to clear message history
        function clearMessageHistory() {
            messageHistory = [];
            updateMessageHistory();  // Refresh the message history display
        }

        $(document).ready(function() {
            // Start the AJAX polling by default
            startAjax();

            // Toggle AJAX polling when the button is clicked
            $('#toggle-ajax').click(function() {
                ajaxRunning = !ajaxRunning;
                if (ajaxRunning) {
                    startAjax();
                    $(this).text('Only Live Translation');
                } else {
                    stopAjax();
                    $(this).text('Save Live Translation');
                }
            });

            // Clear the sentence when the clear button is clicked
            $('#clear-sentence').click(function() {
                $.ajax({
                    url: '{{ route('clear.sentence') }}', // Laravel route
                    method: 'POST',
                    data: new FormData(),
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
            });

            // Button actions for saving and clearing message history
            $('#save-history').click(saveMessageHistory);
            $('#clear-history').click(clearMessageHistory);
        });
    </script>

    <div class="container">
        <h1>SIBI Translation Video Feed</h1>

        @php
            $displayStyle = Session::get('image_visible', true) ? 'block' : 'none';
        @endphp

        <div class="video-container">
            <img id="videoFeed" src="http://localhost:5000/video_feed" alt="Video Feed" style="display: {{ $displayStyle }};">

            <div id="message-history"></div>
        </div>

        <div id="data-container">
            <p>Result Box: </p>
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
        <button id="toggle-ajax" class="toggle-ajax-btn">Only Live Translation</button>
        <button id="clear-sentence" class="toggle-ajax-btn">Clear Sentence</button>

        <!-- Buttons to Save and Clear Message History -->
        <button id="save-history" class="toggle-ajax-btn">Save History</button>
        <button id="clear-history" class="toggle-ajax-btn">Clear History</button>
    </div>
</body>
</html>
