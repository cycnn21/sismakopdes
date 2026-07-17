@extends('layouts.dashboard')

@section('title', 'Tambah Barang')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Tambah Barang
            </h1>

            <p class="text-gray-500 mt-1">
                Tambahkan data barang baru ke dalam sistem.
            </p>

        </div>

        <a href="{{ route('barang.index') }}"
            class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl transition">

            ← Kembali

        </a>

    </div>

    <!-- Card -->

    <div class="bg-white rounded-2xl shadow p-8">

        @if ($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-xl p-4">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <form
            action="{{ route('barang.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                <!-- Nama Barang -->

                <div>

                    <label class="font-semibold">

                        Nama Barang

                    </label>

                    <input
                        type="text"
                        name="nama_barang"
                        value="{{ old('nama_barang') }}"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                </div>

                <!-- Kategori -->

                <div>

                    <label class="font-semibold">

                        Kategori

                    </label>

                    <select
                        name="kategori_barang_id"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                        <option value="">

                            -- Pilih Kategori --

                        </option>

                        @foreach($kategori as $item)

                        <option
                            value="{{ $item->id }}"
                            @selected(old('kategori_barang_id')==$item->id)>

                            {{ $item->nama_kategori }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- Supplier -->

                <div>

                    <label class="font-semibold">

                        Supplier

                    </label>

                    <select
                        name="supplier_id"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                        <option value="">

                            -- Pilih Supplier --

                        </option>

                        @foreach($suppliers as $supplier)

                        <option
                            value="{{ $supplier->id }}"
                            @selected(old('supplier_id')==$supplier->id)>

                            {{ $supplier->nama_supplier }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- Satuan -->

                <div>

                    <label class="font-semibold">

                        Satuan

                    </label>

                    <select
                        name="satuan"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                        <option value="">

                            -- Pilih Satuan --

                        </option>

                        @foreach($satuans as $satuan)

                        <option
                            value="{{ $satuan }}"
                            @selected(old('satuan')==$satuan)>

                            {{ $satuan }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- Harga Beli -->

                <div>

                    <label class="font-semibold">

                        Harga Beli

                    </label>

                    <input
                        type="number"
                        name="harga_beli"
                        value="{{ old('harga_beli') }}"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                </div>

                <!-- Harga Jual -->

                <div>

                    <label class="font-semibold">

                        Harga Jual

                    </label>

                    <input
                        type="number"
                        name="harga_jual"
                        value="{{ old('harga_jual') }}"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                </div>

                <!-- Stok -->

                <div>

                    <label class="font-semibold">

                        Stok Awal

                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok',0) }}"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                </div>

                <!-- Stok Minimum -->

                <div>

                    <label class="font-semibold">

                        Stok Minimum

                    </label>

                    <input
                        type="number"
                        name="stok_minimum"
                        value="{{ old('stok_minimum',5) }}"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>

                    <p class="text-sm text-gray-500 mt-1">

                        Batas minimum sebelum stok dianggap menipis.

                    </p>

                </div>

                <!-- Status Barang -->

                <div>

                    <label class="font-semibold">

                        Status Barang

                    </label>


                    <select
                        name="status"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>


                        <option value="aktif">

                            Aktif

                        </option>


                        <option value="nonaktif">

                            Nonaktif

                        </option>


                    </select>

                </div>

                <!-- Upload -->

                <div>

                    <label class="font-semibold">

                        Gambar Barang

                    </label>

                    <input
                        type="file"
                        name="gambar"
                        id="gambar"
                        accept="image/*"
                        class="mt-2 w-full border rounded-xl p-3"
                        onchange="previewImage(event)">

                </div>

            </div>

            <!-- Preview -->

            <div class="mt-8">

                <label class="font-semibold">

                    Preview Gambar

                </label>

                <div class="mt-3">

                    <img
                        id="preview"
                        src="https://placehold.co/250x250?text=Preview"
                        class="w-56 h-56 rounded-xl border object-cover">

                </div>

            </div>

            <!-- Deskripsi -->

            <div class="mt-8">

                <label class="font-semibold">

                    Deskripsi

                </label>

                <textarea
                    name="deskripsi"
                    rows="5"
                    class="mt-2 w-full border rounded-xl p-3">{{ old('deskripsi') }}</textarea>

            </div>

            <!-- Button -->

            <div class="flex justify-end gap-4 mt-10">

                <a href="{{ route('barang.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-8 py-3 rounded-xl bg-red-700 hover:bg-red-800 text-white">

                    Simpan Barang

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    function previewImage(event) {

        const preview = document.getElementById('preview');

        preview.src = URL.createObjectURL(event.target.files[0]);

    }
</script>

@endsection