<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    protected $fillable = [
        'challenge_type_id', 'title', 'description',
        'target_amount', 'reward_coin', 'total_winner',
        'start_date', 'end_date', 'status'
    ];

    // Mengetahui tipe dari tantangan ini
    public function challengeType(): BelongsTo
    {
        return $this->belongsTo(ChallengeType::class, 'challenge_type_id');
    }

    // Mengetahui siapa saja user yang berpartisipasi
    public function participants(): HasMany
    {
        return $this->hasMany(ChallengeParticipant::class);
    }
}
