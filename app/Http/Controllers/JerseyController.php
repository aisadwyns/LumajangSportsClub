<?php

namespace App\Http\Controllers;

use App\Models\Jersey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class JerseyController extends Controller
{
    public function index()
{
    $jerseys = Jersey::latest()->paginate(9);

    // Pindahkan ke sini agar SweetAlert me-load script-nya di halaman index
    $title = 'Hapus Jersey!';
    $text = "Apakah kamu yakin?";
    confirmDelete($title, $text);

    return view('jersey.index', compact('jerseys'));
}

    public function show()
    {
        $jerseys = Jersey::latest()->get();

    // Siapkan konfirmasi hapus untuk SweetAlert
    confirmDelete('Hapus Jersey!', 'Apakah kamu yakin?');

    return view('jersey.show', compact('jerseys'));
    }

    public function create()
    {
        return view('jersey.create');
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
        Storage::disk('public')->putFileAs('jerseys', $image, $fileName);

        // Simpan Data
        $data = $request->all();
        $data['image'] = $fileName;

        Jersey::create($data);

        Alert::success('sukses', 'Jersey berhasil ditambahkan');
        return redirect()->route('jersey.index');
    }

    public function edit(string $id)
    {
        $jersey = Jersey::findOrFail($id);
        return view('jersey.edit', compact('jersey'));
    }


    public function destroy(string $id)
    {
        $jersey = Jersey::findOrFail($id);

        // Hapus file gambar dari disk
        if ($jersey->image) {
            Storage::disk('public')->delete('jerseys/' . $jersey->image);
        }

        $jersey->delete();

        Alert::success('sukses', 'Jersey berhasil dihapus');
        return redirect()->route('jersey.index');
    }
}
