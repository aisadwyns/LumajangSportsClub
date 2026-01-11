<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\LscTeam;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class LscTeamController extends Controller
{
    public function index()
    {
        $teams = LscTeam::all();
        return view('lscteam.index', compact('teams'));
    }
    public function show() {}
    public function create()
    {
        return view('lscteam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'        => 'required|string|max:100',
            'nik'                 => 'required|string|max:20|unique:lscteams,nik',
            'email'               => 'required|email|unique:users,email',
            'nomor_hp'            => 'required|string|max:15',
            'alamat'              => 'required|string',
            'jobdesk'             => 'required|string',
            'keahlian'            => 'required|string',
            'pendidikan_terakhir' => 'required|string|max:50',
            'foto'                => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = $request->file('foto');
        $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('foto_lscteam', $foto, $fileName);

        $data = $request->all();
        $data['foto'] = $fileName;

        $newData = LscTeam::create($data);
        $user = User::create([
            'name' => $newData->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'lscteam_id' => $newData->id,
        ]);
        $newData->user_id = $user->id;
        $newData->save();
        return redirect()->route('lscteam.index')->with('success', 'Data LSC Team berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $teams = LscTeam::findOrFail($id);
        return view('lscteam.edit', compact('teams'));
    }

    public function update(Request $request, LscTeam $lscteam)
    {
        $request->validate([
            'nama_lengkap'        => 'required|string|max:100',
            'nik'                 => 'required|string|max:20|unique:lscteams,nik,' . $lscteam->id,
            'email'               => 'required|email|unique:users,email,' . $lscteam->id,
            'nomor_hp'            => 'required|string|max:15',
            'alamat'              => 'required|string',
            'jobdesk'             => 'required|string',
            'keahlian'            => 'required|string',
            'pendidikan_terakhir' => 'required|string|max:50',
            'foto'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fileName = $lscteam->foto;

        if ($request->hasFile('foto')) {
            if ($fileName) {
                Storage::disk('public')->delete('foto_lscteam/' . $fileName);
            }

            $foto = $request->file('foto');
            $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_lscteam', $foto, $fileName);
        }

        $data = $request->all();
        $data['foto'] = $fileName;

        $lscteam->update($data);

        return redirect()
            ->route('lscteam.index')
            ->with('success', 'Data LSC Team berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $lscteam = LscTeam::findOrFail($id);

        if ($lscteam->foto) {
            Storage::disk('public')->delete('foto_lscteam/' . $lscteam->foto);
        }

        $lscteam->delete();

        return redirect()
            ->route('lscteam.index')
            ->with('success', 'Data LSC Team berhasil dihapus.');
    }
}
