<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jersey;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class JerseyController extends Controller
{
    public function index()
    {
        $jerseys = Jersey::latest()->paginate(9);
        return view('jersey.index', compact('jerseys'));
    }

    // Tampilan Dashboard Admin untuk Kelola Jersey
    public function manage()
    {
        $jerseys = Jersey::latest()->get();
        return view('jerseys.manage', compact('jerseys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('image');
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/jerseys', $fileName);

        Jersey::create([
            'name' => $request->name,
            'image' => $fileName,
        ]);

        return back()->with('success', 'Jersey berhasil ditambahkan!');
    }

    public function update(Request $request, Jersey $jersey)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::delete('public/jerseys/' . $jersey->image);
            
            $file = $request->file('image');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/jerseys', $fileName);
            $jersey->image = $fileName;
        }

        $jersey->name = $request->name;
        $jersey->save();

        return back()->with('success', 'Jersey berhasil diupdate!');
    }

    public function destroy(Jersey $jersey)
    {
        Storage::delete('public/jerseys/' . $jersey->image);
        $jersey->delete();
        return back()->with('success', 'Jersey berhasil dihapus!');
    }
}
