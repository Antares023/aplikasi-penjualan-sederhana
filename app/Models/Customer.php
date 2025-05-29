<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'kode_customer',
        'nama_customer',
        'email',
        'no_telp',
        'alamat'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_customer)) {
                $model->kode_customer = strtolower(substr(uniqid(), -6));
            }
        });
    }
}