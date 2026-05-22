<?php

namespace App\Services;

use App\Models\Challenge;
use App\Models\User;
use App\Models\Booking;
use App\Models\Komunitas;

class ChallengeService
{
    public function checkProgress(User $user)
    {
        // Ambil semua challenge aktif
        $activeChallenges = Challenge::where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

        foreach ($activeChallenges as $challenge) {
            $currentAmount = 0;

            // 1. Hitung aktivitas riil user
            if ($challenge->tipe_misi === 'akumulasi_booking') {
                $currentAmount = Booking::where('user_id', $user->id)
                    ->whereBetween('created_at', [$challenge->start_date, $challenge->end_date])
                    ->where('status', 'success')
                    ->count();
            } elseif ($challenge->tipe_misi === 'akumulasi_komunitas') {
                $currentAmount = Komunitas::where('user_id', $user->id)
                    ->whereBetween('created_at', [$challenge->start_date, $challenge->end_date])
                    ->count();
            }

            // 2. Hubungkan atau update data di tabel pivot
            $participant = $challenge->participants()->where('user_id', $user->id)->first();

            // Jika belum terdaftar di pivot, daftarkan otomatis saat ada progress
            if (!$participant && $currentAmount > 0) {
                $challenge->participants()->attach($user->id, [
                    'current_progress' => $currentAmount,
                    'status' => 'progress'
                ]);
                $participant = $challenge->participants()->where('user_id', $user->id)->first();
            }

            // 3. Jika sudah ada recordnya, update progress-nya
            if ($participant) {
                $isAlreadyCompleted = $participant->pivot->status === 'completed';

                // Cek apakah baru saja menembus target
                if ($currentAmount >= $challenge->target_amount && !$isAlreadyCompleted) {
                    $challenge->participants()->updateExistingPivot($user->id, [
                        'current_progress' => $currentAmount,
                        'status' => 'completed',
                        'completed_at' => now()
                    ]);

                    // Tambah poin reward ke user (Gunakan nama kolom poin di app Kakak, misal 'points')
                    $user->increment('points', $challenge->poin_reward);
                } else {
                    // Update progress biasa jika belum mencapai target
                    $challenge->participants()->updateExistingPivot($user->id, [
                        'current_progress' => $currentAmount
                    ]);
                }
            }
        }
    }
}
