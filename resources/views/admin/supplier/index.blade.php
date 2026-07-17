@extends('layouts.dashboard')

@section('title', 'Supplier')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">
            Data Supplier
        </h1>

        <p class="text-gray-500 mt-1">
            Kelola data supplier koperasi.
        </p>

    </div>

    <a href="{{ route('supplier.create') }}"
        class="bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">

        + Tambah Supplier

    </a>

</div>

<div class="bg-white rounded-xl shadow p-5 mb-6">

    <form method="GET"
        action="{{ route('supplier.index') }}"
        class="flex gap-3">

        <input
            type="text"
            name="keyword"
            value="{{ request('keyword') }}"
            placeholder="Cari nama supplier, telepon atau email..."
            class="flex-1 border rounded-lg px-4 py-3">

        <button
            class="bg-red-700 hover:bg-red-800 text-white px-6 rounded-lg">

            Cari

        </button>

        @if(request('keyword'))

        <a href="{{ route('supplier.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

            Reset

        </a>

        @endif

    </form>

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
                <th>Nama Supplier</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($suppliers as $supplier)

            <tr class="border-t">

                <td class="p-4">

                    {{ $suppliers->firstItem() + $loop->index }}

                </td>

                <td>{{ $supplier->nama_supplier }}</td>

                <td>{{ $supplier->telepon }}</td>

                <td>{{ $supplier->email }}</td>

                <td>

                    @if($supplier->status == 'aktif')

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                        Aktif

                    </span>

                    @else

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">

                        Nonaktif

                    </span>

                    @endif

                </td>

                <td>

                    <div class="flex justify-center gap-2 flex-wrap">

                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                            Edit

                        </a>

                        <form action="{{ route('supplier.toggleStatus', $supplier->id) }}" method="POST">

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                onclick="return confirm('Ubah status supplier ini?')"
                                class="{{ $supplier->status == 'aktif'
                                    ? 'bg-orange-500 hover:bg-orange-600'
                                    : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-2 rounded-lg">

                                {{ $supplier->status == 'aktif'
                                    ? 'Nonaktifkan'
                                    : 'Aktifkan' }}

                            </button>

                        </form>

                        @if(!$supplier->barangs()->exists())

                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus supplier ini?')"
                                class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">

                                Hapus

                            </button>

                        </form>

                        @endif

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center py-10 text-gray-500">

                    <div class="py-8">

                        <p class="text-lg font-semibold text-gray-500">

                            Belum ada data supplier.

                        </p>

                        <a href="{{ route('supplier.create') }}"
                            class="inline-block mt-4 bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg">

                            + Tambah Supplier

                        </a>

                    </div>

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>
    <div class="p-5 border-t">

    {{ $suppliers->links() }}

</div>

</div>

@endsection