<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        $kategori = KategoriBarang::latest()->get();

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Simpan kategori
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100|unique:kategori_barangs,nama_kategori',
            'keterangan' => 'nullable'
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Tidak digunakan
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Form edit kategori
     */
    public function edit(string $id)
    {
        $kategori = KategoriBarang::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100|unique:kategori_barangs,nama_kategori,' . $id,
            'keterangan' => 'nullable'
        ]);

        $kategori = KategoriBarang::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy(string $id)
{
    $kategori = KategoriBarang::findOrFail($id);

    if ($kategori->barangs()->exists()) {

        return back()->with('error', 'Kategori masih digunakan');

    }

    dd('AKAN DELETE');

    $kategori->delete();
}
}
