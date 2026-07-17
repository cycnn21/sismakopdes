<aside class="w-72 bg-red-700 text-white flex flex-col min-h-screen">

    <!-- Logo -->
    <div class="h-20 flex items-center justify-center border-b border-red-600">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-xl bg-white text-red-700 flex items-center justify-center font-bold text-xl">
                K
            </div>

            <div>

                <h1 class="font-bold text-xl">
                    SISMA KOPDES
                </h1>

                <p class="text-red-200 text-sm">
                    Desa Merah Putih
                </p>

            </div>

        </div>

    </div>

    <!-- Menu -->

    <nav class="flex-1 mt-6 px-4">

        <p class="text-red-200 text-xs uppercase mb-2 px-3">
            Dashboard
        </p>

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 transition
            {{ request()->routeIs('admin.dashboard') ? 'bg-red-900' : 'hover:bg-red-800' }}">

            📊
            <span>Dashboard</span>

        </a>


        <p class="text-red-200 text-xs uppercase mt-6 mb-2 px-3">
            Master Data
        </p>

        <a href="{{ route('kategori.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 transition
            {{ request()->routeIs('kategori.*') ? 'bg-red-900' : 'hover:bg-red-800' }}">

            🏷️
            <span>Kategori Barang</span>

        </a>

        <a href="{{ route('supplier.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 transition
            {{ request()->routeIs('supplier.*') ? 'bg-red-900' : 'hover:bg-red-800' }}">

            🚚
            <span>Supplier</span>

        </a>

        <a href="{{ route('barang.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 transition
    {{ request()->routeIs('barang.*') ? 'bg-red-900' : 'hover:bg-red-800' }}">

            📦
            <span>Barang</span>

        </a>


        <p class="text-red-200 text-xs uppercase mt-6 mb-2 px-3">
            Transaksi
        </p>

        <a href="{{ route('barang-masuk.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 transition
    {{ request()->routeIs('barang-masuk.*') ? 'bg-red-900' : 'hover:bg-red-800' }}">

            📥
            <span>Barang Masuk</span>

        </a>

        <a href="{{ route('barang-keluar.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 transition
    {{ request()->routeIs('barang-keluar.*') ? 'bg-red-900' : 'hover:bg-red-800' }}">

            📤
            <span>Barang Keluar</span>

        </a>

        <a href="#"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 hover:bg-red-800 transition">

            🧾
            <span>Penjualan</span>

        </a>


        <p class="text-red-200 text-xs uppercase mt-6 mb-2 px-3">
            Laporan
        </p>

        <a href="#"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 hover:bg-red-800 transition">

            📈
            <span>Laporan</span>

        </a>


        @if(Auth::user()->role == 'admin')

        <p class="text-red-200 text-xs uppercase mt-6 mb-2 px-3">
            Pengaturan
        </p>

        <a href="#"
            class="flex items-center gap-3 px-5 py-3 rounded-xl mb-2 hover:bg-red-800 transition">

            👥
            <span>Manajemen User</span>

        </a>

        @endif

    </nav>

    <!-- Footer -->

    <div class="border-t border-red-600 p-5">

        <div class="text-sm text-red-200">
            Login sebagai
        </div>

        <div class="font-semibold">
            {{ Auth::user()->name }}
        </div>

        <div class="capitalize text-red-200">
            {{ Auth::user()->role }}
        </div>

    </div>

</aside>