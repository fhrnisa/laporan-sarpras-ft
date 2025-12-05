<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'UNNES Sarpras')</title>

    <!-- Favicon (opsional) -->
    <link rel="icon" type="image/png" href="{{ asset('img/unnes-logo.png') }}">

    <!-- Font Fira Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-white text-gray-900 font-sans">
    <div class="p-6 w-full">
        @yield('content')
    </div>
</body>
</html>
