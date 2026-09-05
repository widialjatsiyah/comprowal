<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'company_name',
    'tagline',
    'description',
    'logo_path',
    'email',
    'phone',
    'address',
    'seo_title',
    'seo_description',
    'seo_keywords',
    'seo_image',
])]
class CompanySetting extends Model
{
    protected $table = 'company_settings';
}
