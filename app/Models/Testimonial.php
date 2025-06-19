<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasUuids;

    protected $table = 'testimonials';

    protected $fillable = [
        'author_name',
        'author_position',
        'author_company',
        'author_avatar',
        'content',
        'rating',
        'is_featured',
        'order',
    ];

    // Scope untuk testimonial unggulan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk pengurutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
