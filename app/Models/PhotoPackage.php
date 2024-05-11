<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoPackage extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image_url',
    ];

    // Konversi JSON ke array
    protected $casts = [
        'description' => 'array', // Mengubah JSON menjadi array saat mengambil data
    ];

    public function directOrders()
    {
        return $this->hasMany(DirectOrder::class, 'photo_package_id');
    }
}
