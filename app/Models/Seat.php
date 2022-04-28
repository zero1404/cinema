<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Seat extends Model
{
    use HasFactory;
    
    protected $table = 'seats';
    protected $primaryKey = 'seat_id';
    protected $fillable = ['name', 'room_id', 'type_seat_id'];

    public function room()
    {
        return $this->hasOne('App\Models\Room', 'room_id', 'room_id');
    }

    public function typeSeat() {
        return $this->hasOne('App\Models\TypeSeat', 'type_seat_id', 'type_seat_id');
    }

    public function tickets() {
        return $this->hasMany('App\Models\Seat', 'seat_id', 'seat_id');
    }

    public function isFree($showId)
    {
        $tickets = Ticket::where('show_id', $showId)->whereDate('created_at', Carbon::today())->get();
        foreach($tickets as $ticket) {
            if($ticket->seat_id === $this["seat_id"]) return false;
        }
        return true;
    }
}
