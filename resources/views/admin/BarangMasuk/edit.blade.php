@extends('layouts.dashboard')

@section('title', 'Edit Barang Masuk')

@section('content')

<div class="mb-6">

    <h1 class="text-3xl font-bold">
        Edit Barang Masuk
    </h1>

    <p class="text-gray-500 mt-1">
        Perbarui transaksi barang masuk koperasi.
    </p>

</div>



@if($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-5">

<ul>

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif





<div class="bg-white rounded-xl shadow p-6">


<form method="POST"
action="{{ route('barang-masuk.update',$barangMasuk->id) }}">


@csrf

@method('PUT')





<div class="grid grid-cols-2 gap-5">





<div>

<label class="block mb-2 font-semibold">

Barang

</label>


<select name="barang_id"
class="w-full border rounded-lg p-3">


<option value="">
-- Pilih Barang --
</option>


@foreach($barangs as $barang)


<option value="{{ $barang->id }}"

{{ $barangMasuk->barang_id == $barang->id ? 'selected' : '' }}

>

{{ $barang->nama_barang }}

(Stok : {{ $barang->stok }})

</option>


@endforeach


</select>

</div>







<div>

<label class="block mb-2 font-semibold">

Supplier

</label>


<select name="supplier_id"
class="w-full border rounded-lg p-3">


<option value="">
-- Pilih Supplier --
</option>



@foreach($suppliers as $supplier)


<option value="{{ $supplier->id }}"

{{ $barangMasuk->supplier_id == $supplier->id ? 'selected' : '' }}

>

{{ $supplier->nama_supplier }}

</option>


@endforeach


</select>


</div>








<div>

<label class="block mb-2 font-semibold">

Jumlah Barang

</label>


<input type="number"

name="jumlah"

value="{{ $barangMasuk->jumlah }}"

class="w-full border rounded-lg p-3">


</div>







<div>

<label class="block mb-2 font-semibold">

Harga Beli

</label>


<input type="number"

name="harga_beli"

value="{{ $barangMasuk->harga_beli }}"

class="w-full border rounded-lg p-3">


</div>








<div>

<label class="block mb-2 font-semibold">

Tanggal Masuk

</label>


<input type="date"

name="tanggal_masuk"

value="{{ $barangMasuk->tanggal_masuk }}"

class="w-full border rounded-lg p-3">


</div>







<div>

<label class="block mb-2 font-semibold">

Keterangan

</label>


<textarea

name="keterangan"

rows="3"

class="w-full border rounded-lg p-3">{{ $barangMasuk->keterangan }}</textarea>


</div>



</div>






<div class="mt-6 flex gap-3">


<a href="{{ route('barang-masuk.index') }}"

class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg">

Kembali

</a>




<button

type="submit"

class="bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">

Update Barang Masuk

</button>



</div>



</form>


</div>


@endsection