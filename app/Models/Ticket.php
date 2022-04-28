<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';
    protected $fillable = ['price', 'booking_id', 'show_id', 'seat_id', 'status'];

    public function booking() {
        return $this->hasOne('App\Models\Booking', 'booking_id', 'booking_id');
    }

    public function show() {
        return $this->hasOne('App\Models\Show', 'show_id', 'show_id');
    }

    public function seat() {
        return $this->hasOne('App\Models\Seat', 'seat_id', 'seat_id');
    }

    public function isCanceled() {
        return $this['status'] === 'canceled';
    }
}
