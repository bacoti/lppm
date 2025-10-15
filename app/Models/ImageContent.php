<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageContent extends Model
{
    protected $guarded = ['id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
