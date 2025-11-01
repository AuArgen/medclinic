<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor_id',
        'room_number',
        'capacity',
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
