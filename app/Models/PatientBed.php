<?php

namespace App\Models;

use App\Models\HospitalPatient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientBed extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = "patient_bed_id";
    protected $foreignKey = 'hpercode';
    protected $fillable = [
        'patient_id',
        'bed_id',
        'ward_code',
        'enccode'
    ];

    public function patientInfo()
    {
        return $this->belongsTo(HospitalPatient::class, 'patient_id', 'hpercode');
    }
}
