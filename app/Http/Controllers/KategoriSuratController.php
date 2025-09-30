<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriSurat::all();
        return view('kategori-surat.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori-surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_surat,nama',
            'keterangan' => 'nullable|string'
        ]);

        $kategori = KategoriSurat::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        if ($request->wantsJson()) {
            return response()->json($kategori, 201);
        }

        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriSurat::findOrFail($id);
        return view('kategori-surat.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriSurat::findOrFail($id);
        return view('kategori-surat.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_surat,nama,'.$id,
            'keterangan' => 'nullable|string'
        ]);

        $kategori = KategoriSurat::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriSurat::findOrFail($id);
        
        // Check if there are any arsip associated with this category
        if ($kategori->arsip()->count() > 0) {
            if (request()->wantsJson()) {
                return response()->json(['message' => 'Tidak dapat menghapus kategori karena masih terdapat arsip yang terkait.'], 422);
            }
            
            return redirect()->route('kategori-surat.index')->with('error', 'Tidak dapat menghapus kategori karena masih terdapat arsip yang terkait.');
        }
        
        $kategori->delete();
        
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Kategori surat berhasil dihapus.']);
        }
        
        return redirect()->route('kategori-surat.index')->with('success', 'Kategori surat berhasil dihapus.');
    }
    
    /**
     * Get all categories as JSON for AJAX requests.
     */
    public function getKategori()
    {
        $kategori = KategoriSurat::withCount('arsip')->get();
        return response()->json($kategori);
    }
}
