<?php

namespace App\Models;

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
}
