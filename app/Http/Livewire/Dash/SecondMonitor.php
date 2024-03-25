<?php

namespace App\Http\Livewire\Dash;

use DateTime;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\HospitalHerlog;
use Illuminate\Support\Facades\DB;
use App\Models\ErdashActivePatient;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class SecondMonitor extends Component
{
    protected $listeners = [
        'saveCount'
    ];

    public $ward2FICU = 0, $ward3FMIC = 0, $ward3FMN = 0, $ward3FMP = 0, $ward3FNIC = 0, $wardCBNS = 0, $wardCBPA = 0, $wardCBPN = 0, $wardSDICU = 0, $wardSICU = 0, $ward3FCCU = 0, $wardFH2 = 0, $wardFH3 = 0;

    public $ward2FICUAvailable, $ward3FMICAvailable, $ward3FMNAvailable, $ward3FMPAvailable, $ward3FNICAvailable, $wardCBNSAvailable, $wardCBPAAvailable, $wardCBPNAvailable, $wardSDICUAvailable, $wardSICUAvailable, $ward3FCCUAvailable, $wardFH2Available, $wardFH3Available;

    public $ward3FMPColor, $ward3FMICColor, $ward3FMNColor, $wardCBNSColor, $wardCBPAColor, $wardCBPNColor, $wardSICUColor, $ward2FICUColor, $ward3FCCUColor, $wardSDICUColor, $wardFH2Color, $wardFH3Color;
    public $erAdmittedCount = 0;
    public $erSlotAvailable;
    public $erAdmittedCountColor;

    public $months = [], $monthCount = [], $days = [], $dayCount = [], $departments = [], $deptCount = [], $dateFilter, $date_filter, $i = 0, $k = 0, $j = 0;

    public $start_date, $end_date, $sdate, $edate;

    public $getHpersons, $patientBeds, $beds, $getCurrentDateTime;

    public function mount()
    {
    }

    public function render()
    {

        //-- SET DATES
        $CurrentDateTime = date('Y-m-d H:i:s');
        $this->getCurrentDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $CurrentDateTime);
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
        // $cur_time = Carbon::parse(now())->format('H');
        // $cur_date = Carbon::parse(now())->format('Y-m-d H:i:s');

        // $counActive = count(DB::connection('hospital')
        //     ->select("SELECT er.enccode, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
        // FROM hospital.dbo.henctr entr
        // RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
        // RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = er.hpercode
        // WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
        // AND (er.tscode IS NOT NULL) AND (er.erdtedis IS NULL)
        // AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));

        // $findHourDate = ErdashActivePatient::select('id', 'created_at', 'hour', 'count')->whereDate('created_at', Carbon::today())->where('hour', $cur_time)->first();

        // if ($findHourDate) {

        //     if ($findHourDate->count < $counActive) {
        //         $findHourDate->count = $counActive;
        //         $findHourDate->updated_at = $cur_date;
        //         $findHourDate->save();
        //     } else {
        //         $findHourDate->updated_at = $cur_date;
        //         $findHourDate->save();
        //     }
        // } else {
        //     ErdashActivePatient::create([
        //         'count' => $counActive,
        //         'hour' => $cur_time,
        //     ]);
        // }
        //-- UDPATE ACTIVE PATIENT COUNT END

        $this->i = 0;
        //$this->j = 0;
        $this->erAdmittedCount = 0;
        $this->months = null;
        $this->monthCount = null;
        $this->days = null;
        $this->dayCount = null;

        //---- 1 OPD 3rd Floor (MICU A)
        $this->ward3FMP = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
                FROM hospital.dbo.henctr enctr
                RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
                RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
                WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='3FMP') "));

        if ($this->ward3FMP > 0) {
            $ward3FMPSlot = 8;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
            if ($this->ward3FMP < floor($ward3FMPSlot * .5)) {
                $this->ward3FMPColor = '#04bd55';
            }
            if ($this->ward3FMP >= ($ward3FMPSlot * .5)) {
                $this->ward3FMPColor = '#d1c704';
            }
            if ($this->ward3FMP >= floor($ward3FMPSlot * .8)) {
                $this->ward3FMPColor = '#bd4602';
            }
            if ($this->ward3FMP > $ward3FMPSlot) {
                $this->ward3FMPColor = '#b30202';
            }
        } else {
            $ward3FMPSlot = 8;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
            $this->ward3FMPColor = '#04bd55';
        }
        //---- 2 OPD 3rd Floor (MICU B)
        $this->ward3FMIC = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='3FMIC')"));

        if ($this->ward3FMIC > 0) {
            $ward3FMICSlot = 22;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
            if ($this->ward3FMIC < floor($ward3FMICSlot * .5)) {
                $this->ward3FMICColor = '#04bd55';
            }
            if ($this->ward3FMIC > floor($ward3FMICSlot * .5)) {
                $this->ward3FMICColor = '#d1c704';
            }
            if ($this->ward3FMIC >= floor($ward3FMICSlot * .8)) {
                $this->ward3FMICColor = '#bd4602';
            }
            if ($this->ward3FMIC > $ward3FMICSlot) {
                $this->ward3FMICColor = '#b30202';
            }
        } else {
            $ward3FMICSlot = 22;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
            $this->ward3FMICColor = '#04bd55';
        }
        //---- 3 Main 3rd Floor  (NICU A)
        $this->ward3FMN = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='3FMN')"));

        if ($this->ward3FMN > 0) {
            $ward3FMNSlot = 15;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
            if ($this->ward3FMN < floor($ward3FMNSlot * .5)) {
                $this->ward3FMNColor = '#04bd55';
            }
            if ($this->ward3FMN >= floor($ward3FMNSlot * .5)) {
                $this->ward3FMNColor = '#d1c704';
            }
            if ($this->ward3FMN >= floor($ward3FMNSlot * .8)) {
                $this->ward3FMNColor = '#bd4602';
            }
            if ($this->ward3FMN > $ward3FMNSlot) {
                $this->ward3FMNColor = '#b30202';
            }
        } else {
            $ward3FMNSlot = 15;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
            $this->ward3FMNColor = '#04bd55';
        }
        //---- 4 Main 3rd Floor (NICU B)
        $this->wardCBNS = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='CBNS')"));

        if ($this->wardCBNS > 0) {
            $wardCBNSSlot = 15;
            $this->wardCBNSAvailable = $wardCBNSSlot - $this->wardCBNS;
            if ($this->wardCBNS < floor($wardCBNSSlot * .5)) {
                $this->wardCBNSColor = '#04bd55';
            }
            if ($this->wardCBNS >= floor($wardCBNSSlot * .5)) {
                $this->wardCBNSColor = '#d1c704';
            }
            if ($this->wardCBNS >= floor($wardCBNSSlot * .8)) {
                $this->wardCBNSColor = '#bd4602';
            }
            if ($this->wardCBNS > $wardCBNSSlot) {
                $this->wardCBNSColor = '#b30202';
            }
        } else {
            $ward3CBNSSlot = 15;
            $this->wardCBNSAvailable = $ward3CBNSSlot - $this->wardCBNS;
            $this->wardCBNSColor = '#04bd55';
        }
        //---- 5 Annex 2nd Floor (Pedia A & PICU A)
        $this->wardCBPA = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='CBPA')"));

        if ($this->wardCBPA > 0) {
            $wardCBPASlot = 6;
            $this->wardCBPAAvailable = $wardCBPASlot - $this->wardCBPA;
            if ($this->wardCBPA < floor($wardCBPASlot * .5)) {
                $this->wardCBPAColor = '#04bd55';
            }
            if ($this->wardCBPA >= floor($wardCBPASlot * .5)) {
                $this->wardCBPAColor = '#d1c704';
            }
            if ($this->wardCBPA >= floor($wardCBPASlot * .8)) {
                $this->wardCBPAColor = '#bd4602';
            }
            if ($this->wardCBPA > $wardCBPASlot) {
                $this->wardCBPAColor = '#b30202';
            }
        } else {
            $ward3CBPASlot = 6;
            $this->wardCBPAAvailable = $ward3CBPASlot - $this->wardCBPA;
            $this->wardCBPAColor = '#04bd55';
        }
        //---- 6 Annex 2nd Floor (PICU B)
        $this->wardCBPN = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='CBPN')"));

        if ($this->wardCBPN > 0) {
            $wardCBPNSlot = 8;
            $this->wardCBPNAvailable = $wardCBPNSlot - $this->wardCBPN;
            if ($this->wardCBPN < floor($wardCBPNSlot * .5)) {
                $this->wardCBPNColor = '#04bd55';
            }
            if ($this->wardCBPN >= floor($wardCBPNSlot * .5)) {
                $this->wardCBPNColor = '#d1c704';
            }
            if ($this->wardCBPN >= floor($wardCBPNSlot * .8)) {
                $this->wardCBPNColor = '#bd4602';
            }
            if ($this->wardCBPN > $wardCBPNSlot) {
                $this->wardCBPNColor = '#b30202';
            }
        } else {
            $ward3CBPNSlot = 8;
            $this->wardCBPNAvailable = $ward3CBPNSlot - $this->wardCBPN;
            $this->wardCBPNColor = '#04bd55';
        }
        //---- 7 SICU A
        $this->wardSICU = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='SICU')"));

        if ($this->wardSICU > 0) {
            $wardSICUSlot = 21;
            $this->wardSICUAvailable = $wardSICUSlot - $this->wardSICU;
            if ($this->wardSICU < floor($wardSICUSlot * .5)) {
                $this->wardSICUColor = '#04bd55';
            }
            if ($this->wardSICU >= floor($wardSICUSlot * .5)) {
                $this->wardSICUColor = '#d1c704';
            }
            if ($this->wardSICU >= floor($wardSICUSlot * .8)) {
                $this->wardSICUColor = '#bd4602';
            }
            if ($this->wardSICU > $wardSICUSlot) {
                $this->wardSICUColor = '#b30202';
            }
        } else {
            $ward3SICUSlot = 21;
            $this->wardSICUAvailable = $ward3SICUSlot - $this->wardSICU;
            $this->wardSICUColor = '#04bd55';
        }

        //---- 8 SICU B
        $this->ward2FICU = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='2FICU')"));

        if ($this->ward2FICU > 0) {
            $ward2FICUSlot = 6;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
            if ($this->ward2FICU < floor($ward2FICUSlot * .5)) {
                $this->ward2FICUColor = '#04bd55';
            }
            if ($this->ward2FICU >= floor($ward2FICUSlot * .5)) {
                $this->ward2FICUColor = '#d1c704';
            }
            if ($this->ward2FICU >= floor($ward2FICUSlot * .8)) {
                $this->ward2FICUColor = '#bd4602';
            }
            if ($this->ward2FICU > $ward2FICUSlot) {
                $this->ward2FICUColor = '#b30202';
            }
        } else {
            $ward2FICUSlot = 6;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
            $this->ward2FICUColor = '#04bd55';
        }
        //---- 9 CCU
        $this->ward3FCCU = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='3FCCU')"));

        if ($this->ward3FCCU > 0) {
            $ward3FCCUSlot = 14;
            $this->ward3FCCUAvailable = $ward3FCCUSlot - $this->ward3FCCU;
            if ($this->ward3FCCU < floor($ward3FCCUSlot * .5)) {
                $this->ward3FCCUColor = '#04bd55';
            }
            if ($this->ward3FCCU > floor($ward3FCCUSlot * .5)) {
                $this->ward3FCCUColor = '#d1c704';
            }
            if ($this->ward3FCCU >= floor($ward3FCCUSlot * .8)) {
                $this->ward3FCCUColor = '#bd4602';
            }
            if ($this->ward3FCCU > $ward3FCCUSlot) {
                $this->ward3FCCUColor = '#b30202';
            }
        } else {
            $ward3SICUSlot = 14;
            $this->ward3FCCUAvailable = $ward3SICUSlot - $this->ward3FCCU;
            $this->ward3FCCUColor = '#04bd55';
        }
        //----10 Stepdown
        $this->wardSDICU = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='SDICU')"));

        if ($this->wardSDICU > 0) {
            $wardSDICUSlot = 10;
            $this->wardSDICUAvailable = $wardSDICUSlot - $this->wardSDICU;
            if ($this->wardSDICU < floor($wardSDICUSlot * .5)) {
                $this->wardSDICUColor = '#04bd55';
            }
            if ($this->wardSDICU >= floor($wardSDICUSlot * .5)) {
                $this->wardSDICUColor = '#d1c704';
            }
            if ($this->wardSDICU >= floor($wardSDICUSlot * .8)) {
                $this->wardSDICUColor = '#bd4602';
            }
            if ($this->wardSDICU > $wardSDICUSlot) {
                $this->wardSDICUColor = '#b30202';
            }
        } else {
            $ward3SDICUSlot = 10;
            $this->wardSDICUAvailable = $ward3SDICUSlot - $this->wardSDICU;
            $this->wardSDICUColor = '#04bd55';
        }
        //----11 Eastern Ward Gr Floor
        $this->wardFH2 = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
            FROM hospital.dbo.henctr enctr
            RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
            RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
            WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='FH2')"));

        if ($this->wardFH2 > 0) {
            $wardFH2Slot = 13;
            $this->wardFH2Available = $wardFH2Slot - $this->wardFH2;
            if ($this->wardFH2 <= floor($wardFH2Slot * .5)) {
                $this->wardFH2Color = '#04bd55';
            }
            if ($this->wardFH2 >= floor($wardFH2Slot * .5)) {
                $this->wardFH2Color = '#d1c704';
            }
            if ($this->wardFH2 > floor($wardFH2Slot * .8)) {
                $this->wardFH2Color = '#bd4602';
            }
            if ($this->wardFH2 > $wardFH2Slot) {
                $this->wardFH2Color = '#b30202';
            }
        } else {
            $ward3wardFH2Slot = 13;
            $this->wardFH2Available = $ward3wardFH2Slot - $this->wardFH2;
            $this->wardFH2Color = '#04bd55';
        }
        //----12 Field Hospital 3 (CAMES)
        $this->wardFH3 = count(DB::connection('hospital')
            ->select("SELECT patrm.enccode
        FROM hospital.dbo.henctr enctr
        RIGHT JOIN hospital.dbo.hadmlog hdlg ON  hdlg.enccode =enctr.enccode
        RIGHT JOIN hospital.dbo.hpatroom patrm ON  patrm.enccode = hdlg.enccode
        WHERE patrm.patrmstat= 'A' AND (hdlg.admstat ='A') AND (hdlg.disdate IS NULL) AND (hdlg.disdate IS NULL) AND(enctr.encstat= 'A') AND (patrm.wardcode ='FH3')"));

        if ($this->wardFH3 > 0) {
            $wardFH3Slot = 15;
            $this->wardFH3Available = $wardFH3Slot - $this->wardFH3;
            if ($this->wardFH3 < floor($wardFH3Slot * .5)) {
                $this->wardFH3Color = '#04bd55';
            }
            if ($this->wardFH3 > floor($wardFH3Slot * .5)) {
                $this->wardFH3Color = '#d1c704';
            }
            if ($this->wardFH3 > floor($wardFH3Slot * .8)) {
                $this->wardFH3Color = '#bd4602';
            }
            if ($this->wardFH3 > $wardFH3Slot) {
                $this->wardFH2Color = '#b30202';
            }
        } else {
            $ward3wardFH3Slot = 15;
            $this->wardFH3Available = $ward3wardFH3Slot - $this->wardFH3;
            $this->wardFH3Color = '#04bd55';
        }

        //--
        //---- ER


        $getpatientBeds = collect(DB::select("SELECT patientBed.enccode, patientBed.patient_id, patientBed.bed_id, patientBed.created_at
            FROM erdashboard.erdash_patient_beds patientBed"));

        $getErlogs = collect(DB::connection('hospital')
            ->select("SELECT er.enccode, er.hpercode, er.erstat, er.erdate, er.erdtedis, per.patfirst, per.patlast, per.patmiddle, per.patsex, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
            FROM hospital.dbo.henctr entr
            RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
            RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = er.hpercode
            WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
            AND (er.tscode IS NOT NULL) AND (er.erdtedis IS NULL)
            AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));
        //$getdat;
        foreach ($getpatientBeds as $patientBed) {
            foreach ($getErlogs as $getErlog) {
                if ($patientBed->enccode == $getErlog->enccode) {
                    $this->erAdmittedCount++;
                    //$getdat[] = $getErlog;
                }
            }
        }
        //dd($getdat);
        if ($this->erAdmittedCount) {
            $erslot = 38;
            $this->erSlotAvailable = $erslot - $this->erAdmittedCount;
            if ($this->erAdmittedCount < floor($erslot * .5)) {
                $this->erAdmittedCountColor = '#04bd55';
            }
            if ($this->erAdmittedCount >= floor($erslot * .5)) {
                $this->erAdmittedCountColor = '#bd4602';
            }
            if ($this->erAdmittedCount >= floor($erslot * .8)) {
                $this->erAdmittedCountColor = '#b30202';
            }
            if ($this->erAdmittedCount > $erslot) {
                $this->erAdmittedCountColor = '#b30202';
            }
        } else {
            $erslot = 38;
            $this->erSlotAvailable = $erslot - $this->erAdmittedCount;
            $this->erAdmittedCountColor = '#04bd55';
        }
        /// ER END
        //--
        $this->beds = collect(DB::select("SELECT bed.bed_id, bed.bed_name, bed.room_id
        FROM erdashboard.erdash_beds bed"));

        $this->patientBeds = collect(DB::select("SELECT patientBed.enccode, patientBed.patient_id, patientBed.bed_id, patientBed.created_at
        FROM erdashboard.erdash_patient_beds patientBed"));

        $this->getHpersons = collect(DB::connection('hospital')
            ->select("SELECT er.enccode, er.hpercode, er.erstat, er.erdtedis, er.erdate, per.patfirst, per.patlast, per.patmiddle, per.patsex, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
        FROM hospital.dbo.henctr entr
        RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
        RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = er.hpercode
        WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
        AND (er.tscode IS NOT NULL) AND (er.erdtedis IS NULL)
        AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));
        //--
        $patients = HospitalHerlog::select('erdate')->whereDate(DB::raw('CONVERT(date, erdate)'), Carbon::today())->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
            return Carbon::parse($data->erdate)->format('H');
        });

        $lineChartModel = (new LineChartModel())
            ->setAnimated(true)
            //->setTitle('PATIENT ARRIVED HOURLY CENSUS')
            ->withDataLabels();
        foreach ($patients as $day => $values) {
            $this->days[] = $day;
            $this->dayCount[] = count($values);
            $lineChartModel->addPoint($this->days[$this->i], $this->dayCount[$this->i]);
            $this->i++;
        }
        //--

        $getActivepatients = ErdashActivePatient::select(DB::raw('DATE(created_at) as created_at'), 'hour', 'count', 'updated_at')->whereBetween(DB::raw('DATE(created_at)'), [$current_date, $current_date])->get();
        $activepatients = (new LineChartModel())
            //->setTitle('ACTIVE PATIENT CENSUS')
            ->multiLine()
            ->setAnimated(true)
            //->addSeriesPoint('Trainees', Carbon::now()->subDays(7)->format('d.m.Y'), count(Trainee::whereDate('created_at', Carbon::now()->subDays(7)->format('Y-m-d'))->get()))
            ->withDataLabels();
        foreach ($getActivepatients as $patient) {
            $getdate = $patient->created_at->format('F-d-Y');
            if ($this->sdate <= $getdate) {
                $activepatients->addSeriesPoint($getdate, $patient->hour, $patient->count);
            }
        }

        return view('livewire.dash.second-monitor', [
            'activepatients' => $activepatients,
            'lineChartModel' => $lineChartModel,

        ]);
    }

    public function saveCount()
    {
        //-- UDPATE ACTIVE PATIENT COUNT
        $cur_time = Carbon::parse(now())->format('H');
        $cur_date = Carbon::parse(now())->format('Y-m-d H:i:s');

        $counActive = count(DB::connection('hospital')
            ->select("SELECT er.enccode, ROW_NUMBER() OVER (ORDER BY er.erdate ASC) as row_num
        FROM hospital.dbo.henctr entr
        RIGHT JOIN hospital.dbo.herlog er ON er.enccode = entr.enccode
        RIGHT JOIN hospital.dbo.hperson per ON per.hpercode = er.hpercode
        WHERE (er.erstat= 'A') AND(er.erdate BETWEEN '$this->sdate' AND '$this->edate')
        AND (er.tscode IS NOT NULL) AND (er.erdtedis IS NULL)
        AND (entr.encstat = 'A') AND (entr.toecode = 'ER' OR entr.toecode = 'ERADM')"));

        $findHourDate = ErdashActivePatient::select('id', 'created_at', 'hour', 'count')->whereDate('created_at', Carbon::today())->where('hour', $cur_time)->first();

        if ($findHourDate) {

            if ($findHourDate->count < $counActive) {
                $findHourDate->count = $counActive;
                $findHourDate->updated_at = $cur_date;
                $findHourDate->save();
                return redirect()->route('dashboard_monitoring');
            } else {
                $findHourDate->updated_at = $cur_date;
                $findHourDate->save();
                return redirect()->route('dashboard_monitoring');
            }
        } else {
            ErdashActivePatient::create([
                'count' => $counActive,
                'hour' => $cur_time,
            ]);
            return redirect()->route('dashboard_monitoring');
        }
        //-- UDPATE ACTIVE PATIENT COUNT END

        // $this->reset(
        //     'ward2FICU',
        //     'ward3FMIC',
        //     'ward3FMN',
        //     'ward3FMP',
        //     'ward3FNIC',
        //     'wardCBNS',
        //     'wardCBPA',
        //     'wardCBPN',
        //     'wardSDICU',
        //     'wardSICU',
        //     'ward3FCCU',
        //     'wardFH2',
        //     'wardFH3',
        //     'ward3FMPColor',
        //     'ward3FMICColor',
        //     'ward3FMNColor',
        //     'wardCBNSColor',
        //     'wardCBPAColor',
        //     'wardCBPNColor',
        //     'wardSICUColor',
        //     'ward2FICUColor',
        //     'ward3FCCUColor',
        //     'wardSDICUColor',
        //     'wardFH2Color',
        //     'wardFH3Color',
        //     'ward2FICUAvailable',
        //     'ward3FMICAvailable',
        //     'ward3FMNAvailable',
        //     'ward3FMPAvailable',
        //     'ward3FNICAvailable',
        //     'wardCBNSAvailable',
        //     'wardCBPAAvailable',
        //     'wardCBPNAvailable',
        //     'wardSDICUAvailable',
        //     'wardSICUAvailable',
        //     'ward3FCCUAvailable',
        //     'wardFH2Available',
        //     'wardFH3Available',
        //     'erAdmittedCount',
        //     'erSlotAvailable',
        //     'erAdmittedCountColor',
        //     'getHpersons',
        //     'patientBeds',
        //     'beds'
        // );
    }
}
