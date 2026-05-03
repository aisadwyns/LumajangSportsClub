<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Komunitas;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RiwayatController extends Controller
{
    public function indexKomunitas()
    {
        $riwayat = Komunitas::with(['jenis'])
        ->whereRelation('users', 'users.id', Auth::id())
        ->latest()
        ->get();

        return view('client.riwayat.komunitas', compact('riwayat'));
    }

    public function indexBooking()
    {
        $userId = Auth::id();
        $books = Booking::with('court')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('client.riwayat.booking', compact('books'));
    }
}
