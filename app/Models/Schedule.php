<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['court_id', 'member_id', 'schedule_date', 'start_time', 'end_time', 'type', 'note'];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function court() {
        return $this->belongsTo(Court::class);
    }
}
