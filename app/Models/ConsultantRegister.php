<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultantRegister extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consultant_registers'; // Update to match the actual table name if needed

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'qualification',
        'experience_years',
        'hospital_affiliation',
        'consultation_fee',
        'availability',
        'profile_picture',
        'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'experience_years' => 'integer',
        'consultation_fee' => 'float',
    ];

    /**
     * The attributes that should be hidden for arrays (e.g., API responses).
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
