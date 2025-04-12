<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::paginate(10);
        return view('pages.riwayat.riwayat-berita.index', compact('berita'));
    }

    public function create()
    {
        return view('pages.riwayat.riwayat-berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
            'judul_berita' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $fotoPath = $request->file('foto')->store('berita', 'public');

        Berita::create([
            'foto' => $fotoPath,
            'tanggal' => $request->tanggal,
            'judul_berita' => $request->judul_berita,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('riwayat-berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('pages.riwayat.riwayat-berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
            'judul_berita' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $berita = Berita::findOrFail($id);

        // Update foto jika ada file baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            Storage::disk('public')->delete($berita->foto);
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('berita', 'public');
            $berita->foto = $fotoPath;
        }

        $berita->update([
            'tanggal' => $request->tanggal,
            'judul_berita' => $request->judul_berita,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('riwayat-berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        // Hapus foto dari storage
        Storage::disk('public')->delete($berita->foto);
        // Hapus data dari database
        $berita->delete();

        return redirect()->route('riwayat-berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function apiIndex()
{
    $berita = Berita::all()->map(function ($item) {
        $imagePath = $item->foto ? storage_path('app/public/' . $item->foto) : null;
        $imageBase64 = $imagePath && file_exists($imagePath)
            ? base64_encode(file_get_contents($imagePath))
            : null;

        return [
            'id' => $item->id,
            'title' => $item->judul_berita,
            'content' => $item->deskripsi,
            'image_base64' => $imageBase64,
            'created_at' => $item->tanggal->format('Y-m-d'),
        ];
    });

    return response()->json($berita);
}
}