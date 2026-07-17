@extends('layouts.dashboard')

@section('title', 'Barang Masuk')

@section('content')


<div class="flex justify-between items-center mb-6">


    <div>

        <h1 class="text-3xl font-bold">
            Data Barang Masuk
        </h1>


        <p class="text-gray-500 mt-1">
            Kelola transaksi barang masuk koperasi.
        </p>


    </div>




    <a href="{{ route('barang-masuk.create') }}"

        class="bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">


        + Tambah Barang Masuk


    </a>


</div>





@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-5">


    {{ session('success') }}


</div>

@endif





@if(session('error'))

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-5">


    {{ session('error') }}


</div>

@endif








<div class="bg-white rounded-xl shadow overflow-hidden">


<table class="w-full">


<thead class="bg-gray-100">


<tr>


<th class="p-4 text-left">
No
</th>


<th>
Kode Masuk
</th>


<th>
Tanggal
</th>


<th>
Barang
</th>


<th>
Supplier
</th>


<th>
Jumlah
</th>


<th>
Harga Beli
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



@forelse($barangMasuks as $masuk)



<tr class="border-t">





<td class="p-4">


{{ $barangMasuks->firstItem() + $loop->index }}


</td>





<td>


<span class="font-semibold">

{{ $masuk->kode_masuk }}

</span>


</td>






<td>


{{ \Carbon\Carbon::parse($masuk->tanggal_masuk)->format('d-m-Y') }}


</td>







<td>


{{ $masuk->barang->nama_barang ?? '-' }}


</td>







<td>


{{ $masuk->supplier->nama_supplier ?? '-' }}


</td>







<td>


{{ $masuk->jumlah }}

{{ $masuk->barang->satuan ?? '' }}


</td>







<td>


Rp {{ number_format($masuk->harga_beli,0,',','.') }}


</td>







<td>


{{ $masuk->user->name ?? '-' }}


</td>








<td>


<div class="flex justify-center gap-2 flex-wrap">





<a href="{{ route('barang-masuk.show',$masuk->id) }}"

class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">


Detail


</a>







<a href="{{ route('barang-masuk.edit',$masuk->id) }}"

class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">


Edit


</a>







<form action="{{ route('barang-masuk.destroy',$masuk->id) }}"

method="POST">


@csrf

@method('DELETE')



<button

type="submit"

onclick="return confirm('Hapus transaksi barang masuk ini? Stok akan dikurangi.')"

class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">


Hapus


</button>



</form>







</div>


</td>






</tr>





@empty




<tr>


<td colspan="9"

class="text-center py-10 text-gray-500">



<div class="py-5">


<p class="text-lg font-semibold">

Belum ada transaksi barang masuk.

</p>


</div>



</td>


</tr>




@endforelse





</tbody>




</table>





<div class="p-5 border-t">


{{ $barangMasuks->links() }}


</div>





</div>



@endsection