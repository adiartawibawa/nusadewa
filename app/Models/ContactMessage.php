<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactMessage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'is_read'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ContactMessageReply::class);
    }
}
