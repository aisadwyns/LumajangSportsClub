<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeType;
use App\Services\ChallengeService;
use App\Http\Requests\Admin\StoreChallengeRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ChallengeController extends Controller
{

    public function index()
    {
        // Menggunakan eager loading 'challengeType' agar query lebih optimis dan cepat
        $challenges = Challenge::with('challengeType')->latest()->get();
        return view('challenge.index', compact('challenges'));
    }

    /**
     * Halaman form tambah tantangan baru.
     */
    public function create()
    {
        // Ambil semua tipe tantangan untuk opsi pilihan di form
        $challengeTypes = ChallengeType::all();
        return view('challenge.create', compact('challengeTypes'));
    }

    /**
     * Menyimpan tantangan baru yang dibuat oleh Superadmin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'challenge_type_id' => 'required|exists:challenge_types,id',
            'title'             => 'required|string|max:150',
            'description'       => 'nullable|string',
            'target_amount'     => 'required|integer|min:1',
            'reward_coin'       => 'required|integer|min:0',
            'total_winner'      => 'required|integer|min:1',
            'start_date'        => 'required|date|after_or_equal:today',
            'end_date'          => 'required|date|after:start_date',
            'status'            => 'required|in:draft,active,finished',
        ]);

        Challenge::create($request->all());

        Alert::success('Sukses', 'Tantangan baru berhasil ditambahkan');
        return redirect()->route('challenge.index');
    }

    /**
     * Halaman detail tantangan (Opsional).
     */
    public function show(string $id) {}

    /**
     * Halaman form edit tantangan.
     */
    public function edit(string $id)
    {
        $challenge = Challenge::findOrFail($id);
        $challengeTypes = ChallengeType::all();

        return view('challenge.edit', compact('challenge', 'challengeTypes'));
    }

    /**
     * Memperbarui data tantangan di database.
     */
    public function update(Request $request, Challenge $challenge)
    {
        $request->validate([
            'challenge_type_id' => 'required|exists:challenge_types,id',
            'title'             => 'required|string|max:150',
            'description'       => 'nullable|string',
            'target_amount'     => 'required|integer|min:1',
            'reward_coin'       => 'required|integer|min:0',
            'total_winner'      => 'required|integer|min:1',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after:start_date',
            'status'            => 'required|in:draft,active,finished',
        ]);

        $challenge->update($request->all());

        Alert::success('Sukses', 'Data tantangan berhasil diupdate');
        return redirect()->route('challenge.index');
    }

    /**
     * Menghapus data tantangan dari database.
     */
    public function destroy(string $id)
    {
        $challenge = Challenge::findOrFail($id);

        // Data di tabel challenge_participants otomatis ikut terhapus
        // karena kita sudah mengatur 'onDelete(cascade)' pada file migrasinya.
        $challenge->delete();

        Alert::success('Sukses', 'Tantangan berhasil dihapus');
        return redirect()->route('challenge.index');
    }
}

