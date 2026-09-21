<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#ad3150">

        <title>@yield('title', 'Dashboard Bidan — Prevanta')</title>
        <meta
            name="description"
            content="Portal bidan Prevanta untuk pemantauan pertumbuhan dan pencegahan stunting di Posyandu."
        >

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden antialiased">
        @yield('content')
    </body>
</html>
