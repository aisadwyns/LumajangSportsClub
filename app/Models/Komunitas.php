<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JenisKomunitas;
class Komunitas extends Model
{
    use HasFactory;

    protected $table = 'komunitas';

    protected $fillable = [
        'jenis_komunitas_id','nama_komunitas','slug','deskripsi','logo',
        'lokasi','kontak','harga_per_sesi','waktu','link_wa'
    ];

    protected $casts = ['harga_per_sesi' => 'decimal:2'];

    public function jenis()
    {
        return $this->belongsTo(JenisKomunitas::class, 'jenis_komunitas_id');
    }

public function users()
{
    return $this->belongsToMany(\App\Models\User::class, 'join_komunitas', 'komunitas_id', 'user_id')
        ->withTimestamps();
}


}
