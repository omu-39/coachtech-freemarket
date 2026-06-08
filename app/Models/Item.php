<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'status',
        'brand',
        'price',
        'image',
        'shipping_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasOne(Order::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            2 => '目立った傷や汚れなし',
            3 => 'やや傷や汚れあり',
            4 => '状態が悪い',
            default => '良好',
        };
    }

    public function isLiked()
    {
        return $this->likes()
            ->where('user_id', Auth::id())
            ->exists();
    }

    /**
     * 画像のURL取得アクセサ
     * @return string 画像パス
     */
    public function getImageUrlAttribute(): string
    {
        return Str::startsWith($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    /**
     * 税込み価格計算アクセサ
     * @return int 税込み価格
     */
    public function getPriceWithTaxAttribute(): int
    {
        return (int) floor($this->price * 1.1);
    }
}
