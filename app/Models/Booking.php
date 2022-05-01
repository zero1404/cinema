<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $fillable = ['first_name', 'last_name', 'telephone', 'email', 'amount', 'payment_method', 'status', 'created_at', 'updated_at'];
    protected $appends = ['fullname'];

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'booking_id', 'booking_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'user_id', 'user_id');
    }

    public function show() {
        return $this->hasOne('App\Models\Show', 'show_id', 'show_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this['last_name']} {$this['first_name']}";
    }

    public static function getListBooking()
    {
        return Booking::where('user_id', Auth::id())->orderBy('booking_id', 'DESC')->paginate(12);
    }
}
