<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErdashActivePatient extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "erdash_active_patients";
    protected $primaryKey = "id";
    protected $fillable = [
        'count',
        'hour'
    ];
}
