<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['visitor_hash', 'path', 'ip', 'user_agent', 'visited_at'];

    protected $casts = ['visited_at' => 'datetime'];
}
