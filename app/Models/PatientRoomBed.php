<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRoomBed extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = "patient_room_bed_id";
    protected $fillable = [
        'patient_id',
        'room_id',
        'bed_id',
        'ward_code',
        'status'
    ];
    public function patientName()
    {
        return $this->belongsTo(HospitalPatient::class, 'patient_id', 'hpercode');
    }
}
