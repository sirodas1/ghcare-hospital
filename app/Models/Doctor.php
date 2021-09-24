<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'doctors';

    protected $fillable = [
        'hospital_id',
        'doctor_card_number',
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

    public function assignedFiles()
    {
        return $this->hasMany(File::class, 'doctore_id');
    }
}
