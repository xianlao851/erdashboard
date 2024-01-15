<?php

namespace App\Http\Livewire\Dash;

use App\Models\Bed;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HospitalHward;
use App\Models\HospitalHerlog;
use App\Models\PatientRoomBed;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['getPatientID', 'getPatientBed'];

    public $text = 'text';

    public $search_patient;
    public $get_ward = '1F';

    public $selected_patient;
    public $selected_patient_bed;

    public $beds;
    public $rooms;

    protected $get_patients;
    protected $getWards;
    public $getRoomId;
    public $getBeds;
    public $start_date;
    public $end_date;

    public $patient_list;

    public function  mount()
    {
        $this->start_date = date('Y-m-d', strtotime('2023-08-02'));
        $this->end_date = date('Y-m-d', strtotime('2023-08-03'));
    }
    public function render()
    {
        if (strlen($this->search_patient) > 2) {
            $columns = ['dbo.hperson.hpercode', 'dbo.hperson.patlast', 'dbo.hperson.patfirst', 'dbo.hperson.patmiddle'];
            $this->get_patients = DB::connection('hospital')->table('dbo.hperson')
                ->join('dbo.herlog', 'dbo.hperson.hpercode', '=', 'dbo.herlog.hpercode')
                ->join('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
                ->select('dbo.hperson.patlast', 'dbo.hperson.patfirst', 'dbo.hperson.patmiddle', 'dbo.hperson.hpercode', 'dbo.herlog.erdate')
                ->where(function ($query) use ($columns) {
                    foreach ($columns as $column) {
                        $query->orWhere($column, 'like', '%' . $this->search_patient . '%')
                            ->whereNotNull('dbo.herlog.tscode')
                            ->whereNotNull('dbo.hencdiag.diagtext')
                            ->where('dbo.hencdiag.primediag', 'Y')
                            ->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59']);
                    }
                })->paginate(10, ['*'], 'patient_list');
        }

        $this->getWards = HospitalHward::select('wardcode', 'wardname')->get();

        $this->rooms = Room::where('ward_code', $this->get_ward)->get();

        if ($this->rooms) {
            $this->beds = Bed::where('room_id', $this->getRoomId)->get();
        }

        return view('livewire.dash.index', [
            'patients' => $this->get_patients ?? null,
            'wards' => $this->getWards,

        ]);
    }

    public function getRoomIdfn($getId)
    {
        $this->getRoomId = $getId;
    }

    public function getPatientID($getId)
    {
        $this->selected_patient = $getId;
    }

    public function getPatientBed($getID)
    {
        $this->selected_patient_bed = $getID;

        $patient_id = $this->selected_patient;
        $room_id = $this->getRoomId;
        $bed_id =  $this->selected_patient_bed;
        $ward_code = $this->get_ward;

        $bed = Bed::where('bed_id', $bed_id)->first();

        if ($bed->status == 'occupied') {
            $this->alert('warning', 'Bed Occupied!');
        } else {
            PatientRoomBed::create([
                'patient_id' => $patient_id,
                'room_id' => $room_id,
                'bed_id' => $bed_id,
                'ward_code' => $ward_code,
                'status' => 'admit'
            ]);
            $bed = Bed::where('bed_id', $bed_id)->first();
            $bed->status = 'occupied';
            $bed->save();
            $this->alert('success', 'Bed Assigned');
        }
    }
}
