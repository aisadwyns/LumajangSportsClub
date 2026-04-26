<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\CourtImage;
use App\Models\JenisKomunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CourtController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $courts = Court::where('venue_admin_id', $venue->id)->get();

        return view('venue.courts.index', compact('courts'));
    }

    public function create()
    {
        $jenis = JenisKomunitas::select('nama_jenis')->distinct()->get();

        return view('venue.courts.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $request->validate([
            'name' => 'required|string|max:100',
            'sport_type' => 'required|string|max:50',
            'court_type' => 'nullable|in:indoor,outdoor',
            'price_per_hour' => 'required|numeric',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:10000',
            'open_time' => 'nullable',
            'close_time' => 'nullable',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['venue_admin_id'] = $venue->id;

        $court = Court::create($data);

        // 🔥 MULTIPLE IMAGE
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('courts', $file, $fileName);

                CourtImage::create([
                    'court_id' => $court->id,
                    'image' => $fileName
                ]);
            }
        }

        Alert::success('sukses', 'Court berhasil ditambahkan');
        return redirect()->route('venue.court.index');
    }

    public function edit(string $id)
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $court = Court::where('venue_admin_id', $venue->id)->findOrFail($id);

        $jenis = JenisKomunitas::select('nama_jenis')->distinct()->get();

        return view('venue.courts.edit', compact('court', 'jenis'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $court = Court::where('venue_admin_id', $venue->id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'sport_type' => 'required|string|max:50',
            'court_type' => 'nullable|in:indoor,outdoor',
            'price_per_hour' => 'required|numeric',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'open_time' => 'nullable',
            'close_time' => 'nullable',
            'status' => 'required|in:active,inactive'
        ]);

        $court->update($request->all());

        // 🔥 TAMBAH GAMBAR BARU (tidak hapus lama)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('courts', $file, $fileName);

                CourtImage::create([
                    'court_id' => $court->id,
                    'image' => $fileName
                ]);
            }
        }

        Alert::success('sukses', 'Court berhasil diupdate');
        return redirect()->route('venue.court.index');
    }

    public function destroy(string $id)
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $court = Court::where('venue_admin_id', $venue->id)->findOrFail($id);

        // 🔥 HAPUS SEMUA GAMBAR
        foreach ($court->images as $img) {
            Storage::disk('public')->delete('courts/' . $img->image);
            $img->delete();
        }

        $court->delete();

        Alert::success('sukses', 'Court berhasil dihapus');
        return redirect()->route('venue.court.index');
    }
}
