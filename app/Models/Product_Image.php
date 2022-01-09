<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    use HasFactory;
    protected $table = 'product_image';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'MaDT',
        'Anh',
    ];
}
