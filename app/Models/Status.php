<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table      = 'status';
    protected $fillable   = ['kode', 'nama', 'deskripsi'];

    protected static function booted()
    {
        static::creating(function ($bagian) {
            $bagian->kode = 'STT-' . time();
        });
    }
}
