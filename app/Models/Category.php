<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = ['title', 'description', 'slug'];

    public function movies()
    {
        return $this->hasMany('App\Models\Movie', 'category_id', 'category_id')->where('status', 'active');
    }

    public static function getBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }

    public static function getCountCategory()
    {
        return Category::get()->count();
    }
}
