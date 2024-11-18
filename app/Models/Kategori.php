<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $table      = 'kategori';
    protected $fillable   = ['kode', 'nama', 'deskripsi'];

    protected static function booted()
    {
        static::creating(function ($bagian) {
            $bagian->kode = 'KTG-' . time();
        });
    }

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
