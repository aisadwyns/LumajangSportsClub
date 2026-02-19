<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Komunitas;
use RealRashid\SweetAlert\Facades\Alert;


class JoinKomunitasController extends Controller {

    public function join($id)
    {
        $user = auth()->user();

        // Pengecekan agar tidak duplikat
        if (!$user->komunitas()->where('komunitas_id', $id)->exists()) {
            $user->komunitas()->attach($id);
            Alert::success('Sukses', 'Berhasil bergabung dengan komunitas!');
        } else {
            Alert::info('Info', 'Kamu sudah bergabung di komunitas ini.');
        }

        return back();
    }

    public function leave($id)
    {
        $user = auth()->user();
        $user->komunitas()->detach($id); // Menghapus baris di tabel pivot

        Alert::success('Sukses', 'Berhasil keluar dari komunitas');
        return back();
    }
}
