<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllergyAndPhorbia extends Model
{
    use HasFactory;

    protected $table = 'allergies_and_phobias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'patient_id',
        'type',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
