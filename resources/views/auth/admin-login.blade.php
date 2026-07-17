@extends('layouts.auth')

@section('title','Login Admin')

@section('content')

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-3xl p-10 w-full max-w-md">

        <h1 class="text-3xl font-bold text-center text-red-700">
            Login Administrator
        </h1>

        <p class="text-center text-gray-500 mt-2">
            Silakan login sebagai Administrator.
        </p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded-lg mt-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg mt-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('authenticate.admin') }}" class="mt-8">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-medium">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan Email"
                    class="w-full border rounded-xl p-3"
                    required>

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-medium">
                    Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan Password"
                        class="w-full border rounded-xl p-3 pr-12"
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

            <button
                type="submit"
                class="w-full bg-red-700 hover:bg-red-800 text-white rounded-xl py-3 transition">

                Login Admin

            </button>

        </form>

        <div class="mt-8 text-center">

            <a href="{{ route('login.user') }}"
                class="text-gray-500 hover:text-red-700">

                Login sebagai User

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