<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';
    protected $primaryKey = 'language_id';
    protected $fillable = ['name'];

    public function movies()
    {
        return $this->hasMany('App\Models\Movie', 'language_id', 'language_id');
    }

    public static function getCountLanguage()
    {
        return Language::count();
    }
}
