<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

// app/Models/Transaction.php
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'kode_transaksi',
        'kode_customer',
        'kode_produk',
        'quantity',
        'total_harga',
        'status',
        'tanggal_dibayar'
    ];

    protected $casts = [
        'tanggal_dibayar' => 'datetime',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function markAsDone()
    {
        $this->update([
            'status' => 'done',
            'tanggal_dibayar' => now()
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_transaksi)) {
                $model->kode_transaksi = 'TRX' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
            }
        });
    }
}