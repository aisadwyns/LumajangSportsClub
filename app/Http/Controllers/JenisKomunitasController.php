<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKomunitas;
use RealRashid\SweetAlert\Facades\Alert;

class JenisKomunitasController extends Controller
{
    public function index()
    {
        $jenisKomunitas = JenisKomunitas::all();
        return view('jeniskom.index', compact('jenisKomunitas'));
    }

    public function create()
    {
        return view('jeniskom.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_jenis' => 'required|string|max:255',]);
        JenisKomunitas::create([ 'nama_jenis' => $request->nama_jenis,]);

        Alert::success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('jenis-komunitas.index');
    }

    public function destroy($id)
    {
        $jenisKomunitas = JenisKomunitas::findOrFail($id);
        $jenisKomunitas->delete();

        Alert::success('sukses', 'data berhasil dihapus');
        return redirect()->route('jenis-komunitas.index');
    }

}
