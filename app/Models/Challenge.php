<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'challenges';


    public function participants()
    {
        return $this->belongsToMany(User::class, 'challenge_participants')
                    ->withPivot('current_progress', 'status', 'completed_at')
                    ->withTimestamps();
    }
}
