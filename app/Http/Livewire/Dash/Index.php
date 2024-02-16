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

    public $erAdmittedCount = 0;
    public $erSlotAvailable;

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


        //$admittedlogs = HospitalHadmlog::select('admstat', 'wardcode')->where('admstat', 'A')->with('patRoom')->get();

        // $admlogs = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
        //     ->whereIn('wardcode', $this->selectedWards)
        //     ->where('patrmstat', 'A')->with('admittedLogs')
        //     ->get()->groupBy(function ($data) {
        //         return $data->wardcode;
        //     });

        //---- ER
        $this->erlogs = PatientBed::select('enccode', 'patient_id')->get();
        foreach ($this->erlogs as $logcount) {
            if ($logcount->patientErLog) {
                $this->erAdmittedCount++;
                //dd('here');
            }
        }
        if ($this->erAdmittedCount) {
            $erslot = 38;
            $this->erSlotAvailable = $erslot - $this->erAdmittedCount;
        } else {
            $erslot = 38;
            $this->erSlotAvailable = $erslot - $this->erAdmittedCount;
        }
        //---- 1 OPD 3rd Floor (MICU A)
        $getward3FMP = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMP')->where('patrmstat', 'A')->get();
        if ($getward3FMP) {
            foreach ($getward3FMP as $getCountward3FMP) {
                if ($getCountward3FMP->getAdlog) {
                    $this->ward3FMP++;
                }
            }
            $ward3FMPSlot = 8;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
        } else {
            $ward3FMPSlot = 8;
            $this->ward3FMPAvailable = $ward3FMPSlot - $this->ward3FMP;
        }
        //---- 2 OPD 3rd Floor (MICU B)
        $getward3FMIC = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMIC')->where('patrmstat', 'A')->get();
        if ($getward3FMIC) {
            foreach ($getward3FMIC as $getCountward3FMIC) {
                if ($getCountward3FMIC->getAdlog) {
                    $this->ward3FMIC++;
                }
            }
            $ward3FMICSlot = 22;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
        } else {
            $ward3FMICSlot = 22;
            $this->ward3FMICAvailable = $ward3FMICSlot - $this->ward3FMIC;
        }
        //---- 3 Main 3rd Floor  (NICU A)
        $getward3FMN = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FMN')->where('patrmstat', 'A')->get();
        if ($getward3FMN) {
            foreach ($getward3FMN as $getCountward3FMN) {
                if ($getCountward3FMN->getAdlog) {
                    $this->ward3FMN++;
                }
            }
            $ward3FMNSlot = 15;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
        } else {
            $ward3FMNSlot = 15;
            $this->ward3FMNAvailable = $ward3FMNSlot - $this->ward3FMN;
        }
        //---- 4 Main 3rd Floor (NICU B)
        $getwardCBNS = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBNS')->where('patrmstat', 'A')->get();
        if ($getwardCBNS) {
            foreach ($getwardCBNS as $getCoutwardCBNS) {
                if ($getCoutwardCBNS->getAdlog) {
                    $this->wardCBNS++;
                }
            }
            $wardCBNSSlot = 15;
            $this->wardCBNSAvailable = $wardCBNSSlot - $this->wardCBNS;
        } else {
            $ward3CBNSSlot = 15;
            $this->wardCBNSAvailable = $ward3CBNSSlot - $this->wardCBNS;
        }
        //---- 5 Annex 2nd Floor (Pedia A & PICU A)
        $getwardCBPA = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBPA')->where('patrmstat', 'A')->get();
        if ($getwardCBPA) {
            foreach ($getwardCBPA as $getCountwardCBPA) {
                if ($getCountwardCBPA->getAdlog) {
                    $this->wardCBPA++;
                }
            }
            $wardCBPASlot = 6;
            $this->wardCBPAAvailable = $wardCBPASlot - $this->wardCBPA;
        } else {
            $ward3CBPASlot = 6;
            $this->wardCBPAAvailable = $ward3CBPASlot - $this->wardCBPA;
        }
        //---- 6 Annex 2nd Floor (PICU B)
        $getwardCBPN = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'CBPN')->where('patrmstat', 'A')->get();
        if ($getwardCBPN) {
            foreach ($getwardCBPN as $getCountwardCBPN) {
                if ($getCountwardCBPN->getAdlog) {
                    $this->wardCBPN++;
                }
            }
            $wardCBPNSlot = 8;
            $this->wardCBPNAvailable = $wardCBPNSlot - $this->wardCBPN;
        } else {
            $ward3CBPNSlot = 8;
            $this->wardCBPNAvailable = $ward3CBPNSlot - $this->wardCBPN;
        }
        //---- 7 SICU A
        $getwardSICU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'SICU')->where('patrmstat', 'A')->get();
        if ($getwardSICU) {
            foreach ($getwardSICU as $getCountwardSICU) {
                if ($getCountwardSICU->getAdlog) {
                    $this->wardSICU++;
                }
            }
            $wardSICUSlot = 21;
            $this->wardSICUAvailable = $wardSICUSlot - $this->wardSICU;
        } else {
            $ward3SICUSlot = 21;
            $this->wardSICUAvailable = $ward3SICUSlot - $this->wardSICU;
        }
        //---- 8 SICU B
        $getward2FICU = HospitalHpatroom::with('admittedLogs')->select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '2FICU')->where('patrmstat', 'A')->get();
        if ($getward2FICU) {
            foreach ($getward2FICU as $getCountward2FICU) {
                if ($getCountward2FICU->getAdlog) {
                    $this->ward2FICU++;
                }
            }
            $ward2FICUSlot = 6;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
        } else {
            $ward2FICUSlot = 6;
            $this->ward2FICUAvailable = $ward2FICUSlot - $this->ward2FICU;
        }

        //---- 9 CCU
        $getward3FCCU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FCCU')->where('patrmstat', 'A')->get();
        if ($getward3FCCU) {
            foreach ($getward3FCCU as $getCountwar3FCCU) {
                if ($getCountwar3FCCU->getAdlog) {
                    $this->ward3FCCU++;
                }
            }
            $ward3FCCUSlot = 14;
            $this->ward3FCCUAvailable = $ward3FCCUSlot - $this->ward3FCCU;
        } else {
            $ward3SICUSlot = 14;
            $this->ward3FCCUAvailable = $ward3SICUSlot - $this->ward3FCCU;
        }

        //----10 Stepdown
        $getwardSDICU = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'SDICU')->where('patrmstat', 'A')->get();
        if ($getwardSDICU) {
            foreach ($getwardSDICU as $getCountwardSDICU) {
                if ($getCountwardSDICU->getAdlog) {
                    $this->wardSDICU++;
                }
            }
            $wardSDICUSlot = 10;
            $this->wardSDICUAvailable = $wardSDICUSlot - $this->wardSDICU;
        } else {
            $ward3SDICUSlot = 10;
            $this->wardSDICUAvailable = $ward3SDICUSlot - $this->wardSDICU;
        }

        //----11 Eastern Ward Gr Floor
        $getwardwardFH2 = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'FH2')->where('patrmstat', 'A')->get();
        if ($getwardwardFH2) {
            foreach ($getwardwardFH2 as $getCountwardwardFH2) {
                if ($getCountwardwardFH2->getAdlog) {
                    $this->wardFH2++;
                }
            }
            $wardwardFH2Slot = 13;
            $this->wardFH2Available = $wardwardFH2Slot - $this->wardFH2;
        } else {
            $ward3wardFH2Slot = 13;
            $this->wardFH2Available = $ward3wardFH2Slot - $this->wardFH2;
        }

        //----12 Field Hospital 3 (CAMES)
        $getwardwardFH3 = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', 'FH3')->where('patrmstat', 'A')->get();
        if ($getwardwardFH3) {
            foreach ($getwardwardFH3 as $getCountwardwardFH3) {
                if ($getCountwardwardFH3->getAdlog) {
                    $this->wardFH3++;
                }
            }
            $wardwardFH3Slot = 15;
            $this->wardFH3Available = $wardwardFH3Slot - $this->wardFH3;
        } else {
            $ward3wardFH3Slot = 15;
            $this->wardFH3Available = $ward3wardFH3Slot - $this->wardFH3;
        }

        //---- 3rd Floor(NICU)*
        $getward3FNIC = HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')->where('wardcode', '3FNIC')->where('patrmstat', 'A')->get();
        if ($getward3FNIC) {
            foreach ($getward3FNIC as $getCountward3FNIC) {
                if ($getCountward3FNIC->getAdlog) {
                    $this->ward3FNIC++;
                }
            }
            $ward3FNICSlot = 25;
            $this->ward3FNICAvailable = $ward3FNICSlot - $this->ward3FNIC;
        } else {
            $ward33FNICSlot = 25;
            $this->ward3FNICAvailable = $ward33FNICSlot - $this->ward3FNIC;
        }

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