<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = ['name','slug'];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
    public function canDelete(): bool
    {
        return $this->posts()->count() === 0;
    }

    public static function boot() //desvincula los tags de los post y elimina el tags
    {
        parent::boot();

        static::deleting(function ($tag) {
            $tag->posts()->detach();
        });
    }


}
