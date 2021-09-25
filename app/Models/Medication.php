<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'medications';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hospital_id',
        'file_id',
        'doctor_id',
        'pharmacist_id',
        'drug_id',
        'quantity',
        'dosage',
        'completed',
        'start_date',
        'end_date',
    ];

    public function connectedFile()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function prescribedDoctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function drug()
    {
        return $this->belongsTo(Inventory::class, 'drug_id');
    }

    public function processedPharmacist()
    {
        return $this->belongsTo(Pharmacist::class, 'pharmacist_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
