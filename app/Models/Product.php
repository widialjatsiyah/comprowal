<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = ['title', 'category', 'summary', 'description', 'image_path', 'product_url', 'sort_order', 'is_featured', 'is_active'];

    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean', 'views_count' => 'integer'];
}
