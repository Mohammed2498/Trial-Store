<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'cost', 'price', 'sale_price', 'category_id', 'quantity', 'description', 'image', 'title'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
