<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Komunitas;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
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

    public function joinbayarsekarang(Request $request, $id)
    {
        $user = auth()->user();
        $komunitas = Komunitas::findOrFail($id);

        // join dulu (biar tercatat)
        if (!$user->komunitas()->where('komunitas_id', $id)->exists()) $user->komunitas()->attach($id);

        // generate order id unik
        $orderId = 'JOIN-' . $user->id . '-' . $komunitas->id . '-' . Str::upper(Str::random(8));

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) ($komunitas->harga_per_sesi ?? 0),
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [[
                'id' => 'komunitas-' . $komunitas->id,
                'price' => (int) ($komunitas->harga_per_sesi ?? 0),
                'quantity' => 1,
                'name' => 'Join ' . $komunitas->nama_komunitas,
            ]],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'order_id' => $orderId,
        ]);
    }

    public function leave($id)
    {
        $user = auth()->user();
        $user->komunitas()->detach($id); // Menghapus baris di tabel pivot

        Alert::success('Sukses', 'Berhasil keluar dari komunitas');
        return back();
    }
}
