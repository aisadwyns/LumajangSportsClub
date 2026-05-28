<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChallengeType extends Model
{
    use HasFactory;
    protected $table = 'challenge_types';
    protected $fillable = ['name', 'code', 'description'];

    // Satu tipe bisa digunakan oleh banyak tantangan
    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class);
    }
}
