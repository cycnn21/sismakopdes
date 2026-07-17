@extends('layouts.dashboard')

@section('title', 'Tambah Barang Keluar')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">
                Tambah Barang Keluar
            </h1>

            <p class="text-gray-500 mt-1">
                Input transaksi barang keluar koperasi.
            </p>

        </div>

        <a href="{{ route('barang-keluar.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg">

            ← Kembali

        </a>

    </div>


    <div class="bg-white rounded-xl shadow p-8">

        <form
            action="{{ route('barang-keluar.store') }}"
            method="POST">

            @csrf


            <div class="grid md:grid-cols-2 gap-6">


                {{-- Barang --}}
                <div>

                    <label class="font-semibold">
                        Barang
                    </label>

                    <select
                        name="barang_id"
                        class="w-full border rounded-lg p-3 mt-2"
                        required>

                        <option value="">
                            -- Pilih Barang --
                        </option>

                        @foreach($barangs as $barang)

                        <option
                            value="{{ $barang->id }}"
                            {{ old('barang_id')==$barang->id ? 'selected' : '' }}>

                            {{ $barang->nama_barang }}
                            (Stok : {{ $barang->stok }} {{ $barang->satuan }})

                        </option>

                        @endforeach

                    </select>

                    @error('barang_id')
                    <small class="text-red-600">
                        {{ $message }}
                    </small>
                    @enderror

                </div>



                {{-- Jumlah --}}
                <div>

                    <label class="font-semibold">
                        Jumlah Keluar
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        value="{{ old('jumlah') }}"
                        min="1"
                        class="w-full border rounded-lg p-3 mt-2"
                        required>

                    @error('jumlah')
                    <small class="text-red-600">
                        {{ $message }}
                    </small>
                    @enderror

                </div>



                {{-- Tanggal --}}
                <div>

                    <label class="font-semibold">
                        Tanggal Keluar
                    </label>

                    <input
                        type="date"
                        name="tanggal_keluar"
                        value="{{ old('tanggal_keluar',date('Y-m-d')) }}"
                        class="w-full border rounded-lg p-3 mt-2"
                        required>

                    @error('tanggal_keluar')
                    <small class="text-red-600">
                        {{ $message }}
                    </small>
                    @enderror

                </div>



                {{-- Tujuan --}}
                <div>

                    <label class="font-semibold">
                        Tujuan
                    </label>

                    <input
                        type="text"
                        name="tujuan"
                        value="{{ old('tujuan') }}"
                        placeholder="Contoh : Penjualan"
                        class="w-full border rounded-lg p-3 mt-2">

                </div>


            </div>



            {{-- Keterangan --}}
            <div class="mt-6">

                <label class="font-semibold">
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    rows="4"
                    class="w-full border rounded-lg p-3 mt-2">{{ old('keterangan') }}</textarea>

            </div>



            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('barang-keluar.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                    Batal

                </a>

                <button
                    type="submit"
                    class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-lg">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection