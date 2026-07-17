@extends('layouts.dashboard')

@section('title', 'Tambah Supplier')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold">
            Tambah Supplier
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan data supplier baru ke dalam sistem.
        </p>

    </div>

    <form action="{{ route('supplier.store') }}"
        method="POST"
        class="bg-white rounded-xl shadow-lg p-8 space-y-6">

        @csrf

        <!-- Nama Supplier -->

        <div>

            <label class="font-medium">
                Nama Supplier <span class="text-red-600">*</span>
            </label>

            <input
                type="text"
                name="nama_supplier"
                value="{{ old('nama_supplier') }}"
                class="w-full mt-2 p-3 border rounded-lg
                @error('nama_supplier') border-red-500 @else border-gray-300 @enderror">

            @error('nama_supplier')

                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Alamat -->

        <div>

            <label class="font-medium">
                Alamat
            </label>

            <textarea
                name="alamat"
                rows="4"
                class="w-full mt-2 p-3 border rounded-lg
                @error('alamat') border-red-500 @else border-gray-300 @enderror">{{ old('alamat') }}</textarea>

            @error('alamat')

                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Telepon -->

        <div>

            <label class="font-medium">
                Nomor Telepon <span class="text-red-600">*</span>
            </label>

            <input
                type="text"
                name="telepon"
                value="{{ old('telepon') }}"
                class="w-full mt-2 p-3 border rounded-lg
                @error('telepon') border-red-500 @else border-gray-300 @enderror">

            @error('telepon')

                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Email -->

        <div>

            <label class="font-medium">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full mt-2 p-3 border rounded-lg
                @error('email') border-red-500 @else border-gray-300 @enderror">

            @error('email')

                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Tombol -->

        <div class="flex gap-3 pt-4">

            <button
                type="submit"
                class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-lg">

                Simpan Supplier

            </button>

            <a href="{{ route('supplier.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection