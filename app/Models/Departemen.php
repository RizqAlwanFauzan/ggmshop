<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table      = 'departemen';
    protected $primaryKey = 'id_departemen';
    protected $fillable   = ['kode', 'nama', 'deskripsi'];

    protected static function booted()
    {
        static::creating(function ($departemen) {
            $departemen->kode = 'DEP-' . time();
        });
    }
}
