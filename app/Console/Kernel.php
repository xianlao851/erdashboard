<?php

namespace App\Console;

use App\Models\ErdashActivePatient;
use App\Models\HospitalHerlog;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use DateTime;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // $schedule->call(function () {

        //     $current_date = date('Y-m-d H:i:s');


        //     $getCurrentDate = new DateTime($current_date);
        //     $getCurrentDate->modify('-7 day');
        //     $setStartDate = $getCurrentDate->format('Y-m-d');

        //     $start_date = date('Y-m-d', strtotime($setStartDate));
        //     $end_date = date('Y-m-d', strtotime($current_date));
        //     $sdate = $start_date  . ' 00:00:00.000';
        //     $edate = $end_date  . ' 23:59:59.000';

        //     $getcounActive = HospitalHerlog::select('erstat')->where('erstat', 'A')->whereNotNull('erdtedis')->whereBetween(DB::raw('erdate'), [$sdate, $edate])->count();
        //     dd($getcounActive);
        //     $counActive = $getcounActive;
        //     ErdashActivePatient::create([
        //         'count' => $counActive
        //     ]);
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}