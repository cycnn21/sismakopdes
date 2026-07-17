@extends('layouts.dashboard')

@section('title','Detail Barang Masuk')


@section('content')

<div class="space-y-6">


<div class="flex justify-between items-center">


<div>

<h1 class="text-3xl font-bold">
Detail Barang Masuk
</h1>

<p class="text-gray-500">
Informasi transaksi barang masuk.
</p>

</div>



<a href="{{ route('barang-masuk.index') }}"
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
{{ $barangMasuk->kode_masuk }}
</p>

</div>



<div>
<p class="text-gray-500">
Tanggal Masuk
</p>

<p class="font-bold">
{{ $barangMasuk->tanggal_masuk }}
</p>

</div>




<div>
<p class="text-gray-500">
Barang
</p>

<p class="font-bold">
{{ $barangMasuk->barang->nama_barang ?? '-' }}
</p>

</div>




<div>
<p class="text-gray-500">
Supplier
</p>

<p class="font-bold">
{{ $barangMasuk->supplier->nama_supplier ?? '-' }}
</p>

</div>




<div>
<p class="text-gray-500">
Jumlah Masuk
</p>

<p class="font-bold">
{{ $barangMasuk->jumlah }}
{{ $barangMasuk->barang->satuan ?? '' }}
</p>

</div>




<div>
<p class="text-gray-500">
Harga Beli
</p>

<p class="font-bold">
Rp {{ number_format($barangMasuk->harga_beli,0,',','.') }}
</p>

</div>




<div>
<p class="text-gray-500">
Total Nilai Barang
</p>

<p class="font-bold">

Rp {{ number_format(
$barangMasuk->jumlah * $barangMasuk->harga_beli,
0,
',',
'.'
) }}

</p>

</div>




<div>
<p class="text-gray-500">
Input Oleh
</p>

<p class="font-bold">
{{ $barangMasuk->user->name ?? '-' }}
</p>

</div>


</div>



<hr class="my-6">



<p class="text-gray-500">
Keterangan
</p>


<p class="mt-2">

{{ $barangMasuk->keterangan ?? '-' }}

</p>


</div>


</div>

@endsection