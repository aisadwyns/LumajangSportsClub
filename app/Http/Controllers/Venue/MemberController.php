<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $datamember = Member::all();
        return view('venue.member.index', compact('datamember'));
    }

    public function show() {}
    public function create()
    {
        return view('venue.member.create');
    }

    public function store(Request $request)
    {
        //cek inputas
        $request->validate([
            'nama_lengkap' => 'required',
            'nama_club' => 'required',
            'no_telpon' => 'required',
        ], [
            'nama_lengkap.required' => 'nama lengkap belum di isi.',
            'nama_club.required' => 'nama club belum di isi.',
            'no_telpon.required' => 'nomor telpon belum di isi.',
        ]);

        // Member::create([
        //     'nama_lengkap' => $request['nama_lengkap'],
        //     'nama_club'    => $request['nama_club'],
        //     'no_telpon'    => $request['no_telpon'],
        // ]);

        //cara yang lebih simpel
        Member::create($request->all());

        return redirect(route('venue.member.index'))->with('success', 'Data member berhasil disimpan.');
    }

    public function edit(String $id)
    {
        $datamember = Member::find($id);
        return view('venue.member.edit', compact('datamember'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nama_club' => 'required',
            'no_telpon' => 'required',
        ], [
            'nama_lengkap.required' => 'nama lengkap belum di isi.',
            'nama_club.required' => 'nama club belum di isi.',
            'no_telpon.required' => 'nomor telpon belum di isi.',
        ]);

        //semua data boleh berbah, jika ada inputan yang tidak boleh dirubah maka pada blade edit tambahkan readonly
        // $member->update($request->all()); //cara ini bisa saja diinject untuk lebih amannya pakai dibawah ini, rentanlah
        $member->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nama_club'    => $request->nama_club,
            'no_telpon'    => $request->no_telpon,

            //jika ada yg tidak mau di ubah tingal tidak ush ditulis di update sini atributnya
        ]);

        //cara ke 3
        // $member->update($request->except('nama_lengkap'));

        return redirect()->route('venue.member.index')->with('success', 'Data member berhasil diperbarui.');
    }

    public function destroy(String $id)
    {
        Member::destroy($id);
        return redirect()->route('venue.member.index')->with('success', 'Data member berhasil dihapus.');
    }
}
