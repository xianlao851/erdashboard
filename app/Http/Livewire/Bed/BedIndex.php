<?php

namespace App\Http\Livewire\Bed;

use App\Models\Bed;
use App\Models\HospitalHerlog;
use App\Models\PatientBed;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class BedIndex extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['getPatientID', 'getPatientBed', 'dischargePatient'];

    public $bed_name;

    public $text = 'text';

    public $search_patient;
    public $get_ward = '1F';

    public $selected_patient;
    public $selected_patient_bed;

    //public $beds;
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

    public function  mount()
    {
        $this->start_date = date('Y-m-d', strtotime('2023-01-01'));
        $this->end_date = date('Y-m-d', strtotime('2023-11-01'));
    }

    public function render()
    {
        $this->get_patients = DB::connection('hospital')->table('dbo.herlog')
            ->join('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
            ->join('dbo.hperson', 'dbo.herlog.hpercode', '=', 'dbo.hperson.hpercode')
            //->join('dbo.dbo.haddr', 'dbo.herlog.hpercode', '=', 'dbo.herlog.hpercode')
            ->select(
                'dbo.hperson.patlast',
                'dbo.hperson.patfirst',
                'dbo.hperson.patmiddle',
                'dbo.hperson.patsex',
                'dbo.hperson.hpercode',
                'dbo.herlog.erdate',
                'dbo.herlog.enccode',
                'dbo.herlog.patage',
                'dbo.hencdiag.diagtext',

            )
            ->whereNotNull('dbo.herlog.tscode')
            ->where('dbo.herlog.erstat', 'A')
            ->whereNotNull('dbo.hencdiag.diagtext')
            ->where('dbo.hencdiag.primediag', 'Y')
            ->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59'])
            ->orderBy('dbo.hperson.patlast', 'asc')->paginate(18, ['*'], 'patient_list');


        $beds = Bed::all();
        return view('livewire.bed.bed-index', [
            'patients' => $this->get_patients,
            'beds' => $beds
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

        $getPatientLog = HospitalHerlog::where('hpercode', $this->selected_patient)
            ->where('erstat', 'A')
            ->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59'])->latest('erdate')->first();

        $this->selected_patient_bed = $getID;
        $patient_id = $this->selected_patient;
        $bed_id =  $this->selected_patient_bed;
        $enccode = $getPatientLog->enccode;

        $checkenccode = PatientBed::where('enccode', $getPatientLog->enccode)->first();

        if ($checkenccode) {
            $this->alert('warning', 'Patient already assigned to a bed');
        } else {
            PatientBed::create([
                'patient_id' => $patient_id,
                'bed_id' => $bed_id,
                'ward_code' => 'EROOM',
                'enccode' => $enccode,
            ]);
            $this->alert('success', 'Patient assign');
        }
    }

    public function saveBed()
    {
        $this->validate([
            'bed_name' => 'required'
        ]);

        Bed::create([
            'bed_name' => $this->bed_name,
        ]);
        $this->alert('success', 'Bed Added');
    }
}
