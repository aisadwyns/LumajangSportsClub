<?php

namespace App\Http\Controllers;

use App\Models\Merch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MerchController extends Controller
{
    public function index()
{
    $merchs = Merch::latest()->paginate(9)->where('jenis_katalog', 'merch');

    // Pindahkan ke sini agar SweetAlert me-load script-nya di halaman index
    $title = 'Hapus Merch!';
    $text = "Apakah kamu yakin?";
    confirmDelete($title, $text);

    return view('merch.index', compact('merchs'));
}

    public function show()
    {
        $merchs = Merch::latest()->where('jenis_katalog', 'merch')->get();

    // Siapkan konfirmasi hapus untuk SweetAlert
    confirmDelete('Hapus Merch!', 'Apakah kamu yakin?');

    return view('merch.show', compact('merchs'));
    }

    public function create()
    {
        return view('merch.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:7048',
        ]);

        // Proses File Gambar
        $image = $request->file('image');
        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('Merchs', $image, $fileName);

        // Simpan Data
        $data = $request->all();
        $data['image'] = $fileName;

        Merch::create($data);

        Alert::success('sukses', 'Merch berhasil ditambahkan');
        return redirect()->route('merch.index');
    }

    public function edit(string $id)
    {
        $merch = Merch::findOrFail($id);
        return view('merch.edit', compact('merch'));
    }


    public function destroy(string $id)
    {
        $merch = Merch::findOrFail($id);

        // Hapus file gambar dari disk
        if ($merch->image) {
            Storage::disk('public')->delete('Merchs/' . $merch->image);
        }

        $merch->delete();

        Alert::success('sukses', 'Merch berhasil dihapus');
        return redirect()->route('merch.index');
    }
}
