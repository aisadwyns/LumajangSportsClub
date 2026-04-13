<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueAdmin extends Model
{

    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'venue_admins';

    public function user() {
        return $this->belongsTo(User::class);
    }

}
