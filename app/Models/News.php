<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $primaryKey = 'MaTinTuc';
    // protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'TieuDe',
        'Anh',
        'TacGia',
        'NoiDung',
        'TrangThai',
        'NgayTao',
    ];

    public function news_newscategory()
    {
        return $this->hasMany(News_NewsCategory::class, 'news_id', 'MaTinTuc');
    }
}
