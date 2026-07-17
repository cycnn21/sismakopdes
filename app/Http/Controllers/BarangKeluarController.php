<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BarangKeluarController extends Controller
{

    /**
     * Menampilkan data barang keluar
     */
    public function index()
    {

        $barangKeluars = BarangKeluar::with([
            'barang',
            'user'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'admin.BarangKeluar.index',
            compact('barangKeluars')
        );

    }



    /**
     * Form tambah barang keluar
     */
    public function create()
    {

        $barangs = Barang::where(
            'status',
            'aktif'
        )
        ->orderBy('nama_barang')
        ->get();

        return view(
            'admin.BarangKeluar.create',
            compact('barangs')
        );

    }



    /**
     * Simpan transaksi barang keluar
     */
    public function store(Request $request)
    {

        $request->validate([

            'barang_id' =>
                'required|exists:barangs,id',

            'jumlah' =>
                'required|integer|min:1',

            'tanggal_keluar' =>
                'required|date',

            'tujuan' =>
                'nullable|string|max:255',

            'keterangan' =>
                'nullable|string',

        ]);


        DB::transaction(function () use ($request) {

            /*
            |--------------------------------------------------------------------------
            | Generate kode transaksi
            |--------------------------------------------------------------------------
            */

            $terakhir = BarangKeluar::latest()->first();

            if ($terakhir) {

                $nomor = intval(
                    substr(
                        $terakhir->kode_keluar,
                        3
                    )
                );

                $kodeKeluar =
                    'BK-' .
                    str_pad(
                        $nomor + 1,
                        4,
                        '0',
                        STR_PAD_LEFT
                    );

            } else {

                $kodeKeluar = 'BK-0001';

            }



            /*
            |--------------------------------------------------------------------------
            | Ambil barang
            |--------------------------------------------------------------------------
            */

            $barang = Barang::lockForUpdate()
                ->findOrFail(
                    $request->barang_id
                );



            /*
            |--------------------------------------------------------------------------
            | Validasi stok
            |--------------------------------------------------------------------------
            */

            if ($barang->stok < $request->jumlah) {

                throw ValidationException::withMessages([

                    'jumlah' => 'Stok barang tidak mencukupi.'

                ]);

            }



            /*
            |--------------------------------------------------------------------------
            | Kurangi stok
            |--------------------------------------------------------------------------
            */

            $barang->stok -= $request->jumlah;

            $barang->save();



            /*
            |--------------------------------------------------------------------------
            | Simpan transaksi
            |--------------------------------------------------------------------------
            */

            BarangKeluar::create([

                'kode_keluar' =>
                    $kodeKeluar,

                'barang_id' =>
                    $request->barang_id,

                'jumlah' =>
                    $request->jumlah,

                'tanggal_keluar' =>
                    $request->tanggal_keluar,

                'tujuan' =>
                    $request->tujuan,

                'user_id' =>
                    Auth::id(),

                'keterangan' =>
                    $request->keterangan,

            ]);

        });


        return redirect()

            ->route('barang-keluar.index')

            ->with(
                'success',
                'Barang keluar berhasil ditambahkan.'
            );

    }



    /**
     * Detail barang keluar
     */
    public function show(BarangKeluar $barangKeluar)
    {

        $barangKeluar->load([

            'barang',
            'user'

        ]);

        return view(

            'admin.BarangKeluar.show',
            compact('barangKeluar')

        );

    }



    /**
     * Form edit barang keluar
     */
    public function edit(BarangKeluar $barangKeluar)
    {

        $barangs = Barang::orderBy(
            'nama_barang'
        )->get();

        return view(

            'admin.BarangKeluar.edit',

            compact(

                'barangKeluar',
                'barangs'

            )

        );

    }



    /**
     * Update barang keluar
     */
    public function update(
        Request $request,
        BarangKeluar $barangKeluar
    ) {

        $request->validate([

            'barang_id' =>
                'required|exists:barangs,id',

            'jumlah' =>
                'required|integer|min:1',

            'tanggal_keluar' =>
                'required|date',

            'tujuan' =>
                'nullable|string|max:255',

            'keterangan' =>
                'nullable|string',

        ]);


        DB::transaction(function () use (

            $request,
            $barangKeluar

        ) {

            /*
            |--------------------------------------------------------------------------
            | Kembalikan stok lama
            |--------------------------------------------------------------------------
            */

            $barangLama = Barang::lockForUpdate()

                ->findOrFail(
                    $barangKeluar->barang_id
                );

            $barangLama->stok +=
                $barangKeluar->jumlah;

            $barangLama->save();



            /*
            |--------------------------------------------------------------------------
            | Ambil barang baru
            |--------------------------------------------------------------------------
            */

            $barangBaru = Barang::lockForUpdate()

                ->findOrFail(
                    $request->barang_id
                );



            if (
                $barangBaru->stok <
                $request->jumlah
            ) {

                throw ValidationException::withMessages([

                    'jumlah' => 'Stok barang tidak mencukupi.'

                ]);

            }



            /*
            |--------------------------------------------------------------------------
            | Kurangi stok baru
            |--------------------------------------------------------------------------
            */

            $barangBaru->stok -=
                $request->jumlah;

            $barangBaru->save();



            /*
            |--------------------------------------------------------------------------
            | Update transaksi
            |--------------------------------------------------------------------------
            */

            $barangKeluar->update([

                'barang_id' =>
                    $request->barang_id,

                'jumlah' =>
                    $request->jumlah,

                'tanggal_keluar' =>
                    $request->tanggal_keluar,

                'tujuan' =>
                    $request->tujuan,

                'keterangan' =>
                    $request->keterangan,

            ]);

        });


        return redirect()

            ->route('barang-keluar.index')

            ->with(

                'success',
                'Barang keluar berhasil diperbarui.'

            );

    }



    /**
     * Hapus barang keluar
     */
    public function destroy(
        BarangKeluar $barangKeluar
    ) {

        DB::transaction(function () use (

            $barangKeluar

        ) {

            /*
            |--------------------------------------------------------------------------
            | Kembalikan stok
            |--------------------------------------------------------------------------
            */

            $barang = Barang::lockForUpdate()

                ->findOrFail(
                    $barangKeluar->barang_id
                );

            $barang->stok +=
                $barangKeluar->jumlah;

            $barang->save();



            /*
            |--------------------------------------------------------------------------
            | Hapus transaksi
            |--------------------------------------------------------------------------
            */

            $barangKeluar->delete();

        });


        return redirect()

            ->route('barang-keluar.index')

            ->with(

                'success',
                'Transaksi barang keluar berhasil dihapus.'

            );

    }

}