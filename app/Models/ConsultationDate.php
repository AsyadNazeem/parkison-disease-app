<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationDate extends Model
{
    use HasFactory;

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'date',
        'time_slot',
        'max_bookings',
        'venue',
        'booked_count',
    ];

    public function consultant()
    {
        return $this->belongsTo(ConsultantRegister::class, 'user_id', 'user_id');
    }

    // Define the consultant_bookings relationship
    public function bookings()
    {
        return $this->hasMany(ConsultantBooking::class, 'consultation_id', 'id');
    }
}

