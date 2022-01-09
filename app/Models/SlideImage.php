<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideImage extends Model
{
    use HasFactory;
    protected $table = 'home_image';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'Anh',
        'NoiDung',
        'Type'
    ];
}
