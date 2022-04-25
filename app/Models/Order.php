<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    protected $fillable = ['first_name', 'last_name', 'telephone', 'email', 'total', 'status'];
    protected $appends = ['fullname'];

    public function items()
    {
        return $this->hasMany('App\Models\Ticket', 'order_id', 'order_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this['last_name']} {$this['first_name']}";
    }

    public static function getCountActiveOrder()
    {
        return Order::whereNotIn('status', ['cancel', 'done'])->count();
    }

    public static function getListOrdered()
    {
        return Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(12);
    }
}
