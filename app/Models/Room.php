<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    protected $fillable = ['name', 'total_seat', 'seat_id'];

    public function seat() {
        return $this->hasOne('App\Models\Seat', 'seat_id', 'seat_id');
    }
}
