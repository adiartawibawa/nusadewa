<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessageReply extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'contact_message_id',
        'message'
    ];

    public function contactMessage(): BelongsTo
    {
        return $this->belongsTo(ContactMessage::class);
    }
}
