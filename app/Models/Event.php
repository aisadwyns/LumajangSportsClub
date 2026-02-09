<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jenisKomunitas()
    {
        return $this->belongsTo(JenisKomunitas::class);
    }
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}



