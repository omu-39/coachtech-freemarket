<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    const CATEGORIES = [
        1 => "ファッション",
        2 => "家電",
        3 => "インテリア",
        4 => "レディース",
        5 => "メンズ",
        6 => "コスメ",
        7 => "本",
        8 => "ゲーム",
        9 => "スポーツ",
        10 => "キッチン",
        11 => "ハンドメイド",
        12 => "アクセサリー",
        13 => "おもちゃ",
        14 => "ベビー・キッズ",
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function getCategoryLabelAttribute()
    {
        return self::CATEGORIES[$this->id];
    }
}
