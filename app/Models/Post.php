<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use SoftDeletes, HasUuids, HasSlug, HasFactory;

    protected $table = 'posts';

    protected $casts = [
        'meta' => 'array',
        'seo_data' => 'array',
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'slug',
        'language',
        'type',
        'is_featured',
        'is_landing_page',
        'landing_page_section',
        'landing_page_order',
        'title',
        'summary',
        'body',
        'published_at',
        'featured_image',
        'featured_image_caption',
        'user_id',
        'meta',
        'seo_data',
        'indexable',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'read_time',
    ];


    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    // Relasi dengan topics
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'posts_topics', 'post_id', 'topic_id');
    }

    // Relasi dengan kategori produk
    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'post_product_categories', 'post_id', 'category_id')
            ->withPivot('order')
            ->orderBy('post_product_categories.order'); // Spesifikasikan tabel pivot
    }

    // Relasi dengan views
    public function views()
    {
        return $this->hasMany(View::class);
    }

    // Scope untuk konten yang bisa diindex
    public function scopeIndexable($query)
    {
        return $query->where('indexable', true);
    }

    // Scope untuk konten unggulan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk konten landing page
    public function scopeLandingPage($query)
    {
        return $query->where('is_landing_page', true);
    }

    // Scope untuk konten berdasarkan jenis
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the human-friendly estimated reading time of a given text.
     *
     * @return string
     */
    public function getReadTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->body));
        $minutes = ceil($words / 250);
        $locale = optional(request()->user())->locale;

        return vsprintf(
            '%d %s %s',
            [
                $minutes,
                Str::plural(trans('app.mins', [], $locale), $minutes),
                trans('app.read', [], $locale),
            ]
        );
    }

    /**
     * Check to see if the post is published.
     *
     * @return bool
     */
    public function getPublishedAttribute(): bool
    {
        return ! is_null($this->published_at) && $this->published_at <= now()->toDateTimeString();
    }

    /**
     * Scope a query to only include published posts.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now()->toDateTimeString());
    }

    /**
     * Scope a query to only include drafted posts.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('published_at', '=', null)->orWhere('published_at', '>', now()->toDateTimeString());
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $post) {
            $post->tags()->detach();
            $post->topic()->detach();
        });
    }
}
