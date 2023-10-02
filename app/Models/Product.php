<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id', 'category_id', 'name', 'slug', 'description', 'image', 'price', 'compar_price',
        'options', 'rating', 'featured', 'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope('storeData', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }

    //? Relations 
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id')->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //? scopes 
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=',  'active');
    }

    //? Accessors => creating custom attributes (calculated) for the model obj 
    // get...Attribute 
    public function getImageUrlAttribute()
    {
        if (!$this->image)
            return "https://boschbrandstore.com/wp-content/uploads/2019/01/no-image.png";

        if (Str::startsWith($this->image, ['http://', 'https://']))
            return $this->image;
        return asset('storage/', $this->image);
    }

    public function getSaleTagAttribute()
    {
        return round(100 - ($this->price / $this->compare_price * 100), 1);
    }
}
