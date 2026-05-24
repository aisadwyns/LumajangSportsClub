<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input dengan gaya $request->validate() sesuai acuanmu
        $request->validate([
            'type'           => 'required|in:aplikasi,komunitas,lapangan',
            'id_komunitas'   => 'required_if:type,komunitas|nullable|integer',
            'id_lapangan'    => 'required_if:type,lapangan|nullable|integer',
            'rating'         => 'required|integer|between:1,5',
            'review_message' => 'required|string|min:5',
        ]);

        // 2. Ambil data inputan
        $data = $request->all();
        $data['user_id']       = auth()->user()->id;
        $data['reviewer_name'] = auth()->user()->name;
        $data['is_active']     = false; // Default false untuk approval admin

        // Kondisi dinamis menentukan ID sesuai dengan tipenya
        if ($request->type === 'aplikasi') {
            $data['id_komunitas'] = null;
            $data['id_lapangan']  = null;
        } elseif ($request->type === 'komunitas') {
            $data['id_lapangan']  = null;
        } elseif ($request->type === 'lapangan') {
            $data['id_komunitas'] = null;
        }

        // 3. Simpan ke database
        Review::create($data);

        // 4. Pemicu SweetAlert dari Backend langsung
        Alert::success('Sukses', 'Terima kasih, ulasan Anda berhasil dikirim.');

        // 5. Kembalikan halaman (Redirect kembali)
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
