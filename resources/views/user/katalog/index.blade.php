@extends('layouts.user-dashboard')

@section('title', 'Katalog Barang')

@section('content')

<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Katalog Barang
        </h1>

        <p class="text-gray-500 mt-1">
            Pilih barang yang ingin Anda beli.
        </p>

    </div>

</div>

<form
    action="{{ route('user.katalog.index') }}"
    method="GET"
    class="mb-8">

    <div class="flex gap-3">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama barang..."
            class="flex-1 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-600 focus:outline-none">

        <button
            class="bg-red-700 hover:bg-red-800 text-white px-6 rounded-xl">

            Cari

        </button>

        @if(request('search'))

        <a
            href="{{ route('user.katalog.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

            Reset

        </a>

        @endif

    </div>

</form>


@if($barangs->count())

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

@foreach($barangs as $barang)

<div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

    @if($barang->gambar)

    <img
        src="{{ asset('storage/'.$barang->gambar) }}"
        class="w-full h-52 object-cover">

    @else

    <div class="h-52 bg-gray-200 flex items-center justify-center text-6xl">

        📦

    </div>

    @endif

    <div class="p-5">

        <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs mb-3">

            {{ $barang->kategori->nama_kategori }}

        </span>

        <h2 class="font-bold text-lg">

            {{ $barang->nama_barang }}

        </h2>

        <p class="text-red-700 font-bold text-xl mt-3">

            Rp {{ number_format($barang->harga_jual,0,',','.') }}

        </p>

        <div class="mt-3">

            <span class="text-gray-500">

                Stok :

            </span>

            <span class="font-semibold">

                {{ $barang->stok }}
                {{ $barang->satuan }}

            </span>

        </div>

        <div class="mt-3">

            @if($barang->stok > $barang->stok_minimum)

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                Tersedia

            </span>

            @else

            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                Stok Terbatas

            </span>

            @endif

        </div>

        <a
            href="{{ route('user.katalog.show',$barang->id) }}"
            class="block text-center bg-red-700 hover:bg-red-800 text-white py-3 rounded-xl mt-5">

            Lihat Detail

        </a>

    </div>

</div>

@endforeach

</div>

<div class="mt-8">

    {{ $barangs->links() }}

</div>

@else

<div class="bg-white rounded-2xl shadow p-12 text-center">

    <div class="text-6xl">

        📦

    </div>

    <h2 class="text-2xl font-bold mt-4">

        Barang Tidak Ditemukan

    </h2>

    <p class="text-gray-500 mt-2">

        Tidak ada barang yang sesuai dengan pencarian Anda.

    </p>

</div>

@endif

@endsection