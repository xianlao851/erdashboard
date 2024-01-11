<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalHward extends Model
{
    use HasFactory;
    protected $connection = 'hospital', $table = 'dbo.hward', $primaryKey = 'wardcode', $keyType = 'string', $foreignKey = 'wclcode';
}
