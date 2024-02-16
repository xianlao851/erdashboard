<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PatientBed;

class HospitalPatient extends Model
{
    use HasFactory;
    protected $connection = 'hospital', $table = 'dbo.hperson', $primaryKey = 'hpercode', $keyType = 'string';

    public function get_patient_name()
    {
        //return $this->belongsTo()
        if ($this->patmiddle) {
            return $this->patlast . ', ' . $this->patfirst . ' ' . $this->patmiddle;
        } else {
            return $this->patlast . ', ' . $this->patfirst;
        }
    }

    public function get_patient_name_initial()
    {
        //return $this->belongsTo()
        if ($this->patmiddle) {
            return $this->patlast . ', ' . $this->patfirst[0] . '.';
        } else {
            return $this->patlast . ', ' . $this->patfirst[0] . '.';
        }
    }

    public function getPatientRoom()
    {
        return $this->belongsTo(HospitalHpatroom::class, 'hpercode', 'hpercode')->latest('hprdate')->where('patrmstat', 'A');
    }

    public function checkPatientBedAssinged()
    {
        return $this->hasMany(PatientBed::class, 'patient_id', 'hpercode');
    }
}
