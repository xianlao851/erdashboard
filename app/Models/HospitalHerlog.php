<?php

namespace App\Models;

use App\Models\HospitalPatient;
use App\Models\HospitalHpatroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HospitalHerlog extends Model
{
    use HasFactory;
    protected $connection = 'hospital', $table = 'dbo.herlog', $primaryKey = 'enccode', $keyType = 'string', $foreignKey = 'hpercode';

    public function getPatient()
    {
        return $this->belongsTo(HospitalPatient::class, 'hpercode', 'hpercode');
    }

    public function patientInfo()
    {
        return $this->belongsTo(HospitalPatient::class, 'hpercode', 'hpercode');
    }

    public function getPatientBedInfo()
    {
        return $this->belongsTo(PatientBed::class, 'enccode', 'enccode');
    }
}
