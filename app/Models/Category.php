<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
}
