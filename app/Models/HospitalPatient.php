<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
