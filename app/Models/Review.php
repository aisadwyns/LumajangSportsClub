<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
    'user_id',
    'reviewer_name',
    'type',
    'id_komunitas',
    'id_lapangan',
    'rating',
    'review_message',
    'is_active'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
