<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    public function teams()
{
    return $this->hasMany(LscTeam::class);
}
}
