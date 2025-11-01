<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medic_id',
        'appointment_date',
        'appointment_time',
        'notes',
        'status',
        'room_id',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medic()
    {
        return $this->belongsTo(User::class, 'medic_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
