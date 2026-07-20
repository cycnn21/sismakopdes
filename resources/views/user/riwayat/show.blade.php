@extends('layouts.user-dashboard')

@section('title','Detail Transaksi')

@section('content')

<div class="mb-8">

    <a href="{{ route('user.riwayat.index') }}"
        class="text-red-700 hover:text-red-800 font-semibold">

        ← Kembali ke Riwayat

    </a>

</div>

<div class="bg-white rounded-2xl shadow-lg p-8">

    <div class="flex justify-between items-start">

        <div>

            <h1 class="text-3xl font-bold">

                {{ $transaksi->kode_transaksi }}

            </h1>

            <p class="text-gray-500 mt-2">

                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d F Y') }}

            </p>

        </div>

        <div>

            @if($transaksi->status=='Menunggu')

                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                    Menunggu

                </span>

            @elseif($transaksi->status=='Diproses')

                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                    Diproses

                </span>

            @elseif($transaksi->status=='Selesai')

                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                    Selesai

                </span>

            @else

                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">

                    Dibatalkan

                </span>

            @endif

        </div>

    </div>

    <hr class="my-8">

    <div class="grid md:grid-cols-2 gap-8">

        <div>

            <h3 class="font-bold mb-3">

                Data Penerima

            </h3>

            <p><strong>Nama :</strong> {{ $transaksi->nama_penerima }}</p>

            <p><strong>Telepon :</strong> {{ $transaksi->telepon }}</p>

            <p><strong>Alamat :</strong></p>

            <p class="text-gray-600">

                {{ $transaksi->alamat }}

            </p>

            @if($transaksi->catatan)

            <div class="mt-4">

                <strong>Catatan :</strong>

                <p class="text-gray-600">

                    {{ $transaksi->catatan }}

                </p>

            </div>

            @endif

        </div>

    </div>

    <hr class="my-8">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3">Barang</th>

                <th>Qty</th>

                <th>Harga</th>

                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>

            @foreach($transaksi->detailTransaksis as $detail)

            <tr class="border-t">

                <td class="p-4">

                    {{ $detail->barang->nama_barang }}

                </td>

                <td class="text-center">

                    {{ $detail->qty }}

                </td>

                <td class="text-center">

                    Rp {{ number_format($detail->harga,0,',','.') }}

                </td>

                <td class="text-center font-semibold">

                    Rp {{ number_format($detail->subtotal,0,',','.') }}

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="flex justify-end mt-8">

        <div class="text-right">

            <p class="text-gray-500">

                Total Pembayaran

            </p>

            <h2 class="text-4xl font-bold text-red-700">

                Rp {{ number_format($transaksi->total,0,',','.') }}

            </h2>

        </div>

    </div>

</div>

@endsection