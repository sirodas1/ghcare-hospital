<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'patients';

    protected $fillable = [
        'firstname',
        'lastname',
        'othernames',
        'email',
        'phone_number',
        'national_card_id',
        'profile_pic',
        'age',
        'gender',
        'occupation',
        'region',
        'district',
        'town',
        'landmark',
        'residential_address',
        'next_of_kin',
        'nok_phone_number',
    ];


}
