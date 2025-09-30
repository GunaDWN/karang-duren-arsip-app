<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsip = Arsip::with('kategori')->get();
        return view('arsip.index', compact('arsip'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriSurat::all();
        return view('arsip.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_surat,id',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        $filePath = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files', $fileName, 'public');
        }

        $arsip = Arsip::create([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'file_path' => $filePath
        ]);

        if ($request->wantsJson()) {
            return response()->json($arsip->load('kategori'), 201);
        }

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arsip = Arsip::with('kategori')->findOrFail($id);
        return view('arsip.show', compact('arsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $arsip = Arsip::findOrFail($id);
        $kategori = KategoriSurat::all();
        return view('arsip.edit', compact('arsip', 'kategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_surat,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        $arsip = Arsip::findOrFail($id);

        $filePath = $arsip->file_path;
        if ($request->hasFile('file')) {
            // Delete old file
            if ($arsip->file_path && Storage::disk('public')->exists($arsip->file_path)) {
                Storage::disk('public')->delete($arsip->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files', $fileName, 'public');
        }

        $arsip->update([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'file_path' => $filePath
        ]);

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $arsip = Arsip::findOrFail($id);

        // Delete file if exists
        if ($arsip->file_path && Storage::disk('public')->exists($arsip->file_path)) {
            Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Arsip berhasil dihapus.']);
        }

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
    }

    /**
     * Download the specified file.
     */
    public function download(string $id)
    {
        $arsip = Arsip::findOrFail($id);

        if ($arsip->file_path && Storage::disk('public')->exists($arsip->file_path)) {
            return Storage::disk('public')->download($arsip->file_path, $arsip->judul . '.' . pathinfo($arsip->file_path, PATHINFO_EXTENSION));
        }

        abort(404, 'File tidak ditemukan.');
    }

    /**
     * Get all arsip as JSON for AJAX requests.
     */
    public function getArsip1()
    {
        $arsip = Arsip::with('kategori')->get();
        return response()->json($arsip);
    }

    public function getArsip(Request $request)
    {
        $search = $request->query('search', '');

        $arsip = Arsip::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nomor_surat', 'like', "%{$search}%")
                        ->orWhere('judul', 'like', "%{$search}%")
                        ->orWhereHas('kategori', function ($q) use ($search) {
                            $q->where('nama', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Untuk request AJAX, kembalikan HTML partial
        if ($request->ajax()) {
            $html = view('arsip.partials.table', compact('arsip', 'search'))->render();

            return response()->json([
                'html' => $html,
                'total' => $arsip->count()
            ]);
        }

        // Untuk request biasa, kembalikan JSON data
        return response()->json($arsip);
    }

    /**
     * Preview file tanpa paksa download
     */
    public function preview(string $id)
    {
        $arsip = Arsip::findOrFail($id);

        if (!$arsip->file_path) {
            abort(404, 'File tidak ditemukan di database');
        }

        // Path asli di storage
        $path = storage_path('app/public/' . $arsip->file_path);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan di storage');
        }

        $mimeType = mime_content_type($path);

        return response()->file($path, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }

}


