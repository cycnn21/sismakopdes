@extends('layouts.app')

@section('title', 'Login')

@section('content')

<section class="min-h-screen bg-gray-100 flex items-center justify-center pt-28 pb-16">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-md p-10">

        <div class="text-center">

            <div class="w-20 h-20 mx-auto bg-red-700 rounded-2xl flex items-center justify-center text-white text-3xl font-bold">
                K
            </div>

            <h1 class="text-3xl font-bold mt-6">
                Login
            </h1>

            <p class="text-gray-500 mt-2">
                Sistem Manajemen Koperasi Desa
            </p>

        </div>

        @if ($errors->any())

            <div class="bg-red-100 text-red-700 p-3 rounded-lg mt-6">
                {{ $errors->first() }}
            </div>

        @endif

        <form action="{{ route('login.authenticate') }}" method="POST" class="mt-8">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-600"
                    placeholder="Masukkan Email"
                    required>

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-600"
                    placeholder="Masukkan Password"
                    required>

            </div>

            <button
                class="w-full bg-red-700 hover:bg-red-800 text-white py-3 rounded-xl font-semibold transition">

                Login

            </button>

        </form>

        <div class="text-center mt-6">

            <a href="/"
                class="text-red-700 hover:underline">

                ← Kembali ke Beranda

            </a>

        </div>

    </div>

</section>

@endsection