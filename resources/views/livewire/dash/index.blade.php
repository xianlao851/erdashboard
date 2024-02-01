<x-slot name="header">
    <h2 class="text-lg font-semibold leading-tight text-gray-800">
        {{ __('ERDASH') }}
    </h2>
</x-slot>
<div class="flex w-full">
    <div class="w-full p-2 mx-4">

        <div class="flex p-2 space-x-3 h-[460px] w-full">

            <div class="h-full p-2 bg-white rounded-lg w-2/8" wire:ignore>
                <div class="w-full h-full">
                    <div id="erAdmittedCount"></div>
                </div>
            </div>
            <div class="w-2/4 bg-white rounded-lg" wire:ignore>
                <div class="grid w-full grid-cols-5 grid-rows-2 gap-2 p-6">
                    <div id="ward2FICU"></div>
                    <div id="ward3FMIC"></div>
                    <div id="ward3FMN"></div>
                    <div id="ward3FMP"></div>
                    <div id="ward3FNIC"></div>
                    <div id="wardCBNS"></div>
                    <div id="wardCBPA"></div>
                    <div id="wardCBPN"></div>
                    <div id="wardSDICU"></div>
                    <div id="wardSICU"></div>
                </div>
            </div>
            <div class="w-2/8">
                <div class="grid grid-cols-3 grid-rows-1 gap-2 mt-0">
                    @if ($beds)
                        @foreach ($beds as $bed)
                            <div class="w-[195px] h-24 p-2 bg-white rounded-lg shadow-lg hover:bg-gray-50">
                                <div class="flex items-center mt-0">
                                    <img src="{{ URL('/images/bed III.png') }}" class="w-[30px] h-[30px]">
                                    <div class="mt-4 ml-2 text-[12px] text-black underline uppercase">
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
                                                <div class="mt-1 ml-0 text-[12px] text-black  flex">
                                                    {{ $patient->patientHerlog->patientInfo->get_patient_name() }}
                                                    {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div> <!-- bed div container--->
                        @endforeach
                    @endif
                </div>
                <div class="mt-2">
                    @if ($beds)
                        {{ $beds->links() }}
                    @endif
                </div>
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

        <div class="h-64 mx-4 mt-16 bg-white rounded-lg">
            <livewire:livewire-line-chart key="{{ $lineChartModel->reactiveKey() }}" :line-chart-model="$lineChartModel" />
        </div>
        <!--MODALS HERE-->
        <!--MODALS HERE-->
    </div>
    <!--Script here-->
    <script>
        var ward2FICU = {
            series: [@json($ward2FICU), @json($ward2FICUAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: '*SICU',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 230,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartward2FICU = new ApexCharts(document.querySelector("#ward2FICU"), ward2FICU);
        chartward2FICU.render();
        //--- ward2FICU
        var ward3FMIC = {
            series: [@json($ward3FMIC), @json($ward3FMICAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'OPD 3rd Floor (MICU B)',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartward3FMIC = new ApexCharts(document.querySelector("#ward3FMIC"), ward3FMIC);
        chartward3FMIC.render();
        //---ward3FMIC

        var ward3FMN = {
            series: [@json($ward3FMN), @json($ward3FMNAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'Main 3rd Floor  (NICU A)',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartward3FMN = new ApexCharts(document.querySelector("#ward3FMN"), ward3FMN);
        chartward3FMN.render();
        //---ward3FMN

        var ward3FMP = {
            series: [@json($ward3FMP), @json($ward3FMPAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'OPD 3rd Floor (MICU A)',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartward3FMP = new ApexCharts(document.querySelector("#ward3FMP"), ward3FMP);
        chartward3FMP.render();
        //---ward3FMP

        var ward3FNIC = {
            series: [@json($ward3FNIC), @json($ward3FNICAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: '3rd Floor(NICU)*',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartward3FNIC = new ApexCharts(document.querySelector("#ward3FNIC"), ward3FNIC);
        chartward3FNIC.render();
        //---ward3FMP

        var wardCBNS = {
            series: [@json($wardCBNS), @json($wardCBNSAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'Main 3rd Floor (NICU B)',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartwardCBNS = new ApexCharts(document.querySelector("#wardCBNS"), wardCBNS);
        chartwardCBNS.render();
        //---wardCBNS

        var wardCBPA = {
            series: [@json($wardCBPA), @json($wardCBPAAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'Annex 2nd Floor (Pedia A & PICU A)',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartwardCBPA = new ApexCharts(document.querySelector("#wardCBPA"), wardCBPA);
        chartwardCBPA.render();
        //---wardCBPA

        var wardCBPN = {
            series: [@json($wardCBPN), @json($wardCBPNAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'Annex 2nd Floor (PICU B)',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartwardCBPN = new ApexCharts(document.querySelector("#wardCBPN"), wardCBPN);
        chartwardCBPN.render();
        //---wardCBPN

        var wardSDICU = {
            series: [@json($wardSDICU), @json($wardSDICUAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'Stepdown',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartwardSDICU = new ApexCharts(document.querySelector("#wardSDICU"), wardSDICU);
        chartwardSDICU.render();
        //---wardSDICU

        var wardSICU = {
            series: [@json($wardSICU), @json($wardSICUAvailable)],
            chart: {
                //height: 480,
                height: 230,
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
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'SICU',
                align: 'center',
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var chartwardSICU = new ApexCharts(document.querySelector("#wardSICU"), wardSICU);
        chartwardSICU.render();
        //---wardSICU

        var erAdmittedCount = {
            series: [@json($erAdmittedCount), @json($erSlotAvailable)],
            chart: {
                height: 600,
                //height: 230,
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
                position: 'bottom',
                fontSize: '12px',
                fontWeight: 600,
                fontFamily: 'sans',
            },
            title: {
                text: 'ER',
                align: 'center',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: 'sans',
                    // color: '#263238'
                },
            },
            dataLabels: {
                // enabled: true
                formatter: (val, {
                    seriesIndex,
                    w
                }) => w.config.series[seriesIndex]
            },
            colors: ["#03a155", "#2a4bf5"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };

        var charterAdmittedCount = new ApexCharts(document.querySelector("#erAdmittedCount"), erAdmittedCount);
        charterAdmittedCount.render();
        //---erAdmittedCount
    </script>
</div>
