<?php

namespace App\Http\Livewire\RoomBed;

use App\Models\Bed;
use App\Models\Room;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class View extends Component
{
    use LivewireAlert;

    public $bed_name;

    public $getRoomId;
    public $getRoom;
    public $getWardCode;
    public function mount($id)
    {
        $this->getRoomId = $id;
    }
    public function render()
    {
        $this->getRoom = Room::where('room_id', $this->getRoomId)->first();
        $this->getWardCode = $this->getRoom->ward_code;
        $beds = Bed::where('room_id', $this->getRoomId)->get();
        return view('livewire.room-bed.view', [
            'beds' => $beds,
        ]);
    }

    public function saveBed()
    {
        $this->validate([
            'bed_name' => 'required',
        ]);

        Bed::create([
            'bed_name' => $this->bed_name,
            'room_id' => $this->getRoomId,
            'status' => 'available'
        ]);
        $this->alert('success', 'Successfully Created!');
    }
}
