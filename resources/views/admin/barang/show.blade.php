@extends('layouts.dashboard')

@section('title','Detail Barang')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold">
                Detail Barang
            </h1>

            <p class="text-gray-500 mt-1">
                Informasi lengkap barang.
            </p>

        </div>

        <a href="{{ route('barang.index') }}"
            class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl">

            ← Kembali

        </a>

    </div>


    <div class="bg-white rounded-2xl shadow p-8">

        <div class="grid lg:grid-cols-3 gap-8">

            <div>

                @if($barang->gambar)

                    <img
                        src="{{ asset('storage/'.$barang->gambar) }}"
                        class="rounded-xl w-full h-80 object-cover">

                @else

                    <img
                        src="https://placehold.co/500x500?text=No+Image"
                        class="rounded-xl w-full">

                @endif

            </div>


            <div class="lg:col-span-2">

                <table class="w-full">

                    <tr class="border-b">

                        <td class="py-3 font-semibold w-52">
                            Kode Barang
                        </td>

                        <td>
                            {{ $barang->kode_barang }}
                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="py-3 font-semibold">
                            Nama Barang
                        </td>

                        <td>

                            {{ $barang->nama_barang }}

                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="py-3 font-semibold">

                            Kategori

                        </td>

                        <td>

                            {{ $barang->kategori->nama_kategori }}

                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="py-3 font-semibold">

                            Supplier

                        </td>

                        <td>

                            {{ $barang->supplier->nama_supplier }}

                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="py-3 font-semibold">

                            Harga Beli

                        </td>

                        <td>

                            Rp {{ number_format($barang->harga_beli,0,',','.') }}

                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="py-3 font-semibold">

                            Harga Jual

                        </td>

                        <td>

                            Rp {{ number_format($barang->harga_jual,0,',','.') }}

                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="py-3 font-semibold">

                            Stok

                        </td>

                        <td>

                            {{ $barang->stok }}
                            {{ $barang->satuan }}

                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="py-3 font-semibold">

                            Status

                        </td>

                        <td>

                            @if($barang->status=='aktif')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                    Aktif

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td class="py-3 font-semibold">

                            Deskripsi

                        </td>

                        <td>

                            {{ $barang->deskripsi ?: '-' }}

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection