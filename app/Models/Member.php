<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'member_id'); // sesuaikan foreign key-nya
    }
}
