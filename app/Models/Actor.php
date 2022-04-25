<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    protected $table = 'actors';
    protected $primaryKey = 'actor_id';
    protected $fillable = ['first_name', 'last_name', 'avatar', 'description'];
    protected $appends = ['fullname'];

    public function getFullNameAttribute()
    {
        return "{$this['last_name']} {$this['first_name']}";
    }
    
    public function movies()
    {
        $this->belongsToMany(Movie::class);
    }
}
