<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $datamember = Member::all();
        return view('member.index', compact('datamember'));
    }

    public function create()
    {
        return view('member.create');
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
        return redirect(route('member.index'))->with('success', 'Data member berhasil disimpan.');
    }
}
