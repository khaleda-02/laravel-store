<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'slug',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
        // in case we didn't name the pivot table as laravel standard , 
        // return $this->belongsToMany(related class , pivot class , FK in pivot for the current model ,  FK in pivot for the related model , PK in current model , PK in related model ,);
    }
}
