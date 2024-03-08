<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "erdash_rooms";
    protected $primaryKey = "room_id";
    //protected $foreignKey = 'enccode';
    protected $fillable = [
        'room_name',
    ];

    public function getBeds()
    {
        return $this->hasMany(Bed::class, 'room_id', 'room_id');
    }

    public function getSelectedBeds($getId)
    {
        //dd($getId);
        return $this->hasMany(Bed::class, 'room_id', 'room_id')->whereIn('bed_id', $getId)->get();
    }

    public function getSelectedBedsDesc($getId)
    {
        //dd($getId);
        return $this->hasMany(Bed::class, 'room_id', 'room_id')->whereIn('bed_id', $getId)->orderBy('bed_id', 'desc')->get();
    }

    public function getSelectedBeds1()
    {
        //dd($getId);
        return $this->hasMany(Bed::class, 'room_id', 'room_id')->with('patientBed');
    }

    public function getSelectedBedsDesc1()
    {
        //dd($getId);
        return $this->hasMany(Bed::class, 'room_id', 'room_id');
    }

    public function bedCount($getId)
    {
        return $this->hasMany(Bed::class, 'room_id', 'room_id')->where('room_id', $getId);
    }
}
