    <div class="">
        <div class="p-2 mx-4 ">

            <div class="flex p-4 space-x-4 h-[700px]">

                <div class="w-1/3 h-full p-2 bg-white rounded-lg join-item">
                    <div class="w-full h-full">
                        <livewire:livewire-pie-chart key="{{ $pieChartModelallWards->reactiveKey() }}"
                            :pie-chart-model="$pieChartModelallWards" />
                    </div>
                </div>

                <div class="grid w-full grid-cols-5 grid-rows-2 p-2 bg-white rounded-lg">
                    <div id="ward2FICU"></div>
                    <div id="ward3FMIC"></div>
                </div>
            </div> <!-- div for ocuppied beds --->

            <div class="relative">
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

            <div class="mx-4 mt-16 bg-white rounded-lg h-96">
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
                    height: 480,
                    type: 'donut',
                },
                labels: ['Ocuppied', 'Available', ],
                legend: {
                    position: 'bottom',
                    fontSize: '12px',
                    fontWeight: 600,
                },
                dataLabels: {
                    // enabled: true
                    formatter: (val, {
                        seriesIndex,
                        w
                    }) => w.config.series[seriesIndex]
                },
                colors: ["#0eebca", "#150af2"],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                    }
                }]
            };

            var chartward2FICU = new ApexCharts(document.querySelector("#ward2FICU"), ward2FICU);
            chartward2FICU.render();


            var ward3FMIC = {
                series: [@json($ward3FMIC), @json($ward3FMICAvailable)],
                chart: {
                    height: 480,
                    type: 'donut',
                },
                labels: ['Ocuppied', 'Available', ],
                legend: {
                    position: 'bottom',
                    fontSize: '12px',
                    fontWeight: 600,
                },
                dataLabels: {
                    // enabled: true
                    formatter: (val, {
                        seriesIndex,
                        w
                    }) => w.config.series[seriesIndex]
                },
                colors: ["#0eebca", "#150af2"],
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
        </script>
    </div>
