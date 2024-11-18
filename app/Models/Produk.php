<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    protected $table      = 'produk';
    protected $fillable   = ['kode', 'nama', 'kategori_id', 'supplier_id', 'deskripsi'];

    protected static function booted()
    {
        static::creating(function ($produk) {
            $produk->kode = 'PRD-' . time();
        });
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
