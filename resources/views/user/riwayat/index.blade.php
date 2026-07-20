@extends('layouts.user-dashboard')

@section('title','Riwayat Pembelian')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Riwayat Pembelian
        </h1>

        <p class="text-gray-500 mt-2">
            Daftar seluruh transaksi yang pernah Anda lakukan.
        </p>

    </div>

</div>

@if(session('success'))

<div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 p-4">

    {{ session('success') }}

</div>

@endif


@if($transaksis->count())

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4 text-left">
Kode
</th>

<th>
Tanggal
</th>

<th>
Total
</th>

<th>
Status
</th>

<th class="text-center">
Aksi
</th>

</tr>

</thead>

<tbody>

@foreach($transaksis as $trx)

<tr class="border-t hover:bg-gray-50">

<td class="p-4 font-semibold">

{{ $trx->kode_transaksi }}

</td>

<td>

{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}

</td>

<td>

Rp {{ number_format($trx->total,0,',','.') }}

</td>

<td>

@if($trx->status=='Menunggu')

<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
Menunggu
</span>

@elseif($trx->status=='Diproses')

<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
Diproses
</span>

@elseif($trx->status=='Selesai')

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
Selesai
</span>

@else

<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
Dibatalkan
</span>

@endif

</td>

<td class="text-center">

<a
href="{{ route('user.riwayat.show',$trx->id) }}"
class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">

Detail

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@else

<div class="bg-white rounded-2xl shadow p-12 text-center">

<div class="text-6xl">

📦

</div>

<h2 class="text-2xl font-bold mt-4">

Belum Ada Transaksi

</h2>

<p class="text-gray-500 mt-3">

Anda belum pernah melakukan pembelian.

</p>

<a
href="{{ route('user.katalog.index') }}"
class="inline-block mt-6 bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-xl">

Belanja Sekarang

</a>

</div>

@endif

@endsection