<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatienBedUpdatedByLog extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "patien_bed_updated_by_logs";
    protected $primaryKey = "id";
    protected $foreignKey = 'enccode';
    protected $fillable = [
        'emp_id',
        'bed_id',
        'enccode',
        'bed_id_from',
        'bed_id_to'
    ];
}
