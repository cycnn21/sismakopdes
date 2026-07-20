@extends('layouts.user-dashboard')

@section('title', 'Detail Barang')

@section('content')

<div class="mb-8">

    <a href="{{ route('user.katalog.index') }}"
        class="inline-flex items-center gap-2 text-red-700 hover:text-red-800 font-semibold">

        ← Kembali ke Katalog

    </a>

</div>

<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    <div class="grid lg:grid-cols-2 gap-10 p-10">

        {{-- Gambar Barang --}}
        <div>

            @if($barang->gambar)

            <img
                src="{{ asset('storage/'.$barang->gambar) }}"
                alt="{{ $barang->nama_barang }}"
                class="w-full h-[450px] object-cover rounded-2xl border">

            @else

            <div class="w-full h-[450px] rounded-2xl bg-gray-100 flex items-center justify-center text-8xl">

                📦

            </div>

            @endif

        </div>

        {{-- Informasi Barang --}}
        <div>

            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">

                {{ $barang->kategori->nama_kategori }}

            </span>

            <h1 class="text-4xl font-bold mt-5">

                {{ $barang->nama_barang }}

            </h1>

            <div class="mt-6 space-y-4">

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Kode Barang
                    </span>

                    <span class="font-semibold">

                        {{ $barang->kode_barang }}

                    </span>

                </div>

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">

                        Supplier

                    </span>

                    <span class="font-semibold">

                        {{ $barang->supplier->nama_supplier }}

                    </span>

                </div>

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">

                        Stok

                    </span>

                    <span class="font-semibold">

                        {{ $barang->stok }}
                        {{ $barang->satuan }}

                    </span>

                </div>

            </div>

            <div class="mt-8">

                <h2 class="text-red-700 text-4xl font-bold">

                    Rp {{ number_format($barang->harga_jual,0,',','.') }}

                </h2>

            </div>

            <div class="mt-8">

                <h3 class="font-bold text-lg mb-3">

                    Deskripsi Barang

                </h3>

                <p class="text-gray-600 leading-8">

                    {{ $barang->deskripsi ?: 'Belum ada deskripsi barang.' }}

                </p>

            </div>

            <form
                action="{{ route('user.keranjang.store') }}"
                method="POST"
                class="mt-10">

                @csrf

                <input
                    type="hidden"
                    name="barang_id"
                    value="{{ $barang->id }}">

                <label class="font-semibold block mb-3">
                    Jumlah
                </label>

                <div class="flex items-center gap-3">

                    <button
                        type="button"
                        onclick="kurang()"
                        class="w-12 h-12 rounded-xl bg-gray-200 hover:bg-gray-300">

                        -

                    </button>

                    <input
                        id="jumlah"
                        name="jumlah"
                        type="number"
                        value="1"
                        min="1"
                        max="{{ $barang->stok }}"
                        class="w-24 text-center border rounded-xl py-3">

                    <button
                        type="button"
                        onclick="tambah()"
                        class="w-12 h-12 rounded-xl bg-gray-200 hover:bg-gray-300">

                        +

                    </button>

                </div>

                <button
                    type="submit"
                    class="w-full mt-8 bg-red-700 hover:bg-red-800 text-white py-4 rounded-2xl text-lg font-semibold">

                    🛒 Tambah ke Keranjang

                </button>

            </form>
            </form>

        </div>

    </div>

</div>

<script>

function tambah(){

    let qty = document.getElementById('jumlah');

    if(parseInt(qty.value) < {{ $barang->stok }}){

        qty.value = parseInt(qty.value) + 1;

    }

}

function kurang(){

    let qty = document.getElementById('jumlah');

    if(parseInt(qty.value) > 1){

        qty.value = parseInt(qty.value) - 1;

    }

}

</script>

@endsection