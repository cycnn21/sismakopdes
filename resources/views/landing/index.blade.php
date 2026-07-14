@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<section class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-6 py-24">

        <div class="grid lg:grid-cols-2 gap-20 items-center">

            <!-- Kiri -->

            <div>

                <span
                    class="bg-red-100 text-red-700 px-5 py-2 rounded-full font-semibold">

                    Sistem Informasi Koperasi

                </span>

                <h1 class="mt-8 text-6xl font-black leading-tight">

                    Kelola

                    <span class="text-red-700">

                        Koperasi Desa

                    </span>

                    Lebih Mudah

                </h1>

                <p class="mt-8 text-gray-600 text-lg leading-8">

                    Sistem Manajemen Koperasi Desa Merah Putih
                    membantu pengurus dalam mengelola inventaris,
                    supplier, transaksi penjualan,
                    dan laporan secara digital.

                </p>

                <div class="flex gap-5 mt-10">

                    <a href="#"class="btn-primary">

                        Mulai Sekarang

                    </a>

                    <a href="#tentang" class="btn-secondary">

                        Pelajari

                    </a>

                </div>

            </div>

            <!-- Kanan -->

            <div>

                <img
                    src="https://placehold.co/650x450/F8FAFC/C62828?text=Dashboard+SISMA+KOPDES"
                    class="rounded-3xl shadow-xl">

            </div>

        </div>

    </div>

</section>
<!-- Tentang -->

<section id="tentang" class="py-28 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center">

            <span class="section-subtitle">
                Tentang Sistem
            </span>

            <h2 class="section-title mt-3">

                Solusi Digital untuk
                Koperasi Desa Merah Putih

            </h2>

            <p class="mt-6 text-gray-600 max-w-3xl mx-auto leading-8">

                Sistem ini dirancang untuk membantu pengurus koperasi
                dalam mengelola data barang, supplier,
                transaksi penjualan, dan laporan
                dengan lebih cepat, akurat,
                dan efisien.

            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-20">

            <!-- Card 1 -->

            <div class="card">

                <div class="text-5xl">

                    📦

                </div>

                <h3 class="mt-6 text-xl font-bold">

                    Manajemen Barang

                </h3>

                <p class="mt-3 text-gray-600">

                    Kelola stok dan data barang secara terpusat.

                </p>

            </div>

            <!-- Card 2 -->

            <div class="card">

                <div class="text-5xl">

                    🚚

                </div>

                <h3 class="mt-6 text-xl font-bold">

                    Supplier

                </h3>

                <p class="mt-3 text-gray-600">

                    Mengelola data supplier dengan mudah.

                </p>

            </div>

            <!-- Card 3 -->

            <div class="card">

                <div class="text-5xl">

                    💳

                </div>

                <h3 class="mt-6 text-xl font-bold">

                    Penjualan

                </h3>

                <p class="mt-3 text-gray-600">

                    Pencatatan transaksi penjualan secara digital.

                </p>

            </div>

            <!-- Card 4 -->

            <div class="card">

                <div class="text-5xl">

                    📈

                </div>

                <h3 class="mt-6 text-xl font-bold">

                    Laporan

                </h3>

                <p class="mt-3 text-gray-600">

                    Menampilkan laporan transaksi dan stok secara otomatis.

                </p>

            </div>

        </div>

    </div>

</section>
<section id="layanan" class="py-28 bg-gray-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center">

            <span class="section-subtitle">
                Fitur Utama
            </span>

            <h2 class="section-title mt-3">
                Semua Kebutuhan Koperasi Dalam Satu Sistem
            </h2>

            <p class="mt-5 text-gray-600 max-w-2xl mx-auto">
                Kelola seluruh aktivitas koperasi dengan mudah melalui fitur-fitur yang terintegrasi.
            </p>

        </div>

        <div class="grid lg:grid-cols-3 gap-8 mt-16">

            <div class="card">
                <div class="text-5xl">📦</div>
                <h3 class="mt-6 text-xl font-bold">Inventaris Barang</h3>
                <p class="mt-3 text-gray-600">
                    Mengelola stok barang, kategori, dan satuan secara terstruktur.
                </p>
            </div>

            <div class="card">
                <div class="text-5xl">🧾</div>
                <h3 class="mt-6 text-xl font-bold">Transaksi Penjualan</h3>
                <p class="mt-3 text-gray-600">
                    Mencatat transaksi penjualan dengan cepat dan akurat.
                </p>
            </div>

            <div class="card">
                <div class="text-5xl">📊</div>
                <h3 class="mt-6 text-xl font-bold">Laporan</h3>
                <p class="mt-3 text-gray-600">
                    Menampilkan laporan stok dan penjualan secara otomatis.
                </p>
            </div>

        </div>

    </div>

</section>

@endsection