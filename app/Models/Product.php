<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'kode_produk',
        'merek_produk',
        'nama_produk',
        'stok',
        'harga',
        'foto'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_produk)) {
                $model->kode_produk = 'PRD' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
            }
        });
    }
}