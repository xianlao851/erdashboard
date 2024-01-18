<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $connection = 'mysql', $table = 'wards', $primaryKey = 'ward_id', $keyType = 'string', $foreignKey = 'ward_code';

    public function  getWardDetail()
    {
        return $this->belongsTo(HospitalHward::class, 'ward_code', 'wardcode');
    }

    public function getPatientBedAssigned()
    {
        return $this->hasMany(PatientBed::class, 'ward_code', 'ward_code');
    }
}
