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
    public static function rules(bool $is_image_required = false)
    {
        return [
            // name of the form input , validation array 
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'parent_id' => ['nullable', 'int', 'exists:categories,parent_id'],
            'status' => ['required', 'in:active,archived'],
            'image' => [$is_image_required ?? 'required', 'image', 'max:1048576']

        ];
    }
}
