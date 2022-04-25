<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['firstname', 'lastname', 'address', 'telephone', 'email', 'note', 'discount', 'total', 'status'];
    protected $appends = ['fullname'];

    public function items()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this['lastname']} {$this['firstname']}";
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
