<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = ['service_id', 'image_url', 'caption'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
