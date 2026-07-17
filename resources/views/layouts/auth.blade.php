<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SISMA KOPDES')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <header class="w-full bg-white shadow-sm">

        <div class="max-w-7xl mx-auto h-20 flex items-center justify-between px-6">

            <a href="/" class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl bg-red-700 text-white flex items-center justify-center font-bold">
                    K
                </div>

                <div>

                    <h1 class="font-bold text-xl">
                        SISMA KOPDES
                    </h1>

                    <p class="text-sm text-gray-500">
                        Desa Merah Putih
                    </p>

                </div>

            </a>

            <a href="/"
                class="text-red-700 hover:text-red-800 font-semibold">

                ← Kembali ke Beranda

            </a>

        </div>

    </header>

    <main>

        @yield('content')

    </main>

</body>

</html>