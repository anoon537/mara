<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'photo_package_id',
        'booking_date',
        'booking_time',
        'price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photo_package()
    {
        return $this->belongsTo(PhotoPackage::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id'); // Relasi satu-ke-banyak
    }
}
