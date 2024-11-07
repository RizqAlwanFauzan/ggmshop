<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bagian extends Model
{
    use HasFactory;

    protected $table      = 'bagian';
    protected $fillable   = ['kode', 'departemen_id', 'nama', 'deskripsi'];

    protected static function booted()
    {
        static::creating(function ($bagian) {
            $bagian->kode = 'BAG-' . time();
        });
    }

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(Departemen::class);
    }

    public function penerima(): HasMany
    {
        return $this->hasMany(Penerima::class);
    }
}
