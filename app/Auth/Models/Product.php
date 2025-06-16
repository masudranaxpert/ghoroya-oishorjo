<?php

namespace App\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
        protected $fillable = [
        'name',
        'slug', 
        'description',
        'keywords',
        'price',
        'sale_price',
        'image',
        'stock',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories')->withPivot('subcategory_id')->withTimestamps();
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'product_categories')->withTimestamps();
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function getFormattedPriceAttribute()
    {
        return '৳' . number_format($this->price, 2);
    }

    public function getFormattedSalePriceAttribute()
    {
        if ($this->sale_price) {
            return '৳' . number_format($this->sale_price, 2);
        }
        return null;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price && $this->price > $this->sale_price) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }
} 