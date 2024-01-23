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
    protected $foreignKey = 'enccode';
    protected $fillable = [
        'patient_id',
        'bed_id',
        'ward_code',
        'enccode'
    ];


    public function patientHerlog()
    {
        return $this->belongsTo(HospitalHerlog::class, 'enccode', 'enccode')->where('erstat', 'A');
    }

    public function bedInfo()
    {
        return $this->belongsTo(Bed::class, 'bed_id', 'bed_id');
    }

    public function patientRoom()
    {
        return $this->hasMany(HospitalHadmlog::class, 'enccode', 'enccode');
    }

    public function patientErLog()
    {
        return $this->belongsTo(HospitalHerlog::class, 'enccode', 'enccode')->where('erstat', 'A');
    }
}
