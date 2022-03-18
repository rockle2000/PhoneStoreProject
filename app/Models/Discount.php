<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discount_code';
    protected $primaryKey = 'MaKM';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'MaKM',
        'TenKM',
        'NoiDung',
        'GiamGia',
        'NgayBatDau',
        'NgayKetThuc',
        'SoLuong',
        'TrangThai',
    ];
}
