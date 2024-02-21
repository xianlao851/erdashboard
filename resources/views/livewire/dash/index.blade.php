<x-slot name="header">
    <h2 class="text-lg font-semibold leading-tight text-gray-800">
        {{ __('ERDASHBOARD') }}
    </h2>
</x-slot>
<div class="flex w-full">
    <div class="w-full" wire:loading>
        <div class="absolute flex items-center justify-center mt-0 ml-0 bg-black z-[9999] w-full h-full opacity-75">
            <span class="text-green-400 loading loading-spinner loading-lg"></span>
        </div>
    </div>
    <div class="w-full p-2 mx-auto">
        <div class="flex w-full gap-3 p-4 mt-4">
            <div class="w-1/16" wire:ignore>
                <div class="w-full bg-white rounded-lg h-[435px]">
                    <div class="flex justify-center p-2 mx-auto font-semibold text-md">ER
                    </div>
                    <div class="" id="erAdmittedCount"></div>
                </div>
            </div>
            <div class="w-3/4" wire:ignore>
                <div class="grid w-full grid-cols-6 grid-rows-2 gap-3">
                    {{-- <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold">*SICU
                        </div>
                        <div id="ward2FICU"> </div>
                    </div> --}}
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">OPD 3rd Floor (MICU A)
                        </div>
                        <div class="content-center bg-white rounded-lg" id="ward3FMP"></div>
                    </div>
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">OPD 3rd Floor (MICU B)
                        </div>
                        <div class="content-center bg-white rounded-lg" id="ward3FMIC"></div>
                    </div>
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">Main 3rd Floor (NICU A)
                        </div>
                        <div class="content-center bg-white rounded-lg" id="ward3FMN"></div>
                    </div>
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">Main 3rd Floor (NICU B)
                        </div>
                        <div class="content-center bg-white rounded-lg" id="wardCBNS"></div>
                    </div>
                    {{-- <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">3rd Floor(NICU)*
                        </div>
                        <div class="content-center bg-white rounded-lg" id="ward3FNIC"></div>
                    </div> --}}

                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center mx-auto text-[11px] mt-2 font-semibold text-nowrap">Annex 2nd
                            Floor
                            Pedia A &
                            PICU A
                        </div>
                        <div class="mt-2" id="wardCBPA"></div>
                    </div>
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">Annex 2nd Floor (PICU B)
                        </div>
                        <div id="wardCBPN"></div>
                    </div>
                    {{-- <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">Stepdown
                        </div>
                        <div id="wardSDICU"></div>
                    </div> --}}
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">SICU A
                        </div>
                        <div id="wardSICU"></div>
                    </div>

                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">SICU B
                        </div>
                        <div id="ward2FICU"></div>
                    </div>

                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">CCU
                        </div>
                        <div id="ward3FCCU"></div>
                    </div>
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">Stepdown
                        </div>
                        <div id="wardSDICU"></div>
                    </div>
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">Eastern Ward Gr Floor
                        </div>
                        <div id="wardFH2"></div>
                    </div>
                    <div class="content-center bg-white rounded-lg">
                        <div class="flex justify-center p-2 mx-auto text-xs font-semibold ">Field Hospital 3 (CAMES)
                        </div>
                        <div id="wardFH3"></div>
                    </div>
                </div>
            </div>
            <div class="w-1/16">
                <div class="overflow-y-auto h-[410px] w-96" wire:ignore>
                    @foreach ($rooms as $room)
                        <div class="grid w-full">
                            <div class="ml-4 text-green-700 underline "> {{ $room->room_name }}
                            </div>
                            <div class="grid w-full grid-cols-2 gap-2 p-2 rounded-lg">
                                @foreach ($room->getBeds as $bed)
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="{{ $bed->bed_id }}"
                                        class="h-20 p-2 bg-white rounded-lg shadow-lg hover:bg-gray-50">
                                        <div class="flex items-center mt-0">
                                            <img draggable="false" src="{{ URL('/images/bed III.png') }}"
                                                class="w-[30px] h-[30px]">
                                            <div class="mt-4 ml-2 text-[10px] text-black underline uppercase">
                                                {{ $bed->bed_name }}
                                            </div>
                                        </div>
                                        <div>
                                            @foreach ($bed->patientBed as $patient)
                                                @if ($patient->patientHerlog)
                                                    <div class="w-full grid-cols-3 gap-1 mt-2 join">
                                                        <div>
                                                            @if ($patient->patientHerlog->patientInfo->patsex == 'M')
                                                                <img draggable="false"
                                                                    src="{{ URL('/images/man III.PNG') }}"
                                                                    class="w-[30px] h-[30px]">
                                                            @endif
                                                            @if ($patient->patientHerlog->patientInfo->patsex == 'F')
                                                                <img draggable="false"
                                                                    src="{{ URL('/images/women II.PNG') }}"
                                                                    class="w-[30px] h-[30px]">
                                                            @endif
                                                        </div>
                                                        <div class="mt-2 ml-0 text-[10px] text-black">
                                                            {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="grid w-full grid-cols-2 grid-rows-1 gap-2 mt-0">
                    @if ($beds)
                        @foreach ($beds as $bed)
                            <div class="h-24 p-2 bg-white rounded-lg shadow-lg hover:bg-gray-50">
                                <div class="flex items-center mt-0">
                                    <img src="{{ URL('/images/bed III.png') }}" class="w-[30px] h-[30px]">
                                    <div class="mt-4 ml-2 text-[10px] text-black underline uppercase">
                                        {{ $bed->bed_name }}
                                    </div>
                                </div> <!-- for bed info and bed image-->
                                <div>
                                    @foreach ($bed->patientBed as $patient)
                                        @if ($patient->patientHerlog)
                                            <div class="w-full grid-cols-2 gap-1 mt-2 join">
                                                <div>
                                                    @if ($patient->patientHerlog->patientInfo->patsex == 'M')
                                                        <img src="{{ URL('/images/man III.PNG') }}"
                                                            class="w-[30px] h-[30px]">
                                                    @endif
                                                    @if ($patient->patientHerlog->patientInfo->patsex == 'F')
                                                        <img src="{{ URL('/images/women II.PNG') }}"
                                                            class="w-[30px] h-[30px]">
                                                    @endif
                                                </div>
                                                <div class="mt-3 ml-0 text-[10px] text-black flex w-44">
                                                    {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div> <!-- bed div container--->
                        @endforeach
                    @endif
                </div> --}}
                {{-- <div class="mt-2">
                    @if ($beds)
                        {{ $beds->links() }}
                    @endif
                </div> --}}
            </div>
        </div> <!-- div for ocuppied beds --->

        <div class="relative mt-3">
            <div class="absolute left-7 top-6">
                <h2>PATIENT COUNT</h2>
            </div>
            <div class="absolute right-4">
                <div class="join">
                    <select class="select select-bordered join-item focus:border-blue-700 focus:ring-blue-700"
                        wire:model.lazy="date_filter">
                        <option class="hover:bg-green-700" value="today"
                            {{ $dateFilter == 'today' ? 'selected' : '' }}>
                            Today</option>
                        {{-- <option class="hover:bg-green-700" value="this_year"
                                {{ $dateFilter == 'define' ? 'selected' : '' }}>Define
                            </option> --}}
                        <option class="hover:bg-green-700" value="this_year"
                            {{ $dateFilter == 'this_year' ? 'selected' : '' }}>This Year
                        </option>
                        <option class="hover:bg-green-700" value="yesterday"
                            {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>Yesterday
                        </option>
                        <option class="hover:bg-green-700" value="this_week"
                            {{ $dateFilter == 'this_week' ? 'selected' : '' }}>This Week
                        </option>
                        <option class="hover:bg-green-700" value="last_week"
                            {{ $dateFilter == 'last_week' ? 'selected' : '' }}>Last Week
                        </option>
                        <option class="hover:bg-green-700" value="this_month"
                            {{ $dateFilter == 'this_month' ? 'selected' : '' }}>This
                            Month</option>
                        <option class="hover:bg-green-700" value="last_month"
                            {{ $dateFilter == 'last_month' ? 'selected' : '' }}>Last
                            Month</option>
                        <option class="hover:bg-green-700" value="last_year"
                            {{ $dateFilter == 'last_year' ? 'selected' : '' }}>Last Year
                        </option>
                    </select>
                    <label type="submit" class="text-white bg-blue-600 btn join-item">Filter</label>
                </div>
            </div>
        </div>

        <div class="h-64 mx-4 mt-16 bg-white rounded-lg" wire:target='date_filter'>
            <livewire:livewire-line-chart key="{{ $lineChartModel->reactiveKey() }}" :line-chart-model="$lineChartModel" />
        </div>
        <!--MODALS HERE-->
        <!--MODALS HERE-->
    </div>
    <!--Script here-->
    <script>
        //--- 1 OPD 3rd Floor (MICU A)
        var ward3FMP = {
            series: [@json($ward3FMP), @json($ward3FMPAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                fontFamily: 'sans',
                                // color: '#263238'
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'OPD 3rd Floor (MICU A)',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($ward3FMPColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartward3FMP = new ApexCharts(document.querySelector("#ward3FMP"), ward3FMP);
        chartward3FMP.render(); //---ward3FMP, 1 OPD 3rd Floor (MICU A);


        //--- 2 OPD 3rd Floor (MICU B)
        var ward3FMIC = {
            series: [@json($ward3FMIC), @json($ward3FMICAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                fontFamily: 'sans',
                                // color: '#263238'
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'OPD 3rd Floor (MICU B)',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($ward3FMICColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartward3FMIC = new ApexCharts(document.querySelector("#ward3FMIC"), ward3FMIC);
        chartward3FMIC.render(); //---ward3FMIC, 2 OPD 3rd Floor (MICU B);

        //--- 3 Main 3rd Floor  (NICU A)
        var ward3FMN = {
            series: [@json($ward3FMN), @json($ward3FMNAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                fontFamily: 'sans',
                                // color: '#263238'
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Main 3rd Floor  (NICU A)',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($ward3FMNColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartward3FMN = new ApexCharts(document.querySelector("#ward3FMN"), ward3FMN);
        chartward3FMN.render(); //---ward3FMN, 3 Main 3rd Floor  (NICU A)

        //---- 4 Main 3rd Floor (NICU B)
        var wardCBNS = {
            series: [@json($wardCBNS), @json($wardCBNSAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Main 3rd Floor (NICU B)',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($wardCBNSColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartwardCBNS = new ApexCharts(document.querySelector("#wardCBNS"), wardCBNS);
        chartwardCBNS.render(); //---wardCBNS, 4 Main 3rd Floor (NICU B)

        //---- 5 Annex 2nd Floor (Pedia A & PICU A)
        var wardCBPA = {
            series: [@json($wardCBPA), @json($wardCBPAAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Annex 2nd Floor Pedia A & PICU A',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($wardCBPAColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartwardCBPA = new ApexCharts(document.querySelector("#wardCBPA"), wardCBPA);
        chartwardCBPA.render(); //---wardCBPA, 5 Annex 2nd Floor (Pedia A & PICU A);

        //---- 6 Annex 2nd Floor (PICU B)
        var wardCBPN = {
            series: [@json($wardCBPN), @json($wardCBPNAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Annex 2nd Floor (PICU B)',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($wardCBPNColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartwardCBPN = new ApexCharts(document.querySelector("#wardCBPN"), wardCBPN);
        chartwardCBPN.render(); //---wardCBPN, 6 Annex 2nd Floor (PICU B);

        //---- 7 SICU A
        var wardSICU = {
            series: [@json($wardSICU), @json($wardSICUAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'SICU',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($wardSICUColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartwardSICU = new ApexCharts(document.querySelector("#wardSICU"), wardSICU);
        chartwardSICU.render(); //---wardSICU, 7 SICU A;

        //---- 8 SICU B
        var ward2FICU = {
            series: [@json($ward2FICU), @json($ward2FICUAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    //size: 480,
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                fontFamily: 'sans',
                                // color: '#089629',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: '*SICU',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($ward2FICUColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartward2FICU = new ApexCharts(document.querySelector("#ward2FICU"), ward2FICU);
        chartward2FICU.render(); //--- ward2FICU, 8 SICU B;

        //---- 9 CCU
        var ward3FCCU = {
            series: [@json($ward3FCCU), @json($ward3FCCUAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: '3FCCU',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($ward3FCCUColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartward3FCCU = new ApexCharts(document.querySelector("#ward3FCCU"), ward3FCCU);
        chartward3FCCU.render(); //---ward3FCCU, 9 CCU;

        //----10 Stepdown
        var wardSDICU = {
            series: [@json($wardSDICU), @json($wardSDICUAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Stepdown',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($wardSDICUColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartwardSDICU = new ApexCharts(document.querySelector("#wardSDICU"), wardSDICU);
        chartwardSDICU.render(); //---wardSDICU, 10 Stepdown

        //---wardFH2, 11 Eastern Ward Gr Floor
        var wardFH2 = {
            series: [@json($wardFH2), @json($wardFH2Available)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Stepdown',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($wardFH2Color), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartwardFH2 = new ApexCharts(document.querySelector("#wardFH2"), wardFH2);
        chartwardFH2.render(); //---wardFH2, 11 Eastern Ward Gr Floor

        //---wardFH2, 11 Eastern Ward Gr Floor
        var wardFH3 = {
            series: [@json($wardFH3), @json($wardFH3Available)],
            chart: {
                //height: 480,
                height: 230,
                width: 170,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 15,
                                //fontWeight: 'bold',
                                fontFamily: 'sans',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Stepdown',
            //     align: 'center',
            //     style: {
            //         fontSize: '12px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($wardFH3Color), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var chartwardFH3 = new ApexCharts(document.querySelector("#wardFH3"), wardFH3);
        chartwardFH3.render(); //---wardFH3, 12 Field Hospital 3 (CAMES)

        var erAdmittedCount = {
            series: [@json($erAdmittedCount), @json($erSlotAvailable)],
            chart: {
                height: 400,
                width: 330,
                align: 'left',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        //background: '#030a91',
                        labels: {
                            show: true,
                            color: '#FFFFFF',
                            total: {
                                show: true,
                                fontSize: 30,
                                fontFamily: 'fontFamily',
                            }
                        }
                    }
                }
            },
            labels: ['Ocuppied', 'Available', ],
            legend: {
                //color: '#4d4c4a',
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'ER',
            //     align: 'center',
            //     style: {
            //         fontSize: '16px',
            //         fontWeight: 'bold',
            //         fontFamily: 'sans',
            //         // color: '#263238'
            //     },
            // },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: [@json($erAdmittedCountColor), "#0571f5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 50
                    },
                }
            }]
        };

        var charterAdmittedCount = new ApexCharts(document.querySelector("#erAdmittedCount"), erAdmittedCount);
        charterAdmittedCount.render();
        //---erAdmittedCount
    </script>
</div>
