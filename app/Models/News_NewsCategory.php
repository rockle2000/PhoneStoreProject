<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_NewsCategory extends Model
{
    use HasFactory;
    protected $table = 'news_newscategory';
    protected $primaryKey = ['news_id', 'newscategory_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'news_id',
        'newscategory_id',
    ];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('news_id', $this->getAttribute('news_id'))
            ->where('newscategory_id', $this->getAttribute('newscategory_id'));
    }
    public function news()
    {
        return $this->belongsTo(News::class,'news_id',"MaTinTuc");
    }
    public function newscategory(){
        return $this->belongsTo(NewsCategory::class,'newscategory_id',"MaTheLoai");
    }
}
