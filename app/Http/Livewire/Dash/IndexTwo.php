<?php

namespace App\Http\Livewire\Dash;

use App\Models\ErdashActivePatient;
use App\Models\PatientBed;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexTwo extends Component
{
    public $sdate, $edate;

    public function mount()
    {
        $cur_date = Carbon::parse(now())->format('Y-m-d');
        $this->sdate = $cur_date;
        $this->edate = $cur_date;
    }
    public function render()
    {


        if ($this->sdate && $this->edate) {

            $getActivepatients = ErdashActivePatient::select(DB::raw('DATE(created_at) as created_at'), 'hour', 'count', 'updated_at')->whereBetween(DB::raw('DATE(created_at)'), [$this->sdate, $this->edate])->get();
            $activepatients = (new LineChartModel())
                ->setTitle('ACTIVE PATIENT CENSUS')
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
        }

        return view('livewire.dash.index-two', [
            'activepatients' => $activepatients ?? null
        ]);
    }
}
