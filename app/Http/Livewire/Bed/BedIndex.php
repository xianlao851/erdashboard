<?php

namespace App\Http\Livewire\Bed;

use DateTime;
use Carbon\Carbon;
use App\Models\Bed;
use App\Models\Room;
use Livewire\Component;
use App\Models\PatientBed;
use Livewire\WithPagination;
use App\Models\HospitalHerlog;
//use Illuminate\Support\Facades\DB;
use App\Models\HospitalPatient;
use Illuminate\Support\Facades\DB;
use App\Models\ErdashActivePatient;
use Illuminate\Support\Facades\Auth;
//use DB;
use App\Models\PatienBedUpdatedByLog;
use App\Models\PatientBedDeleteByLog;
use App\Models\PatientBedDeletedByLog;
use App\Models\PatientBedUpdatedByLog;
use function PHPUnit\Framework\isNull;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BedIndex extends Component
{
    use LivewireAlert;
    use WithPagination;
    //protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'onDrag', 'onDrop', 'dischargePatient', 'getTransferBedenccode', 'getTransferBedCode', 'reset_page',
        'trgTransferBed', 'transferPatientBed', 'patientAssignedSuccess', 'saveCount', 'showMdPatientDidNotDischargedTrg'
    ];
    public $bed_name;

    public $text = 'text';

    public $search_patient;
    public $get_ward = '1F';

    public $selected_patient_enccode, $selected_patient_bed, $selected_transfer_patient;

    // public $transfer_patient_code;
    // public $transfer_patient_bed_code;
    protected $get_beds, $get_beds_transfer;
    public $rooms, $room_id;

    protected $get_patients, $getWards, $patient_list_results;
    public $getRoomId, $getBeds;

    public $start_date, $end_date;
    public $patient_list, $patient_list_transfer, $patient_bed_list;

    public $status = false, $bedStatus = false, $transferBedStatus = false, $available = false;

    public $recentBedId, $recentPatientBedId, $getPtientBedList;

    public $perPage = 20, $currentPage = 1, $totalCount = 0, $listCount = 0;

    public $diffCount, $getTake, $setStart = 1, $setEnd, $getDiv, $sdate, $edate;

    public $resultGetTakeDivByTwo, $current_date, $created_by_emp_id, $selected_person;
    public $getRemainingPage;
    public $checkenccode = [], $getEnccode = [];
    public $getPatients = null;
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
        //-- SET USER DATA
        $this->created_by_emp_id = sprintf('%06d', Auth::user()->employee->emp_id);
        //-- SET USER DATA END

        //-- SET DATES
        $current_date = date('Y-m-d');

        $getCurrentDate = new DateTime($current_date);
        $getCurrentDate->modify('-0 day');
        $setStartDate = $getCurrentDate->format('Y-m-d');

        $this->start_date = date('Y-m-d', strtotime($setStartDate));
        $this->end_date = date('Y-m-d', strtotime($current_date));

        $this->sdate = $this->start_date  . ' 00:00:00.000';
        $this->edate = $this->end_date  . ' 23:59:59.000';
        //-- SET DATES END

        //-- UDPATE ACTIVE PATIENT COUNT
        $cur_time = Carbon::parse(now())->format('H');
        $cur_date = Carbon::parse(now())->format('Y-m-d H:i:s');

        $counActive = count(DB::connection('hospital')
            ->select("SELECT er.enccode, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
        FROM hospital.dbo.henctr entr
        RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
        RIGHT JOIN hospital.dbo.hencdiag diag ON diag.enccode = er.enccode
        RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = diag.hpercode
        WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
        AND (er.tscode IS NOT NULL) AND (diag.primediag='Y') AND (diag.diagtext IS NOT NULL) AND (er.erdtedis IS NULL)
        AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));

        $findHourDate = ErdashActivePatient::select('id', 'created_at', 'hour', 'count')->whereDate('created_at', Carbon::today())->where('hour', $cur_time)->first();

        if ($findHourDate) {

            if ($findHourDate->count < $counActive) {
                $findHourDate->count = $counActive;
                $findHourDate->updated_at = $cur_date;
                $findHourDate->save();
            } else {
                $findHourDate->updated_at = $cur_date;
                $findHourDate->save();
            }
        } else {
            ErdashActivePatient::create([
                'count' => $counActive,
                'hour' => $cur_time,
            ]);
        }
        //-- UDPATE ACTIVE PATIENT COUNT END

        $offset = ($this->currentPage - 1) * $this->perPage;
        $take = $offset + $this->perPage;

        // query with encounter table with manual pagination
        // $this->getPatients = collect(DB::connection('hospital')
        //     ->select(
        //         "SELECT * FROM (SELECT hperson.patlast, hperson.patfirst, hperson.patmiddle, hperson.patsex, hperson.hpercode, herlog.erdate, hencdiag.primediag, herlog.enccode, herlog.tscode, herlog.patage, hencdiag.diagtext, henctr.encstat, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
        //          FROM henctr
        //          INNER JOIN herlog ON  herlog.enccode = henctr.enccode
        //          INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
        //          INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
        //          WHERE herlog.erstat='A'
        //          AND (henctr.encstat = 'A')
        //          AND (henctr.toecode = 'ER' OR henctr.toecode = 'ERADM')
        //          AND (hencdiag.diagtext IS NOT NULL)
        //          AND (herlog.erdtedis IS NULL)
        //          AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
        //          AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')
        //       ) e
        //       WHERE row_num > {$offset} AND row_num <= {$take}"
        //     ));

        $this->totalCount = count(DB::connection('hospital')->select("SELECT herlog.enccode, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
        FROM henctr
             INNER JOIN herlog ON  herlog.enccode = henctr.enccode
             INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
             INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
             WHERE herlog.erstat='A'
             AND (henctr.encstat = 'A')
             AND (henctr.toecode = 'ER' OR henctr.toecode = 'ERADM')
             AND (hencdiag.diagtext IS NOT NULL)
             AND (herlog.erdtedis IS NULL)
             AND(herlog.erdate BETWEEN '$this->sdate' AND '$this->edate')
             AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')"));

        //$this->getTake =  $take;
        // if ($this->currentPage == 1) {
        //     $this->getDiv = $this->totalCount / $this->perPage;
        //     //     //$this->getDiv = (int)$this->getDiv;
        //     //     //$this->getDiv = 3;
        //     $this->getDiv = round($this->getDiv);
        //     $this->setEnd = round($this->getDiv / 2);
        // }

        // query with encounter table with manual pagination end code good pagination

        // query without encounter tabble manual pagination also
        // $this->getPatients = collect(DB::connection('hospital')
        //     ->select(
        //         "SELECT * FROM (SELECT hperson.patlast, hperson.patfirst, hperson.patmiddle, hperson.patsex, hperson.hpercode, herlog.erdate, hencdiag.primediag, herlog.enccode, herlog.tscode, herlog.patage, hencdiag.diagtext, herlog.erstat, herlog.erdtedis, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
        //         FROM herlog
        //         INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
        //         INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
        //         WHERE herlog.erstat='A'
        //         AND (hencdiag.diagtext IS NOT NULL)
        //         AND (herlog.erdtedis IS NULL)
        //         AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
        //         AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')
        //      ) e
        //      WHERE row_num > {$offset} AND row_num <= {$take}"
        //     ));

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


        $beds = collect(DB::select("SELECT bed.bed_id, bed.bed_name
        FROM erdashboard.erdash_beds bed"));

        $patientBeds = collect(DB::select("SELECT patientBed.enccode, patientBed.patient_id, patientBed.bed_id, patientBed.created_at
        FROM erdashboard.erdash_patient_beds patientBed
        WHERE (patientBed.created_at BETWEEN '$this->sdate' AND '$this->edate')"));

        $getHpersons = collect(DB::connection('hospital')
            ->select("SELECT er.enccode, er.hpercode, er.erstat, er.erdtedis, er.erdate, per.patfirst, per.patlast, per.patmiddle, per.patsex, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
        FROM hospital.dbo.henctr entr
        RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
        RIGHT JOIN hospital.dbo.hencdiag diag ON diag.enccode = er.enccode
        RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = diag.hpercode
        WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
        AND (er.tscode IS NOT NULL) AND (diag.primediag='Y') AND (diag.diagtext IS NOT NULL) AND (er.erdtedis IS NULL)
        AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));
        //dd($getHpersons);
        // old query, patient assigned is removed in the patient list but response is slow
        foreach ($patientBeds as $patientBed) {
            foreach ($getHpersons as $getHperson) {
                if ($patientBed->enccode == $getHperson->enccode) {
                    $this->getEnccode[] = $patientBed->enccode;
                }
            }
        }

        // foreach ($getEnccode as $removeEnccode) {
        //     foreach ($getHpersons as $getHperson) {
        //         if ($removeEnccode->enccode == $getHperson->enccode) {
        //             $filteredEnccode[] = $removeEnccode->enccode;
        //         }
        //     }
        // }
        //dd($getHpersons);

        if ($this->getEnccode) {
            $this->getPatients = DB::connection('hospital')->table('dbo.henctr')
                ->leftJoin('dbo.herlog', 'dbo.henctr.enccode', '=', 'dbo.herlog.enccode')
                ->leftJoin('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
                ->leftJoin('dbo.hperson', 'dbo.hencdiag.hpercode', '=', 'dbo.hperson.hpercode')
                ->select(
                    'dbo.hperson.patlast',
                    'dbo.hperson.patfirst',
                    'dbo.hperson.patmiddle',
                    //'dbo.hperson.patsex',
                    'dbo.hperson.hpercode',
                    'dbo.herlog.erdate',
                    'dbo.herlog.enccode',
                    //'dbo.herlog.patage',
                    //'dbo.hencdiag.diagtext',
                    //'dbo.hencdiag.primediag',
                )
                ->whereNotIn('dbo.herlog.enccode', $this->getEnccode)
                ->whereNotNull('dbo.herlog.tscode')
                ->where('dbo.herlog.erstat', 'A')
                ->where('dbo.henctr.encstat', 'A')
                ->whereNotNull('dbo.hencdiag.diagtext')
                ->where('dbo.hencdiag.primediag', 'Y')
                ->whereNull('dbo.herlog.erdtedis')
                ->whereIn('dbo.henctr.toecode', ['ER', 'ERADM'])
                ->whereBetween(DB::raw('erdate'), [$this->sdate, $this->edate])
                ->orderBy('dbo.hperson.patlast', 'asc')->get();
        } elseif ($this->getEnccode == null) {
            $this->getPatients = DB::connection('hospital')->table('dbo.henctr')
                ->leftJoin('dbo.herlog', 'dbo.henctr.enccode', '=', 'dbo.herlog.enccode')
                ->leftJoin('dbo.hencdiag', 'dbo.herlog.enccode', '=', 'dbo.hencdiag.enccode')
                ->leftJoin('dbo.hperson', 'dbo.hencdiag.hpercode', '=', 'dbo.hperson.hpercode')
                ->select(
                    'dbo.hperson.patlast',
                    'dbo.hperson.patfirst',
                    'dbo.hperson.patmiddle',
                    //'dbo.hperson.patsex',
                    'dbo.hperson.hpercode',
                    'dbo.herlog.erdate',
                    'dbo.herlog.enccode',
                    //'dbo.herlog.patage',
                    //'dbo.hencdiag.diagtext',
                    //'dbo.hencdiag.primediag',
                )
                //->whereNotIn('dbo.herlog.enccode', $this->getEnccode)
                ->whereNotNull('dbo.herlog.tscode')
                ->where('dbo.herlog.erstat', 'A')
                ->where('dbo.henctr.encstat', 'A')
                ->whereNotNull('dbo.hencdiag.diagtext')
                ->where('dbo.hencdiag.primediag', 'Y')
                ->whereNull('dbo.herlog.erdtedis')
                ->whereIn('dbo.henctr.toecode', ['ER', 'ERADM'])
                ->whereBetween(DB::raw('erdate'), [$this->sdate, $this->edate])
                ->orderBy('dbo.hperson.patlast', 'asc')->get();
        }

        //dd($this->getPatients);
        // old query end

        // trial
        // foreach ($patientBeds as $patientBed) {
        //     foreach ($getHpersons as $getHperson) {
        //         if ($patientBed->enccode == $getHperson->enccode) {
        //             $getAssinged[] = $getHperson->enccode;
        //         }
        //     }
        // }
        // $getPatients = collect(DB::connection('hospital')->select("SELECT hperson.patlast, hperson.patfirst, hperson.patmiddle, hperson.patsex, hperson.hpercode, herlog.erdate, hencdiag.primediag, herlog.enccode, herlog.tscode, herlog.patage, hencdiag.diagtext, henctr.encstat, ROW_NUMBER() OVER (ORDER BY hperson.patlast ASC) as row_num
        //  FROM henctr
        //       INNER JOIN herlog ON  herlog.enccode = henctr.enccode
        //       INNER JOIN hencdiag ON hencdiag.enccode = herlog.enccode
        //       INNER JOIN hperson ON hencdiag.hpercode = hperson.hpercode
        //       WHERE herlog.erstat='A'
        //       AND (henctr.encstat = 'A')
        //       AND (henctr.toecode = 'ER' OR henctr.toecode = 'ERADM')
        //       AND (hencdiag.diagtext IS NOT NULL)
        //       AND (herlog.erdtedis IS NULL)
        //       AND(herlog.erdate BETWEEN '$sdate' AND '$edate')
        //       AND (herlog.tscode IS NOT NULL) AND (hencdiag.primediag='Y')
        //       AND (herlog.enccode NOT IN )", $getAssinged));

        //dd($getPatients);


        // $checkLogCount = ErdashActivePatient::whereDate('created_at', Carbon::today())->whereYear('created_at', Carbon::now()->year)->get()->groupBy(function ($data) {
        //     return Carbon::parse($data->erdate)->format('H');
        // });

        // dd($checkLogCount->);


        // $ward3FMP = collect(DB::connection('hospital')
        //     ->select("SELECT patrm.enccode, hdlg.admdate, patrm.patrmstat, hdlg.disdate, per.patfirst, per.patlast, per.patmiddle
        //     FROM hospital.dbo.henctr enctr
        //     RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
        //     RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
        //     RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = patrm.hpercode
        //     WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL)  AND(enctr.encstat= 'A') AND (patrm.wardcode ='FH3')
        //     AND(hdlg.admdate BETWEEN '$this->sdate' AND '$this->edate')"));
        // dd($ward3FMP);

        return view('livewire.bed.bed-index', [
            //'patients' => $this->get_patients ?? null,
            'patient_results' => $this->patient_list_results ?? null,
            'beds' => $this->get_beds,
            'bedsTransfer' => $this->get_beds_transfer,
            //'getPatients' => $getPatients,
            'beds' => $beds,
            'patientBeds' => $patientBeds,
            'getHpersons' => $getHpersons,
            //'getAssinged' => $getAssinged

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

                PatientBedDeletedByLog::create([
                    'enccode' => $this->selected_patient_enccode,
                    'emp_id' => $this->created_by_emp_id,
                    'bed_id' => $getBedDeatils->bed_id,
                ]);

                $getBedDeatilsToDelete = PatientBed::where('patient_bed_id', $getBedDeatils->patient_bed_id)->first();
                $getBedDeatilsToDelete->delete();
                $this->alert('success', 'DELETED');
            } elseif (isNull($getBedDeatils)) {
                $this->alert('info', 'NOT ASSIGNED TO A BED YET!');
            }
        } elseif ($getID != 'delete') { // code if not for delete

            $bedAvailability = Bed::select('bed_id')->where('bed_id', $this->selected_patient_bed)->get();

            foreach ($bedAvailability as $beds) { // checks if the bed is occupied
                foreach ($beds->findPatientBed as $patienBed) {
                    if ($patienBed->confirmPatientErlogStatus) {
                        $getEnccode = $patienBed->confirmPatientErlogStatus->enccode;

                        $getHperson = collect(DB::connection('hospital')
                            ->select("SELECT er.enccode, er.hpercode, er.erstat, er.erdtedis, er.erdate, per.patfirst, per.patlast, per.patmiddle, per.patsex, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
                            FROM hospital.dbo.henctr entr
                            RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
                            RIGHT JOIN hospital.dbo.hencdiag diag ON diag.enccode = er.enccode
                            RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = diag.hpercode
                            WHERE (er.enccode= '$getEnccode') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')"));

                        if ($getHperson->isNotEmpty()) {
                            $this->status = true;
                            $this->reset('selected_patient_enccode', 'selected_patient_bed');
                            $this->dispatchBrowserEvent('occupied');
                        } else {
                            $this->status = true;
                            $this->selected_person = $patienBed->confirmPatientErlogStatus;
                            $this->dispatchBrowserEvent('showMdPatientDidNotDischargedTrg');
                        }
                    }
                }
            }

            if ($this->status == false) {
                $checkenccode = PatientBed::select('enccode', 'patient_bed_id', 'bed_id')->where('enccode', $this->selected_patient_enccode)->first(); //check if the patient is assigned to a bed already=
                if ($checkenccode) {
                    $this->recentPatientBedId = $checkenccode->patient_bed_id;
                    $this->recentBedId = $checkenccode->bed_id;
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
                        'emp_id' => $this->created_by_emp_id,
                    ]);

                    $this->reset('selected_patient_enccode', 'selected_patient_bed');
                    $this->dispatchBrowserEvent('patientAssigned');
                }
            }
        }

        //-- UDPATE ACTIVE PATIENT COUNT
        $cur_time = Carbon::parse(now())->format('H');
        $cur_date = Carbon::parse(now())->format('Y-m-d H:i:s');

        $counActive = count(DB::connection('hospital')
            ->select("SELECT er.enccode, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
        FROM hospital.dbo.henctr entr
        RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
        RIGHT JOIN hospital.dbo.hencdiag diag ON diag.enccode = er.enccode
        RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = diag.hpercode
        WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
        AND (er.tscode IS NOT NULL) AND (diag.primediag='Y') AND (diag.diagtext IS NOT NULL) AND (er.erdtedis IS NULL)
        AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));

        $findHourDate = ErdashActivePatient::select('id', 'created_at', 'hour', 'count')->whereDate('created_at', Carbon::today())->where('hour', $cur_time)->first();

        if ($findHourDate) {

            if ($findHourDate->count < $counActive) {
                $findHourDate->count = $counActive;
                $findHourDate->updated_at = $cur_date;
                $findHourDate->save();
            } else {
                $findHourDate->updated_at = $cur_date;
                $findHourDate->save();
            }
        } else {
            ErdashActivePatient::create([
                'count' => $counActive,
                'hour' => $cur_time,
            ]);
        }
        //-- UDPATE ACTIVE PATIENT COUNT

        $this->reset('getPatients', 'getEnccode');
        $this->status = false;
    }

    public function transferPatientBed()
    {
        //dd();

        $fetchRoomId = Bed::select('bed_id', 'room_id')->where('bed_id', $this->selected_patient_bed)->first();
        //$getRecentBedId = $fetchRoomId->bed_id;
        $patientBed = PatientBed::where('patient_bed_id', $this->recentPatientBedId)->first();
        $patientBed->bed_id = $this->selected_patient_bed;
        $patientBed->room_id = $fetchRoomId->room_id;
        $patientBed->save();

        PatientBedUpdatedByLog::create([
            'enccode' => $this->selected_patient_enccode,
            'bed_id_from' => $this->recentBedId,
            'bed_id_to' => $this->selected_patient_bed,
            'emp_id' => $this->created_by_emp_id
        ]);

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

    // public function saveCount()
    // {
    //     $cur_time = Carbon::parse(now())->format('H');
    //     $cur_date = Carbon::parse(now())->format('Y-m-d H:i:s');


    //     $counActive = count(DB::connection('hospital')
    //         ->select("SELECT er.enccode, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
    //         FROM hospital.dbo.henctr entr
    //         RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
    //         RIGHT JOIN hospital.dbo.hencdiag diag ON diag.enccode = er.enccode
    //         RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = diag.hpercode
    //         WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
    //         AND (er.tscode IS NOT NULL) AND (diag.primediag='Y') AND (diag.diagtext IS NOT NULL) AND (er.erdtedis IS NULL)
    //         AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));

    //     $findHourDate = ErdashActivePatient::select('id', 'created_at', 'hour', 'count')->whereDate('created_at', Carbon::today())->where('hour', $cur_time)->first();
    //     if ($findHourDate) {
    //         if ($findHourDate->count < $counActive) {
    //             $findHourDate->count = $counActive;
    //             $findHourDate->updated_at = $cur_date;
    //             $findHourDate->save();
    //         } else {
    //             $findHourDate->count = $findHourDate->count;
    //             $findHourDate->updated_at = $cur_date;
    //             $findHourDate->save();
    //         }
    //     } else {
    //         ErdashActivePatient::create([
    //             'count' => $counActive,
    //             'hour' => $cur_time
    //         ]);
    //     }
    // }

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
