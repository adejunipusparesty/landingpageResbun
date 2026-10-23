<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && file_exists(public_path('images/' . $this->avatar))) {
            return asset('images/' . $this->avatar);
        }
        return asset('images/avatar_alice.jpg');
    }
}
