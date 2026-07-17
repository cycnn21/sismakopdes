@extends('layouts.dashboard')

@section('title', 'Detail Barang Keluar')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold">
                Detail Barang Keluar
            </h1>

            <p class="text-gray-500">
                Informasi transaksi barang keluar.
            </p>

        </div>

        <a href="{{ route('barang-keluar.index') }}"
            class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-lg">

            ← Kembali

        </a>

    </div>



    <div class="bg-white rounded-xl shadow p-8">

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <p class="text-gray-500">
                    Kode Transaksi
                </p>

                <p class="font-bold text-lg">
                    {{ $barangKeluar->kode_keluar }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Tanggal Keluar
                </p>

                <p class="font-bold">
                    {{ \Carbon\Carbon::parse($barangKeluar->tanggal_keluar)->format('d-m-Y') }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Nama Barang
                </p>

                <p class="font-bold">
                    {{ $barangKeluar->barang->nama_barang }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Tujuan
                </p>

                <p class="font-bold">
                    {{ $barangKeluar->tujuan ?? '-' }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Jumlah Keluar
                </p>

                <p class="font-bold">
                    {{ $barangKeluar->jumlah }}
                    {{ $barangKeluar->barang->satuan }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Stok Barang Saat Ini
                </p>

                <p class="font-bold">
                    {{ $barangKeluar->barang->stok }}
                    {{ $barangKeluar->barang->satuan }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Harga Jual Barang
                </p>

                <p class="font-bold">
                    Rp {{ number_format($barangKeluar->barang->harga_jual,0,',','.') }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Total Nilai Barang
                </p>

                <p class="font-bold">
                    Rp {{ number_format(
                        $barangKeluar->barang->harga_jual * $barangKeluar->jumlah,
                        0,
                        ',',
                        '.'
                    ) }}
                </p>

            </div>



            <div>

                <p class="text-gray-500">
                    Diinput Oleh
                </p>

                <p class="font-bold">
                    {{ $barangKeluar->user->name }}
                </p>

            </div>

        </div>



        <hr class="my-6">



        <div>

            <p class="text-gray-500">
                Keterangan
            </p>

            <p class="mt-2">
                {{ $barangKeluar->keterangan ?? '-' }}
            </p>

        </div>

    </div>

</div>

@endsection