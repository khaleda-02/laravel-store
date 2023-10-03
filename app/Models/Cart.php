<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        static::creating(function (Cart $cart) {
            $cart->id = Str::uuid();
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
}
