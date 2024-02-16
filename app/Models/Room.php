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
}
