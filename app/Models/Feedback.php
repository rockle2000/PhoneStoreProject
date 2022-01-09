<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    // protected $primaryKey = ['MaDT', 'Mau'];
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'MaDT',
        'EmailKH',
        'DanhGia',
        'BinhLuan',
        'NgayTao'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'EmailKH', 'email');
    }
}
