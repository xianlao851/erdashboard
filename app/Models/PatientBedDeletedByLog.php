<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBedDeletedByLog extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "patient_bed_deleted_by_logs";
    protected $primaryKey = "id";
    protected $foreignKey = 'enccode';
    protected $fillable = [
        'enccode',
        'emp_id',
        'bed_id',
    ];
}
