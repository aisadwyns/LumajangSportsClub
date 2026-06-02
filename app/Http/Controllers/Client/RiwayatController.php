<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Komunitas;
use App\Models\Booking;
use App\Models\Challenge;
use App\Models\ChallengeParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
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

    public function indexChallenges()
    {
        $userId = Auth::id();
        $challenges = Challenge::where('status', 'active')
            ->where('end_date', '>', now())
            ->with(['challengeType', 'participants' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])->latest()->get();

        return view('client.riwayat.challenge', compact('challenges'));
    }

    public function joinChallenge($id)
    {
        $challenge = Challenge::findOrFail($id);
        $userId = Auth::id();

        // 1. Validasi apakah periode tantangan masih berlaku
        if (now()->isBefore($challenge->start_date) || now()->isAfter($challenge->end_date)) {
            Alert::error('Gagal', 'Tantangan tidak berada dalam periode aktif!');
            return redirect()->back();
        }

        // 2. Cek apakah user sudah pernah bergabung sebelumnya
        $alreadyJoined = ChallengeParticipant::where('challenge_id', $challenge->id)
            ->where('user_id', $userId)
            ->exists();

        if ($alreadyJoined) {
            Alert::warning('Perhatian', 'Kamu sudah mengikuti tantangan ini');
            return redirect()->back();
        }

        $initialProgress = 0;

        if ($challenge->challenge_type === 'akumulasi_booking') {
            // Paksa ambil tanggalnya saja agar jam tidak merusak query comparison
            $startDate = \Carbon\Carbon::parse($challenge->start_date)->startOfDay(); // Jadi 2026-05-30 00:00:00
            $endDate = \Carbon\Carbon::parse($challenge->end_date)->endOfDay();     // Jadi 2026-06-30 23:59:59

            $initialProgress = Booking::where('user_id', $userId)
                ->where('status', 'success')
                ->whereBetween('booking_date', [$startDate, $endDate])
                ->count();
        }

        // 4. TENTUKAN STATUS & APALAKAH LANGSUNG SELESAI
        $status = 'joined';
        $completedAt = null;

        // Jika ternyata dari riwayat lamanya progres user sudah mencapai atau melebihi target_amount
        if ($initialProgress >= $challenge->target_amount) {
            $status = 'completed';
            $completedAt = now();

            /**
             * OPSIONAL LOGIKA TAMBAHAN:
             * Jika user langsung selesai saat join, kamu bisa langsung menambahkan koin
             * ke dompet/saldo koin user di sini.
             * Contoh:
             * $user = Auth::user();
             * $user->increment('coin', $challenge->reward_coin);
             */
        }

        // 5. Daftarkan user ke tantangan dengan progres hasil kalkulasi riwayat
        ChallengeParticipant::create([
            'challenge_id' => $challenge->id,
            'user_id'      => $userId,
            'progress'     => $initialProgress,
            'status'       => $status,
            'completed_at' => $completedAt,
        ]);

        // 6. Notifikasi SweetAlert yang adaptif
        if ($status === 'completed') {
            Alert::success('Luar Biasa!', 'Kamu langsung menyelesaikan tantangan ini dari akumulasi riwayat booking-mu! Koin berhasil didapatkan.');
        } else {
            Alert::success('Berhasil Bergabung', 'Progres awal kamu dimulai dari ' . $initialProgress . ' berdasarkan riwayat booking-mu di periode ini.');
        }
        return redirect()->route('challenges.index');
    }
}
