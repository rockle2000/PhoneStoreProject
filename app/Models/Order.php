<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    //     protected $table = 'Order';

    //     public $timestamps = false;
    //     protected $primaryKey = 'SoHDB';

    protected $table = 'order';
    protected $primaryKey = 'SoHDB';
    public $timestamps = false;
    protected $fillable = [
        'SoHDB',
        'EmailKH',
        'NgayDatHang',
        'DiaChi',
        'SoDienThoai',
        'GhiChu',
        'TongTien',
        'TrangThai',
        'payment_id'
    ];
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class, 'SoHDB', 'SoHDB')->with('product');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'EmailKH', 'email');
    }
}
