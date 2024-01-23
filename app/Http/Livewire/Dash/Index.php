<?php

namespace App\Http\Livewire\Dash;

use Carbon\Carbon;
use App\Models\Ward;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HospitalHerlog;
use App\Models\HospitalHadmlog;
use App\Models\HospitalHpatroom;
use App\Models\PatientBed;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $erlogs;
    public $ward2FICU;
    public $ward3FMIC;
    public $ward3FMN;
    public $ward3FMP;
    public $ward3FNIC;
    public $wardCBNS;
    public $wardCBPA;
    public $wardCBPN;
    public $wardSDICU;
    public $wardSICU;

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

    public $getWard2FICU;
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

        $this->date_filter = 'this_year';
    }
    public function render()
    {
        $this->i = 0;
        //$this->j = 0;
        $this->months = null;
        $this->monthCount = null;
        $this->days = null;
        $this->dayCount = null;

        $this->dateFilter = $this->date_filter;

        if ($this->date_filter == 'today') {
            $patients = HospitalHerlog::select('erdate')->whereDate(DB::raw('CONVERT(date, erdate)'), Carbon::today())->whereYear(DB::raw('CONVERT(date, erdate)'), Carbon::now()->year)->orderBy('erdate', 'asc')->get()->groupBy(function ($data) {
                return Carbon::parse($data->erdate)->format('M-d');
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
                return Carbon::parse($data->erdate)->format('M-d');
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


        $admittedlogs = HospitalHadmlog::select('admstat', 'wardcode')->where('admstat', 'A')->with('patRoom')->get();

        $admlogs = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
            ->whereIn('wardcode', $this->selectedWards)
            ->where('patrmstat', 'A')->with('admittedLogs')
            ->get()->groupBy(function ($data) {
                return $data->wardcode;
            });

        //dd($admlogs);

        // $pieChartModelallWards = (new PieChartModel())
        //     ->setTitle('')
        //     //->withDataLabels()
        //     ->withDataLabels()
        //     ->setAnimated(true);

        // foreach ($admlogs as $log => $values) {
        //     $this->wards[] = $log;
        //     $this->wardsCount[] = count($values);
        //     $pieChartModelallWards->addSlice($this->wards[$this->j], $this->wardsCount[$this->j], $this->wardsColor[$this->wards[$this->j]]);
        //     $this->j++;
        // }


        $this->erlogs = PatientBed::select('enccode', 'patient_id')->get();
        //dd($this->erlogs);
        //----
        $this->ward2FICU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '2FICU')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->ward2FICU) {
            $ward2FICUSlot = 25;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
        } else {
            $ward2FICUSlot = 25;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
        }
        //----
        $this->ward3FMIC = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMIC')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->ward3FMIC) {
            $ward3FMICSlot = 25;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
        } else {
            $ward3FMICSlot = 25;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
        }

        //----
        $this->ward3FMN = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMN')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->ward3FMN) {
            $ward3FMNSlot = 25;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
        } else {
            $ward3FMNSlot = 25;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
        }
        //----
        $this->ward3FMP = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMP')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->ward3FMP) {
            $ward3FMPSlot = 25;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
        } else {
            $ward3FMPSlot = 25;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
        }
        //----
        $this->ward3FNIC = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FNIC')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->ward3FNIC) {
            $ward3FNICSlot = 25;
            $this->ward3FNICAvailable = $ward3FNICSlot - $this->ward3FNIC;
        } else {
            $ward33FNICSlot = 25;
            $this->ward3FNICAvailable = $ward33FNICSlot - $this->ward3FNIC;
        }
        //----
        $this->wardCBNS = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBNS')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->wardCBNS) {
            $wardCBNSSlot = 25;
            $this->wardCBNSAvailable = $wardCBNSSlot - $this->wardCBNS;
        } else {
            $ward3CBNSSlot = 25;
            $this->wardCBNSAvailable = $ward3CBNSSlot - $this->wardCBNS;
        }
        //----
        $this->wardCBPA = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBPA')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->wardCBPA) {
            $wardCBPASlot = 25;
            $this->wardCBPAAvailable = $wardCBPASlot - $this->wardCBPA;
        } else {
            $ward3CBPASlot = 25;
            $this->wardCBPAAvailable = $ward3CBPASlot - $this->wardCBPA;
        }
        //----
        $this->wardCBPN = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBPN')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->wardCBPN) {
            $wardCBPNSlot = 25;
            $this->wardCBPNAvailable = $wardCBPNSlot - $this->wardCBPN;
        } else {
            $ward3CBPNSlot = 25;
            $this->wardCBPNAvailable = $ward3CBPNSlot - $this->wardCBPN;
        }
        //----
        $this->wardSDICU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'SDICU')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->wardSDICU) {
            $wardSDICUSlot = 25;
            $this->wardSDICUAvailable = $wardSDICUSlot - $this->wardSDICU;
        } else {
            $ward3SDICUSlot = 25;
            $this->wardSDICUAvailable = $ward3SDICUSlot - $this->wardSDICU;
        }
        //----
        $this->wardSICU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'SICU')->where('patrmstat', 'A')->with('admittedLogs')->count();
        if ($this->wardSICU) {
            $wardSICUSlot = 25;
            $this->wardSICUAvailable = $wardSICUSlot - $this->wardSICU;
        } else {
            $ward3SICUSlot = 25;
            $this->wardSICUAvailable = $ward3SICUSlot - $this->wardSICU;
        }
        //dd($this->wardSICU);
        // '2FICU',
        // '3FMIC',
        // '3FMN',
        // '3FMP',
        // '3FNIC',
        // 'CBNS',
        // 'CBPA',
        // 'CBPN',
        // 'SDICU',
        // 'SICU',

        return view('livewire.dash.index', [
            'admlogs' => $admlogs,
            'admittedlogs' => $admittedlogs,
            'lineChartModel' => $lineChartModel,
            //'pieChartModelallWards' => $pieChartModelallWards
        ]);
    }
}
