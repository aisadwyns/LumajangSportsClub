<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtImage extends Model
{

    protected $fillable = ['court_id', 'image'];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}
