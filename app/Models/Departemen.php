<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departemen extends Model
{
    use HasFactory;

    protected $table      = 'departemen';
    protected $fillable   = ['kode', 'nama', 'deskripsi'];

    protected static function booted()
    {
        static::creating(function ($departemen) {
            $departemen->kode = 'DEP-' . time();
        });
    }

    public function bagian(): HasMany
    {
        return $this->hasMany(Bagian::class);
    }
}
