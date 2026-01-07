<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    public function index()
    {
        $datalapangan = Lapangan::all();
        return view('lapangan.index', compact('datalapangan'));
    }
    public function show() {}
    public function create()
    {
        return view('lapangan.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan'   => 'required|max:100',
            'jenis_lapangan'  => 'required|max:50',
            'harga_per_jam'   => 'required|numeric|min:0',
            'fasilitas'       => 'nullable|string',
            'foto'            => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_lapangan.required'  => 'Nama lapangan belum diisi.',
            'jenis_lapangan.required' => 'Jenis lapangan belum diisi.',
            'harga_per_jam.required'  => 'Harga per jam belum diisi.',
            'harga_per_jam.numeric'   => 'Harga per jam harus berupa angka.',
        ]);
        $foto = $request->file('foto');
        $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('foto_lapangan', $foto, $fileName);
        //bikin variable baru buat nampung semua inputan
        $newRequest = $request->all();
        $newRequest['foto'] = $fileName;

        Lapangan::create($newRequest);
        return redirect()->route('lapangan.index')->with('success', 'Data lapangan berhasil disimpan.');
    }
    public function edit(String $id)
    {
        $dataslapangan = Lapangan::find($id);
        return view('lapangan.edit', compact('datalapangan'));
    }
    public function update(Request $request, Lapangan $lapangan)
    {
        $request->validate([
            'nama_lapangan'  => 'required|string|max:100',
            'jenis_lapangan' => 'required|string|max:50',
            'harga_per_jam'  => 'required|numeric|min:0',
            'fasilitas'      => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_lapangan.required'  => 'Nama lapangan belum diisi.',
            'jenis_lapangan.required' => 'Jenis lapangan belum diisi.',
            'harga_per_jam.required'  => 'Harga per jam belum diisi.',
            'harga_per_jam.numeric'   => 'Harga harus berupa angka.',
        ]);
        $fileName = $lapangan->foto; // foto lama
        $foto = $request->file('foto');

        if ($foto) {
            $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto', $foto, $fileName);
        }
        $newRequest = $request->all();
        $newRequest['foto'] = $fileName;

        // update data lapangan
        $lapangan->update($newRequest);
        // $lapangan->update([
        //     'nama_lapangan'  => $request->nama_lapangan,
        //     'jenis_lapangan' => $request->jenis_lapangan,
        //     'harga_per_jam'  => $request->harga_per_jam,
        //     'fasilitas'      => $request->fasilitas,
        // ]);

        return redirect()
            ->route('lapangan.index')
            ->with('success', 'Data lapangan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $lapangan = Lapangan::find($id);

        if ($lapangan->foto) {
            Storage::disk('public')->delete('foto_lapangan/' . $lapangan->foto);
        }
        $lapangan->delete();
        return redirect()->route('lapangan.index')->with('success', 'Data lapangan berhasil dihapus.');
    }
}
