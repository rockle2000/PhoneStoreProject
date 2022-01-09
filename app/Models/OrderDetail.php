<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetail';
    protected $primaryKey = ['SoHDB', 'MaDT', 'Mau'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'SoHDB',
        'MaDT',
        'Mau',
        'SoLuong',
        'DonGiaBan',
    ];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('SoHDB', $this->getAttribute('SoHDB'))
            ->where('MaDT', $this->getAttribute('MaDT'))
            ->where('Mau', $this->getAttribute('Mau'));
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'MaDT',"MaDT");
    }
    public function order(){
        return $this->belongsTo(Order::class,'SoHDB',"SoHDB");
    }
}
