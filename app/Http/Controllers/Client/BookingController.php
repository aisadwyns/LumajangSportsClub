<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
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

        // Kalau error database (misal mass assignment), bakal ketangkep catch di bawah
        $booking = Booking::create([
            'user_id' => $user->id,
            'court_id' => $request->court_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => date('H:i:s', strtotime($request->start_time . ' +1 hour')),
            'total_price' => 20000, // Aku sesuain sama harga 20.000 di gambar kamu
            'status' => 'pending',
        ]);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $orderId = $booking->kode_booking . '-' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(3));

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
            'snap_token' => $snapToken
        ]);

    } catch (\Exception $e) {
        // Nah, semua error Laravel bakal ditangkep di sini dan dikirim rapi ke frontend
        return response()->json([
            'success' => false,
            'error' => 'Error Server: ' . $e->getMessage() . ' di baris ' . $e->getLine()
        ], 500);
    }
}
}
