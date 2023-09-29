<?php

namespace App\Http\Controllers;

use App\Models\Welder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardWeldersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $welders = Welder::all();
        return view('dashboard.welders.index')->with(compact('welders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.welders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'pemilik' => 'required',
                'jumlah_pekerja' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'foto' => 'required',
                'deskripsi' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/dashboard/welder')->with('failed', $e->getMessage());
        }

        if ($request->file('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
            $image->storeAs('public/foto-welder', $imageName);

            $validatedData['foto'] = 'foto-welder/' . $imageName;
        }

        Welder::create($validatedData);

        return redirect('/dashboard/welder')->with('success', 'Data Welder berhasil dibuat');
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
    public function edit(Welder $welder)
    {
        return view('dashboard.welders.edit')->with(compact('welder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Welder $welder)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'pemilik' => 'required',
            'jumlah_pekerja' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                unlink(storage_path('app/public/' . $request->oldImage));
            }
            $image = $request->file('foto');
            $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
            $image->storeAs('public/foto-welder', $imageName);

            $validatedData['foto'] = 'foto-welder/' . $imageName;
        }

        Welder::where('id', $welder->id)->update($validatedData);

        return redirect('/dashboard/welder')->with('success', 'Data Welder baru berhasil di Ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Welder $welder)
    {
        try {
            if ($welder->foto) {
                unlink(storage_path('app/public/' . $welder->foto));
            }
            Welder::destroy($welder->id);
            return redirect('/dashboard/welder')->with('success', "Data Welder $welder->name berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/welder')->with('failed', "Data Welder $welder->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
