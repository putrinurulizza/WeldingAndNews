<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $newBeritas = Berita::latest()->take(3)->get();
        $search = $request->input('search');
        $kategoris = KategoriBerita::all();
        $beritas = Berita::where('title', 'like', '%' . $search . '%')->paginate(9);
        $title = "Berita";
        return view('main.berita')->with(compact('title', 'beritas', 'kategoris', 'search', 'newBeritas'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        $title = "Berita";
        return view('main.berita-detail')->with(compact('berita', 'title'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function beritaByKategori(Request $request, $kategori_id)
    {
        $search = $request->input('search');
        $kategoris = KategoriBerita::all();
        $newBeritas = Berita::latest()->take(3)->get();

        // Ambil berita berdasarkan kategori yang dipilih
        $beritas = Berita::where('title', 'like', '%' . $search . '%')
            ->whereHas('kategoriBerita', function ($query) use ($kategori_id) {
                $query->where('kategoriId', $kategori_id);
            })
            ->paginate(9);

        $title = "Berita";
        return view('main.berita')->with(compact('title', 'beritas', 'kategoris', 'search', 'newBeritas'));
    }
}
