<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hospital_id',
        'patient_id',
        'locked',
        'pin',
        'created_at',
        'updated_at',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'folder_id');
    }
}
