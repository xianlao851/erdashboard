<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalHadmlog extends Model
{
    use HasFactory;
    protected $connection = 'hospital', $table = 'dbo.hadmlog', $primaryKey = 'enccode', $keyType = 'string', $foreignKey = 'hpercode';

    // public function getWard($getWardCode)
    // {
    //     return $this->belongsTo(HospitalHpatroom::class, 'enccode', 'enccode')->select('wardcode', 'patrmstat')->where('wardcode', $getWardCode)->where('patrmstat', 'I')->count();
    // }

    public function patRoom()
    {
        return $this->hasMany(HospitalHpatroom::class, 'enccode', 'enccode');
    }
}
