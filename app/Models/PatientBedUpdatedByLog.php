<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBedUpdatedByLog extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = "patient_bed_updated_by_logs";
    protected $primaryKey = "id";
    protected $foreignKey = 'enccode';
    protected $fillable = [
        'enccode',
        'emp_id',
        'bed_id_from',
        'bed_id_to'
    ];
}
