<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Court extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'courts';

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function jenis() {
        return $this->belongsTo(JenisKomunitas::class, 'jenis_komunitas_id');
    }
    public function images() {
        return $this->hasMany(CourtImage::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function getOpenTimeFormatAttribute(){
        return $this->open_time
            ? \Carbon\Carbon::parse($this->open_time)->format('H:i')
            : null;
    }

    public function getCloseTimeFormatAttribute(){
        return $this->close_time
            ? \Carbon\Carbon::parse($this->close_time)->format('H:i')
            : null;
    }

    public function venueAdmin()
    {
        return $this->belongsTo(VenueAdmin::class, 'venue_id');
    }
}
