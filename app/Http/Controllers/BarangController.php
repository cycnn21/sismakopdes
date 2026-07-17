<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang
     */
    public function index(Request $request)
    {
        $search = $request->search;


        $barangs = Barang::with([
                'kategori',
                'supplier'
            ])

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {


                    $q->where(
                        'nama_barang',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'kode_barang',
                        'like',
                        "%{$search}%"
                    )


                    ->orWhereHas('kategori', function ($kategori) use ($search) {

                        $kategori->where(
                            'nama_kategori',
                            'like',
                            "%{$search}%"
                        );

                    })


                    ->orWhereHas('supplier', function ($supplier) use ($search) {

                        $supplier->where(
                            'nama_supplier',
                            'like',
                            "%{$search}%"
                        );

                    });


                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();



        return view(
            'admin.barang.index',
            compact(
                'barangs',
                'search'
            )
        );
    }





    /**
     * Form tambah barang
     */
    public function create()
    {

        $kategori = KategoriBarang::orderBy(
            'nama_kategori'
        )->get();



        $suppliers = Supplier::orderBy(
            'nama_supplier'
        )->get();




        $satuans = [

            'PCS',
            'Unit',
            'Box',
            'Dus',
            'Pack',
            'Kg',
            'Gram',
            'Liter',
            'Botol',
            'Sak',
            'Karung',
            'Lusin',

        ];



        return view(
            'admin.barang.create',
            compact(
                'kategori',
                'suppliers',
                'satuans'
            )
        );

    }





    /**
     * Simpan barang baru
     */
    public function store(Request $request)
    {

        $request->validate([


            'kategori_barang_id' =>
                'required|exists:kategori_barangs,id',


            'supplier_id' =>
                'required|exists:suppliers,id',


            'nama_barang' =>
                'required|max:255',


            'stok' =>
                'required|integer|min:0',


            'harga_beli' =>
                'required|numeric|min:0',


            'harga_jual' =>
                'required|numeric|min:0',


            'satuan' =>
                'required|max:30',


            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',


            'deskripsi' =>
                'nullable'


        ]);





        /*
        |--------------------------------------------------------------------------
        | Generate kode barang otomatis
        |--------------------------------------------------------------------------
        */


        $barangTerakhir = Barang::latest()->first();



        if($barangTerakhir){


            $nomor = intval(

                substr(
                    $barangTerakhir->kode_barang,
                    4
                )

            );



            $kodeBarang = 'BRG-' .

                str_pad(
                    $nomor + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );


        }else{


            $kodeBarang = 'BRG-0001';


        }






        /*
        |--------------------------------------------------------------------------
        | Upload gambar
        |--------------------------------------------------------------------------
        */


        $gambar = null;



        if($request->hasFile('gambar')){


            $gambar = $request
                ->file('gambar')
                ->store(
                    'barang',
                    'public'
                );


        }







        /*
        |--------------------------------------------------------------------------
        | Simpan data barang
        |--------------------------------------------------------------------------
        */


        Barang::create([


            'kategori_barang_id' =>
                $request->kategori_barang_id,


            'supplier_id' =>
                $request->supplier_id,


            'kode_barang' =>
                $kodeBarang,


            'nama_barang' =>
                $request->nama_barang,


            'stok' =>
                $request->stok,


            'harga_beli' =>
                $request->harga_beli,


            'harga_jual' =>
                $request->harga_jual,


            'satuan' =>
                $request->satuan,


            'gambar' =>
                $gambar,


            'deskripsi' =>
                $request->deskripsi,


        ]);





        return redirect()

            ->route('barang.index')

            ->with(
                'success',
                'Barang berhasil ditambahkan.'
            );


    }







    /**
     * Detail barang
     */
    public function show(Barang $barang)
    {

        return view(
            'admin.barang.show',
            compact('barang')
        );

    }







    /**
     * Form edit barang
     */
    public function edit(Barang $barang)
    {

        $kategori = KategoriBarang::orderBy(
            'nama_kategori'
        )->get();


        $suppliers = Supplier::orderBy(
            'nama_supplier'
        )->get();



        $satuans = [

            'PCS',
            'Unit',
            'Box',
            'Dus',
            'Pack',
            'Kg',
            'Gram',
            'Liter',
            'Botol',
            'Sak',
            'Karung',
            'Lusin',

        ];



        return view(
            'admin.barang.edit',
            compact(
                'barang',
                'kategori',
                'suppliers',
                'satuans'
            )
        );

    }








    /**
     * Update barang
     */
    public function update(Request $request, Barang $barang)
    {

        $request->validate([


            'kategori_barang_id' =>
                'required|exists:kategori_barangs,id',


            'supplier_id' =>
                'required|exists:suppliers,id',


            'nama_barang' =>
                'required|max:255',


            'stok' =>
                'required|integer|min:0',


            'harga_beli' =>
                'required|numeric|min:0',


            'harga_jual' =>
                'required|numeric|min:0',


            'satuan' =>
                'required|max:30',


            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',


            'deskripsi' =>
                'nullable'


        ]);






        $gambar = $barang->gambar;



        if($request->hasFile('gambar')){


            if($barang->gambar){

                Storage::disk('public')
                    ->delete($barang->gambar);

            }



            $gambar = $request
                ->file('gambar')
                ->store(
                    'barang',
                    'public'
                );


        }







        $barang->update([


            'kategori_barang_id' =>
                $request->kategori_barang_id,


            'supplier_id' =>
                $request->supplier_id,


            'nama_barang' =>
                $request->nama_barang,


            'stok' =>
                $request->stok,


            'harga_beli' =>
                $request->harga_beli,


            'harga_jual' =>
                $request->harga_jual,


            'satuan' =>
                $request->satuan,


            'gambar' =>
                $gambar,


            'deskripsi' =>
                $request->deskripsi,


        ]);






        return redirect()

            ->route('barang.index')

            ->with(
                'success',
                'Barang berhasil diperbarui.'
            );

    }








    /**
     * Hapus barang
     */
    public function destroy(Barang $barang)
    {


        if($barang->gambar){


            Storage::disk('public')
                ->delete($barang->gambar);

        }




        $barang->delete();




        return redirect()

            ->route('barang.index')

            ->with(
                'success',
                'Barang berhasil dihapus.'
            );

    }

}