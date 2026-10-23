<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo && file_exists(public_path('images/' . $this->photo))) {
            return asset('images/' . $this->photo);
        }
        return asset('images/doctor_amanda.jpg');
    }
}
