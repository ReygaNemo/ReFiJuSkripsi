<!DOCTYPE html>
<html lang="en">
<head>
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
        .hide-btn {
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

        .hide-btn:hover {
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
    <div class="container">
        <h1>SIBI Translation Video Feed</h1>

        <?php
            $displayStyle = Session::get('image_visible', true) ? 'block' : 'none';
        ?>

        <img id="videoFeed" src="http://localhost:5000/video_feed" alt="Video Feed" style="display: <?php echo e($displayStyle); ?>;">

        <!-- Form to toggle image visibility -->
        <form action="<?php echo e(route('toggle-image')); ?>" method="POST">
            <?php echo csrf_field(); ?> <!-- Include CSRF token for security -->
            <button type="submit" class="hide-btn">
                <?php echo e(Session::get('image_visible', true) ? 'Hide Image' : 'Show Image'); ?>

            </button>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\LaravelSkripsi\resources\views/Translate.blade.php ENDPATH**/ ?>