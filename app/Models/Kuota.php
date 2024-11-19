<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kuota extends Model
{
    use HasFactory;

    protected $table      = 'kuota';
    protected $fillable   = ['penerima_id', 'produk_id', 'jumlah', 'deskripsi'];

    public function penerima(): BelongsTo
    {
        return $this->belongsTo(Penerima::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
