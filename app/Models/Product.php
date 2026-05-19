<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'buyer_id',
        'name',
        'description',
        'status',
        'brand',
        'price',
        'image',
    ];

    const STATUS = [
        1 => "良好",
        2 => "目立った傷や汚れなし",
        3 => "やや傷や汚れあり",
        4 => "状態が悪い",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
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
        return self::STATUS[$this->status];
    }
}
