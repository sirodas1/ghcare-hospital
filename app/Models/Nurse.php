<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'nurses';

    protected $fillable = [
        'hospital_id',
        'nursing_card_number',
        'firstname',
        'lastname',
        'othernames',
        'gender',
        'age',
        'email',
        'phone_number',
        'password',
        'profile_pic',
        'region',
        'district',
        'town',
        'landmark',
        'residential_address',
        'on_duty',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
