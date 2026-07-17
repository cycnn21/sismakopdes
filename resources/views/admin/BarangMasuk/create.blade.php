@extends('layouts.dashboard')

@section('title', 'Tambah Barang Masuk')

@section('content')

<div class="mb-6">

    <h1 class="text-3xl font-bold">
        Tambah Barang Masuk
    </h1>

    <p class="text-gray-500 mt-1">
        Input transaksi barang masuk koperasi.
    </p>

</div>



@if($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-5">

<ul class="list-disc ml-5">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif





<div class="bg-white rounded-xl shadow p-6">


<form action="{{ route('barang-masuk.store') }}" method="POST">

@csrf



<div class="grid grid-cols-1 md:grid-cols-2 gap-5">



<!-- Barang -->

<div>

<label class="block font-semibold mb-2">

Barang

</label>


<select name="barang_id"
class="w-full border rounded-lg p-3"
required>


<option value="">
-- Pilih Barang --
</option>


@foreach($barangs as $barang)


<option value="{{ $barang->id }}">

{{ $barang->kode_barang }} - {{ $barang->nama_barang }}

(Stok: {{ $barang->stok }})

</option>


@endforeach


</select>

</div>





<!-- Supplier -->

<div>

<label class="block font-semibold mb-2">

Supplier

</label>


<select name="supplier_id"
class="w-full border rounded-lg p-3"
required>


<option value="">
-- Pilih Supplier --
</option>


@foreach($suppliers as $supplier)


<option value="{{ $supplier->id }}">

{{ $supplier->nama_supplier }}

</option>


@endforeach


</select>

</div>






<!-- Jumlah -->

<div>

<label class="block font-semibold mb-2">

Jumlah Masuk

</label>


<input type="number"
name="jumlah"
min="1"
class="w-full border rounded-lg p-3"
placeholder="Jumlah barang masuk"
required>


</div>






<!-- Harga Beli -->

<div>

<label class="block font-semibold mb-2">

Harga Beli

</label>


<input type="number"
name="harga_beli"
min="0"
class="w-full border rounded-lg p-3"
placeholder="Harga beli satuan"
required>


</div>






<!-- Tanggal -->

<div>

<label class="block font-semibold mb-2">

Tanggal Masuk

</label>


<input type="date"
name="tanggal_masuk"
value="{{ date('Y-m-d') }}"
class="w-full border rounded-lg p-3"
required>


</div>





<!-- Keterangan -->

<div>

<label class="block font-semibold mb-2">

Keterangan

</label>


<input type="text"
name="keterangan"
class="w-full border rounded-lg p-3"
placeholder="Opsional">


</div>



</div>





<div class="flex gap-3 mt-6">


<a href="{{ route('barang-masuk.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg">

Kembali

</a>



<button type="submit"
class="bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">

Simpan Barang Masuk

</button>



</div>



</form>


</div>


@endsection