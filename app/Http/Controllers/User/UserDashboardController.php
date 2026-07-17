<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{

    public function index()
    {

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Total Barang Aktif
        |--------------------------------------------------------------------------
        */

        $totalBarang = Barang::where('status', 'aktif')
            ->where('stok', '>', 0)
            ->count();



        /*
        |--------------------------------------------------------------------------
        | Total Keranjang User
        |--------------------------------------------------------------------------
        */

        $totalKeranjang = Keranjang::where('user_id', $user->id)
            ->count();




        /*
        |--------------------------------------------------------------------------
        | Total Pembelian
        |--------------------------------------------------------------------------
        |
        | sementara 0 karena transaksi belum dibuat
        |
        */

        $totalPembelian = 0;




        /*
        |--------------------------------------------------------------------------
        | Produk Terbaru
        |--------------------------------------------------------------------------
        */

        $produkTerbaru = Barang::where('status', 'aktif')
            ->where('stok', '>', 0)
            ->latest()
            ->limit(4)
            ->get();




        return view(
            'user.dashboard',
            compact(
                'totalBarang',
                'totalKeranjang',
                'totalPembelian',
                'produkTerbaru'
            )
        );

    }

}