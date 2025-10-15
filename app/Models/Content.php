<?php

// app/Models/Content.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'slug', 'body'];

    public function imageContents()
    {
        return $this->hasMany(ImageContent::class);
    }
}
