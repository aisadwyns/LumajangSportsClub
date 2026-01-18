<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class BagianController extends Controller
{
    public function index()
    {
        $bagian = Bagian::all();
        $title = 'Konfirmasi hapus data bagian!';
        $text = "Data akan dihapus permanen, lanjutkan?";
        confirmDelete($title, $text);
        return view('bagian.index', compact('bagian'));
    }
    public function show(String $id)
    {
        $bagian = Bagian::find($id);
        return view('bagian.show', compact('bagian'));
    }
    public function destroy(string $id)
    {
        $bagian = Bagian::findOrFail($id);
        $bagian->delete();
        Alert::success('sukses', 'data berhasil dihapus');
        return redirect()->route('bagian.index');
    }
}
