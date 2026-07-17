@extends('layouts.dashboard')

@section('title', 'Edit Barang Keluar')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">
                Edit Barang Keluar
            </h1>

            <p class="text-gray-500 mt-1">
                Perbarui data transaksi barang keluar.
            </p>

        </div>

        <a href="{{ route('barang-keluar.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg">

            ← Kembali

        </a>

    </div>



    @if ($errors->any())

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">

        <ul class="list-disc ml-5">

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif



    <div class="bg-white rounded-xl shadow p-8">

        <form
            action="{{ route('barang-keluar.update', $barangKeluar->id) }}"
            method="POST">

            @csrf
            @method('PUT')



            {{-- Barang --}}

            <div class="mb-5">

                <label class="block font-semibold mb-2">

                    Barang

                </label>

                <select
                    name="barang_id"
                    class="w-full border rounded-lg px-4 py-3">

                    @foreach($barangs as $barang)

                    <option
                        value="{{ $barang->id }}"
                        {{ old('barang_id',$barangKeluar->barang_id)==$barang->id ? 'selected' : '' }}>

                        {{ $barang->kode_barang }}
                        -
                        {{ $barang->nama_barang }}
                        (Stok : {{ $barang->stok }} {{ $barang->satuan }})

                    </option>

                    @endforeach

                </select>

            </div>



            {{-- Jumlah --}}

            <div class="mb-5">

                <label class="block font-semibold mb-2">

                    Jumlah Keluar

                </label>

                <input
                    type="number"
                    name="jumlah"
                    min="1"
                    value="{{ old('jumlah',$barangKeluar->jumlah) }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>



            {{-- Tanggal --}}

            <div class="mb-5">

                <label class="block font-semibold mb-2">

                    Tanggal Keluar

                </label>

                <input
                    type="date"
                    name="tanggal_keluar"
                    value="{{ old('tanggal_keluar',$barangKeluar->tanggal_keluar) }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>



            {{-- Tujuan --}}

            <div class="mb-5">

                <label class="block font-semibold mb-2">

                    Tujuan

                </label>

                <input
                    type="text"
                    name="tujuan"
                    value="{{ old('tujuan',$barangKeluar->tujuan) }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>



            {{-- Keterangan --}}

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Keterangan

                </label>

                <textarea
                    name="keterangan"
                    rows="4"
                    class="w-full border rounded-lg px-4 py-3">{{ old('keterangan',$barangKeluar->keterangan) }}</textarea>

            </div>



            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-lg">

                    Simpan Perubahan

                </button>

                <a
                    href="{{ route('barang-keluar.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection