<?php

namespace App\Http\Livewire\Bed;

use App\Models\Bed;
use App\Models\HospitalHerlog;
use App\Models\HospitalPatient;
use App\Models\PatientBed;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
//use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
//use DB;
use Illuminate\Support\Facades\DB;
use DateTime;
use function PHPUnit\Framework\isNull;

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

    public $room_id;

    protected $get_patients, $getWards, $patient_list_results;
    public $getRoomId, $getBeds;

    public $start_date, $end_date;
    public $patient_list, $patient_list_transfer, $patient_bed_list;

    public $status = false, $bedStatus = false, $transferBedStatus = false, $available = false;

    public $recentBedId, $recentPatientBedId, $getPtientBedList;

    public $perPage = 20, $currentPage = 1, $totalCount = 0;

    public $diffCount, $getTake, $setStart = 1, $setEnd, $getDiv;

    public $resultGetTakeDivByTwo, $current_date;
    public $getRemainingPage;
    public $checkenccode = [];
    public $num = 0;
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
        $this->available = false;
    }

    public function render()
    {
        $current_date = date('Y-m-d');

        $getCurrentDate = new DateTime($current_date);
        $getCurrentDate->modify('-7 day');
        $setStartDate = $getCurrentDate->format('Y-m-d');

        $this->start_date = date('Y-m-d', strtotime($setStartDate));
        $this->end_date = date('Y-m-d', strtotime($current_date));

        $sdate = $this->start_date  . ' 17:00:00.000';
        $edate = $this->end_date  . ' 23:59:59.000';

        $offset = ($this->currentPage - 1) * $this->perPage;
        $take = $offset + $this->perPage;

        // $trygetPatients = collect(DB::connection('hospital')
        //     ->select(
        //         "SELECT * FROM (SELECT hperson.patlast, hperson.patfirst, hperson.patmiddle, hperson.patsex, hperson.hpercode, herlog.erdate, hencdiag.primediag, herlog.enccode, herlog.tscode, herlog.patage, hencdiag.diagtext, henctr.encstat, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
        //         FROM henctr
        //         INNER JOIN herlog ON  herlog.enccode = henctr.enccode
        //         INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
        //         INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
        //         WHERE herlog.erstat='A'
        //         AND (henctr.encstat = 'A')
        //         AND (henctr.toecode = 'ER')
        //         AND (hencdiag.diagtext IS NOT NULL)
        //         AND (herlog.erdtedis IS NULL)
        //         AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
        //         AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')
        //      ) e
        //      WHERE row_num > {$offset} AND row_num <= {$take}"
        //     ));
        // dd($trygetPatients);

        $getPatients = collect(DB::connection('hospital')
            ->select(
                "SELECT * FROM (SELECT hperson.patlast, hperson.patfirst, hperson.patmiddle, hperson.patsex, hperson.hpercode, herlog.erdate, hencdiag.primediag, herlog.enccode, herlog.tscode, herlog.patage, hencdiag.diagtext, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
                FROM herlog
                INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
                INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
                WHERE herlog.erstat='A'
                AND (hencdiag.diagtext IS NOT NULL)
                AND (herlog.erdtedis IS NULL)
                AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
                AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')
             ) e
             WHERE row_num > {$offset} AND row_num <= {$take}"
            ));
        //dd($getPatients);
        $this->totalCount = count(DB::connection('hospital')->select("SELECT herlog.enccode, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
            FROM herlog
            INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
            INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
            WHERE herlog.erstat='A'
            AND (hencdiag.diagtext IS NOT NULL)
            AND (herlog.erdtedis IS NULL)
            AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
            AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')"));

        $this->getTake =  $take;
        if ($this->currentPage == 1) {
            $this->getDiv = $this->totalCount / $this->perPage;
            //$this->getDiv = (int)$this->getDiv;
            //$this->getDiv = 3;
            $this->getDiv = round($this->getDiv);
            $this->setEnd = round($this->getDiv / 2);
        }


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

        // if (strlen($this->search_patient) > 3) {
        //     $columns = ['hpercode', 'patlast', 'patfirst', 'patmiddle'];
        //     $this->patient_list_results = HospitalPatient::select('hpercode', 'patlast', 'patfirst', 'patmiddle')->where(function ($query) use ($columns) {
        //         foreach ($columns as $column) {
        //             $query->orWhere($column, 'LIKE', '%' . $this->search_patient . '%');
        //             //$query->orWhere($column, $this->search_patient);
        //         }
        //     })->get();
        // } else {
        //     //$this->get_beds = Bed::select('bed_id', 'bed_name', 'room_id')->where('room_id', $this->room_id)->paginate(20, ['*'], 'patient_bed_list');
        // }
        // if ($this->transferBedStatus == true) {
        //     $this->get_beds_transfer = Bed::select('bed_id', 'bed_name', 'room_id')->where('room_id', $this->room_id)->paginate(12, ['*'], 'patient_list_transfer');
        // }

        // if ($this->room_id != null || $this->room_id != '') {
        //     $this->get_beds = Bed::select('bed_id', 'bed_name', 'room_id')->where('room_id', $this->room_id)->paginate(20, ['*'], 'patient_bed_list');
        // }

        // $this->rooms = Room::select('room_name', 'room_id')->get();

        // $roomBeds = collect(DB::select("SELECT room.room_name, bed.bed_id, bed.bed_name
        // FROM erdashboard.erdash_rooms room
        // RIGHT JOIN erdashboard.erdash_beds bed ON room.room_id = bed.room_id"));

        $beds = collect(DB::select("SELECT bed.bed_id, bed.bed_name
        FROM erdashboard.erdash_beds bed"));

        $patientBeds = collect(DB::select("SELECT patientBed.enccode, patientBed.patient_id, patientBed.bed_id, patientBed.created_at
        FROM erdashboard.erdash_patient_beds patientBed"));

        $getHpersons = collect(DB::connection('hospital')
            ->select("SELECT er.enccode, er.hpercode, er.erstat, er.erdtedis, per.patfirst, per.patlast, per.patmiddle, per.patsex
            FROM hospital.dbo.herlog er
            RIGHT JOIN hospital.dbo.hperson per ON er.hpercode = per.hpercode
            RIGHT JOIN hospital.dbo.hencdiag diag ON er.enccode = diag.enccode
            WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$sdate' AND '$edate')
            AND (er.tscode IS NOT NULL) AND (diag.primediag='Y') AND (diag.diagtext IS NOT NULL) AND (er.erdtedis IS NULL)"));

        //dd($getHpersons);
        return view('livewire.bed.bed-index', [
            //'patients' => $this->get_patients ?? null,
            'patient_results' => $this->patient_list_results ?? null,
            'beds' => $this->get_beds,
            'bedsTransfer' => $this->get_beds_transfer,
            'getPatients' => $getPatients,
            'beds' => $beds,
            'patientBeds' => $patientBeds,
            'getHpersons' => $getHpersons

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
        //dd($this->selected_patient_enccode);
        if ($getID == 'delete') { // if for delete
            $getBedDeatils = PatientBed::where('enccode', $this->selected_patient_enccode)->first();
            if ($getBedDeatils) {
                $getBedDeatils->delete();
                $this->alert('success', 'DELETED');
            } elseif (isNull($getBedDeatils)) {
                $this->alert('info', 'NOT ASSIGNED TO A BED YET!');
            }
        } elseif ($getID != 'delete') { // code if not for delete

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
                $checkenccode = PatientBed::select('enccode', 'patient_bed_id')->where('enccode', $this->selected_patient_enccode)->first(); //check if the patient is assigned to a bed already=
                if ($checkenccode) {
                    $this->recentPatientBedId = $checkenccode->patient_bed_id;
                    $this->dispatchBrowserEvent('patientAssingedToABedAlready');
                } elseif (isNull($checkenccode)) {

                    $getPatientLog = HospitalHerlog::select('enccode', 'hpercode')->where('enccode', $this->selected_patient_enccode)->first();
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
        }


        $this->status = false;
    }

    public function transferPatientBed()
    {
        //dd($this->recentPatientBedId);
        $fetchRoomId = Bed::select('bed_id', 'room_id')->where('bed_id', $this->selected_patient_bed)->first();
        $patientBed = PatientBed::where('patient_bed_id', $this->recentPatientBedId)->first();
        $patientBed->bed_id = $this->selected_patient_bed;
        $patientBed->room_id = $fetchRoomId->room_id;
        $patientBed->save();
        $this->dispatchBrowserEvent('patientAssignedSuccess');

        //$fetchPatientBedInfo = PatientBed::where('patient_bed_id')->first();
        //dd($fetchPatientBedInfo->bedInfo->bed_name);
        //$this->dispatchBrowserEvent('patientAssignedSuccess', ['bedName' => $fetchPatientBedInfo->bedInfo->bed_name, 'patienInfo' => $fetchPatientBedInfo->getHerlogPatientInfo->getPatient->get_patient_name()]);
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
