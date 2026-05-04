<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Komunitas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class JoinKomunitasController extends Controller {

    public function join($id)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        if (!$user->komunitas()->where('komunitas_id', $id)->exists()) {
        $user->komunitas()->attach($id, [
            'status_pembayaran' => 'cod',
            'metode_pembayaran' => 'cod'
        ]);

        Alert::success('Sukses', 'Berhasil bergabung! Silakan lakukan pembayaran di lokasi.');
        } else {
            Alert::info('Info', 'Kamu sudah bergabung di komunitas ini.');
        }

        return back();
    }

    public function joinbayarsekarang(Request $request, $id)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $komunitas = Komunitas::findOrFail($id);

        $orderId = 'JOIN-' . $user->id . '-' . Str::upper(Str::random(8));

        if (!$user->komunitas()->where('komunitas_id', $id)->exists()) {
            $user->komunitas()->attach($id, [
                'order_id' => $orderId,
                'status_pembayaran' => 'pending',
                'metode_pembayaran' => 'midtrans'
            ]);
        }


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
         $userId = Auth::id();
        $user = User::findOrFail($userId);
        $user->komunitas()->detach($id); // Menghapus baris di tabel pivot

        Alert::success('Sukses', 'Berhasil keluar dari komunitas');
        return back();
    }

    public function midtransCallback(Request $request)
    {
        // 1. Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        try {
            // Mengambil data notifikasi dari Midtrans
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id; // Contoh: JOIN-5-ABCDEFGH

        // 2. Cek apakah ini transaksi Join Komunitas (karena Kakak pakai awalan 'JOIN-')
        if (str_starts_with($orderId, 'JOIN-')) {

            // Ekstrak ID User dari order_id (karena format Kakak tadi 'JOIN-' . $user->id . '-...')
            $parts = explode('-', $orderId);
            $userId = $parts[1];

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {

                // A. Update status di tabel pivot (komunitas_user) menjadi success
                DB::table('komunitas_user')
                    ->where('order_id', $orderId)
                    ->update(['status_pembayaran' => 'success']);

                // B. 🔥 BERIKAN 20 POIN KE USER!
                $user = User::find($userId);
                if ($user) {
                    $user->increment('points', 20);
                }

            } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {

                // Jika gagal/batal/kadaluarsa, update status jadi failed
                DB::table('komunitas_user')
                    ->where('order_id', $orderId)
                    ->update(['status_pembayaran' => 'failed']);
            }
        }

        // Midtrans butuh balasan HTTP 200 OK agar tidak mengirim notifikasi berulang-ulang
        return response()->json(['message' => 'Callback handled successfully']);
    }
}
