<x-slot name="header">
    <h2 class="text-lg font-semibold leading-tight text-gray-800">
        {{ __('ERMERGENCY DASHBOARD') }}
    </h2>
</x-slot>
<div class="flex flex-col w-full">
    <div class="w-full" wire:loading>
        <div class="absolute flex items-center justify-center mt-0 ml-0 bg-black z-[9999] w-full h-full opacity-75">
            <span class="text-green-400 loading loading-spinner loading-lg"></span>
        </div>
    </div>

    <div class="one">
        <div class="w-full p-2 mx-auto">
            <div class="flex w-full gap-3 p-4 mt-4">
                <div class="w-2/12" wire:ignore>
                    <div class="w-full bg-white rounded-lg h-[480px]">
                        <div class="flex justify-center p-2 mx-auto font-semibold text-md">ER
                        </div>
                        <div class="" id="erAdmittedCount"></div>
                    </div>
                </div>
                <div class="w-10/12" wire:ignore>
                    <div class="grid w-full grid-cols-6 grid-rows-2 gap-3">
                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">OPD 3rd Floor (MICU A)
                            </div>
                            <div class="content-center bg-white rounded-lg" id="ward3FMP"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">OPD 3rd Floor (MICU B)
                            </div>
                            <div class="content-center bg-white rounded-lg" id="ward3FMIC"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">Main 3rd Floor (NICU A)
                            </div>
                            <div class="content-center bg-white rounded-lg" id="ward3FMN"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">Main 3rd Floor (NICU B)
                            </div>
                            <div class="content-center bg-white rounded-lg" id="wardCBNS"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center mx-auto mt-2 text-sm font-semibold text-nowrap">Annex 2nd
                                Floor
                                Pedia A &
                                PICU A
                            </div>
                            <div class="mt-2" id="wardCBPA"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">Annex 2nd Floor (PICU B)
                            </div>
                            <div id="wardCBPN"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">SICU A
                            </div>
                            <div id="wardSICU"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">SICU B
                            </div>
                            <div id="ward2FICU"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">CCU
                            </div>
                            <div id="ward3FCCU"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">Stepdown
                            </div>
                            <div id="wardSDICU"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">Eastern Ward Gr Floor
                            </div>
                            <div id="wardFH2"></div>
                        </div>

                        <div class="content-center bg-white rounded-lg" wire:ignore>
                            <div class="flex justify-center p-2 mx-auto text-sm font-semibold ">Field Hospital 3 (CAMES)
                            </div>
                            <div id="wardFH3"></div>
                        </div>
                    </div>
                </div>
                {{-- <div class="w-2/12">
                    <div class="overflow-y-auto h-[470px] w-full bg-white p-3 rounded-lg" id="data">
                        <div class="">
                            @foreach ($rooms as $room)
                                <div> {{ $room->room_name }}</div>
                                <div class="grid grid-cols-2 grid-rows-2 gap-2">
                                    @forelse ($beds as $bed)
                                        @if ($room->room_id == $bed->room_id)
                                            <div
                                                class="relative flex flex-col w-32 p-1 mt-0 rounded-md bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                <span
                                                    class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                @forelse ($patientBeds as $patientBed)
                                                    @if ($patientBed->bed_id == $bed->bed_id)
                                                        @forelse ($getHpersons as $getHperson)
                                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                                <div
                                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700">
                                                                    <span class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                        {{ $bed->bed_name }}</span>
                                                                    <span class="text-[12px] text-black ml-1 p-0 truncate">
                                                                        {{ $getHperson->patlast }},
                                                                    </span>
                                                                    <span class="text-[12px] text-black ml-1 p-0 truncate">
                                                                        {{ $getHperson->patfirst[0][0] }}.
                                                                    </span>
                                                                    <div></div>
                                                                </div>
                                                            @else
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                    <!----->
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif

                                    @empty
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
            </div> <!-- div for ocuppied beds --->

            {{-- <div class="relative mt-3">
                <div class="absolute left-7 top-6">
                    <h2>PATIENT COUNT</h2>
                </div>
                <div class="absolute left-4">
                    <div class="join">
                        <select class="select select-bordered join-item focus:border-blue-700 focus:ring-blue-700"
                            wire:model.lazy="date_filter">
                            <option class="hover:bg-green-700" value="today"
                                {{ $dateFilter == 'today' ? 'selected' : '' }}>
                                Today</option>
                            <option class="hover:bg-green-700" value="this_year"
                                {{ $dateFilter == 'define' ? 'selected' : '' }}>Define
                            </option>
                            <option class="hover:bg-green-700" value="this_year"
                                {{ $dateFilter == 'this_year' ? 'selected' : '' }}>This
                                Year
                            </option>
                            <option class="hover:bg-green-700" value="yesterday"
                                {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>
                                Yesterday
                            </option>
                            <option class="hover:bg-green-700" value="this_week"
                                {{ $dateFilter == 'this_week' ? 'selected' : '' }}>This
                                Week
                            </option>
                            <option class="hover:bg-green-700" value="last_week"
                                {{ $dateFilter == 'last_week' ? 'selected' : '' }}>Last
                                Week
                            </option>
                            <option class="hover:bg-green-700" value="this_month"
                                {{ $dateFilter == 'this_month' ? 'selected' : '' }}>
                                This
                                Month</option>
                            <option class="hover:bg-green-700" value="last_month"
                                {{ $dateFilter == 'last_month' ? 'selected' : '' }}>
                                Last
                                Month</option>
                            <option class="hover:bg-green-700" value="last_year"
                                {{ $dateFilter == 'last_year' ? 'selected' : '' }}>Last
                                Year
                            </option>
                        </select>
                        <label type="submit" class="text-white bg-blue-600 btn join-item">Filter</label>
                    </div>
                </div>
            </div> --}}
            <div class="flex flex-row gap-4 p-3 mt-4 h-96">

                <div class="w-1/2 p-2 bg-white rounded-lg " wire:ignore>
                    <div class="flex justify-center p-2 mx-auto font-semibold text-md ">PATIENT ARRIVED HOURLY CENSUS
                    </div>
                    <div class="h-5/6"><livewire:livewire-line-chart key="{{ $lineChartModel->reactiveKey() }}"
                            :line-chart-model="$lineChartModel" /></div>
                </div>

                <div class="w-1/2 p-2 bg-white rounded-lg" wire:ignore>
                    <div class="flex justify-center p-2 mx-auto font-semibold text-md ">ACTIVE PATIENT CENSUS
                    </div>
                    <div class="h-5/6"><livewire:livewire-line-chart key="{{ $activepatients->reactiveKey() }}"
                            :line-chart-model="$activepatients" /></div>
                </div>

            </div>
        </div>
    </div>

    <div class="p-4 two">
        <div class="w-full p-4 space-y-2 bg-white rounded-lg">
            <div class="px-3">
                <div class="mt-0 overflow-scroll bg-gray-200 border-4 border-gray-700 rounded-md ">
                    <div class="flex flex-row gap-10 ">
                        <div class="flex flex-row gap-2 p-2 bg-white">
                            <div class="">
                                <h6 class="w-full p-1 mt-2 text-sm text-center text-white bg-green-900 rounded-md">
                                    OVERFLOW
                                </h6>
                                <div class="grid grid-rows-6 gap-2 mt-1">
                                    @forelse ($beds as $bed)
                                        @if (
                                            $bed->bed_id == '27' or
                                                $bed->bed_id == '28' or
                                                $bed->bed_id == '29' or
                                                $bed->bed_id == '30' or
                                                $bed->bed_id == '44' or
                                                $bed->bed_id == '45')
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                <div style="transform: rotate(-90deg);" class="flex flex-col mt-12">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-0 mt-0">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-0">AVAILABLE</span>
                                                </div>
                                                @forelse ($patientBeds as $patientBed)
                                                    @if ($patientBed->bed_id == $bed->bed_id)
                                                        @forelse ($getHpersons as $getHperson)
                                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                                <div drag-item draggable="true"
                                                                    id="{{ $patientBed->enccode }}"
                                                                    ondragstart="drag(event)"
                                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-t from-rose-400 to-rose-700">
                                                                    @php
                                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                                            $getHperson->erdate,
                                                                        );
                                                                    @endphp
                                                                    <div style="transform: rotate(-90deg);"
                                                                        class="flex flex-col mt-12">
                                                                        <div class="flex flex-row w-32 h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                                {{ $bed->bed_name }}</div>
                                                                            <div>
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate w-24 h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                    <!----->
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div><!--overflow -->
                            <div class=" mt-7"> <!--medicine left extension start-->
                                <div class="grid gap-2 grid-rows-9">
                                    @forelse ($beds as $bed)
                                        @if (
                                            $bed->bed_id == '25' or
                                                $bed->bed_id == '26' or
                                                $bed->bed_id == '31' or
                                                $bed->bed_id == '32' or
                                                $bed->bed_id == '33' or
                                                $bed->bed_id == '34' or
                                                $bed->bed_id == '35' or
                                                $bed->bed_id == '36' or
                                                $bed->bed_id == '37')
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                <span
                                                    class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                @forelse ($patientBeds as $patientBed)
                                                    @if ($patientBed->bed_id == $bed->bed_id)
                                                        @forelse ($getHpersons as $getHperson)
                                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                                <div drag-item draggable="true"
                                                                    id="{{ $patientBed->enccode }}"
                                                                    ondragstart="drag(event)"
                                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                    @php
                                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                                            $getHperson->erdate,
                                                                        );
                                                                    @endphp
                                                                    <div class="flex flex-row h-1/3">
                                                                        <div
                                                                            class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                            {{ $bed->bed_name }}
                                                                        </div>
                                                                        <div class="w-1/2 ">
                                                                            @if ($getDiff == 3)
                                                                                <span
                                                                                    class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                    <span
                                                                                        class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                    <span
                                                                                        class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                    </span>
                                                                                </span>
                                                                            @endif
                                                                            @if ($getDiff >= 4)
                                                                                <span
                                                                                    class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                    <span
                                                                                        class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                    <span
                                                                                        class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                    </span>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                        {{ $getHperson->patlast }},
                                                                    </div>
                                                                    <div
                                                                        class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                        {{ $getHperson->patfirst[0] }}.
                                                                    </div>

                                                                </div>
                                                            @else
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                    <!----->
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div> <!--medicine left extension end-->
                        </div> <!--first -->

                        <div class="flex flex-col">
                            <div class="flex space-x-0">
                                <div class="p-1 bg-white rounded-md ">
                                    <h6 class="p-1 mt-0 text-sm text-center text-white bg-green-900 rounded-md">
                                        MEDICINE
                                    </h6>
                                    <div class="grid grid-rows-3 gap-2 mt-2">
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '24')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer border-emera bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>

                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif

                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '23')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer border-emera bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>

                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '22')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer border-emera bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>

                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                </div><!-- medicine 1 to 3 bed end -->
                                <div class="p-2 bg-white border-2 border-t-0 border-gray-600 w-28">
                                    <h4 class="p-1 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
                                        SUP
                                        OFFICE
                                    </h4>
                                </div>
                                <div class="bg-white border-2 border-t-0 border-l-0 border-gray-600">
                                    <div class="mt-2 ">
                                        <div class="flex flex-col gap-2 p-2">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '4' or $bed->bed_id == '5')
                                                    <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                        id="{{ $bed->bed_id }}"
                                                        class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                        <span
                                                            class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                        <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                        @forelse ($patientBeds as $patientBed)
                                                            @if ($patientBed->bed_id == $bed->bed_id)
                                                                @forelse ($getHpersons as $getHperson)
                                                                    @if ($patientBed->enccode == $getHperson->enccode)
                                                                        <div drag-item draggable="true"
                                                                            id="{{ $patientBed->enccode }}"
                                                                            ondragstart="drag(event)"
                                                                            class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                            @php
                                                                                $getDiff = $getCurrentDateTime->diffInHours(
                                                                                    $getHperson->erdate,
                                                                                );
                                                                            @endphp
                                                                            <div class="flex flex-row h-1/3">
                                                                                <div
                                                                                    class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                    {{ $bed->bed_name }}
                                                                                </div>
                                                                                <div class="w-1/2 ">
                                                                                    @if ($getDiff == 3)
                                                                                        <span
                                                                                            class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                            <span
                                                                                                class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                            <span
                                                                                                class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                            </span>
                                                                                        </span>
                                                                                    @endif
                                                                                    @if ($getDiff >= 4)
                                                                                        <span
                                                                                            class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                            <span
                                                                                                class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                            <span
                                                                                                class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                            </span>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                                {{ $getHperson->patlast }},
                                                                            </div>

                                                                            <div
                                                                                class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                                {{ $getHperson->patfirst[0] }}.
                                                                            </div>
                                                                            <div></div>
                                                                        </div>
                                                                    @else
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            @endif
                                                            <!----->
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                @endif
                                            @empty
                                            @endforelse
                                        </div>
                                        <div class="p-2">
                                            <h6
                                                class="p-1 mt-1 text-sm text-center text-white bg-green-900 rounded-md">
                                                RESU</h6>
                                        </div>

                                    </div>
                                </div>
                                <div class="bg-white border-2 border-t-0 border-l-0 border-gray-600 w-28">

                                </div>
                                <div class="p-2 bg-white border-2 border-t-0 border-l-0 border-gray-600 w-28">
                                    <h4 class="p-1 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
                                        TRIAGE
                                    </h4>
                                </div><!-- end --><!-- end -->
                            </div> <!--overflow rigth side 1 2 3 -->
                            <!--1 -->
                            <div class="flex flex-row p-0 mt-8 space-x-0 rounded-md">
                                <div class="w-2/4 p-2 bg-white border-2 border-gray-600 rounded-l-md">
                                    <div class="p-2">
                                        <h4 class="p-1 text-base bg-blue-300 rounded-md"> Nurse Station</h4>
                                    </div>
                                    <div class="p-2">
                                        <h4 class="p-1 text-base rounded-md bg-amber-300">Doctors area</h4>
                                    </div>
                                    <div class="p-2">
                                        <h4 class="p-1 text-base bg-green-300 rounded-md">Internal medicine</h4>
                                    </div>
                                </div>
                                <div class="bg-white border-2 border-l-0 border-gray-600 w-28">

                                </div>
                                <div class="p-2 bg-white border-2 border-l-0 border-gray-600 w-28 rounded-r-md">
                                    <h4 class="p-1 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
                                        BLOTTER
                                    </h4>
                                </div>
                                <div class="w-12">

                                </div>
                                <div class="p-2 bg-white border-2 border-gray-600 rounded-md">
                                    <div class="grid grid-rows-3 gap-2">
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '7' or $bed->bed_id == '8' or $bed->bed_id == '9')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="mt-4">
                                        <p class="p-1 text-sm text-center text-white bg-green-900 rounded-md">
                                            TRAUMA
                                        </p>
                                    </div>
                                </div>

                            </div><!--2 -->
                            <!--bottom for famed and medicine extension--->
                            <div class="flex flex-col mt-12 bg-white rounded-md">
                                <div
                                    class="grid grid-cols-6 gap-6 p-2 bg-white border-b-4 border-gray-600 rounded-t-md">
                                    @forelse ($beds as $bed)
                                        @if (
                                            $bed->bed_id == '38' or
                                                $bed->bed_id == '39' or
                                                $bed->bed_id == '40' or
                                                $bed->bed_id == '41' or
                                                $bed->bed_id == '42' or
                                                $bed->bed_id == '43')
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                <div style="transform: rotate(-90deg);" class="flex flex-col mt-12">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-0 mt-0">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-0">AVAILABLE</span>
                                                </div>
                                                @forelse ($patientBeds as $patientBed)
                                                    @if ($patientBed->bed_id == $bed->bed_id)
                                                        @forelse ($getHpersons as $getHperson)
                                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                                <div drag-item draggable="true"
                                                                    id="{{ $patientBed->enccode }}"
                                                                    ondragstart="drag(event)"
                                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-t from-rose-400 to-rose-700">
                                                                    @php
                                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                                            $getHperson->erdate,
                                                                        );
                                                                    @endphp
                                                                    <div style="transform: rotate(-90deg);"
                                                                        class="flex flex-col mt-12">
                                                                        <div class="flex flex-row w-32 h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                                {{ $bed->bed_name }}</div>
                                                                            <div>
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate w-24 h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                    <!----->
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div> <!--medicine -->
                                <div class="grid grid-cols-6 gap-6 p-2 mt-0 bg-white rounded-b-md">
                                    @forelse ($beds as $bed)
                                        @if ($bed->bed_id == '1' or $bed->bed_id == '2' or $bed->bed_id == '3')
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                <div style="transform: rotate(-90deg);" class="flex flex-col mt-12">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-0 mt-0">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-0">AVAILABLE</span>
                                                </div>
                                                @forelse ($patientBeds as $patientBed)
                                                    @if ($patientBed->bed_id == $bed->bed_id)
                                                        @forelse ($getHpersons as $getHperson)
                                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                                <div drag-item draggable="true"
                                                                    id="{{ $patientBed->enccode }}"
                                                                    ondragstart="drag(event)"
                                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-t from-rose-400 to-rose-700">
                                                                    @php
                                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                                            $getHperson->erdate,
                                                                        );
                                                                    @endphp
                                                                    <div style="transform: rotate(-90deg);"
                                                                        class="flex flex-col mt-12">
                                                                        <div class="flex flex-row w-32 h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                                {{ $bed->bed_name }}</div>
                                                                            <div>
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate w-24 h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                    <!----->
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                                <div class="p-2 ml-8 w-44">
                                    <h4 class="w-full p-1 mt-2 text-sm text-center text-white bg-green-900 rounded-md">
                                        FAMILY
                                        MEDICINE</h4>
                                </div>
                            </div><!--3 -->
                        </div> <!--second -->

                        <div class=""> <!--third start-->
                            <div class="flex flex-row gap-4 p-2 bg-white border-2 border-t-0 border-gray-600">
                                <div class="mt-2">
                                    <div class="">
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '21')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                    <!-- pedia bed 7-->
                                    <div class="w-32 h-14"> </div>
                                    <div class="">
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '19')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>

                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                    <!-- pedia bed 5-->
                                </div>
                                <div class="mt-6">
                                    <div>
                                        <div class="">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '18')
                                                    <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                        id="{{ $bed->bed_id }}"
                                                        class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                        <div style="transform: rotate(-90deg);"
                                                            class="flex flex-col mt-12">
                                                            <span
                                                                class="text-[12px] text-black p-0 ml-0 mt-0">{{ $bed->bed_name }}</span>
                                                            <span
                                                                class="text-[12px] text-black p-0 ml-0">AVAILABLE</span>
                                                        </div>
                                                        @forelse ($patientBeds as $patientBed)
                                                            @if ($patientBed->bed_id == $bed->bed_id)
                                                                @forelse ($getHpersons as $getHperson)
                                                                    @if ($patientBed->enccode == $getHperson->enccode)
                                                                        <div drag-item draggable="true"
                                                                            id="{{ $patientBed->enccode }}"
                                                                            ondragstart="drag(event)"
                                                                            class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-t from-rose-400 to-rose-700">
                                                                            @php
                                                                                $getDiff = $getCurrentDateTime->diffInHours(
                                                                                    $getHperson->erdate,
                                                                                );
                                                                            @endphp
                                                                            <div style="transform: rotate(-90deg);"
                                                                                class="flex flex-col mt-12">
                                                                                <div class="flex flex-row w-32 h-1/3">
                                                                                    <div
                                                                                        class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                                        {{ $bed->bed_name }}</div>
                                                                                    <div>
                                                                                        @if ($getDiff == 3)
                                                                                            <span
                                                                                                class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                                <span
                                                                                                    class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                                <span
                                                                                                    class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                                </span>
                                                                                            </span>
                                                                                        @endif
                                                                                        @if ($getDiff >= 4)
                                                                                            <span
                                                                                                class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                                <span
                                                                                                    class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                                <span
                                                                                                    class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                                </span>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="text-[12px] text-black ml-1 p-0 h-1/3">
                                                                                    {{ $getHperson->patlast }},
                                                                                </div>
                                                                                <div
                                                                                    class="text-[12px] text-black ml-1 p-0 truncate w-24 h-1/3">
                                                                                    {{ $getHperson->patfirst[0] }}.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            @endif
                                                            <!----->
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                @endif
                                            @empty
                                            @endforelse
                                        </div>
                                        <!-- pedia bed 4-->
                                    </div>
                                    <div>
                                        <div class="w-32 h-14"> </div>
                                        <div
                                            class="w-16 text-xs bg-green-800 border-2 border-gray-900 rounded-md h-14">
                                            <div class="p-1">
                                                <p class="text-white">NURSE</p>
                                                <p class="text-white">DOCTOR</p>
                                                <p class="text-white">AREA</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '20')
                                                    <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                        id="{{ $bed->bed_id }}"
                                                        class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                        <span
                                                            class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                        <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                        @forelse ($patientBeds as $patientBed)
                                                            @if ($patientBed->bed_id == $bed->bed_id)
                                                                @forelse ($getHpersons as $getHperson)
                                                                    @if ($patientBed->enccode == $getHperson->enccode)
                                                                        <div drag-item draggable="true"
                                                                            id="{{ $patientBed->enccode }}"
                                                                            ondragstart="drag(event)"
                                                                            class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                            @php
                                                                                $getDiff = $getCurrentDateTime->diffInHours(
                                                                                    $getHperson->erdate,
                                                                                );
                                                                            @endphp
                                                                            <div class="flex flex-row h-1/3">
                                                                                <div
                                                                                    class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                    {{ $bed->bed_name }}
                                                                                </div>
                                                                                <div class="w-1/2 ">
                                                                                    @if ($getDiff == 3)
                                                                                        <span
                                                                                            class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                            <span
                                                                                                class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                            <span
                                                                                                class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                            </span>
                                                                                        </span>
                                                                                    @endif
                                                                                    @if ($getDiff >= 4)
                                                                                        <span
                                                                                            class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                            <span
                                                                                                class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                            <span
                                                                                                class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                            </span>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                                {{ $getHperson->patlast }},
                                                                            </div>
                                                                            <div
                                                                                class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                                {{ $getHperson->patfirst[0] }}.
                                                                            </div>
                                                                            <div></div>
                                                                        </div>
                                                                    @else
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            @endif
                                                            <!----->
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                @endif
                                            @empty
                                            @endforelse
                                        </div>
                                        <!-- pedia bed 6-->
                                    </div>
                                </div>
                                <div class="flex flex-col mt-2 ml-2"> <!-- pedia bed 1 bed 2 bed 3-->
                                    <div class="grid grid-rows-3 gap-2 ">
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '17')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse

                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '16')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse

                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '15')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-32 p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                                    @forelse ($patientBeds as $patientBed)
                                                        @if ($patientBed->bed_id == $bed->bed_id)
                                                            @forelse ($getHpersons as $getHperson)
                                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                                    <div drag-item draggable="true"
                                                                        id="{{ $patientBed->enccode }}"
                                                                        ondragstart="drag(event)"
                                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                                        @php
                                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                                $getHperson->erdate,
                                                                            );
                                                                        @endphp
                                                                        <div class="flex flex-row h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                                {{ $bed->bed_name }}
                                                                            </div>
                                                                            <div class="w-1/2 ">
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                        <div></div>
                                                                    </div>
                                                                @else
                                                                @endif
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                        <!----->
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="p-2">
                                        <h4 class="p-1 mt-6 text-sm text-center text-white bg-green-900 rounded-md">
                                            PEDIA
                                        </h4>
                                    </div>
                                </div>

                            </div> <!--- for pedia -->

                            <div class="flex flex-row p-6 mt-12 bg-white border-2 border-gray-600 rounded-md">
                                <!--- for ob start -->
                                <div class="flex flex-row space-x-4">
                                    @forelse ($beds as $bed)
                                        @if ($bed->bed_id == '11')
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                <div style="transform: rotate(-90deg);" class="flex flex-col mt-12">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-0 mt-0">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-0">AVAILABLE</span>
                                                </div>
                                                @forelse ($patientBeds as $patientBed)
                                                    @if ($patientBed->bed_id == $bed->bed_id)
                                                        @forelse ($getHpersons as $getHperson)
                                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                                <div drag-item draggable="true"
                                                                    id="{{ $patientBed->enccode }}"
                                                                    ondragstart="drag(event)"
                                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-t from-rose-400 to-rose-700">
                                                                    @php
                                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                                            $getHperson->erdate,
                                                                        );
                                                                    @endphp
                                                                    <div style="transform: rotate(-90deg);"
                                                                        class="flex flex-col mt-12">
                                                                        <div class="flex flex-row w-32 h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                                {{ $bed->bed_name }}</div>
                                                                            <div>
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate w-24 h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                    <!----->
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                    @forelse ($beds as $bed)
                                        @if ($bed->bed_id == '10')
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                <div style="transform: rotate(-90deg);" class="flex flex-col mt-12">
                                                    <span
                                                        class="text-[12px] text-black p-0 ml-0 mt-0">{{ $bed->bed_name }}</span>
                                                    <span class="text-[12px] text-black p-0 ml-0">AVAILABLE</span>
                                                </div>
                                                @forelse ($patientBeds as $patientBed)
                                                    @if ($patientBed->bed_id == $bed->bed_id)
                                                        @forelse ($getHpersons as $getHperson)
                                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                                <div drag-item draggable="true"
                                                                    id="{{ $patientBed->enccode }}"
                                                                    ondragstart="drag(event)"
                                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-t from-rose-400 to-rose-700">
                                                                    @php
                                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                                            $getHperson->erdate,
                                                                        );
                                                                    @endphp
                                                                    <div style="transform: rotate(-90deg);"
                                                                        class="flex flex-col mt-12">
                                                                        <div class="flex flex-row w-32 h-1/3">
                                                                            <div
                                                                                class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                                {{ $bed->bed_name }}</div>
                                                                            <div>
                                                                                @if ($getDiff == 3)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                                @if ($getDiff >= 4)
                                                                                    <span
                                                                                        class="relative flex w-6 h-6 mt-0 ml-8">
                                                                                        <span
                                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                        <span
                                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                        </span>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 h-1/3">
                                                                            {{ $getHperson->patlast }},
                                                                        </div>
                                                                        <div
                                                                            class="text-[12px] text-black ml-1 p-0 truncate w-24 h-1/3">
                                                                            {{ $getHperson->patfirst[0] }}.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                    <!----->
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                                <div class="p-2">
                                    <h4 class="p-1 text-sm text-center text-white bg-green-900 rounded-md">OB/GYNE
                                    </h4>
                                </div>
                            </div>
                        </div> <!--third -->

                        <div class="flex flex-row h-full p-2 space-x-4 mt-44">
                            <div class="p-6 bg-white border-2 border-gray-600 rounded-md h-1/2">
                                <div class="w-16 p-2 bg-white border-2 border-gray-300 rounded-md h-28">
                                </div>
                            </div>

                            <div class="p-4 bg-white border-2 border-gray-600 rounded-md">
                                <div class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14 mt-44">
                                </div>
                                <div class="w-32 p-1 mt-10 bg-white border-2 border-gray-300 rounded-md h-14">
                                </div>
                            </div>
                        </div> <!--fourth -->
                    </div>
                </div>
            </div>

        </div> <!------>
    </div>
    <!--MODALS HERE-->
    <!--MODALS HERE-->
    <!--Script here-->
    <script>
        //--- 1 OPD 3rd Floor (MICU A)
        var ward3FMP = {
            series: [@json($ward3FMP), @json($ward3FMPAvailable)],
            chart: {
                //height: 480,
                height: 230,
                width: '100%',
                align: 'left',
                type: 'donut',
            },
            fill: {
                type: 'gradient',
                gradient: {
                    //shade: 'dark',
                    //type: "horizontal",
                    shadeIntensity: 0.5,
                    gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 100],
                    colorStops: []
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'OPD 3rd Floor (MICU A)',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'OPD 3rd Floor (MICU B)',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Main 3rd Floor  (NICU A)',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Main 3rd Floor (NICU B)',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Annex 2nd Floor Pedia A & PICU A',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Annex 2nd Floor (PICU B)',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'SICU',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: '*SICU',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: '3FCCU',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Stepdown',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
                fontWeight: 400,
                fontFamily: 'sans',
            },
            // title: {
            //     text: 'Stepdown',
            //     align: 'center',
            //     style: {
            //         fontSize: '14px',
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

        //---wardFH2, 12 Field Hospital 3 (CAMES)
        var wardFH3 = {
            series: [@json($wardFH3), @json($wardFH3Available)],
            chart: {
                //height: 480,
                height: 230,
                width: '100%',
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
                                fontSize: 22,
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
                fontSize: '14px',
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
                height: 450,
                width: '100%',
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
                fontSize: '14px',
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


        function tick() {
            //get the mins of the current time
            var mins = new Date().getMinutes();
            var seconds = new Date().getSeconds();
            //-- update count section
            if (mins == "00" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "05" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "10" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "15" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "20" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "25" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "30" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "35" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "40" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "45" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "50" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "55" && seconds == "00") {
                Livewire.emit('saveCount');
            }
            if (mins == "58" && seconds == "00") {
                Livewire.emit('saveCount');
            }

            //--

            //-- reload section
            // if (mins == "02" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "07" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "12" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "17" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "22" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "27" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "32" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "37" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "42" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "47" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "52" && seconds == "00") {
            //     location.reload();
            // }
            // if (mins == "57" && seconds == "00") {
            //     location.reload();
            // }
            console.log('Tick ' + mins);
        }

        setInterval(tick, 1000);

        var ContainerOne = document.querySelector('.one');
        var ContainerSecond = document.querySelector('.two');

        setInterval(function() {
            if (ContainerOne.style.display === 'block') {
                ContainerOne.style.display = 'none';
                ContainerSecond.style.display = 'block';
            } else {
                ContainerOne.style.display = 'block';
                ContainerSecond.style.display = 'none';
            }
        }, 10000);

        $("#toggle").on("click", function() {
            $(".isToggable").toggle();
        });
        // window.setInterval(function() {
        //     var elem = document.getElementById('data');
        //     elem.scrollTop = elem.scrollHeight;
        // }, 5000);
    </script>
</div>
