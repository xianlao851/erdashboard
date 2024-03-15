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
    public function render()
    {

        $cur_date = Carbon::parse(now())->format('Y-m-d');
        if ($this->sdate && $this->edate) {

            $getActivepatients = ErdashActivePatient::select(DB::raw('DATE(created_at) as created_at'), 'hour', 'count', 'updated_at')->whereBetween(DB::raw('DATE(created_at)'), [$this->sdate, $this->edate])->get();
            //dd($getActivepatients);
            $activepatients = (new LineChartModel())
                ->setTitle('ACTIVE PATIENT PER HOUR TODAY')
                ->multiLine()
                //->addSeriesPoint('Trainees', Carbon::now()->subDays(7)->format('d.m.Y'), count(Trainee::whereDate('created_at', Carbon::now()->subDays(7)->format('Y-m-d'))->get()))
                ->withDataLabels();

            foreach ($getActivepatients as $patient) {
                //dd($patient->created_at);
                $getdata = $patient->created_at->format('Y-m-d');
                if ($this->sdate <= $getdata) {
                    $activepatients->addSeriesPoint($getdata, $patient->hour, $patient->count, '#d1c704');
                }
            }
        }

        return view('livewire.dash.index-two', [
            'activepatients' => $activepatients ?? null
        ]);
    }
}
