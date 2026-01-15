<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LscTeam extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'lscteams';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
public function bagian()
{
    return $this->belongsTo(Bagian::class);
}

}
