<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'newscategory';
    protected $primaryKey = 'MaTheLoai';
    // protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'TheLoai',
        'TrangThai'
    ];

    public function news_cate()
    {
        return $this->hasMany(News_NewsCategory::class, 'newscategory_id', 'MaTheLoai');
    }
}
