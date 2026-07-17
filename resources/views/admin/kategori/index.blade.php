@extends('layouts.dashboard')

@section('title', 'Kategori Barang')

@section('content')

<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-3xl font-bold">Kategori Barang</h1>
        <p class="text-gray-500 mt-1">
            Kelola data kategori barang koperasi.
        </p>
    </div>

    <a href="{{ route('kategori.create') }}"
        class="bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">

        + Tambah Kategori

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

                <th class="p-4 text-left">No</th>
                <th class="text-left">Nama Kategori</th>
                <th class="text-left">Keterangan</th>
                <th class="text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($kategori as $item)

            <tr class="border-t">

                <td class="p-4">{{ $loop->iteration }}</td>

                <td>{{ $item->nama_kategori }}</td>

                <td>{{ $item->keterangan }}</td>

                <td>

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('kategori.edit', $item->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

                            Edit

                        </a>

                        @if($item->barangs()->exists())

                        <button
                            type="button"
                            disabled
                           class="bg-gray-300 text-gray-600 px-3 py-2 rounded cursor-not-allowed">

                            Digunakan

                        </button>

                        @else

                        <form action="{{ route('kategori.destroy', $item->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                class="bg-red-700 hover:bg-red-800 text-white px-3 py-2 rounded">

                                Hapus

                            </button>

                        </form>

                        @endif

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4"
                    class="text-center py-10 text-gray-500">

                    Belum ada data kategori.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection