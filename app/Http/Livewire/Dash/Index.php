<?php

namespace App\Http\Livewire\Dash;

use Carbon\Carbon;
use App\Models\Bed;
use App\Models\Room;
use App\Models\Ward;
use Livewire\Component;
use App\Models\PatientBed;
use Livewire\WithPagination;
use App\Models\HospitalHerlog;
use App\Models\HospitalHadmlog;
use App\Models\HospitalHpatroom;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $erlogs;
    public $ward2FICU = 0;
    public $ward3FMIC = 0;
    public $ward3FMN = 0;
    public $ward3FMP = 0;
    public $ward3FNIC = 0;
    public $wardCBNS = 0;
    public $wardCBPA = 0;
    public $wardCBPN = 0;
    public $wardSDICU = 0;
    public $wardSICU = 0;
    public $ward3FCCU = 0;
    public $wardFH2 = 0;
    public $wardFH3 = 0;

    public $ward2FICUAvailable;
    public $ward3FMICAvailable;
    public $ward3FMNAvailable;
    public $ward3FMPAvailable;
    public $ward3FNICAvailable;
    public $wardCBNSAvailable;
    public $wardCBPAAvailable;
    public $wardCBPNAvailable;
    public $wardSDICUAvailable;
    public $wardSICUAvailable;
    public $ward3FCCUAvailable;
    public $wardFH2Available;
    public $wardFH3Available;

    public $ward3FMPColor;
    public $ward3FMICColor;
    public $ward3FMNColor;
    public $wardCBNSColor;
    public $wardCBPAColor;
    public $wardCBPNColor;
    public $wardSICUColor;
    public $ward2FICUColor;
    public $ward3FCCUColor;
    public $wardSDICUColor;
    public $wardFH2Color;
    public $wardFH3Color;

    public $erAdmittedCount = 0;
    public $erSlotAvailable;
    public $erAdmittedCountColor;

    public $months = [];
    public $monthCount = [];
    public $days = [];
    public $dayCount = [];
    public $departments = [];
    public $deptCount = [];
    public $dateFilter;
    public $date_filter;
    public $i = 0;
    public $k = 0;
    public $j = 0;

    public $wards = [];
    public $wardsCount = [];

    protected $get_beds;
    public $getWard2FICU;
    public $patient_list;
    public $room_id;
    public $rooms;
    public $colors = [
        // 'Pediatrics Department' => '#7210e3',
        // 'Surgery Department' => '#fc8181',
        // 'Orthopedics Department' => '#90cdf4',
        // 'Ophthalmology Department' => '#66DA26',
        // 'OB-Gyne Department' => '#e3106b',
        // 'Internal Medicine' => '#2170a3',
        // 'Family Medicine' => '#c42163',
        // 'ENT-HNS Department' => '#28756c',
        // 'Anesthesiology Department' => '#e6f51b',
        'ANES' => 'e6f51b',
        'blue' => '#7210e3',
        'PEDIA' => '#7210e3',
        'SURG' => '#fc8181',
        'ORTHO' => '#90cdf4',
        'OPHTH' => '#66DA26',
        'GYNE' => '#e3106b',
        'MED' => '#2170a3',
        'FAMED' => '#c42163',
        'ENT' => '#28756c',
        'Anesthesiology Department' => '#e6f51b',
        'blue' => '#7210e3',
        'OB' => '#91147d',
        'NB' => '#143559',
        '2FICU' => 'e6f51b',
        '3FMIC' => '#7210e3',
        '3FMN' => '#7210e3',
        '3FMP' => '#fc8181',
        '3FNIC' => '#90cdf4',
        'CBNS' => '#66DA26',
        'CBPA' => '#e3106b',
        'CBPN' => '#2170a3',
        'SDICU' => '#c42163',
        'SICU' => '#28756c',

    ];

    public $wardsColor = [
        '2FICU' => 'e6f51b',
        '3FMIC' => '#7210e3',
        '3FMN' => '#1328eb',
        '3FMP' => '#fc8181',
        '3FNIC' => '#90cdf4',
        'CBNS' => '#66DA26',
        'CBPA' => '#fcf003',
        'CBPN' => '#f28322',
        'SDICU' => '#c42163',
        'SICU' => '#28756c',
        '' => '#e3106b',
    ];
    public $selectedWards = [
        '2FICU',
        '3FMIC',
        '3FMN',
        '3FMP',
        '3FNIC',
        'CBNS',
        'CBPA',
        'CBPN',
        'SDICU',
        'SICU',
    ];

    public function mount()
    {
        //$this->get_date = Carbon::createFromFormat('Y', DB::raw('CONVERT(date, erdate)'));

        $this->date_filter = 'this_month';
    }
    public function render()
    {
        $this->i = 0;
        //$this->j = 0;
        $this->erAdmittedCount = 0;
        $this->months = null;
        $this->monthCount = null;
        $this->days = null;
        $this->dayCount = null;

        $this->dateFilter = $this->date_filter;

        if ($this->date_filter == 'today') {
            $patients = HospitalHerlog::select('erdate')->whereDate(DB::raw('CONVERT(date, erdate)'), Carbon::today())->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                return Carbon::parse($data->erdate)->format('H');
            });
        } // this year

        if ($this->date_filter == 'this_year') {
            //$patients = HospitalHerlog::whereYear('erdate', Carbon::now()->year)->get()->groupBy(function ($data) {
            $patients = HospitalHerlog::select('erdate')->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                return Carbon::parse($data->erdate)->format('M');
            });
        } // this year
        if ($this->date_filter == 'this_week') {
            //$patients = Patient::whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get()->groupBy(function($data)
            $patients = HospitalHerlog::select('erdate')->whereBetween(DB::raw('CONVERT(date, erdate)'), [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                    return Carbon::parse($data->erdate)->format('M-d');
                });
        } //this week

        if ($this->date_filter == 'last_week') {
            $patients = HospitalHerlog::select('erdate')->whereBetween(DB::raw('CONVERT(date, erdate)'), [Carbon::now()->subWeek(), Carbon::now()])
                ->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                    return Carbon::parse($data->erdate)->format('M-d');
                });
        } //last week
        if ($this->date_filter == 'this_month') {
            $patients = HospitalHerlog::select('erdate')->whereMonth(DB::raw('CONVERT(date, erdate)'), Carbon::now()->month)->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                return Carbon::parse($data->erdate)->format('M-d');
            });
        } //this month
        if ($this->date_filter == 'last_month') {
            $patients = HospitalHerlog::select('erdate')->whereMonth(DB::raw('CONVERT(date, erdate)'), Carbon::now()->subMonth()->month)->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                return Carbon::parse($data->erdate)->format('M-d');
            });
        } //last month
        if ($this->date_filter == 'yesterday') {
            $patients = HospitalHerlog::select('erdate')->wheredate('erdate', Carbon::yesterday())->orderBy('erdate', 'asc')->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->get()->groupBy(function ($data) {
                return Carbon::parse($data->erdate)->format('H');
            });
        } // yesterday

        if ($this->date_filter == 'last_year') {
            $patients = HospitalHerlog::select('erdate')->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->subYear()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                return Carbon::parse($data->erdate)->format('M');
            });
        } //last year

        if ($this->date_filter == 'this_year' || $this->date_filter == 'last_year') {
            $lineChartModel = (new LineChartModel())
                ->setAnimated(true)
                //->setTitle('Total Patient Count')
                ->withDataLabels();
            foreach ($patients as $month => $values) {
                $this->months[] = $month;
                $this->monthCount[] = count($values);
                $lineChartModel->addPoint($this->months[$this->i], $this->monthCount[$this->i], $this->colors['blue']);
                $this->i++;
            }
        } // End, lineChartmodel for this_year and last_year filter

        // Start lineChartmodel for filter this_week, last_week, yesterday, last_month, this_month and today
        if ($this->date_filter == 'this_week' || $this->date_filter == 'last_week' || $this->date_filter == 'yesterday' || $this->date_filter == 'last_month' || $this->date_filter == 'this_month' || $this->date_filter == 'today' || $this->dateFilter == 'define') {
            $lineChartModel = (new LineChartModel())
                ->setAnimated(true)
                //->setTitle('Patient Count')
                ->withDataLabels();
            foreach ($patients as $day => $values) {
                $this->days[] = $day;
                $this->dayCount[] = count($values);
                $lineChartModel->addPoint($this->days[$this->i], $this->dayCount[$this->i], $this->colors['blue']);
                $this->i++;
            }
        } // End lineChartmodel for filter this_week, last_week, yesterday, last_month, this_month and today

        #bf0000
        #eb0707
        #d10202
        #6b0303
        #990202
        //---- ER
        $this->erlogs = PatientBed::select('enccode', 'patient_id')->get();
        foreach ($this->erlogs as $logcount) {
            if ($logcount->patientErLog) {
                $this->erAdmittedCount++;
                //dd('here');
            }
        }
        //$this->erAdmittedCount = 30;
        if ($this->erAdmittedCount) {
            $erslot = 38;
            $this->erSlotAvailable = $erslot - $this->erAdmittedCount;
            if ($this->erAdmittedCount < floor($erslot * .5)) {
                $this->erAdmittedCountColor = '#04bd55';
            }
            if ($this->erAdmittedCount > floor($erslot * .5)) {
                $this->erAdmittedCountColor = '#bd4602';
            }
            if ($this->erAdmittedCount >= floor($erslot * .8)) {
                $this->erAdmittedCountColor = '#b30202';
            }
        } else {
            $erslot = 38;
            $this->erSlotAvailable = $erslot - $this->erAdmittedCount;
            $this->erAdmittedCountColor = '#04bd55';
        }
        //---- 1 OPD 3rd Floor (MICU A)
        //$getward3FMP = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMP')->where('patrmstat', 'A')->get();
        $this->ward3FMP = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', '3FMP')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->ward3FMP > 0) {
            $ward3FMPSlot = 8;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
            if ($this->ward3FMP < floor($ward3FMPSlot * .5)) {
                $this->ward3FMPColor = '#04bd55';
            }
            if ($this->ward3FMP > ($ward3FMPSlot * .5)) {
                $this->ward3FMPColor = '#bd4602';
            }
            if ($this->ward3FMP >= floor($ward3FMPSlot * .8)) {
                $this->ward3FMPColor = '#b30202';
            }
        } else {
            $ward3FMPSlot = 8;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
            $this->ward3FMPColor = '#04bd55';
        }
        //---- 2 OPD 3rd Floor (MICU B)
        //$getward3FMIC = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMIC')->where('patrmstat', 'A')->get();
        $this->ward3FMIC = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', '3FMIC')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->ward3FMIC > 0) {
            $ward3FMICSlot = 22;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
            if ($this->ward3FMIC < floor($ward3FMICSlot * .5)) {
                $this->ward3FMICColor = '#04bd55';
            }
            if ($this->ward3FMIC > floor($ward3FMICSlot * .5)) {
                $this->ward3FMICColor = '#bd4602';
            }
            if ($this->ward3FMIC >= floor($ward3FMICSlot * .8)) {
                $this->ward3FMICColor = '#b30202';
            }
        } else {
            $ward3FMICSlot = 22;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
            $this->ward3FMICColor = '#04bd55';
        }
        //---- 3 Main 3rd Floor  (NICU A)
        //$getward3FMN = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMN')->where('patrmstat', 'A')->get();
        $this->ward3FMN = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', '3FMN')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->ward3FMN > 0) {
            $ward3FMNSlot = 15;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
            if ($this->ward3FMN < floor($ward3FMNSlot * .5)) {
                $this->ward3FMNColor = '#04bd55';
            }
            if ($this->ward3FMN > floor($ward3FMNSlot * .5)) {
                $this->ward3FMNColor = '#bd4602';
            }
            if ($this->ward3FMN >= floor($ward3FMNSlot * .8)) {
                $this->ward3FMNColor = '#b30202';
            }
        } else {
            $ward3FMNSlot = 15;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
            $this->ward3FMNColor = '#04bd55';
        }
        //---- 4 Main 3rd Floor (NICU B)
        //$getwardCBNS = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBNS')->where('patrmstat', 'A')->get();
        $this->wardCBNS = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', 'CBNS')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->wardCBNS > 0) {
            $wardCBNSSlot = 15;
            $this->wardCBNSAvailable = $wardCBNSSlot - $this->wardCBNS;
            if ($this->wardCBNS < floor($wardCBNSSlot * .5)) {
                $this->wardCBNSColor = '#04bd55';
            }
            if ($this->wardCBNS >= floor($wardCBNSSlot * .5)) {
                $this->wardCBNSColor = '#bd4602';
            }
            if ($this->wardCBNS >= floor($wardCBNSSlot * .8)) {
                $this->wardCBNSColor = '#b30202';
            }
        } else {
            $ward3CBNSSlot = 15;
            $this->wardCBNSAvailable = $ward3CBNSSlot - $this->wardCBNS;
            $this->wardCBNSColor = '#04bd55';
        }
        //---- 5 Annex 2nd Floor (Pedia A & PICU A)
        //$getwardCBPA = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBPA')->where('patrmstat', 'A')->get();
        $this->wardCBPA = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', 'CBNS')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->wardCBPA > 0) {
            $wardCBPASlot = 6;
            $this->wardCBPAAvailable = $wardCBPASlot - $this->wardCBPA;
            if ($this->wardCBPA < floor($wardCBPASlot * .5)) {
                $this->wardCBPAColor = '#04bd55';
            }
            if ($this->wardCBPA > floor($wardCBPASlot * .5)) {
                $this->wardCBPAColor = '#bd4602';
            }
            if ($this->wardCBPA >= floor($wardCBPASlot * .8)) {
                $this->wardCBPAColor = '#b30202';
            }
        } else {
            $ward3CBPASlot = 6;
            $this->wardCBPAAvailable = $ward3CBPASlot - $this->wardCBPA;
            $this->wardCBPAColor = '#04bd55';
        }
        //---- 6 Annex 2nd Floor (PICU B)
        //$getwardCBPN = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBPN')->where('patrmstat', 'A')->get();
        $this->wardCBPN = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', 'CBPN')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->wardCBPN > 0) {
            $wardCBPNSlot = 8;
            $this->wardCBPNAvailable = $wardCBPNSlot - $this->wardCBPN;
            if ($this->wardCBPN < floor($wardCBPNSlot * .5)) {
                $this->wardCBPNColor = '#04bd55';
            }
            if ($this->wardCBPN > floor($wardCBPNSlot * .5)) {
                $this->wardCBPNColor = '#bd4602';
            }
            if ($this->wardCBPN >= floor($wardCBPNSlot * .8)) {
                $this->wardCBPNColor = '#b30202';
            }
        } else {
            $ward3CBPNSlot = 8;
            $this->wardCBPNAvailable = $ward3CBPNSlot - $this->wardCBPN;
            $this->wardCBPNColor = '#04bd55';
        }
        //---- 7 SICU A
        //$getwardSICU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'SICU')->where('patrmstat', 'A')->get();
        $this->wardSICU = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', 'CBPN')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->wardSICU > 0) {
            $wardSICUSlot = 21;
            $this->wardSICUAvailable = $wardSICUSlot - $this->wardSICU;
            if ($this->wardSICU < floor($wardSICUSlot * .5)) {
                $this->wardSICUColor = '#04bd55';
            }
            if ($this->wardSICU > floor($wardSICUSlot * .5)) {
                $this->wardSICUColor = '#bd4602';
            }
            if ($this->wardSICU >= floor($wardSICUSlot * .8)) {
                $this->wardSICUColor = '#b30202';
            }
        } else {
            $ward3SICUSlot = 21;
            $this->wardSICUAvailable = $ward3SICUSlot - $this->wardSICU;
            $this->wardSICUColor = '#04bd55';
        }
        //---- 8 SICU B
        //$getward2FICU = HospitalHpatroom::with('admittedLogs')->select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '2FICU')->where('patrmstat', 'A')->get();
        $this->ward2FICU = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', '2FICU')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->ward2FICU > 0) {
            $ward2FICUSlot = 6;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
            if ($this->ward2FICU < floor($ward2FICUSlot * .5)) {
                $this->ward2FICUColor = '#04bd55';
            }
            if ($this->ward2FICU >= floor($ward2FICUSlot * .5)) {
                $this->ward2FICUColor = '#bd4602';
            }
            if ($this->ward2FICU >= floor($ward2FICUSlot * .8)) {
                $this->ward2FICUColor = '#b30202';
            }
        } else {
            $ward2FICUSlot = 6;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
            $this->ward2FICUColor = '#04bd55';
        }

        //---- 9 CCU
        //$getward3FCCU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FCCU')->where('patrmstat', 'A')->get();
        $this->ward3FCCU = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', '3FCCU')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->ward3FCCU > 0) {
            $ward3FCCUSlot = 14;
            $this->ward3FCCUAvailable = $ward3FCCUSlot - $this->ward3FCCU;
            if ($this->ward3FCCU < floor($ward3FCCUSlot * .5)) {
                $this->ward3FCCUColor = '#04bd55';
            }
            if ($this->ward3FCCU > floor($ward3FCCUSlot * .5)) {
                $this->ward3FCCUColor = '#bd4602';
            }
            if ($this->ward3FCCU >= floor($ward3FCCUSlot * .8)) {
                $this->ward3FCCUColor = '#b30202';
            }
        } else {
            $ward3SICUSlot = 14;
            $this->ward3FCCUAvailable = $ward3SICUSlot - $this->ward3FCCU;
            $this->ward3FCCUColor = '#04bd55';
        }

        //----10 Stepdown
        //$getwardSDICU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'SDICU')->where('patrmstat', 'A')->get();
        $this->wardSDICU = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', 'SDICU')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->wardSDICU > 0) {
            $wardSDICUSlot = 10;
            $this->wardSDICUAvailable = $wardSDICUSlot - $this->wardSDICU;
            if ($this->wardSDICU < floor($wardSDICUSlot * .5)) {
                $this->wardSDICUColor = '#04bd55';
            }
            if ($this->wardSDICU >= floor($wardSDICUSlot * .5)) {
                $this->wardSDICUColor = '#bd4602';
            }
            if ($this->wardSDICU >= floor($wardSDICUSlot * .8)) {
                $this->wardSDICUColor = '#b30202';
            }
        } else {
            $ward3SDICUSlot = 10;
            $this->wardSDICUAvailable = $ward3SDICUSlot - $this->wardSDICU;
            $this->wardSDICUColor = '#04bd55';
        }

        //----11 Eastern Ward Gr Floor
        //$getwardwardFH2 = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'FH2')->where('patrmstat', 'A')->get();
        $this->wardFH2 = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', 'FH2')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->wardFH2 > 0) {
            $wardFH2Slot = 13;
            $this->wardFH2Available = $wardFH2Slot - $this->wardFH2;
            if ($this->wardFH2 <= floor($wardFH2Slot * .5)) {
                $this->wardFH2Color = '#04bd55';
            }
            if ($this->wardFH2 > floor($wardFH2Slot * .5)) {
                $this->wardFH2Color = '#bd4602';
            }
            if ($this->wardFH2 >= floor($wardFH2Slot * .8)) {
                $this->wardFH2Color = '#b30202';
            }
        } else {
            $ward3wardFH2Slot = 13;
            $this->wardFH2Available = $ward3wardFH2Slot - $this->wardFH2;
            $this->wardFH2Color = '#04bd55';
        }
        //dd(floor($wardFH2Slot * .5));
        //----12 Field Hospital 3 (CAMES)
        //$getwardwardFH3 = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'FH3')->where('patrmstat', 'A')->get();
        $this->wardFH3 = DB::connection('hospital')->table('dbo.hpatroom')
            ->join('dbo.hadmlog', 'dbo.hpatroom.enccode', '=', 'dbo.hadmlog.enccode')
            ->select('dbo.hpatroom.enccode', 'dbo.hadmlog.enccode',  'dbo.hpatroom.patrmstat', 'dbo.hpatroom.wardcode', 'dbo.hadmlog.wardcode', 'dbo.hadmlog.admstat')
            ->where('dbo.hpatroom.wardcode', 'FH3')
            ->where('dbo.hpatroom.patrmstat', 'A')
            ->where('dbo.hadmlog.admstat', 'A')->count();
        if ($this->wardFH3 > 0) {
            $wardFH3Slot = 15;
            $this->wardFH3Available = $wardFH3Slot - $this->wardFH3;
            if ($this->wardFH3 < floor($wardFH3Slot * .5)) {
                $this->wardFH3Color = '#04bd55';
            }
            if ($this->wardFH3 > floor($wardFH3Slot * .5)) {
                $this->wardFH3Color = '#bd4602';
            }
            if ($this->wardFH3 >= floor($wardFH3Slot * .8)) {
                $this->wardFH3Color = '#b30202';
            }
        } else {
            $ward3wardFH3Slot = 15;
            $this->wardFH3Available = $ward3wardFH3Slot - $this->wardFH3;
            $this->wardFH3Color = '#04bd55';
        }

        $this->get_beds = Bed::select('bed_id', 'bed_name')->paginate(8, ['*'], 'patient_list');
        $this->rooms = Room::select('room_name', 'room_id')->get();

        return view('livewire.dash.index', [
            //'admlogs' => $admlogs,
            'beds' => $this->get_beds,
            //'admittedlogs' => $admittedlogs,
            'lineChartModel' => $lineChartModel,
            //'pieChartModelallWards' => $pieChartModelallWards
        ]);
    }
}
