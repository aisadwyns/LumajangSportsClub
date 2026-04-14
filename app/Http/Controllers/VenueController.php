<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VenueAdmin;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class VenueController extends Controller
{
    public function index() {
        $venues = VenueAdmin::with('user')->latest()->get();

        return view('validasi.venue', compact('venues'));
    }


    public function approve($id){
        $venue = \App\Models\VenueAdmin::with('user')->findOrFail($id);

        if ($venue->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        $venue->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        // 🔥 AMBIL ROLE VENUE
        $role = Role::where('role_name', 'venue')->first();

        // 🔥 UPDATE USER
        $user = $venue->user;
        $user->role_id = $role->id;
        $user->save();

        return back()->with('success', 'Venue berhasil di-approve');
    }


    public function reject(Request $request, $id)   {
        $venue = VenueAdmin::findOrFail($id);

        $venue->update([
            'status' => 'rejected',
            'rejection_reason' => $request->reason
        ]);

        return back()->with('error', 'Venue ditolak');
    }
}
