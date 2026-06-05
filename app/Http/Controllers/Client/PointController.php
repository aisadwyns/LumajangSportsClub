<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PointController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $histories = $user->pointHistories()->paginate(10);

        return view('client.riwayat.point', compact('user', 'histories'));
    }
}
