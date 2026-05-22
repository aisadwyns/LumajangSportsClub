<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Services\ChallengeService;
use App\Http\Requests\Admin\StoreChallengeRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ChallengeController extends Controller
{

    public function index()
    {
        $challenges = Challenge::latest()->get(); // Disamakan dengan gaya LscTeam (menggunakan get/all)
        return view('admin.challenges.index', compact('challenges'));
    }

    public function create()
    {
        return view('admin.challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'tipe_misi'      => 'required|in:akumulasi_booking,akumulasi_komunitas',
            'target_amount'  => 'required|integer|min:1',
            'poin_reward'    => 'required|integer|min:1',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after:start_date',
        ]);

        Challenge::create($request->all());

        Alert::success('sukses', 'challenge baru berhasil diterbitkan');
        return redirect()->route('admin.challenges.index');
    }

    public function edit(string $id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('admin.challenges.edit', compact('challenge'));
    }

    public function update(Request $request, string $id)
    {
        $challenge = Challenge::findOrFail($id);

        $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'tipe_misi'      => 'required|in:akumulasi_booking,akumulasi_komunitas',
            'target_amount'  => 'required|integer|min:1',
            'poin_reward'    => 'required|integer|min:1',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after:start_date',
            'status'         => 'required|in:active,completed',
        ]);

        $challenge->update($request->all());

        Alert::success('sukses', 'challenge berhasil diupdate');
        return redirect()->route('admin.challenges.index');
    }

    public function destroy(string $id)
    {
        $challenge = Challenge::findOrFail($id);

        $challenge->delete();

        Alert::success('sukses', 'challenge berhasil dihapus');
        return redirect()->route('admin.challenges.index');
    }
}

