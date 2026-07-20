@extends('layouts.dashboard')

@section('title', 'Data Barang')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">
            Data Barang
        </h1>

        <p class="text-gray-500 mt-1">
            Kelola seluruh data barang koperasi.
        </p>

    </div>

    <a href="{{ route('barang.create') }}"
        class="bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">

        + Tambah Barang

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

<form method="GET"
    action="{{ route('barang.index') }}"
    class="mb-5">

    <input
        type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Cari nama atau kode barang..."
        class="w-full border rounded-lg p-3">

</form>

<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4">No</th>
<th>Foto</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Kategori</th>
<th>Supplier</th>
<th>Stok</th>
<th>Harga Jual</th>
<th>Status</th>
<th class="text-center">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($barangs as $barang)

<tr class="border-t">

<td class="p-4">

{{ $barangs->firstItem()+$loop->index }}

</td>

<td>

@if($barang->gambar)

<img
src="{{ asset('storage/'.$barang->gambar) }}"
class="w-14 h-14 rounded object-cover">

@else

<div class="w-14 h-14 bg-gray-200 rounded flex items-center justify-center">

📦

</div>

@endif

</td>

<td>

{{ $barang->kode_barang }}

</td>

<td>

{{ $barang->nama_barang }}

</td>

<td>

{{ $barang->kategori->nama_kategori }}

</td>

<td>

{{ $barang->supplier->nama_supplier }}

</td>

<td>

{{ $barang->stok }}

</td>

<td>

Rp {{ number_format($barang->harga_jual,0,',','.') }}

</td>

<td>

@if($barang->status=='aktif')

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

Aktif

</span>

@else

<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

Nonaktif

</span>

@endif

</td>

<td>

<div class="flex justify-center gap-2">
    <a href="{{ route('barang.show',$barang) }}"
    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">

    Detail

</a>

<a
href="{{ route('barang.edit',$barang->id) }}"
class="bg-yellow-500 text-white px-3 py-2 rounded">

Edit

</a>

<form
action="{{ route('barang.destroy',$barang->id) }}"
method="POST">

@csrf
@method('DELETE')

<button
onclick="return confirm('Hapus barang ini?')"
class="bg-red-700 text-white px-3 py-2 rounded">

Hapus

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="10"
class="text-center py-10 text-gray-500">

Belum ada data barang.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-5">

{{ $barangs->links() }}

</div>

@endsection