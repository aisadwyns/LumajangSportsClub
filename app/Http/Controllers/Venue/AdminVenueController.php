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
    // Ambil semua data booking beserta relasinya, urutkan dari yang terbaru
    $books = \App\Models\Booking::with(['user', 'court'])->latest()->get();

    // Arahkan ke file view tabel index yang sudah kita buat sebelumnya
    return view('venue.booking.index', compact('books'));
}
    public function BookingShow($id) {
        $books = Booking::with(['user', 'court'])->findOrFail($id);

        // Arahkan ke file view (sesuaikan struktur folder kakak)
        // Misalnya view berada di: resources/views/venue/booking/index.blade.php
        return view('venue.booking.index', compact('book'));
    }
}
