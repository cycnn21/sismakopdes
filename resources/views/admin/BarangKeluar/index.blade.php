@extends('layouts.dashboard')

@section('title', 'Barang Keluar')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">
            Data Barang Keluar
        </h1>

        <p class="text-gray-500 mt-1">
            Kelola transaksi barang keluar koperasi.
        </p>

    </div>

    <a href="{{ route('barang-keluar.create') }}"
        class="bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">

        + Tambah Barang Keluar

    </a>

</div>


@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg mb-5">

    {{ session('success') }}

</div>

@endif


@if(session('error'))

<div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-5">

    {{ session('error') }}

</div>

@endif


<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4">
No
</th>

<th>
Kode Keluar
</th>

<th>
Tanggal
</th>

<th>
Barang
</th>

<th>
Jumlah
</th>

<th>
Tujuan
</th>

<th>
Input Oleh
</th>

<th class="text-center">
Aksi
</th>

</tr>

</thead>

<tbody>

@forelse($barangKeluars as $keluar)

<tr class="border-t">

<td class="p-4">

{{ $barangKeluars->firstItem() + $loop->index }}

</td>

<td>

{{ $keluar->kode_keluar }}

</td>

<td>

{{ \Carbon\Carbon::parse($keluar->tanggal_keluar)->format('d-m-Y') }}

</td>

<td>

{{ $keluar->barang->nama_barang ?? '-' }}

</td>

<td>

{{ $keluar->jumlah }}

{{ $keluar->barang->satuan ?? '' }}

</td>

<td>

{{ $keluar->tujuan ?? '-' }}

</td>

<td>

{{ $keluar->user->name ?? '-' }}

</td>

<td>

<div class="flex justify-center gap-2">

<a href="{{ route('barang-keluar.show',$keluar->id) }}"
class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

Detail

</a>

<a href="{{ route('barang-keluar.edit',$keluar->id) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

Edit

</a>

<form action="{{ route('barang-keluar.destroy',$keluar->id) }}"
method="POST">

@csrf
@method('DELETE')

<button
onclick="return confirm('Hapus transaksi barang keluar ini? Stok akan dikembalikan.')"
class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">

Hapus

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="8"
class="text-center py-10 text-gray-500">

Belum ada transaksi barang keluar.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="p-5 border-t">

{{ $barangKeluars->links() }}

</div>

</div>

@endsection