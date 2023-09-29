<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Welder;
use Illuminate\Http\Request;
// use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::all();
        return view('dashboard.berita.index')->with(compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = KategoriBerita::all();
        return view('dashboard.berita.create')->with(compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kategoriId' => 'required',
            'title' => 'required',
            'thumbnail' => 'required',
            'content' => 'required',
        ]);

        if ($request->file('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
            $image->storeAs('public/foto-berita', $imageName);

            $validatedData['thumbnail'] = 'foto-berita/' . $imageName;
        }


        Berita::create([
            'kategoriId' => $validatedData['kategoriId'],
            'title' => $validatedData['title'],
            'slug' => $this->getSlug($validatedData['title']),
            'thumbnail' => $validatedData['thumbnail'],
            'content' => $validatedData['content'],
        ]);

        return redirect('/dashboard/berita')->with('success', 'Berita berhasil di dibuat');
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
    public function edit(Berita $beritum)
    {
        $kategoris = KategoriBerita::all();
        return view('dashboard.berita.edit')->with(compact('kategoris', 'beritum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $beritum)
    {
        $validatedData = $request->validate([
            'kategoriId' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($request->file('thumbnail')) {
            if ($request->oldImage) {
                unlink(storage_path('app/public/' . $request->oldImage));
            }
            $image = $request->file('thumbnail');
            $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
            $image->storeAs('public/foto-berita', $imageName);

            $validatedData['thumbnail'] = 'foto-berita/' . $imageName;
        }

        $updateData = [
            'kategoriId' => $validatedData['kategoriId'],
            'title' => $validatedData['title'],
            'slug' => $this->getSlug($validatedData['title']),
            'content' => $validatedData['content'],
        ];

        if ($request->file('thumbnail')) {
            $updateData['thumbnail'] = $validatedData['thumbnail'];
        }

        Berita::where('id', $beritum->id)->update($updateData);

        return redirect('/dashboard/berita')->with('success', 'Berita berhasil di diUbah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum)
    {
        try {
            if ($beritum->thumbnail) {
                unlink(storage_path('app/public/' . $beritum->thumbnail));
            }
            Berita::destroy($beritum->id);
            return redirect('/dashboard/berita')->with('success', "Data berita $beritum->name berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/berita')->with('failed', "Data berita $beritum->name tidak bisa dihapus karena sedang digunakan!");
        }
    }

    public function getSlug($title)
    {
        $slug = SlugService::createSlug(Berita::class, 'slug', $title);
        return $slug;
    }
}
