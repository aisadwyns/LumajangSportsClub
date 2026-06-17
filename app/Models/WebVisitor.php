<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebVisitor extends Model
{
    protected $table = 'web_visitors';

    protected $fillable = [
        'ip_address',
        'session_id',
        'page_url',
    ];
}
