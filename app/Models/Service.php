<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'summary', 'description', 'icon', 'sort_order', 'is_active'])]
class Service extends Model
{
    protected $casts = ['is_active' => 'boolean'];
}
