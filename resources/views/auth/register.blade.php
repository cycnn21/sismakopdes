@extends('layouts.auth')

@section('title', 'Daftar Akun')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">

        <h1 class="text-3xl font-bold text-center text-red-700">
            Daftar Akun
        </h1>

        <p class="text-gray-500 text-center mt-2 mb-8">
            Buat akun untuk mengakses SISMA KOPDES
        </p>

        @if ($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg mb-5">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-lg p-3"
                    required>

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-lg p-3"
                    required>

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full border rounded-lg p-3 pr-12"
                        required>

                    <button
                        type="button"
                        onclick="togglePassword('password', this)"
                        class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-500 hover:text-red-700">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            width="22"
                            height="22">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z"/>

                            <circle cx="12" cy="12" r="3"/>

                        </svg>

                    </button>

                </div>

            </div>

            <div class="mb-7">

                <label class="block mb-2 font-semibold">
                    Konfirmasi Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full border rounded-lg p-3 pr-12"
                        required>

                    <button
                        type="button"
                        onclick="togglePassword('password_confirmation', this)"
                        class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-500 hover:text-red-700">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            width="22"
                            height="22">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z"/>

                            <circle cx="12" cy="12" r="3"/>

                        </svg>

                    </button>

                </div>

            </div>

            <button
                type="submit"
                class="w-full bg-red-700 hover:bg-red-800 text-white py-3 rounded-lg transition">

                Daftar

            </button>

        </form>

        <div class="text-center mt-6">

            Sudah punya akun?

            <a href="{{ route('login.user') }}"
                class="text-red-700 font-semibold hover:underline">

                Login

            </a>

        </div>

    </div>

</div>

<style>

button svg{
    width:22px;
    height:22px;
}

</style>

<script>

function eyeOpen()
{
    return `
    <svg xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="2"
        stroke="currentColor"
        width="22"
        height="22">

        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z"/>

        <circle cx="12" cy="12" r="3"/>

    </svg>`;
}

function eyeClose()
{
    return `
    <svg xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="2"
        stroke="currentColor"
        width="22"
        height="22">

        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M3 3l18 18"/>

        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M10.58 10.58A3 3 0 0013.42 13.42"/>

        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M9.88 5.09A11.3 11.3 0 0112 4.88c6 0 9.75 7.12 9.75 7.12a13.5 13.5 0 01-3.04 3.98"/>

        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M6.17 6.17A13.3 13.3 0 002.25 12S6 19.12 12 19.12c1.72 0 3.29-.37 4.71-1.03"/>

    </svg>`;
}

function togglePassword(id, button)
{
    const input = document.getElementById(id);

    if (input.type === 'password') {

        input.type = 'text';
        button.innerHTML = eyeClose();

    } else {

        input.type = 'password';
        button.innerHTML = eyeOpen();

    }
}

</script>

@endsection