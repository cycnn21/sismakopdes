@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">
                Tambah Kategori Barang
            </h1>

            <p class="text-gray-500 mt-1">
                Tambahkan kategori barang baru.
            </p>
        </div>

        <a href="{{ route('kategori.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg">

            Kembali

        </a>

    </div>

    <div class="bg-white shadow rounded-xl p-8">

        <form action="{{ route('kategori.store') }}" method="POST">

            @csrf

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700">

                @error('nama_kategori')

                    <p class="text-red-600 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    rows="4"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700">{{ old('keterangan') }}</textarea>

            </div>

            <button
                type="submit"
                class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-lg">

                Simpan Kategori

            </button>

        </form>

    </div>

</div>

@endsection