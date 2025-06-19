<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
