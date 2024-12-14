<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            --bs-gutter-x: 1.5rem;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-right: auto;
            margin-left: auto;
        }

        .card {
            --bs-card-border-radius: 0.9rem;
            border: 1px solid var(--bs-border-color-translucent);
            border-radius: var(--bs-card-border-radius);
            background-color: #fff;
            display: flex;
            flex-direction: column;
            word-wrap: break-word;
            overflow: hidden;
        }

        .about-content {
            background-color: #fceadc;
            padding: 5px;
            background-size: cover;
            border-bottom-left-radius: 5rem;
            border-bottom-right-radius: 5rem;
        }

        .card-body {
            padding: 1rem;
            text-align: center;
        }

        .card-image img {
            width: 100%;
            max-width: 150px;
            height: auto;
        }

        .card-text {
            font-size: 1rem;
            font-family: "Nunito", sans-serif;
        }

        .row-auto {
            margin-top: 7rem;
        }

    </style>
</head>
<body id="page-top">
    <div class="about-content" style="min-height:95vh">
        <div class="container row-auto">
            <div class="row">
                <?php
                    $letters = range('A', 'Z');
                ?>
                <?php $__currentLoopData = $letters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-2 mb-3">
                    <div class="card">
                        <div class="card-body p-4 px-5">
                            <div class="h5 text-center mb-3"><?php echo e($letter); ?></div>
                            <div class="card-image">
                                <img src="<?php echo e(asset('dictionary/' . strtolower($letter) . '.jpg')); ?>" alt="<?php echo e($letter); ?> image">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\ReFiJuSkripsi\resources\views/Kamus.blade.php ENDPATH**/ ?>