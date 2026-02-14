<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $fillable = [
        'whatsapp_number', 
        'store_phone', 
        'opening_hours', 
        'address', 
        'maps_embed', 
        'tagline', 
        'social_links'
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
