<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    // white list : pass those fields to the create 
    protected $fillable = [
        'name', 'description', 'slug', 'parent_id', 'status', 'image'
    ];

    // black list  : exclude those fields from request 
    protected $guarded = [
        'id'
    ];
    public static function rules(bool $requireImage = true)
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'status' => ['required', 'in:active,archived'],
            'image' => [$requireImage ? 'required' : 'nullable', 'image']
        ];
    }
    //? Scopes 
    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'like', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('categories.status', '=', $value);
        });
    }

    //? Relations
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault(['name' => '-']);
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
