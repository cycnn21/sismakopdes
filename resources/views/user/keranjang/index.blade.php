@extends('layouts.user-dashboard')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Keranjang Belanja
        </h1>

        <p class="text-gray-500 mt-1">
            Daftar barang yang akan Anda beli.
        </p>

    </div>

</div>


@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-5">

    {{ session('success') }}

</div>

@endif


@if($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-5">

    {{ $errors->first() }}

</div>

@endif


@if($keranjangs->count())

@php

$total = 0;

@endphp


<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-4">Foto</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th class="text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @foreach($keranjangs as $item)

            @php

            $subtotal = $item->harga * $item->jumlah;

            $total += $subtotal;

            @endphp

            <tr class="border-t">

                <td class="p-4">

                    @if($item->barang->gambar)

                    <img
                        src="{{ asset('storage/'.$item->barang->gambar) }}"
                        class="w-20 h-20 rounded-lg object-cover">

                    @else

                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">

                        📦

                    </div>

                    @endif

                </td>

                <td>

                    <div class="font-semibold">

                        {{ $item->barang->nama_barang }}

                    </div>

                    <div class="text-gray-500 text-sm">

                        {{ $item->barang->kategori->nama_kategori }}

                    </div>

                </td>

                <td>

                    Rp {{ number_format($item->harga,0,',','.') }}

                </td>

                <td>

                    <form
                        action="{{ route('user.keranjang.update',$item->id) }}"
                        method="POST"
                        class="flex items-center gap-2">

                        @csrf
                        @method('PUT')

                        <input
                            type="number"
                            name="jumlah"
                            min="1"
                            max="{{ $item->barang->stok }}"
                            value="{{ $item->jumlah }}"
                            class="w-24 border rounded-lg px-3 py-2">

                        <button
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                            Update

                        </button>

                    </form>

                </td>

                <td>

                    Rp {{ number_format($subtotal,0,',','.') }}

                </td>

                <td>

                    <form
                        action="{{ route('user.keranjang.destroy',$item->id) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Hapus barang ini dari keranjang?')"
                            class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>


<div class="bg-white rounded-xl shadow mt-6 p-6">

    <div class="flex justify-between items-center">

        <div>

            <h2 class="text-2xl font-bold">

                Total Belanja

            </h2>

            <p class="text-gray-500">

                {{ $keranjangs->count() }} Barang

            </p>

        </div>

        <div class="text-right">

            <p class="text-3xl font-bold text-red-700">

                Rp {{ number_format($total,0,',','.') }}

            </p>

        </div>

    </div>
    <div class="space-y-2">

        <div class="flex justify-between">

            <span>Total Barang</span>

            <span>{{ $keranjangs->sum('jumlah') }}</span>

        </div>

        <div class="flex justify-between">

            <span>Total Jenis Barang</span>

            <span>{{ $keranjangs->count() }}</span>

        </div>

        <div class="border-t pt-3 flex justify-between">

            <span class="font-bold">

                Total Bayar

            </span>

            <span class="text-2xl font-bold text-red-700">

                Rp {{ number_format($total,0,',','.') }}

            </span>

        </div>

    </div>

    <div class="mt-6 flex justify-end">

        <a
            href="{{ route('user.checkout.index') }}"
            class="bg-red-700 hover:bg-red-800 text-white px-8 py-4 rounded-xl font-semibold">

            Checkout

        </a>

    </div>

</div>

@else

<div class="bg-white rounded-xl shadow p-12 text-center">

    <div class="text-6xl">

        🛒

    </div>

    <h2 class="text-2xl font-bold mt-4">

        Keranjang Masih Kosong

    </h2>

    <p class="text-gray-500 mt-2">

        Silakan pilih barang dari katalog.

    </p>

    <a
        href="{{ route('user.katalog.index') }}"
        class="inline-block mt-6 bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-xl">

        Lihat Katalog

    </a>

</div>

@endif

@endsection