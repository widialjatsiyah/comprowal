<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['client_name', 'client_role', 'company', 'quote', 'sort_order', 'is_active'])]
class Testimonial extends Model
{
    protected $casts = ['is_active' => 'boolean'];
}
