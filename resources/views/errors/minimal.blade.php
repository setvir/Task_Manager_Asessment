<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body style="color: white !important; font-size: 26px; height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #343a40;">
        <div class="text-center">
            <div>
                @yield('code')
            </div>
<hr/>
            <div>
                @yield('message')
            </div>
        </div>
    </body>
</html>
