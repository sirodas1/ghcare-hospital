<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'hospitals';

    protected $fillable = [
        'logo',
        'name',
        'alias',
        'institution_id',
        'email',
        'phone_number',
        'region',
        'district',
        'town',
        'ghana_post_gps',
        'type_of_institution',
    ];

    public function root_user()
    {
        return $this->hasOne(User::class, 'hospital_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'hospital_id');
    }

    public function pharmacists()
    {
        return $this->hasMany(Pharmacist::class, 'hospital_id');
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class, 'hospital_id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'hospital_id');
    }

    public function folders()
    {
        return $this->hasMany(Folder::class, 'hospital_id');
    }
    
}
