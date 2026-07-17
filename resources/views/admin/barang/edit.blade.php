@extends('layouts.dashboard')

@section('title', 'Edit Barang')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Edit Barang
            </h1>

            <p class="text-gray-500 mt-1">
                Perbarui data barang.
            </p>

        </div>


        <a href="{{ route('barang.index') }}"
            class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl">

            ← Kembali

        </a>

    </div>



    <div class="bg-white rounded-2xl shadow p-8">


        @if ($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-xl p-4">

            <ul class="list-disc pl-5">

                @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif




        <form
            action="{{ route('barang.update',$barang->id) }}"
            method="POST"
            enctype="multipart/form-data">


            @csrf

            @method('PUT')



            <div class="grid md:grid-cols-2 gap-6">


                <!-- Nama Barang -->

                <div>

                    <label class="font-semibold">
                        Nama Barang
                    </label>


                    <input
                        type="text"
                        name="nama_barang"
                        value="{{ old('nama_barang',$barang->nama_barang) }}"
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


                        @foreach($kategori as $item)

                        <option
                            value="{{ $item->id }}"
                            @selected($barang->kategori_barang_id == $item->id)>

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


                        @foreach($suppliers as $supplier)


                        <option
                            value="{{ $supplier->id }}"
                            @selected($barang->supplier_id == $supplier->id)>


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


                        @foreach($satuans as $satuan)


                        <option
                            value="{{ $satuan }}"
                            @selected($barang->satuan == $satuan)>


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
                        value="{{ old('harga_beli',$barang->harga_beli) }}"
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
                        value="{{ old('harga_jual',$barang->harga_jual) }}"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>


                </div>





                <!-- Stok -->

                <div>

                    <label class="font-semibold">
                        Stok
                    </label>


                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok',$barang->stok) }}"
                        class="mt-2 w-full border rounded-xl p-3"
                        required>


                </div>





                <!-- Gambar -->

                <div>

                    <label class="font-semibold">
                        Gambar Baru
                    </label>


                    <input
                        type="file"
                        name="gambar"
                        id="gambar"
                        accept="image/*"
                        onchange="previewImage(event)"
                        class="mt-2 w-full border rounded-xl p-3">


                </div>


            </div>





            <!-- Preview -->

            <div class="mt-8">


                <label class="font-semibold">
                    Preview Gambar
                </label>



                <div class="mt-3">


                    @if($barang->gambar)


                    <img
                        id="preview"
                        src="{{ asset('storage/'.$barang->gambar) }}"
                        class="w-56 h-56 rounded-xl border object-cover">


                    @else


                    <img
                        id="preview"
                        src="https://placehold.co/250x250?text=Preview"
                        class="w-56 h-56 rounded-xl border object-cover">


                    @endif



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
                    class="mt-2 w-full border rounded-xl p-3">{{ old('deskripsi',$barang->deskripsi) }}</textarea>


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


                    Update Barang


                </button>


            </div>



        </form>



    </div>


</div>




<script>

function previewImage(event)
{

    const preview = document.getElementById('preview');

    preview.src = URL.createObjectURL(event.target.files[0]);

}


</script>


@endsection