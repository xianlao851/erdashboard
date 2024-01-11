<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = "bed_id";
    protected $fillable = [
        'bed_name',
        'room_id',
        'status'
    ];

    public function patienRoomBed()
    {
        return $this->belongsTo(PatientRoomBed::class, 'bed_id', 'bed_id');
    }
}
