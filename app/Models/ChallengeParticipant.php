<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChallengeParticipant extends Model
{
    protected $fillable = [
        'challenge_id', 'user_id', 'progress',
        'completed_at', 'ranking', 'reward_coin', 'status'
    ];

    // Relasi balik ke tantangan
    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class);
    }

    // Relasi ke user yang ikut serta
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
