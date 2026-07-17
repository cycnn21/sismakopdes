<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    @include('components.user-sidebar')

    <main class="flex-1 p-8">

        @yield('content')

    </main>

</div>

</body>

</html>