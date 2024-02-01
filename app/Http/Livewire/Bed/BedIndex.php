<?php

namespace App\Http\Livewire\Bed;

use App\Models\Bed;
use App\Models\HospitalHerlog;
use App\Models\HospitalPatient;
use App\Models\PatientBed;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class BedIndex extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['getPatientID', 'getPatientBed', 'dischargePatient', 'getTransferBedenccode', 'getTransferBedCode'];

    public $bed_name;

    public $text = 'text';

    public $search_patient;
    public $get_ward = '1F';

    public $selected_patient_enccode;
    public $selected_patient_bed;
    public $selected_transfer_patient;

    // public $transfer_patient_code;
    // public $transfer_patient_bed_code;
    public $beds;
    public $rooms;

    protected $get_patients;
    protected $getWards;
    protected $patient_list_results;
    public $getRoomId;
    public $getBeds;

    public $start_date;
    public $end_date;
    public $patient_list;

    public $status = false;
    public $bedStatus = false;
    public $transferBedStatus = false;

    public $recentBedId;
    public $recentPatientBedId;

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
    // public function updatedSearchPatient()
    // {
    //     $columns = ['hpercode', 'patlast', 'patfirst', 'patmiddle'];

    //     $this->patient_list_results = HospitalPatient::select('hpercode', 'patlast', 'patfirst', 'patmiddle')->where(function ($query) use ($columns) {
    //         foreach ($columns as $column) {
    //             $query->orWhere($column, 'LIKE', '%' . $this->search_patient . '%');
    //         }
    //     })->get();
    // }
    public function  mount()
    {
    }

    public function render()
    {
        $this->start_date = date('Y-m-d', strtotime('2023-11-01'));
        $this->end_date = date('Y-m-d', strtotime('2023-11-31'));

        $this->get_patients = DB::connection('hospital')->table('dbo.herlog')
            ->join('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
            ->join('dbo.hperson', 'dbo.herlog.hpercode', '=', 'dbo.hperson.hpercode')
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
            ->orderBy('dbo.hperson.patlast', 'asc')->paginate(15, ['*'], 'patient_list');


        // $query = DB::connection('hospital', 'mysql')->table('hospital.dbo.hperson as patient_info')->leftjoin('hospital.dbo.herlog as patientLog', 'patientLog.hpercode', '=', 'patient_info.hpercode')
        //     ->leftjoin('patient_beds as patienBeds', 'patienBeds.patient_id', '=', 'patientLog.hpercode');
        // $output = $query->select(['patient_info.*', 'patientLog.*', 'patienBeds.*'])->where('patient_info.hpercode', '1016166')->get();
        // dd($output);

        if (strlen($this->search_patient) > 3) {
            $columns = ['hpercode', 'patlast', 'patfirst', 'patmiddle'];
            $this->patient_list_results = HospitalPatient::select('hpercode', 'patlast', 'patfirst', 'patmiddle')->where(function ($query) use ($columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $this->search_patient . '%');
                    //$query->orWhere($column, $this->search_patient);
                }
            })->get();
        } else {
            $this->beds = Bed::select('bed_id', 'bed_name')->get();
        }

        return view('livewire.bed.bed-index', [
            'patients' => $this->get_patients ?? null,
            'patient_results' => $this->patient_list_results ?? null,
            //'beds' => $beds
        ]);
    }

    public function getRoomIdfn($getId)
    {
        $this->getRoomId = $getId;
    }

    public function getPatientID($getId)
    {
        $this->selected_patient_enccode = $getId;
    }

    public function getPatientBed($getID)
    {

        // $this->recentPatientBedId = $getPatienBedId;
        // $this->recentBedId = $getBedId;
        if ($this->transferBedStatus == true) {

            $bedAvailability = Bed::select('bed_id')->where('bed_id', $getID)->get();

            foreach ($bedAvailability as $beds) { // checks if the bed is occupied
                foreach ($beds->findPatientBed as $patienBed) {
                    if ($patienBed->confirmPatientErlogStatus) {
                        $this->dispatchBrowserEvent('occupied');
                        $this->status = true;
                    }
                }
            }
            if ($this->status == false) {
                $patientBed = PatientBed::where('patient_bed_id', $this->recentPatientBedId)->first();
                $patientBed->bed_id = $getID;
                $patientBed->save();
                $this->selected_transfer_patient = HospitalHerlog::where('enccode', $this->selected_patient_enccode)->first();
                $this->reset('patient_list_results', 'get_patients', 'beds');
                $this->beds = Bed::select('bed_id', 'bed_name')->get();
                $this->dispatchBrowserEvent('transferedBed');
            }
        } else {
            $bedAvailability = Bed::select('bed_id')->where('bed_id', $getID)->get();

            foreach ($bedAvailability as $beds) { // checks if the bed is occupied
                foreach ($beds->findPatientBed as $patienBed) {
                    if ($patienBed->confirmPatientErlogStatus) {
                        $this->dispatchBrowserEvent('occupied');
                        $this->status = true;
                    }
                }
            }

            if ($this->status == false) {
                $getPatientLog = HospitalHerlog::select('enccode', 'hpercode')->where('enccode', $this->selected_patient_enccode)
                    ->where('erstat', 'A')->first();
                //->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59'])->latest('erdate')->first();

                $this->selected_patient_bed = $getID;
                $patient_id = $getPatientLog->hpercode;
                $bed_id =  $this->selected_patient_bed;
                $enccode = $this->selected_patient_enccode;

                $checkenccode = PatientBed::where('enccode', $getPatientLog->enccode)->first(); //check iuf the patient is assigned to a bed already

                if ($checkenccode) {
                    $this->dispatchBrowserEvent('notAvailable');
                } else {

                    PatientBed::create([
                        'patient_id' => $patient_id,
                        'bed_id' => $bed_id,
                        'ward_code' => 'EROOM',
                        'enccode' => $enccode,
                    ]);

                    $this->dispatchBrowserEvent('patientAssigned');
                }
            }
        }

        $this->status = false;
        $this->reset('selected_patient_enccode', 'selected_patient_bed');
        //dd('in');
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
        $this->reset('beds');
    }

    public function  clearSearcPatient()
    {
        $this->search_patient = '';
    }

    public function transferBed($getId, $getPatienBedId, $getBedId)
    {


        $this->recentPatientBedId = $getPatienBedId;
        $this->recentBedId = $getBedId;
        //dd($getId);
        $this->selected_transfer_patient = HospitalHerlog::where('enccode', $getId)->first();
        $this->transferBedStatus = true;
        $this->patient_list_results = null;
        $this->reset('get_patients');
    }

    public function resetVar()
    {
        $this->reset('selected_transfer_patient');
        $this->transferBedStatus = false;
    }

    // public function getTransferBedenccode($getId)
    // {

    //     $this->transfer_patient_code = $getId;
    //     //dd($this->transfer_patient_code = $getId);
    //     $this->resetExcept('selected_transfer_patient');
    // }

    // public function getTransferBedCode($getId)
    // {
    //     $this->transfer_patient_bed_code = $getId;
    //     //dd($this->transfer_patient_code);
    //     $this->resetExcept('selected_transfer_patient');
    // }
}
