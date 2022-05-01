<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    protected $fillable = ['name', 'total_seat'];

    public function seat() {
       return Seat::where('room_id', $this['room_id'])->get();
    }
}
