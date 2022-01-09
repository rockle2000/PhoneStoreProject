<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quantity extends Model
{
    use HasFactory;
    protected $table = 'product_quantity';
    protected $primaryKey = ['MaDT', 'Mau'];
    public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'MaDT',
        'Mau',
        'SoLuong',
        'DonGiaNhap',
        'DonGiaBan',
    ];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('MaDT', $this->getAttribute('MaDT'))
            ->where('Mau', $this->getAttribute('Mau'));
    }
}
