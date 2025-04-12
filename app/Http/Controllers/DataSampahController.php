<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use Illuminate\Http\Request;

class DataSampahController extends Controller
{
    public function index()
    {
        $sampahs = Sampah::paginate(10);
        return view('pages.data-master.data-sampah.index', compact('sampahs'));
    }

    public function create()
    {
        return view('pages.data-master.data-sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah_sampah' => 'required|integer',
        ]);
        Sampah::create($request->all());
        return redirect()->route('data-master.data-sampah.index')->with('success', 'Data sampah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sampah = Sampah::findOrFail($id);
        return view('pages.data-master.data-sampah.edit', compact('sampah'));
    }

    public function update(Request $request, $id)
    {
        $sampah = Sampah::findOrFail($id);
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah_sampah' => 'required|integer',
        ]);
        $sampah->update($request->all());
        return redirect()->route('data-master.data-sampah.index')->with('success', 'Data sampah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sampah = Sampah::findOrFail($id);
        $sampah->delete();
        return redirect()->route('data-master.data-sampah.index')->with('success', 'Data sampah berhasil dihapus.');
    }
}