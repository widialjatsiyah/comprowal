<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'client', 'category', 'summary', 'image_path', 'media_type', 'project_url', 'sort_order', 'is_featured', 'is_active'])]
class Project extends Model
{
    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean'];
}
