<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $table ='shows';
    protected $primaryKey = 'show_id';
    protected $fillable = ['date', 'time_slot_id', 'movie_id', 'room_id', 'status'];

    public function timeSlot() {
        return $this->hasOne('App\Models\TimeSlot', 'time_slot_id', 'time_slot_id');
    }

    public function movie() {
        return $this->hasOne('App\Models\Movie', 'movie_id', 'movie_id');
    }

    public function room() {
        return $this->hasOne('App\Models\Room', 'room_id', 'room_id');
    }
}
