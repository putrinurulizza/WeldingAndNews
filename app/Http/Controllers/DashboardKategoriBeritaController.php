<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class DashboardKategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriBerita::all();
        return view('dashboard.kategori-berita.index')->with(compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255|unique:kategori_beritas'
            ]);

            KategoriBerita::create($validatedData);

            return redirect('/dashboard/kategori-berita')->with('success', 'Kategori berita baru berhasil dibuat!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/kategori-berita')->with('failed', 'Data gagal disimpan! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBerita $kategori_beritum)
    {
        try {
            $rules = [
                'name' => 'required|max:255|unique:kategori_beritas,name,' . $kategori_beritum->id,
            ];

            $validatedData = $request->validate($rules);

            KategoriBerita::where('id', $kategori_beritum->id)->update($validatedData);

            return redirect('/dashboard/kategori-berita')->with('success', 'Data kategori berita berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/kategori-berita')->with('failed', 'Data gagal diperbarui! ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBerita $kategori_beritum)
    {
        try {
            KategoriBerita::destroy($kategori_beritum->id);
            return redirect('/dashboard/kategori-berita')->with('success', "Kategori berita $kategori_beritum->name berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/kategori-berita')->with('failed', "Kategori berita $kategori_beritum->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
