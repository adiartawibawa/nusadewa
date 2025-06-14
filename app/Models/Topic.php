<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Topic extends Model
{
    use SoftDeletes, HasUuids, HasSlug, HasFactory;

    protected $table = 'topics';

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
        'language',
        'translation_group_id',
        'user_id',
    ];

    // Relasi dengan posts
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_topics', 'topic_id', 'post_id');
    }

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mendapatkan terjemahan dalam bahasa lain
    public function translations()
    {
        return $this->hasMany(Topic::class, 'translation_group_id', 'translation_group_id')
            ->where('id', '!=', $this->id);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $topic) {
            $topic->posts()->detach();
        });
    }
}
