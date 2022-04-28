<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSeat extends Model
{
    use HasFactory;

    protected $table = 'type_seats';
    protected $primaryKey = 'type_seat_id';
    protected $fillable = ['name', 'price'];

    public function seats()
    {
        return $this->hasMany('App\Models\Seat', 'type_seat_id', 'type_seat_id');
    }
}
