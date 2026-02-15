<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Komunitas;
use App\Models\JenisKomunitas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KomunitasController extends Controller
{
    public function index()
    {
        $komunitas = Komunitas::with('jenis')->get();
        return view('komunitas.index', compact('komunitas'));
    }

    public function show() {}

    public function create()
    {
        $jenis = JenisKomunitas::all();
        return view('komunitas.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_komunitas_id' => 'required|exists:jenis_komunitas,id',
            'nama_komunitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lokasi' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'harga_per_sesi' => 'nullable|numeric|min:0',
            'waktu' => 'nullable|string|max:255',
            'link_wa' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->nama_komunitas);
        if (Komunitas::where('slug', $slug)->exists()) $slug .= '-' . now()->format('His');
        $data['slug'] = $slug;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName = Str::uuid() . '.' . $logo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('logo_komunitas', $logo, $fileName);
            $data['logo'] = $fileName;
        }

        Komunitas::create($data);
        Alert::success('sukses', 'data berhasil ditambahkan');
        return redirect()->route('komunitas.index');
    }

    public function edit(string $id)
    {
        $komunitas = Komunitas::findOrFail($id);
        $jenis = JenisKomunitas::all();
        return view('komunitas.edit', compact('komunitas', 'jenis'));
    }

    public function update(Request $request, Komunitas $komunitas)
    {
        $request->validate([
            'jenis_komunitas_id' => 'required|exists:jenis_komunitas,id',
            'nama_komunitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lokasi' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'harga_per_sesi' => 'nullable|numeric|min:0',
            'waktu' => 'nullable|string|max:255',
            'link_wa' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->nama_komunitas);
        if (Komunitas::where('slug', $slug)->where('id', '!=', $komunitas->id)->exists()) $slug .= '-' . now()->format('His');
        $data['slug'] = $slug;

        $fileName = $komunitas->logo;

        if ($request->hasFile('logo')) {
            if ($fileName) Storage::disk('public')->delete('logo_komunitas/' . $fileName);
            $logo = $request->file('logo');
            $fileName = Str::uuid() . '.' . $logo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('logo_komunitas', $logo, $fileName);
        }

        $data['logo'] = $fileName;
        $komunitas->update($data);

        Alert::success('sukses', 'data berhasil diupdate');
        return redirect()->route('komunitas.index');
    }

    public function destroy(string $id)
    {
        $komunitas = Komunitas::findOrFail($id);

        if ($komunitas->logo) Storage::disk('public')->delete('logo_komunitas/' . $komunitas->logo);

        $komunitas->delete();
        Alert::success('sukses', 'data berhasil dihapus');
        return redirect()->route('komunitas.index');
    }
}


