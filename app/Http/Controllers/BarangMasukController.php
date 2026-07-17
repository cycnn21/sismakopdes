<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BarangMasukController extends Controller
{

    /**
     * Menampilkan data barang masuk
     */
    public function index()
    {

        $barangMasuks = BarangMasuk::with([
            'barang',
            'supplier',
            'user'
        ])

        ->latest()

        ->paginate(10);



        return view(
            'admin.BarangMasuk.index',
            compact('barangMasuks')
        );

    }





    /**
     * Form tambah barang masuk
     */
    public function create()
    {

        $barangs = Barang::orderBy(
            'nama_barang'
        )->get();


        $suppliers = Supplier::orderBy(
            'nama_supplier'
        )->get();



        return view(
            'admin.BarangMasuk.create',
            compact(
                'barangs',
                'suppliers'
            )
        );

    }





    /**
     * Simpan transaksi barang masuk
     */
    public function store(Request $request)
    {


        $request->validate([


            'barang_id' =>
                'required|exists:barangs,id',


            'supplier_id' =>
                'required|exists:suppliers,id',


            'jumlah' =>
                'required|integer|min:1',


            'harga_beli' =>
                'required|numeric|min:0',


            'tanggal_masuk' =>
                'required|date',


            'keterangan' =>
                'nullable|string'


        ]);




        DB::transaction(function () use ($request) {



            $terakhir = BarangMasuk::orderBy(
                'id',
                'desc'
            )->first();



            if($terakhir){


                $nomor = intval(
                    substr(
                        $terakhir->kode_masuk,
                        3
                    )
                );


                $kodeMasuk = 'BM-' .
                    str_pad(
                        $nomor + 1,
                        4,
                        '0',
                        STR_PAD_LEFT
                    );


            }else{


                $kodeMasuk = 'BM-0001';


            }





            // tambah stok barang

            $barang = Barang::lockForUpdate()
                ->findOrFail(
                    $request->barang_id
                );



            $barang->stok += $request->jumlah;


            $barang->save();






            BarangMasuk::create([


                'kode_masuk' =>
                    $kodeMasuk,


                'barang_id' =>
                    $request->barang_id,


                'supplier_id' =>
                    $request->supplier_id,


                'jumlah' =>
                    $request->jumlah,


                'harga_beli' =>
                    $request->harga_beli,


                'tanggal_masuk' =>
                    $request->tanggal_masuk,


                'user_id' =>
                    Auth::id(),


                'keterangan' =>
                    $request->keterangan,


            ]);



        });




        return redirect()

            ->route('barang-masuk.index')

            ->with(
                'success',
                'Barang masuk berhasil ditambahkan.'
            );

    }







    /**
     * Detail barang masuk
     */
    public function show(BarangMasuk $barangMasuk)
    {

        $barangMasuk->load([
            'barang',
            'supplier',
            'user'
        ]);



        return view(
            'admin.BarangMasuk.show',
            compact('barangMasuk')
        );

    }







    /**
     * Form edit barang masuk
     */
    public function edit(BarangMasuk $barangMasuk)
    {

        $barangs = Barang::orderBy(
            'nama_barang'
        )->get();



        $suppliers = Supplier::orderBy(
            'nama_supplier'
        )->get();



        return view(
            'admin.BarangMasuk.edit',
            compact(
                'barangMasuk',
                'barangs',
                'suppliers'
            )
        );

    }








    /**
     * Update barang masuk
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {


        $request->validate([


            'barang_id' =>
                'required|exists:barangs,id',


            'supplier_id' =>
                'required|exists:suppliers,id',


            'jumlah' =>
                'required|integer|min:1',


            'harga_beli' =>
                'required|numeric|min:0',


            'tanggal_masuk' =>
                'required|date',


            'keterangan' =>
                'nullable|string'


        ]);






        DB::transaction(function () use ($request, $barangMasuk) {



            /*
            Kembalikan stok transaksi lama
            */

            $barangLama = Barang::lockForUpdate()
                ->findOrFail(
                    $barangMasuk->barang_id
                );



            $barangLama->stok -= $barangMasuk->jumlah;



            if($barangLama->stok < 0){

                $barangLama->stok = 0;

            }



            $barangLama->save();






            /*
            Tambahkan stok baru
            */

            $barangBaru = Barang::lockForUpdate()
                ->findOrFail(
                    $request->barang_id
                );



            $barangBaru->stok += $request->jumlah;



            $barangBaru->save();







            /*
            Update transaksi
            */


            $barangMasuk->update([


                'barang_id' =>
                    $request->barang_id,


                'supplier_id' =>
                    $request->supplier_id,


                'jumlah' =>
                    $request->jumlah,


                'harga_beli' =>
                    $request->harga_beli,


                'tanggal_masuk' =>
                    $request->tanggal_masuk,


                'keterangan' =>
                    $request->keterangan,


            ]);



        });





        return redirect()

            ->route('barang-masuk.index')

            ->with(
                'success',
                'Barang masuk berhasil diperbarui.'
            );

    }








    /**
     * Hapus transaksi barang masuk
     */
    public function destroy(BarangMasuk $barangMasuk)
    {


        DB::transaction(function () use ($barangMasuk) {



            $barang = Barang::lockForUpdate()
                ->findOrFail(
                    $barangMasuk->barang_id
                );



            // kurangi stok

            $barang->stok -= $barangMasuk->jumlah;



            if($barang->stok < 0){

                $barang->stok = 0;

            }



            $barang->save();




            $barangMasuk->delete();



        });





        return redirect()

            ->route('barang-masuk.index')

            ->with(
                'success',
                'Barang masuk berhasil dihapus.'
            );

    }



}