<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','title', 'slug', 'content', 'image', 'published'];
    protected $casts = [
        'published' => 'boolean',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function canDelete(): bool
    {
        return $this->tags()->count() === 0;
    }
}
