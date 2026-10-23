<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }
        return asset('images/article_1.jpg');
    }
}
