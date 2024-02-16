<?php

namespace App\Models;

use App\Models\HospitalHadmlog;
use App\Models\HospitalPatient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HospitalHpatroom extends Model
{
    use HasFactory;
    protected $connection = 'hospital', $table = 'dbo.hpatroom', $primaryKey = 'enccode', $keyType = 'string', $foreignKey = 'hpercode';

    public function patientInfo()
    {
        return $this->belongsTo(HospitalPatient::class, 'hpercode', 'hpercode');
    }

    public function getAdlog()
    {
        return $this->belongsTo(HospitalHadmlog::class, 'enccode', 'enccode')->select('enccode', 'admstat')->where('admstat', 'A');
    }

    public function admittedLogs()
    {
        return $this->hasMany(HospitalHadmlog::class, 'enccode', 'enccode')->where('admstat', 'A');
    }
}
