<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_id',
        'nama_properti',
        'deskripsi',
        'alamat',
        'kota',
        'gambar_properti',
        'lat_properti',
        'long_properti',

    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }





    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)
            ->getPreciseTimestamp(3);
    }
    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::parse($updated_at)
            ->getPreciseTimestamp(3);
    }
}
