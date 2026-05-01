<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'user_id',
        'court_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class, 'court_id');
    }

    public function getKodeBookingAttribute()
    {
        $tanggal = $this->created_at ? $this->created_at->format('Ymd') : date('Ymd');
        // Contoh: ID 1 menjadi 0001, ID 12 menjadi 0012
        $urutan = str_pad($this->id, 4, '0', STR_PAD_LEFT);

        return 'BK-' . $tanggal . '-' . $urutan;
    }
}
