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
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id; // Contoh: JOIN-5-ABCDEFGH

        // 2. Pastikan ini adalah transaksi Join Komunitas (awalan 'JOIN-')
        if (str_starts_with($orderId, 'JOIN-')) {

            // Cari data transaksi di tabel pivot (join_komunitas)
            $komunitasUser = DB::table('join_komunitas')->where('order_id', $orderId)->first();

            if ($komunitasUser) {
                // Ekstrak ID User dari order_id sesuai format Kakak (JOIN-{id}-{random})
                $parts = explode('-', $orderId);
                $userId = $parts[1];

                // 3. JIKA PEMBAYARAN BERHASIL LUNAS
                if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {

                    // Mencegah Poin Nambah Dobel: Pastikan status sebelumnya bukan 'success'
                    if ($komunitasUser->status_pembayaran != 'success') {

                        // A. Update status pembayaran menjadi success
                        DB::table('join_komunitas')
                            ->where('order_id', $orderId)
                            ->update(['status_pembayaran' => 'success']);

                        // B. Tambahkan 20 Poin ke User!
                        $user = User::find($userId);
                        if ($user) {
                            $pointGained = 20;
                            $user->increment('points', $pointGained);

                            \App\Models\Point::create([
                                'user_id'       => $user->id,
                                'amount'        => $pointGained,
                                'activity_type' => 'join_community',
                                'description'   => 'Mendapatkan poin dari join komunitas #' . ($komunitasUser->order_id ?? $komunitasUser->id),
                            ]);

                            $activeKomunitasChallenges = $user->challenges()
                                ->where('status', 'active')
                                ->where('challenge_type_id', 2)
                                ->wherePivot('status', 'joined') // Membaca kolom status di tabel challenge_participants
                                ->get();

                            foreach ($activeKomunitasChallenges as $challenge) {
                                // Mengambil progress saat ini dari tabel pivot
                                $currentProgress = $challenge->pivot->progress;
                                $newProgress = $currentProgress + 1;

                                if ($newProgress >= $challenge->target_amount) {
                                    // Jika progress mencapai target, set completed pada tabel challenge_participants
                                    $user->challenges()->updateExistingPivot($challenge->id, [
                                        'progress'     => $challenge->target_amount,
                                        'status'       => 'completed',
                                        'completed_at' => now(), // Pastikan kolom ini ada di tabel challenge_participants jika ingin diisi
                                    ]);

                                    // Berikan reward koin/poin dari tantangan tersebut
                                    $user->increment('points', $challenge->reward_coin);

                                    // Catat riwayat poin tantangan selesai
                                    \App\Models\Point::create([
                                        'user_id'       => $user->id,
                                        'amount'        => $challenge->reward_coin,
                                        'activity_type' => 'challenge_completed',
                                        'description'   => 'Menyelesaikan Tantangan: ' . $challenge->title,
                                    ]);
                                } else {
                                    // Jika belum mencapai target, update progress-nya saja di tabel challenge_participants
                                    $user->challenges()->updateExistingPivot($challenge->id, [
                                        'progress' => $newProgress,
                                    ]);
                                }
                            }
                        }
                    }
                }
                // 4. JIKA PEMBAYARAN GAGAL / BATAL / KADALUARSA
                elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                    DB::table('join_komunitas')
                        ->where('order_id', $orderId)
                        ->update(['status_pembayaran' => 'failed']);
                }
            }
        }

        // Wajib mengembalikan response 200 OK agar Midtrans tahu notifikasinya sudah diterima
        return response()->json(['message' => 'Callback handled successfully']);
    }
}
