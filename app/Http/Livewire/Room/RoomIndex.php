<?php

namespace App\Http\Livewire\Room;

use App\Models\Bed;
use App\Models\Room;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RoomIndex extends Component
{
    use LivewireAlert;
    public $room_name, $room_id, $getRoomName, $bed_name;
    protected $listeners = ['show_add_bed'];
    public function render()
    {

        $rooms = Room::all();

        return view('livewire.room.room-index', [
            'rooms' => $rooms,
        ]);
    }

    public function clickMe()
    {
        $this->dispatchBrowserEvent('triggerBut');
    }
    public function getRoom($getId)
    {
        $this->room_id = $getId;
        $this->getRoomName = Room::select('room_name', 'room_id')->where('room_id', $this->room_id)->first();
        $this->room_id = $this->getRoomName->room_id;
        $this->dispatchBrowserEvent('show_add_bed');
    }
    public function saveBed()
    {

        $this->validate([
            'bed_name' => 'required',
            'room_id' => 'required'
        ]);
        //dd($this->bed_name);
        Bed::create([
            'bed_name' => $this->bed_name,
            'room_id' => $this->room_id,
        ]);
        $this->reset('room_id', 'bed_name');
        $this->alert('success', 'Bed Added');
    }


    public function saveRoom()
    {
        $this->validate([
            'room_name' => 'required'
        ]);

        Room::create([
            'room_name' => $this->room_name,
        ]);
        $this->alert('success', 'Bed Added');
        $this->reset('room_name');
    }
}
