<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan semua data supplier
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $suppliers = Supplier::when($keyword, function ($query) use ($keyword) {

            $query->where('nama_supplier', 'like', "%{$keyword}%")
                ->orWhere('telepon', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
        })
            ->latest()
            ->paginate(10);

        return view('admin.supplier.index', compact('suppliers', 'keyword'));
    }


    /**
     * Menampilkan form tambah supplier
     */
    public function create()
    {
        return view('admin.supplier.create');
    }


    /**
     * Menyimpan data supplier
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|max:150|unique:suppliers,nama_supplier',
            'alamat'        => 'required',
            'telepon'       => 'required|max:20',
            'email'         => 'nullable|email'
        ]);


        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
            'email'         => $request->email,
            'status'        => 'aktif',
        ]);


        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }


    /**
     * Menampilkan form edit supplier
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('admin.supplier.edit', compact('supplier'));
    }


    /**
     * Mengupdate data supplier
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|max:150|unique:suppliers,nama_supplier,' . $id,
            'alamat'        => 'required',
            'telepon'       => 'required|max:20',
            'email'         => 'nullable|email'
        ]);


        $supplier = Supplier::findOrFail($id);


        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
            'email'         => $request->email,
        ]);


        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Mengubah status supplier
     */
    public function toggleStatus($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->status = $supplier->status == 'aktif'
            ? 'nonaktif'
            : 'aktif';

        $supplier->save();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Status supplier berhasil diperbarui.');
    }


    /**
     * Menghapus data supplier
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);


        if ($supplier->barangs()->exists()) {

            return redirect()
                ->route('supplier.index')
                ->with('error', 'Supplier tidak dapat dihapus karena masih digunakan oleh barang.');
        }


        $supplier->delete();


        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
