<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasAvatar, HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;
    use HasUuids;
    use InteractsWithMedia;

    /**
     * Role identifier for a Contributor.
     *
     * @const int
     */
    public const CONTRIBUTOR = 1;

    /**
     * Role identifier for an Editor.
     *
     * @const int
     */
    public const EDITOR = 2;

    /**
     * Role identifier for an Admin.
     *
     * @const int
     */
    public const ADMIN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'summary',
        'avatar',
        'dark_mode',
        'digest',
        'locale',
        'role',
        'is_team_member',
        'position',
        'social_links',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'social_links' => 'array',
            'digest' => 'boolean',
            'dark_mode' => 'boolean',
            'role' => 'int',
        ];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'default_avatar',
        'default_locale',
    ];

    // Relasi dengan posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relasi dengan tags
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    // Relasi dengan topics
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    // Relasi dengan product categories
    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    // Relasi sebagai team member
    public function teamMember()
    {
        return $this->hasOne(TeamMember::class);
    }

    /**
     * Check to see if the user is a Contributor.
     *
     * @return bool
     */
    public function getIsContributorAttribute(): bool
    {
        return $this->role === self::CONTRIBUTOR;
    }

    /**
     * Check to see if the user is an Editor.
     *
     * @return bool
     */
    public function getIsEditorAttribute(): bool
    {
        return $this->role === self::EDITOR;
    }

    /**
     * Check to see if the user is an Admin.
     *
     * @return bool
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === self::ADMIN;
    }

    /**
     * Return a default user locale.
     *
     * @return string
     */
    public function getDefaultLocaleAttribute(): string
    {
        return config('app.locale');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('avatar') ?: $this->default_avatar;
    }

    /**
     * Get the default avatar URL.
     *
     * @return string
     */
    public function getDefaultAvatarAttribute(): string
    {
        // Menggunakan Gravatar atau URL default
        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?d=identicon";

        // Atau jika ingin menggunakan local default image:
        // return asset('images/default-avatar.png');
    }
}
