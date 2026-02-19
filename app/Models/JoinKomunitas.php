<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JoinKomunitas extends Model
{
    use HasFactory;

    protected $table = 'join_komunitas';
    protected $fillable = ['user_id','komunitas_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function komunitas(){
        return $this->belongsTo(Komunitas::class);
    }
}
