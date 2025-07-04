<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'external_id',
        'customer_name',
        'commodity',
        'sub_commodity',
        'quantity',
        'unit',
        'delivery_date',
    ];

    protected function casts(): array
    {
        return [
            'delivery_date' => 'datetime',
        ];
    }
}
