<?php

namespace App\Http\Livewire\RoomBed;

use Livewire\Component;
use App\Models\HospitalHward;
use App\Models\PatientRoomBed;
use App\Models\Room;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    public $room_name;

    public $ward_code;

    public $getWards;
    public $getWard;

    public function render()
    {
        $this->getWards = HospitalHward::select('wardcode', 'wardname')->get();
        $rooms = Room::where('ward_code', $this->getWard)->get();
        $patientRoomBed = PatientRoomBed::where('ward_code', $this->getWard)->first();
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
}
