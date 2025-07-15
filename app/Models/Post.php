<?php

namespace App\Models;

use App\Enums\PostType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use SoftDeletes, HasUuids, HasSlug, HasFactory, HasTranslations;

    public const DEFAULT_FEATURED_IMAGE = 'default-featured-image.png';

    // PROPERTIES
    protected $table = 'posts';

    /**
     * Mass assignable attributes
     *
     * @var array<string>
     */
    protected $fillable = [
        'slug',
        'type',
        'is_featured',
        'title',
        'summary',
        'body',
        'published_at',
        'featured_image',
        'featured_image_caption',
        'user_id',
        'meta',
        'indexable',
    ];

    /**
     * Appended computed attributes
     *
     * @var array<string>
     */
    protected $appends = [
        'read_time',
        'featured_image_url',
    ];

    /**
     * Attribute casting for type conversion
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return  [
            'meta' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
            'type' => PostType::class,
        ];
    }

    public $translatable = [
        'title',
        'summary',
        'body',
    ];

    // RELATIONSHIPS
    /**
     * Relationship with User model (author)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Many-to-many relationship with Tag model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    /**
     * Many-to-many relationship with Topic model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'posts_topics', 'post_id', 'topic_id');
    }

    /**
     * Many-to-many relationship with ProductCategory model
     * Includes pivot table order field and ordering
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'post_product_categories', 'post_id', 'category_id')
            ->withPivot('order')
            ->orderBy('post_product_categories.order');
    }

    /**
     * One-to-many relationship with View model (track views)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views()
    {
        return $this->hasMany(View::class);
    }

    // SCOPES
    /**
     * Scope for published posts
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now()->toDateTimeString());
    }

    /**
     * Scope for draft posts (unpublished or scheduled)
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->whereNull('published_at')
            ->orWhere('published_at', '>', now()->toDateTimeString());
    }

    /**
     * Scope for indexable posts
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeIndexable($query)
    {
        return $query->where('indexable', true);
    }

    /**
     * Scope for featured posts
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for landing page posts
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeLandingPage($query)
    {
        return $query->where('is_landing_page', true);
    }

    /**
     * Scope for posts of specific type
     *
     * @param Builder $query
     * @param string|PostType $type
     * @return Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeProductType(Builder $query): Builder
    {
        return $query->where('type', PostType::PRODUCT->value);
    }

    // ACCESSORS & MUTATORS
    /**
     * Calculate estimated reading time (accessor)
     *
     * @return string Formatted reading time (e.g. "5 mins read")
     */
    public function getReadTimeAttribute(): string
    {
        // Ambil locale aktif saat ini
        $locale = App::getLocale();

        // Ambil isi body untuk locale aktif
        $body = $this->getTranslation('body', $locale);

        // Hitung jumlah kata
        $words = str_word_count(strip_tags($body));
        $minutes = max(1, ceil($words / 250)); // minimal 1 menit

        // Gunakan fallback ke 'read' dan 'mins' jika tidak ada terjemahan
        return vsprintf(
            '%d %s %s',
            [
                $minutes,
                trans_choice('app.mins', $minutes, [], $locale),
                trans('app.read', [], $locale),
            ]
        );
    }

    /**
     * Check if post is published (attribute accessor)
     *
     * @return bool
     */
    public function getPublishedAttribute(): bool
    {
        return $this->isPublished();
    }

    /**
     * Get views count attribute
     *
     * @return int
     */
    public function getViewsCountAttribute()
    {
        return $this->views()->count();
    }

    /**
     * Get featured image URL with fallback to default
     */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : asset('images/' . self::DEFAULT_FEATURED_IMAGE);
    }

    // METHODS
    /**
     * Check if post is published (method)
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published_at && $this->published_at <= now();
    }

    /**
     * Configure slug generation options
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    // MODEL EVENTS
    /**
     * Boot the model with event handlers
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Clean up relationships when post is deleted
         */
        static::deleting(function (self $post) {
            $post->tags()->detach();
            $post->topics()->detach();
        });
    }
}
