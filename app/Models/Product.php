<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'MaDT';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'MaDT',
        'TenDT',
        'GioiThieu',
        'MaNSX',
        'ThongSo',
        'TrangThai',
        'DanhGia',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'MaNSX', 'MaNSX');
    }

    public function image()
    {
        return $this->hasMany(Image::class, 'MaDT', 'MaDT');
    }

    public function quantity()
    {
        return $this->hasMany(Quantity::class, 'MaDT', 'MaDT')->orderBy('DonGiaBan', 'desc');
    }
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'MaDT', 'MaDT')->orderBy('NgayTao', 'desc');
    }
}
