<?php

namespace App\Http\Livewire\RoomBed;

use App\Models\Bed;
use App\Models\Room;
use Livewire\Component;
use App\Models\HospitalHward;
use App\Models\PatientRoomBed;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    public $room_name;

    public $ward_code = '1F';

    public $beds;

    public $getRoomId;
    public $getWards;

    public function render()
    {
        $this->getWards = HospitalHward::select('wardcode', 'wardname')->get();
        $rooms = Room::where('ward_code', $this->ward_code)->get();
        $this->beds = Bed::where('room_id', $this->getRoomId)->get();
        return view('livewire.room-bed.index', [
            'wards' => $this->getWards,
            'rooms' => $rooms,
        ]);
    }

    public function saveRoom()
    {
        $this->validate([
            'ward_code' => 'required',
            'room_name' => 'required'
        ]);

        Room::create([
            'room_name' => $this->room_name,
            'ward_code' => $this->ward_code,
        ]);
        $this->alert('success', 'Successfully Created!');
    }

    public function getRoomIdfn($getId)
    {
        $this->getRoomId = $getId;
    }
}
