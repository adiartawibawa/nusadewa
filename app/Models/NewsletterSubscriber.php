<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'ip_address',
        'is_active',
        'email_verified_at',
        'unsubscribe_token'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->unsubscribe_token = Str::random(32);
        });
    }
}
