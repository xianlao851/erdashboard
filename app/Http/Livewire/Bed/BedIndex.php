<?php

namespace App\Http\Livewire\Bed;

use App\Models\Bed;
use App\Models\HospitalHerlog;
use App\Models\HospitalPatient;
use App\Models\PatientBed;
use App\Models\Room;
use Livewire\Component;
//use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
//use DB;
use Illuminate\Support\Facades\DB;

class BedIndex extends Component
{
    use LivewireAlert;
    use WithPagination;
    //protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'onDrag', 'onDrop', 'dischargePatient', 'getTransferBedenccode', 'getTransferBedCode', 'reset_page',
        'trgTransferBed', 'transferPatientBed', 'patientAssignedSuccess'
    ];
    public $bed_name;

    public $text = 'text';

    public $search_patient;
    public $get_ward = '1F';

    public $selected_patient_enccode;
    public $selected_patient_bed;
    public $selected_transfer_patient;

    // public $transfer_patient_code;
    // public $transfer_patient_bed_code;
    protected $get_beds;
    protected $get_beds_transfer;
    public $rooms;
    public $room_medicine_one_to_three, $room_medicine_four_nine, $room_medicine_ten_twenty, $room_resu, $room_trauma, $room_pedia_one_to_three, $room_ob_one_two, $room_fam_med;
    public $room_pedia_seven, $room_pedia_four, $room_pedia_five, $room_pedia_six;
    public $room_medicine_one_to_three_r = [
            '22',
            '23',
            '24'
        ],
        $room_medicine_four_nine_r = [
            '25',
            '26',
            '31',
            '32',
            '33',
            '34',
            '35',
            '36',
            '37',
        ],
        $room_medicine_ten_twenty_r = ['38', '39', '40', '41', '42', '43'],
        $room_pedia_one_to_three_r = ['17', '15', '16'],
        $room_ob_one_two_r = ['10', '11'],
        $room_pedia_seven_r = ['21'],
        $room_pedia_four_r = ['18'],
        $room_pedia_five_r = ['19'],
        $room_pedia_six_r = ['20'];

    public $room_id;

    protected $get_patients;
    protected $getWards;
    protected $patient_list_results;
    public $getRoomId;
    public $getBeds;

    public $start_date;
    public $end_date;
    public $patient_list;
    public $patient_list_transfer;
    public $patient_bed_list;

    public $status = false;
    public $bedStatus = false;
    public $transferBedStatus = false;

    public $recentBedId;
    public $recentPatientBedId;


    //public $getPatients;
    public $perPage = 20;
    public $currentPage = 1;
    public $totalCount = 0;

    public $diffCount;
    public $getTake;
    public $setStart = 1;
    public $setEnd;
    public $getDiv;

    public $resultGetTakeDivByTwo;
    public $getRemainingPage;

    public $num = 1;
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
        //$this->getPosition = Auth::user()->employee->position_id;
        $this->room_id = 0;
    }

    public function render()
    {
        $this->start_date = date('Y-m-d', strtotime('2024-02-21'));
        $this->end_date = date('Y-m-d', strtotime('2024-02-29'));

        $offset = ($this->currentPage - 1) * $this->perPage;
        $take = $offset + $this->perPage;

        $sdate = $this->start_date  . ' 17:00:00.000';
        $edate = $this->end_date  . ' 23:59:59.000';
        //$edate = $this->end_date  . ' 07:59:59.000';
        $getPtientBedList = PatientBed::select('enccode')->get();
        //dd($getPtientBedList[0]);
        $query = [];
        $get = [];
        $getPatients = collect(DB::connection('hospital')
            ->select(
                "SELECT * FROM (SELECT hperson.patlast, hperson.patfirst, hperson.patmiddle, hperson.patsex, hperson.hpercode, herlog.erdate, hencdiag.primediag, herlog.enccode, herlog.tscode, herlog.patage, hencdiag.diagtext, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
                     FROM herlog
                     INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
                     INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
                    WHERE herlog.erstat='A'
                     AND (hencdiag.diagtext IS NOT NULL)
                    AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
                     AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')
                    --  AND ( herlog.enccode NOT IN $getPtientBedList)
                 ) e
                 WHERE row_num > {$offset} AND row_num <= {$take}"
            ));
        //dd($getPatients);
        $this->totalCount = collect(DB::connection('hospital')->select("SELECT hperson.patlast, hperson.patfirst, hperson.patmiddle, hperson.patsex, hperson.hpercode, herlog.erdate, hencdiag.primediag, herlog.enccode, herlog.tscode, herlog.patage, hencdiag.diagtext, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
            FROM herlog
            INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
            INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
            WHERE herlog.erstat='A'
            AND (hencdiag.diagtext IS NOT NULL)
            AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
            AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')"))->count();

        $this->getTake =  $take;
        if ($this->currentPage == 1) {
            $this->getDiv = $this->totalCount / $this->perPage;
            //$this->getDiv = (int)$this->getDiv;
            //$this->getDiv = 3;
            $this->getDiv = round($this->getDiv);
            $this->setEnd = round($this->getDiv / 2);
        }
        //dd($this->setEnd);
        //dd($this->totalCount);
        //dd($this->getDiv);
        // if ($this->getTake < 20) {
        //     $getDiv = $this->totalCount / $this->perPage;
        //     //$getDiv = (int)$getDiv;  252
        //     $this->setEnd = $getDiv / 2;
        // } else {
        // }


        //dd($this->setEnd);
        // $this->get_patients = DB::connection('hospital')->table('dbo.herlog')
        //     ->join('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
        //     ->join('dbo.hperson', 'dbo.hencdiag.hpercode', '=', 'dbo.hperson.hpercode')
        //     ->select(
        //         'dbo.hperson.patlast',
        //         'dbo.hperson.patfirst',
        //         'dbo.hperson.patmiddle',
        //         'dbo.hperson.patsex',
        //         'dbo.hperson.hpercode',
        //         'dbo.herlog.erdate',
        //         'dbo.herlog.enccode',
        //         'dbo.herlog.patage',
        //         'dbo.hencdiag.diagtext',
        //         'dbo.hencdiag.primediag',
        //     )
        //     ->whereNotNull('dbo.herlog.tscode')
        //     ->where('dbo.herlog.erstat', 'A')
        //     ->whereNotNull('dbo.hencdiag.diagtext')
        //     ->where('dbo.hencdiag.primediag', 'Y')
        //     ->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59'])
        //     ->orderBy('dbo.hperson.patlast', 'asc')->paginate(12, ['*'], 'patient_list');

        //dd($this->get_patients);

        if (strlen($this->search_patient) > 3) {
            $columns = ['hpercode', 'patlast', 'patfirst', 'patmiddle'];
            $this->patient_list_results = HospitalPatient::select('hpercode', 'patlast', 'patfirst', 'patmiddle')->where(function ($query) use ($columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $this->search_patient . '%');
                    //$query->orWhere($column, $this->search_patient);
                }
            })->get();
        } else {
            //$this->get_beds = Bed::select('bed_id', 'bed_name', 'room_id')->where('room_id', $this->room_id)->paginate(20, ['*'], 'patient_bed_list');
        }
        if ($this->transferBedStatus == true) {
            $this->get_beds_transfer = Bed::select('bed_id', 'bed_name', 'room_id')->where('room_id', $this->room_id)->paginate(12, ['*'], 'patient_list_transfer');
        }

        if ($this->room_id != null || $this->room_id != '') {
            $this->get_beds = Bed::select('bed_id', 'bed_name', 'room_id')->where('room_id', $this->room_id)->paginate(20, ['*'], 'patient_bed_list');
        }

        $this->rooms = Room::select('room_name', 'room_id')->get();

        $get_rooms = Room::select('room_name', 'room_id')->get();

        foreach ($get_rooms as $rooms) {
            if ($rooms->room_id == '6') {
                $this->room_medicine_one_to_three = $rooms->getSelectedBeds($this->room_medicine_one_to_three_r);
                $this->room_medicine_four_nine = $rooms->getSelectedBeds($this->room_medicine_four_nine_r);
                $this->room_medicine_ten_twenty = $rooms->getSelectedBeds($this->room_medicine_ten_twenty_r);
            }
            if ($rooms->room_id == '5') {
                $this->room_resu = $rooms->getBeds;
            }
            if ($rooms->room_id == '2') {
                $this->room_trauma = $rooms->getBeds;
            }
            if ($rooms->room_id == '4') {
                $this->room_pedia_one_to_three = $rooms->getSelectedBedsDesc($this->room_pedia_one_to_three_r);
                $this->room_pedia_seven = $rooms->getSelectedBedsDesc($this->room_pedia_seven_r);
                $this->room_pedia_four = $rooms->getSelectedBedsDesc($this->room_pedia_four_r);
                $this->room_pedia_five = $rooms->getSelectedBedsDesc($this->room_pedia_five_r);
                $this->room_pedia_six = $rooms->getSelectedBedsDesc($this->room_pedia_six_r);
            }
            if ($rooms->room_id == '3') {
                $this->room_ob_one_two = $rooms->getSelectedBeds($this->room_ob_one_two_r);
            }
            if ($rooms->room_id == '1') {
                $this->room_fam_med = $rooms->getBeds;
            }
        }
        //dd($this->room_medicine_one_to_three);

        return view('livewire.bed.bed-index', [
            //'patients' => $this->get_patients ?? null,
            'patient_results' => $this->patient_list_results ?? null,
            'beds' => $this->get_beds,
            'bedsTransfer' => $this->get_beds_transfer,
            'getPatients' => $getPatients
        ]);
    }

    public function getRoomIdfn($getId)
    {
        $this->getRoomId = $getId;
    }

    public function onDrag($getId)
    {
        $this->selected_patient_enccode = $getId;
    }

    public function onDrop($getID, $getenccode)
    {

        // $this->recentPatientBedId = $getPatienBedId;
        // $this->recentBedId = $getBedId;
        $this->selected_patient_bed = $getID;
        $this->selected_patient_enccode = $getenccode;


        // $patientBed = PatientBed::where('patient_bed_id', $this->recentPatientBedId)->first();
        // $patientBed->bed_id = $getID;
        // $patientBed->room_id = $this->room_id;
        // $patientBed->save();
        // $this->selected_transfer_patient = HospitalHerlog::where('enccode', $this->selected_patient_enccode)->first();
        // $this->reset('patient_list_results', 'get_patients');
        // //$this->get_beds_transfer = Bed::select('bed_id', 'bed_name')->paginate(12, ['*'], 'patient_list_transfer');
        // $this->dispatchBrowserEvent('transferedBed');

        $bedAvailability = Bed::select('bed_id')->where('bed_id', $this->selected_patient_bed)->get();

        foreach ($bedAvailability as $beds) { // checks if the bed is occupied
            foreach ($beds->findPatientBed as $patienBed) {
                if ($patienBed->confirmPatientErlogStatus) {

                    $this->dispatchBrowserEvent('occupied');
                    $this->status = true;
                    $this->reset('selected_patient_enccode', 'selected_patient_bed');
                }
            }
        }

        if ($this->status == false) {
            //->whereBetween(DB::raw('erdate'), [$this->start_date  . ' 17:00:00', $this->end_date  . ' 07:59:59'])->latest('erdate')->first();
            $checkenccode = PatientBed::where('enccode', $this->selected_patient_enccode)->first(); //check if the patient is assigned to a bed already
            $this->recentPatientBedId = $checkenccode->patient_bed_id;

            if ($checkenccode) {
                $this->dispatchBrowserEvent('patientAssingedToABedAlready');
            } else {

                $getPatientLog = HospitalHerlog::select('enccode', 'hpercode')->where('enccode', $this->selected_patient_enccode)
                    ->where('erstat', 'A')->first();
                $getRoomdId = Bed::where('bed_id', $this->selected_patient_bed)->first();
                $this->selected_patient_bed = $getID;
                $patient_id = $getPatientLog->hpercode;
                $bed_id =  $this->selected_patient_bed;
                $enccode = $this->selected_patient_enccode;
                $room_id = $getRoomdId->room_id;

                PatientBed::create([
                    'patient_id' => $patient_id,
                    'bed_id' => $bed_id,
                    'room_id' => $room_id,
                    'ward_code' => 'EROOM',
                    'enccode' => $enccode,
                ]);
                $this->reset('selected_patient_enccode', 'selected_patient_bed');
                $this->dispatchBrowserEvent('patientAssigned');
            }
        }

        $this->status = false;
    }

    public function transferPatientBed()
    {

        $fetchRoomId = Bed::select('bed_id', 'room_id')->where('bed_id', $this->selected_patient_bed)->first();
        $patientBed = PatientBed::where('patient_bed_id', $this->recentPatientBedId)->first();
        $patientBed->bed_id = $this->selected_patient_bed;
        $patientBed->room_id = $fetchRoomId->room_id;
        $patientBed->save();

        $fetchPatientBedInfo = PatientBed::where('patient_bed_id', $this->recentPatientBedId)->first();
        //dd($fetchPatientBedInfo->bedInfo->bed_name);
        $this->dispatchBrowserEvent('patientAssignedSuccess', ['bedName' => $fetchPatientBedInfo->bedInfo->bed_name, 'patienInfo' => $fetchPatientBedInfo->getHerlogPatientInfo->getPatient->get_patient_name()]);
    }

    public function saveBed()
    {

        $this->validate([
            'bed_name' => 'required'
        ]);

        Bed::create([
            'bed_name' => $this->bed_name,
            'room_id' => $this->room_id,
        ]);
        $this->alert('success', 'Bed Added');
        $this->reset('get_beds', 'bed_name');
    }

    public function  clearSearcPatient()
    {
        $this->search_patient = '';
    }

    public function transferBed($getId, $getPatienBedId, $getBedId)
    {

        //$this->get_beds_transfer = Bed::select('bed_id', 'bed_name')->paginate(12, ['*'], 'patient_list');
        $this->transferBedStatus = true;
        $this->recentPatientBedId = $getPatienBedId;
        $this->recentBedId = $getBedId;
        $this->selected_transfer_patient = HospitalHerlog::select('enccode', 'hpercode')->where('enccode', $getId)->first();
        if ($this->selected_transfer_patient) {
            $this->dispatchBrowserEvent('trgTransferBed');
        }
        $getRoomid = Bed::select('bed_id', 'room_id')->where('bed_id', $this->recentBedId)->first();
        $this->room_id = $getRoomid->room_id;
        $this->patient_list_results = null;
        $this->reset('get_patients');
    }

    public function resetVar()
    {
        $this->reset('selected_transfer_patient', 'search_patient');
        $this->transferBedStatus = false;
        $this->resetPage('patient_list_transfer', 'get_beds_transfer');
        $this->room_id = 0;
    }

    public function reset_page()
    {
        $this->resetPage('patient_bed_list');
    }


    public function setCurrentPage($page)
    {

        // public $perPage = 20;
        // public $currentPage = 1;
        // public $totalCount = 0;
        // public $diffCount;

        $this->currentPage = $page;
    }

    public function setPageToOne()
    {
        $this->setStart = 1;
        $this->setEnd = 7;
        $this->currentPage = 1;
    }

    public function next()
    {
        $this->getRemainingPage =  $this->getDiv - $this->setEnd;
        $getSetStart = $this->setStart;
        $getSetEnd = $this->setEnd;
        $getcurrentPage = $this->currentPage;

        if ($this->setEnd <= $this->getDiv) {
            $getSetStart = $getSetStart + 1;
            $getSetEnd = $getSetEnd + 1;
            $getcurrentPage = $getcurrentPage + 1;
        }

        if ($getSetEnd <= $this->getDiv) {
            $this->setStart = $this->setStart + 1;
            $this->setEnd = $this->setEnd + 1;
            $this->currentPage = $this->currentPage + 1;
        } else {
            $this->setStart = $this->setStart + $this->getRemainingPage;
            $this->setEnd = $this->setEnd + $this->getRemainingPage;
            $this->currentPage = $this->currentPage + 1;
        }
    }

    public function nextNext()
    {

        $this->getRemainingPage =  $this->getDiv - $this->setEnd;
        $getSetStart = $this->setStart;
        $getSetEnd = $this->setEnd;
        $getcurrentPage = $this->currentPage;

        if ($this->setEnd <= $this->getDiv) {
            $getSetStart = $getSetStart + 6;
            $getSetEnd = $getSetEnd + 6;
            $getcurrentPage = $getcurrentPage + 6;
        }

        if ($getSetEnd <= $this->getDiv) {
            $this->setStart = $this->setStart + 6;
            $this->setEnd = $this->setEnd + 6;
            $this->currentPage = $this->currentPage + 6;
        } else {
            $this->setStart = $this->setStart + $this->getRemainingPage;
            $this->setEnd = $this->setEnd + $this->getRemainingPage;
            $this->currentPage = $this->currentPage + $this->getRemainingPage;
        }




        // if ($this->getTake <= $this->totalCount) {
        //     $this->setStart = $this->setStart + 6;
        //     $this->setEnd = $this->setEnd + 6;
        //     $this->currentPage = $this->currentPage + 6;
        // }
        $this->resultGetTakeDivByTwo = $this->getTake / $this->totalCount;
        //dd($this->resultGetTakeDivByTwo);
    }

    public function previous()
    {

        $this->getRemainingPage =  $this->getDiv - $this->setEnd;
        $getSetStart = $this->setStart;
        $getSetEnd = $this->setEnd;
        $getcurrentPage = $this->currentPage;

        if ($this->setStart >= 1) {
            //$getSetStart = $getSetStart - 1;
            //$getSetEnd = $getSetEnd - 1;
            $getcurrentPage = $getcurrentPage - 1;
        }

        if ($getSetStart > 1) {
            if ($getcurrentPage == $getSetStart) {
                $this->setStart = $this->setStart - 1;
                $this->setEnd = $this->setEnd - 1;
            } else {
                $this->currentPage = $this->currentPage - 1;
            }
        } else {
            // $this->setStart = -1;
            // $this->setEnd = -1;
            // $this->currentPage =  -1;
        }

        // if ($this->getTake > 20 && $this->currentPage > 1) {
        //     if ($this->currentPage >= 2) {
        //         $this->setStart = 1;
        //     } else {
        //         $this->setStart--;
        //     }
        //     $this->setEnd--;
        //     $this->currentPage--;
        // }
    }

    public function previousPrevious()
    {
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
