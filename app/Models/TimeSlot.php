<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $table = 'time_slots';
    protected $primaryKey = 'time_slot_id';
    protected $fillable = ['time_start', 'time_end'];
}
