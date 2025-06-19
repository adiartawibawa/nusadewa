<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
{
    protected $table = 'views';

    protected $fillable = [
        'post_id',
        'ip',
        'agent',
        'referer',
        'country_code',
    ];

    // Relasi dengan post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function getDeviceAttribute(): string
    {
        $agent = strtolower($this->agent);

        if (str_contains($agent, 'mobile')) {
            return 'Mobile';
        } elseif (str_contains($agent, 'tablet')) {
            return 'Tablet';
        } else {
            return 'Desktop';
        }
    }
}
