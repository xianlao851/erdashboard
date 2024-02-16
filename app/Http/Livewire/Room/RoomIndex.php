<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RoomIndex extends Component
{
    use LivewireAlert;
    public $room_name;

    public function render()
    {
        return view('livewire.room.room-index');
    }

    public function save()
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
