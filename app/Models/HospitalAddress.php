<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalAddress extends Model
{
    use HasFactory;
    protected $connection = 'hospital', $table = 'dbo.haddr', $primaryKey = 'hpercode', $keyType = 'string';
}
