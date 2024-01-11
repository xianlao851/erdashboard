<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalHerlog extends Model
{
    use HasFactory;
    protected $connection = 'hospital', $table = 'dbo.herlog', $primaryKey = 'enccode', $keyType = 'string', $foreignKey = 'hpercode';
}
