<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'consultation_id',
        'patient_name',
        'contact_number',
        'email',
        'patient_notes',
        'report_path',
    ];

    // Define the consultation relationship
    public function consultation()
    {
        return $this->belongsTo(ConsultationDate::class, 'consultation_id', 'id');
    }
}
