<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'cookie_id', 'user_id', 'product_id', 'quantity'
    ];

    //? Events 
    protected static function booted()
    {

        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', Cart::getCookieId());
        });

        static::creating(function (Cart $cart) {
            $cart->id = Str::uuid();
            $cart->cookie_id = Cart::getCookieId();
        });

        // my_NOTE: when using the class based observers , here's the usage 
        // command : php artisan make:observer CartObserver --model=Cart
        // static::observe(ObserverClass::class)

    }

    //? Relations 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'name' => 'anonymous user',
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    //? helper methods 
    protected static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 30);
        }
        return $cookie_id;
    }
}
