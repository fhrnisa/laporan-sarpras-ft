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

    <style>
    .input-error {
        border-color: #dc2626 !important; /* merah */
    }
    .error-text {
        color: #dc2626;
        font-size: 0.875rem; /* text-sm */
        margin-top: 4px;
    }

    .timer-big {
        font-size: 3rem;
        font-weight: bold;
    }

    .btn-disabled {
        background: #CCCCCC !important;
        cursor: not-allowed;
        pointer-events: none;
    }

    .btn-active {
        background: #002D56 !important;
        cursor: pointer;
        pointer-events: auto;
    }
    </style>

</head>

<body class="bg-white text-gray-900 font-sans">
    <div class="p-6 w-full">
        @yield('content')
    </div>
</body>
</html>
