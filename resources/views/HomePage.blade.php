<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{ asset('HomePageCss.css') }}">
</head>
<body>
    <div class="container">
        <h1>Kamus SIBI menggunakan AI dan video live capture</h1>
        <div class="button-container">
            <a href="{{ route('translation') }}" class="button">Translation</a>
            <a href="{{ route('about') }}" class="button">About Us</a>
            <a href="{{ route('kamus') }}" class="button">Kamus</a>
        </div>
    </div>
</body>
</html>