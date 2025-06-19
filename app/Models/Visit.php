<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';

    protected $fillable = [
        'post_id',
        'ip',
        'agent',
        'referer',
        'country_code',
    ];

    // Relasi dengan post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
