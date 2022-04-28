<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    protected $table = 'movies';
    protected $primaryKey = 'movie_id';
    protected $fillable = ['title', 'slug', 'description', 'images', 'trailer', 'duaration', 'director', 'release_date', 'language_id', 'status'];
    protected $appends = ['actor_ids', 'category_ids'];

    public function actors() {
        return $this->belongsToMany(Actor::class, 'movie_actor', 'movie_id', 'actor_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'movie_category', 'movie_id', 'category_id');
    }

    public function language() {
        return $this->hasOne('App\Models\Language', 'language_id', 'language_id');
    }

    public function getActorIdsAttribute()
    {
        return $this->actors->pluck('actor_id')->toArray();;
    }

    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('category_id')->toArray();;
    }

    public static function getBySlug($slug)
    {
        return Movie::where('slug', $slug)->first();
    }
}
