@extends('layouts.dashboard')

@section('title', 'Edit Supplier')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">

                Edit Supplier

            </h1>

            <p class="text-gray-500 mt-1">

                Perbarui data supplier.

            </p>

        </div>

        <a href="{{ route('supplier.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg">

            Kembali

        </a>

    </div>

    <div class="bg-white shadow rounded-xl p-8">

        <form
            action="{{ route('supplier.update', $supplier->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Nama Supplier

                </label>

                <input
                    type="text"
                    name="nama_supplier"
                    value="{{ old('nama_supplier', $supplier->nama_supplier) }}"
                    class="w-full border rounded-lg px-4 py-3">

                @error('nama_supplier')

                    <p class="text-red-600 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Alamat

                </label>

                <textarea
                    name="alamat"
                    rows="4"
                    class="w-full border rounded-lg px-4 py-3">{{ old('alamat', $supplier->alamat) }}</textarea>

                @error('alamat')

                    <p class="text-red-600 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Telepon

                </label>

                <input
                    type="text"
                    name="telepon"
                    value="{{ old('telepon', $supplier->telepon) }}"
                    class="w-full border rounded-lg px-4 py-3">

                @error('telepon')

                    <p class="text-red-600 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $supplier->email) }}"
                    class="w-full border rounded-lg px-4 py-3">

                @error('email')

                    <p class="text-red-600 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <button
                type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg">

                Update Supplier

            </button>

        </form>

    </div>

</div>

@endsection