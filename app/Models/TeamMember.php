<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $table = 'team_members';

    protected $casts = [
        'social_links' => 'array',
        'skills' => 'array',
    ];

    protected $fillable = [
        'name',
        'position',
        'language',
        'translation_group_id',
        'bio',
        'avatar',
        'order',
        'social_links',
        'skills',
        'is_active',
        'user_id',
    ];

    // Relasi dengan user (opsional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mendapatkan terjemahan dalam bahasa lain
    public function translations()
    {
        return $this->hasMany(TeamMember::class, 'translation_group_id', 'translation_group_id')
            ->where('id', '!=', $this->id);
    }

    // Scope untuk anggota aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk pengurutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
