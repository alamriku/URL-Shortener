<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_url',
        'long_url',
        'short_chars',
        'expire_at',
        'attempt',
        'time_frame',
        'block_duration',
    ];

    protected function exireAt(): Attribute
    {
        return new Attribute(
             fn($value) => $value,
            fn($value) => Carbon::parse($value)->format('Y-m-d H:i:s')
        );
    }
}
