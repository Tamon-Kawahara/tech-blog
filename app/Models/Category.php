<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    // 投稿とのリレーション（1対多）
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
