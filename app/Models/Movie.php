<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';
    protected $primaryKey = 'movie_id';
    protected $fillable = ['title', 'slug', 'description', 'images', 'trailer', 'duaration', 'release_date', 'category_id', 'language_id'];

    public function actors() {
        return $this->belongsToMany(Actor::class);
    }

    public function category() {
        return $this->hasOne('App\Models\Category', 'category_id', 'category_id');
    }

    public function language() {
        return $this->hasOne('App\Models\Language', 'language_id', 'language_id');
    }
}
