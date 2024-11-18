<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table      = 'supplier';
    protected $fillable   = ['kode', 'nama', 'email', 'nomor_telepon', 'alamat'];

    protected static function booted()
    {
        static::creating(function ($supplier) {
            $supplier->kode = 'SPL-' . time();
        });
    }

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
