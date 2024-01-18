<div class="">
    <div class="p-2 mx-4 ">
        <div class="grid grid-cols-6 grid-rows-2 gap-4 p-4">
            @if ($wards)
                @foreach ($wards as $ward)
                    <div class="h-28 p-2 bg-white uppercase text-gray-900 text-[14px] rounded-lg">
                        @if ($ward->ward_code == 'EROOM')
                            <div>EROOM</div>
                        @endif
                        @if ($ward->getWardDetail)
                            <div>
                                {{ $ward->getWardDetail->wardname }}
                            </div>
                        @endif
                        <div class="flex">
                            <div class="mt-2"> <img src="{{ URL('/images/available bed II.PNG') }}"
                                    class="w-[50px] h-[50px]">
                            </div>
                            <div class="flex flex-col mt-3 ml-6">
                                <h3 class="ml-2 text-3xl font-bold text-gray-600">
                                    @if ($ward->ward_code == 'EROOM')
                                        {{-- {{ $ward->getPatientBedAssigned->patientErHerlog->count() }} --}}
                                        {{-- @foreach ($ward->getPatientBedAssigned as $patient)
                                            @if ($patient->patientErHerlog->count() == 1)
                                                {{ $k += $patient->patientErHerlog->count() }}
                                            @endif
                                        @endforeach --}}
                                        0
                                    @endif
                                    @if ($ward->getWardDetail)
                                        {{ $ward->getWardDetail->getPatientRoom->count() }}
                                        {{-- @foreach ($ward->getWardDetail->getPatientRoom as $patient)
                                            {{ $patient->hpercode }}
                                            {{ $patient->enccode }}
                                        @endforeach --}}
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-400">
                                    BED OCUPPIED</p>
                            </div>

                        </div>
                        <div class="border-b-4 border-blue-600"></div>
                    </div>
                @endforeach
            @endif
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
</div>
