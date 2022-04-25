<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    
    protected $table = 'seats';
    protected $primaryKey = 'seat_id';
    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany('App\Models\Room', 'seat_id', 'seat_id');
    }
}
