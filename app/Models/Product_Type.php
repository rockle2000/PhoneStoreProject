<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Type extends Model
{
    use HasFactory;
    protected $table = 'product_type';
    protected $primaryKey = 'MaLoai';
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'TenLoai',
        'TrangThai',
    ];
}
