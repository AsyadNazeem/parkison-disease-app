<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'MDVP_Fo_Hz',
        'MDVP_Fhi_Hz',
        'MDVP_Flo_Hz',
        'MDVP_Jitter',
        'MDVP_Jitter_Abs',
        'MDVP_RAP',
        'MDVP_PPQ',
        'Jitter_DDP',
        'MDVP_Shimmer',
        'MDVP_Shimmer_dB',
        'Shimmer_APQ3',
        'Shimmer_APQ5',
        'MDVP_APQ',
        'Shimmer_DDA',
        'NHR',
        'HNR',
        'RPDE',
        'DFA',
        'spread1',
        'spread2',
        'D2',
        'PPE',
        'result',
    ];
}

