<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public static function generateBookingCode()
    {
        $prefix = 'RB-' . date('Ym') . '-';
        $last = self::where('booking_code', 'like', $prefix . '%')->orderBy('id', 'desc')->first();
        $num = $last ? ((int) substr($last->booking_code, -4)) + 1 : 1;
        return $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}
