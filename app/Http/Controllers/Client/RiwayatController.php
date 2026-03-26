<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Komunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RiwayatKomunitasController extends Controller
{
    public function index()
    {
        $riwayat = Komunitas::with(['jenis'])
        ->whereRelation('users', 'users.id', Auth::id())
        ->latest()
        ->get();

        return view('client.riwayatkomunitas.index', compact('riwayat'));
    }
}
