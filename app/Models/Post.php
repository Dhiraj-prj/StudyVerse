<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    protected $fillable = [
        'category_id',
        'subcategory',
        'name',
        'slug',
        'description',
        'yt_iframe',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'created_by',
    ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id'); // Corrected the foreign and local keys
    }


    public function created_by()
    {
    return $this->belongsTo(User::class, 'created_by','id'); // Adjust 'created_by' if necessary
    }

    public function user()
    {
    return $this->belongsTo(User::class, 'created_by','id'); // Adjust 'created_by' if necessary
    }

}
