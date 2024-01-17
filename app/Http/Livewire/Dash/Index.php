<?php

namespace App\Http\Livewire\Dash;

use App\Models\Bed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HospitalHward;
use App\Models\HospitalHerlog;
use App\Models\HospitalHpatroom;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['getPatientID', 'getPatientBed', 'dischargePatient'];

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

    public $wards = [
        '2FICU',
        '3FMIC',
        '3FMN',
        '3FMP',
        '3FNIC',
        '3FPIC',
        'CBNS',
        'CBPA',
        'CBPN',
        'SDICU',
        'SICU'
    ];


    public function render()
    {
        //  if (strlen($this->search_patient) > 1) {
        //      $columns = ['dbo.hperson.hpercode', 'dbo.hperson.patlast', 'dbo.hperson.patfirst', 'dbo.hperson.patmiddle'];
        //      $this->get_patients = DB::connection('hospital')->table('dbo.hperson')
        //          ->join('dbo.herlog', 'dbo.hperson.hpercode', '=', 'dbo.herlog.hpercode')
        //          ->join('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
        //          ->select('dbo.hperson.patlast', 'dbo.hperson.patfirst', 'dbo.hperson.patmiddle', 'dbo.hperson.hpercode', 'dbo.herlog.erdate', 'dbo.herlog.enccode')
        //          ->where(function ($query) use ($columns) {
        //              foreach ($columns as $column) {
        //                  $query->orWhere($column, 'like', '%' . $this->search_patient . '%')
        //                      ->whereNotNull('dbo.herlog.tscode')
        //                      ->whereNotNull('dbo.hencdiag.diagtext')
        //                      ->where('dbo.hencdiag.primediag', 'Y')
        //                      ->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59']);
        //              }
        //          })->paginate(10, ['*'], 'patient_list');
        //  }

        $this->get_patients = DB::connection('hospital')->table('dbo.herlog')
            ->join('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
            ->join('dbo.hperson', 'dbo.herlog.hpercode', '=', 'dbo.hperson.hpercode')
            ->select('dbo.hperson.patlast', 'dbo.hperson.patfirst', 'dbo.hperson.patmiddle', 'dbo.hperson.hpercode', 'dbo.herlog.erdate', 'dbo.herlog.enccode', 'dbo.hpatroom.patrmstat')
            ->whereNotNull('dbo.herlog.tscode')
            ->where('dbo.herlog.erstat', 'A')
            ->whereNotNull('dbo.hencdiag.diagtext')
            ->where('dbo.hencdiag.primediag', 'Y')
            ->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59'])->paginate(10, ['*'], 'patient_list');



        return view('livewire.dash.index');
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

        $patient = HospitalHpatroom::where('hpercode', $patient_id)->latest('hprdate')->where('patrmstat', 'A')->first();
    }

    // public function dischargePatient($getId)
    // {
    //     $patient_room_bed = PatientRoomBed::where('patient_room_bed_id', $getId)->first();
    //     $patient_room_bed->status = 'discharged';
    //     $patient_room_bed->save();

    //     $beds = Bed::where('bed_id', $patient_room_bed->bed_id)->first();
    //     $beds->status = 'available';
    //     $beds->save();
    //     $this->alert('success', 'Patient discharged');
    // }
}
