<nav x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-white/90 backdrop-blur-md shadow-sm z-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-red-700 text-white flex items-center justify-center font-bold text-xl">
                    K
                </div>

                <div>
                    <h1 class="font-bold text-2xl text-gray-800">
                        SISMA KOPDES
                    </h1>

                    <p class="text-sm text-gray-500">
                        Desa Merah Putih
                    </p>
                </div>

            </a>

            <!-- Desktop Menu -->
            <ul class="hidden lg:flex items-center gap-8 font-medium text-gray-700">

                <li><a href="#" class="hover:text-red-700">Beranda</a></li>
                <li><a href="#tentang" class="hover:text-red-700">Tentang</a></li>
                <li><a href="#layanan" class="hover:text-red-700">Layanan</a></li>
                <li><a href="#produk" class="hover:text-red-700">Produk</a></li>
                <li><a href="#kontak" class="hover:text-red-700">Kontak</a></li>

            </ul>

            <!-- Desktop Button -->
            <div class="hidden lg:flex items-center">

                <a href="/login"
                    class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-xl font-semibold transition">

                    Login

                </a>

            </div>

            <!-- Mobile Button -->
            <button
                @click="open = !open"
                class="lg:hidden text-3xl text-red-700">

                ☰

            </button>

        </div>

        <!-- Mobile Menu -->

        <div
            x-show="open"
            x-transition
            class="lg:hidden bg-white border-t">

            <a href="#" class="block px-6 py-4 hover:bg-gray-100">
                Beranda
            </a>

            <a href="#tentang" class="block px-6 py-4 hover:bg-gray-100">
                Tentang
            </a>

            <a href="#layanan" class="block px-6 py-4 hover:bg-gray-100">
                Layanan
            </a>

            <a href="#produk" class="block px-6 py-4 hover:bg-gray-100">
                Produk
            </a>

            <a href="#kontak" class="block px-6 py-4 hover:bg-gray-100">
                Kontak
            </a>

            <a href="/login"
                class="block px-6 py-4 bg-red-700 text-white">

                Login

            </a>

        </div>

    </div>

</nav>