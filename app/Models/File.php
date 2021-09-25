<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $primaryKey = 'id';

    protected $fillable = [
        'folder_id',
        'nurse_id',
        'doctor_id',
        'symptoms',
        'temperature',
        'bpm',
        'weight',
        'height',
        'prognosis',
        'diagnosis',
        'health_status',
        'contagious',
        'time_of_detection',
        'time_of_cured',
        'created_at',
        'updated_at',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class, 'nurse_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function medications()
    {
        return $this->hasMany(Medication::class, 'file_id');
    }
}
