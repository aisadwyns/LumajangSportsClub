<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Point;;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

public function pay(Request $request)
{
    try {
        $user = Auth::user();

        // Kita cegat dulu di sini, mastiin data dari JS beneran masuk
        if (!$request->court_id || !$request->booking_date || !$request->start_time) {
            return response()->json([
                'success' => false,
                'error' => 'Data booking dari frontend ada yang kosong nih!'
            ], 400);
        }

        $blocked = Schedule::where('court_id', $request->court_id)
            ->where('schedule_date', $request->booking_date)
            ->where('start_time', $request->start_time)
            ->exists();

        if ($blocked) {
            return response()->json(['success' => false, 'error' => 'Yah, slotnya udah nggak tersedia'], 400);
        }

        $court = Court::findOrFail($request->court_id);
        $totalPrice = $court->price_per_hour;

        $booking = Booking::create([
            'user_id' => $user->id,
            'court_id' => $request->court_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => date('H:i:s', strtotime($request->start_time . ' +1 hour')),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Tambahkan baris ini agar format kode_booking terbentuk sempurna
        $booking->refresh();

        $orderId = $booking->kode_booking . '-' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(3));
        $booking->update(['order_id' => $orderId]);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [[
                'id' => 'COURT-' . $request->court_id,
                'price' => (int) $booking->total_price,
                'quantity' => 1,
                'name' => 'Booking Lapangan',
            ]],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'order_id' => $orderId,
        ]);

    } catch (\Exception $e) {
        // Nah, semua error Laravel bakal ditangkep di sini dan dikirim rapi ke frontend
        return response()->json([
            'success' => false,
            'error' => 'Error Server: ' . $e->getMessage() . ' di baris ' . $e->getLine()
        ], 500);
    }
}

    public function bookingCallback(Request $request)
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

        // Cari data booking berdasarkan order_id yang masuk
        $booking = Booking::where('order_id', $orderId)->first();

        if ($booking) {
            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                if ($booking->status != 'success') {
                    // Update jadi success
                    $booking->update(['status' => 'success']);

                    // Ambil data user pemboking
                    $user = \App\Models\User::find($booking->user_id);
                    if ($user) {
                        $pointGained = 50;

                        // 1. Tambah poin user
                        $user->increment('points', $pointGained);

                        // 2. Gunakan pemicu langsung via Model untuk memastikan mass assignment berjalan aman
                        \App\Models\Point::create([
                            'user_id'       => $user->id,
                            'amount'        => $pointGained,
                            'activity_type' => 'booking',
                            'description'   => 'Mendapatkan poin dari penyewaan lapangan #' . $booking->kode_booking,
                        ]);

                    // ✅ Perbaikan: wherePivot status pakai 'joined' (sesuai enum schema)
                    $activeBookingChallenges = $user->challenges()
                        ->where('status', 'active')
                        ->whereHas('type', function ($query) {
                            $query->where('slug', 'booking');
                        })
                        ->wherePivot('status', 'joined') // 🔧 'progress' → 'joined'
                        ->get();

                    foreach ($activeBookingChallenges as $challenge) {
                        $newProgress = $challenge->pivot->progress + 1;

                        if ($newProgress >= $challenge->target_amount) {
                            $user->challenges()->updateExistingPivot($challenge->id, [
                                'progress'     => $challenge->target_amount, // 🔧 current_amount → progress
                                'status'       => 'completed',               // ✅ sesuai enum
                                'completed_at' => now(),                     // ✅ isi completed_at
                            ]);

                            $user->increment('points', $challenge->reward_coin);

                            // 🔧 Model Point → tabel point_histories, pastikan $table = 'point_histories'
                            \App\Models\Point::create([
                                'user_id'       => $user->id,
                                'amount'        => $challenge->reward_coin,
                                'activity_type' => 'challenge_completed', // ✅ sesuai enum
                                'description'   => 'Menyelesaikan Tantangan: ' . $challenge->title,
                            ]);
                        } else {
                            $user->challenges()->updateExistingPivot($challenge->id, [
                                'progress' => $newProgress, // 🔧 current_amount → progress
                            ]);
                        }
                    }
                }
            } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                // Update jadi failed
                $booking->update(['status' => 'failed']);
            }
        }

            return response()->json(['message' => 'Booking callback handled successfully']);
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
            $booking = Booking::where('order_id', $orderId)->first();
            if ($booking) {
                if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                    if ($booking->status != 'success') {
                        $booking->update(['status' => 'success']);

                        $user = \App\Models\User::find($booking->user_id);
                        if ($user) {
                            $pointGained = 50;

                            // 1. Tambah poin user
                            $user->increment('points', $pointGained);

                            // 2. Gunakan pemicu langsung via Model untuk memastikan mass assignment berjalan aman
                            \App\Models\Point::create([
                                'user_id'       => $user->id,
                                'amount'        => $pointGained,
                                'activity_type' => 'booking',
                                'description'   => 'Mendapatkan poin dari penyewaan lapangan #' . $booking->kode_booking,
                            ]);

                            // ✅ Perbaikan: wherePivot status pakai 'joined' (sesuai enum schema)
                            $activeBookingChallenges = $user->challenges()
                                ->where('status', 'active')
                                ->whereHas('type', function ($query) {
                                    $query->where('slug', 'booking');
                                })
                                ->wherePivot('status', 'joined') // 🔧 'progress' → 'joined'
                                ->get();

                            foreach ($activeBookingChallenges as $challenge) {
                                $newProgress = $challenge->pivot->progress + 1;

                                if ($newProgress >= $challenge->target_amount) {
                                    $user->challenges()->updateExistingPivot($challenge->id, [
                                        'progress'     => $challenge->target_amount, // 🔧 current_amount → progress
                                        'status'       => 'completed',               // ✅ sesuai enum
                                        'completed_at' => now(),                     // ✅ isi completed_at
                                    ]);

                                    $user->increment('points', $challenge->reward_coin);

                                    // 🔧 Model Point → tabel point_histories, pastikan $table = 'point_histories'
                                    \App\Models\Point::create([
                                        'user_id'       => $user->id,
                                        'amount'        => $challenge->reward_coin,
                                        'activity_type' => 'challenge_completed', // ✅ sesuai enum
                                        'description'   => 'Menyelesaikan Tantangan: ' . $challenge->title,
                                    ]);
                                } else {
                                    $user->challenges()->updateExistingPivot($challenge->id, [
                                        'progress' => $newProgress, // 🔧 current_amount → progress
                                    ]);
                                }
                            }
                        }
                    }
                } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                    $booking->update(['status' => 'failed']);
                }
            }
        }
        // 2. Eksekusi jika ini adalah transaksi Join Komunitas
        elseif (str_starts_with($orderId, 'JOIN-')) {
            $komunitasUser = \Illuminate\Support\Facades\DB::table('join_komunitas')->where('order_id', $orderId)->first();
            if ($komunitasUser) {
                $parts = explode('-', $orderId);
                $userId = $parts[1] ?? null;

                if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                    if ($komunitasUser->status_pembayaran != 'success') {
                        \Illuminate\Support\Facades\DB::table('join_komunitas')
                            ->where('order_id', $orderId)
                            ->update(['status_pembayaran' => 'success']);

                        $user = \App\Models\User::find($userId);
                        if ($user) {
                            $user->increment('points', 20);
                        }
                    }
                } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                    \Illuminate\Support\Facades\DB::table('join_komunitas')
                        ->where('order_id', $orderId)
                        ->update(['status_pembayaran' => 'failed']);
                }
            }
        }

        return response()->json(['message' => 'Universal callback handled successfully']);
    }
}
