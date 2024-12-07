<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        .hide-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        .hide-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Welcome to My Laravel Application</h1>

    <?php
        $displayStyle = Session::get('image_visible', true) ? 'block' : 'none';
    ?>

    <?php
        echo '<img id="videoFeed" src="http://localhost:5000/video_feed" alt="Video Feed" style="display: ' . $displayStyle . ';">';
    ?>

    <!-- Form to toggle image visibility -->
    <form action="<?php echo e(route('toggle-image')); ?>" method="POST">
        <?php echo csrf_field(); ?> <!-- Include CSRF token for security -->
        <button type="submit" class="hide-btn">
            <?php echo e(Session::get('image_visible', true) ? 'Hide Image' : 'Show Image'); ?>

        </button>
    </form>
</body>
</html>
<?php /**PATH C:\Users\Reyga\OneDrive\Desktop\SkripsiiiCodeee\SkripCode\resources\views/welcome.blade.php ENDPATH**/ ?>