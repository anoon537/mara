<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Model DirectOrder
class DirectOrder extends Model
{
    public $incrementing = false;
    protected $keyType = 'string'; // Mengatur tipe data ID

    protected $fillable = [
        'id', // ID kustom
        'name',
        'phone',
        'paket',
        'extra_person',
        'photo_package_id',
        'booking_date',
        'booking_time',
        'price',
        'harga',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                // Mendapatkan angka terakhir dari setiap komponen tanggal
                $date = now(); // Tanggal saat ini
                $year = $date->format('Y')[-1]; // Angka terakhir dari tahun
                $month = $date->format('m')[-1]; // Angka terakhir dari bulan
                $day = $date->format('d')[-1]; // Angka terakhir dari hari

                // Urutan pesanan pada hari itu
                $orderCount = self::whereDate('created_at', $date->format('Y-m-d'))->count() + 1;

                // Format: OFFID + angka terakhir dari tahun, bulan, hari + nomor urut
                $model->id = 'OFFID' . $year . $month . $day . sprintf('%03d', $orderCount);
            }
        });
    }
    public function photo_package()
    {
        return $this->belongsTo(PhotoPackage::class, 'photo_package_id');
    }
}
