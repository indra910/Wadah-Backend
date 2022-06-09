<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'url', 'artikel_gambar'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdateAtAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    // public function toArray()
    // {
    //     $toArray = parent::toArray();
    //     $toArray['artikel_gambar'] = $this->artikel_gambar;
    //     return $toArray;
    // }

    // public function getPicturePathAttribute()
    // {
    //     return url('') . Storage::url($this->attributes['artikel_gambar']);
    // }
}
