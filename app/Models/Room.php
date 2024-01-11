<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = "room_id";
    protected $fillable = [
        'room_name',
        'ward_code'
    ];

    public function ward()
    {
        return $this->belongsTo(HospitalHward::class, 'ward_code', 'wardcode');
    }
}
