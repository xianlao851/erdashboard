<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "erdash_beds";
    protected $primaryKey = "bed_id";
    protected $fillable = [
        'bed_name',
        'room_id',
    ];

    public function patientBed()
    {
        return $this->hasMany(PatientBed::class, 'bed_id', 'bed_id')->select('bed_id', 'enccode', 'patient_id');
    }

    public function findPatientBed()
    {
        return $this->hasMany(PatientBed::class, 'bed_id', 'bed_id')->select('bed_id', 'enccode', 'patient_id');
    }

    // public function bedAvailability()
    // {
    //     return $this->hasMany(PatientBed::class, 'bed_id', 'bed_id');
    // }
}
