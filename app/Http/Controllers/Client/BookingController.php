<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Point;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function pay(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$request->court_id || !$request->booking_date || !$request->start_time) {
                return response()->json([
                    'success' => false,
                    'error' => 'Data booking dari frontend ada yang kosong nih!'
                ], 400);
            }

            // Cek ketersediaan slot di database
            $blocked = Schedule::where('court_id', $request->court_id)
                ->where('schedule_date', $request->booking_date)
                ->where('start_time', $request->start_time)
                ->exists();

            if ($blocked) {
                return response()->json(['success' => false, 'error' => 'Yah, slotnya udah nggak tersedia'], 400);
            }

            $court = Court::findOrFail($request->court_id);
            $totalPrice = $court->price_per_hour;

            // 🌟 REVISI: Generate order_id unik tanpa insert ke tabel Booking terlebih dahulu
            // Format: BK-USERID-TIMESTAMP-RANDOM (Contoh: BK-1-1718640000-XYZ)
            $orderId = 'BK-' . $user->id . '-' . time() . '-' . Str::upper(Str::random(3));

            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'item_details' => [[
                    'id' => 'COURT-' . $request->court_id,
                    'price' => (int) $totalPrice,
                    'quantity' => 1,
                    'name' => 'Booking Lapangan',
                ]],
                // 🌟 Tambahkan custom field/metadata agar data booking tidak hilang saat dibaca di callback
                'custom_field1' => json_encode([
                    'court_id'     => $request->court_id,
                    'booking_date' => $request->booking_date,
                    'start_time'   => $request->start_time,
                ])
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error Server: ' . $e->getMessage() . ' di baris ' . $e->getLine()
            ], 500);
        }
    }

    public function handleUniversalCallback(Request $request)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        try {
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id;

        // 1. Eksekusi jika ini adalah transaksi Booking Lapangan
        if (str_starts_with($orderId, 'BK-')) {

            // Ambil data user_id dari order_id (BK-{user_id}-{timestamp}-{rand})
            $parts = explode('-', $orderId);
            $userId = $parts[1] ?? null;

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {

                // Cek apakah data booking dengan order_id ini sudah pernah dibuat sebelumnya (mencegah duplikasi callback)
                $bookingExists = Booking::where('order_id', $orderId)->exists();

                if (!$bookingExists) {
                    // Ambil kembali data lapangan yang disimpan di custom_field1
                    $customData = json_decode($notif->custom_field1 ?? '{}');

                    if (isset($customData->court_id)) {
                        $court = Court::find($customData->court_id);
                        $totalPrice = $court ? $court->price_per_hour : 0;

                        // 🌟 REVISI: Data baru di-insert ke database HANYA saat pembayaran sukses
                        $booking = Booking::create([
                            'user_id'      => $userId,
                            'court_id'     => $customData->court_id,
                            'booking_date' => $customData->booking_date,
                            'start_time'   => $customData->start_time,
                            'end_time'     => date('H:i:s', strtotime($customData->start_time . ' +1 hour')),
                            'total_price'  => $totalPrice,
                            'status'       => 'success', // Langsung set sukses
                            'order_id'     => $orderId
                        ]);

                        // Berikan poin dan proses tantangan (Challenge)
                        $user = \App\Models\User::find($userId);
                        if ($user) {
                            $pointGained = 50;
                            $user->increment('points', $pointGained);

                            \App\Models\Point::create([
                                'user_id'       => $user->id,
                                'amount'        => $pointGained,
                                'activity_type' => 'booking',
                                'description'   => 'Mendapatkan poin dari penyewaan lapangan #' . ($booking->kode_booking ?? $booking->id),
                            ]);

                            $activeBookingChallenges = $user->challenges()
                                ->where('status', 'active')
                                ->whereHas('type', function ($query) {
                                    $query->where('slug', 'booking');
                                })
                                ->wherePivot('status', 'joined')
                                ->get();

                            foreach ($activeBookingChallenges as $challenge) {
                                $newProgress = $challenge->pivot->progress + 1;

                                if ($newProgress >= $challenge->target_amount) {
                                    $user->challenges()->updateExistingPivot($challenge->id, [
                                        'progress'     => $challenge->target_amount,
                                        'status'       => 'completed',
                                        'completed_at' => now(),
                                    ]);

                                    $user->increment('points', $challenge->reward_coin);

                                    \App\Models\Point::create([
                                        'user_id'       => $user->id,
                                        'amount'        => $challenge->reward_coin,
                                        'activity_type' => 'challenge_completed',
                                        'description'   => 'Menyelesaikan Tantangan: ' . $challenge->title,
                                    ]);
                                } else {
                                    $user->challenges()->updateExistingPivot($challenge->id, [
                                        'progress' => $newProgress,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            // Karena pending tidak dimasukkan ke DB, kondisi cancel/deny/expire tidak perlu meng-update apa-apa untuk tabel booking lapangan.
        }

        // 2. Eksekusi jika ini adalah transaksi Join Komunitas (Gunakan DB Transaction agar aman)
        elseif (str_starts_with($orderId, 'JOIN-')) {
            $parts = explode('-', $orderId);
            $userId = $parts[1] ?? null;

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {

                // Cari data join_komunitas
                $komunitasUser = DB::table('join_komunitas')->where('order_id', $orderId)->first();

                if ($komunitasUser && $komunitasUser->status_pembayaran != 'success') {
                    DB::table('join_komunitas')
                        ->where('order_id', $orderId)
                        ->update(['status_pembayaran' => 'success']);

                    $user = \App\Models\User::find($userId);
                    if ($user) {
                        $pointGained = 20;
                        $user->increment('points', $pointGained);

                        \App\Models\Point::create([
                            'user_id'       => $user->id,
                            'amount'        => $pointGained,
                            'activity_type' => 'join_community',
                            'description'   => 'Mendapatkan poin dari join komunitas #' . ($komunitasUser->order_id ?? $komunitasUser->id),
                        ]);
                        $user->increment('points', $pointGained);

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
            // Jika Anda juga ingin menghapus data pending di komunitas saat gagal/expired:
            elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                DB::table('join_komunitas')->where('order_id', $orderId)->delete();
            }
        }

        return response()->json(['message' => 'Universal callback handled successfully']);
    }

    // Method lama sengaja dikosongkan/diarahkan ke handleUniversalCallback jika Anda memakai satu route callback saja
    public function bookingCallback(Request $request)
    {
        return $this->handleUniversalCallback($request);
    }
}
