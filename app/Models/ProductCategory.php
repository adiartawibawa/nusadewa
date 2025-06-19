<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductCategory extends Model
{
    use SoftDeletes, HasUuids, HasSlug, HasFactory;

    protected $table = 'product_categories';

    protected $casts = [
        'seo_data' => 'array',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'slug',
        'name',
        'parent_id',
        'order',
        'icon',
        'description',
        'user_id',
        'seo_data',
    ];

    // Relasi dengan parent category
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    // Relasi dengan subcategories
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->orderBy('order');
    }

    // Relasi dengan posts/products
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_product_categories', 'category_id', 'post_id')
            ->withPivot('order')
            ->orderBy('order');
    }

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk kategori utama (tidak punya parent)
    public function scopeMainCategories($query)
    {
        return $query->whereNull('parent_id');
    }
}
