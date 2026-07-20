@extends('layouts.user-dashboard')

@section('title', 'Checkout')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold">
        Checkout
    </h1>

    <p class="text-gray-500 mt-1">
        Lengkapi data penerima sebelum membuat pesanan.
    </p>

</div>


@if(session('error'))

<div class="bg-red-100 border border-red-300 text-red-700 rounded-xl px-4 py-3 mb-6">

    {{ session('error') }}

</div>

@endif


@if($errors->any())

<div class="bg-red-100 border border-red-300 text-red-700 rounded-xl px-4 py-3 mb-6">

    {{ $errors->first() }}

</div>

@endif


<form
    action="{{ route('user.checkout.store') }}"
    method="POST">

    @csrf

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- ========================= --}}
        {{-- Data Penerima --}}
        {{-- ========================= --}}

        <div class="lg:col-span-2">

            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-2xl font-bold mb-6">

                    Data Penerima

                </h2>

                <div class="space-y-5">

                    <div>

                        <label class="block mb-2 font-semibold">

                            Nama Penerima

                        </label>

                        <input
                            type="text"
                            name="nama_penerima"
                            value="{{ old('nama_penerima', auth()->user()->name) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Nomor Telepon

                        </label>

                        <input
                            type="text"
                            name="telepon"
                            value="{{ old('telepon') }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Alamat Lengkap

                        </label>

                        <textarea
                            name="alamat"
                            rows="5"
                            class="w-full border rounded-xl px-4 py-3">{{ old('alamat') }}</textarea>

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Catatan

                        </label>

                        <textarea
                            name="catatan"
                            rows="3"
                            class="w-full border rounded-xl px-4 py-3">{{ old('catatan') }}</textarea>

                    </div>

                </div>

            </div>

        </div>

        {{-- ========================= --}}
        {{-- Ringkasan Pesanan --}}
        {{-- ========================= --}}

        <div>

            <div class="bg-white rounded-2xl shadow p-6 sticky top-6">

                <h2 class="text-2xl font-bold mb-5">

                    Ringkasan Pesanan

                </h2>

                <div class="space-y-5">

                    @foreach($keranjangs as $item)

                    <div class="flex justify-between">

                        <div>

                            <div class="font-semibold">

                                {{ $item->barang->nama_barang }}

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ $item->jumlah }} x
                                Rp {{ number_format($item->harga,0,',','.') }}

                            </div>

                        </div>

                        <div class="font-bold">

                            Rp {{ number_format($item->subtotal,0,',','.') }}

                        </div>

                    </div>

                    @endforeach

                </div>

                <hr class="my-6">

                <div class="flex justify-between text-xl font-bold">

                    <span>Total</span>

                    <span class="text-red-700">

                        Rp {{ number_format($total,0,',','.') }}

                    </span>

                </div>

                <button
                    type="submit"
                    class="w-full mt-8 bg-red-700 hover:bg-red-800 text-white py-4 rounded-xl font-semibold">

                    Buat Pesanan

                </button>

            </div>

        </div>

    </div>

</form>

@endsection