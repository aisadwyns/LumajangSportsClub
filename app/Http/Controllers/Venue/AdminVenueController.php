<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVenueController extends Controller
{
    public function create()
    {
        if (Auth::check() && Auth::user()->venueAdmin) {
            return back()->with('error', 'Sudah mendaftar venue');
        }

        return view('venue.register');
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->venueAdmin) {
            return back()->with('error', 'Sudah mendaftar venue');
        }

        $request->validate([
            'business_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);

        $venueAdmin = new \App\Models\VenueAdmin();
        $venueAdmin->user_id = Auth::id();
        $venueAdmin->business_name = $request->business_name;
        $venueAdmin->address = $request->address;
        $venueAdmin->phone_number = $request->phone_number;
        $venueAdmin->save();

        return redirect()->route('home')->with('success', 'Pendaftaran venue berhasil, menunggu persetujuan admin.');
    }
    public function BookingIndex()
    {
        // 1. Ambil ID Venue milik user yang sedang login
        $venueAdminId = Auth::user()->venueAdmin->id;

        // 2. Ambil booking khusus untuk lapangan yang dimiliki venue admin ini
        // Asumsi: tabel 'courts' memiliki foreign key 'venue_admin_id'
        $books = Booking::whereHas('court', function ($query) use ($venueAdminId) {
            $query->where('venue_admin_id', $venueAdminId);
        })->with(['user', 'court'])->latest()->get();

        return view('venue.booking.index', compact('books'));
    }

    public function BookingShow($id)
    {
        $venueAdminId = Auth::user()->venueAdmin->id;

        // Tambahkan filter yang sama di sini demi keamanan,
        // agar admin tidak bisa mengintip detail booking venue lain lewat URL
        $book = Booking::whereHas('court', function ($query) use ($venueAdminId) {
            $query->where('venue_admin_id', $venueAdminId);
        })->with(['user', 'court'])->findOrFail($id);

        // Arahkan ke file view 'show', bukan 'index'
        return view('venue.booking.show', compact('book'));
    }
}
