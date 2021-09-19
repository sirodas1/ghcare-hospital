<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'pharmacists';

    protected $fillable = [
        'hospital_id',
        'pharmacist_card_number',
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
