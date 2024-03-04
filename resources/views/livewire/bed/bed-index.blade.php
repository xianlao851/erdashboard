<x-slot name="header">
    <h3 class="text-lg font-normal leading-tight text-gray-800">
        BED ASSIGNMENT </h3>
</x-slot>

<div class="w-full p-2 ">
    <div class="w-full" wire:loading>
        <div class="absolute flex items-center justify-center mt-0 ml-0 bg-black z-[9999] w-full h-full opacity-75">
            <span class="text-green-400 loading loading-spinner loading-lg"></span>
        </div>
    </div>
    <div class="flex flex-col w-full h-screen bg-gray-200">
        {{-- <div class="relative">
            <div class="absolute top-0 flex flex-row space-x-4 right-4">

                <div class="w-full mx-4">
                    <select wire:model='room_id' class="border-green-600 w-28 select ">
                        <option value="0">ALL</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->room_id }}" class="uppercase">{{ $room->room_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full max-w-xs form-control">
                    <div class="indicator">
                        <label for="add_bed" class="text-white bg-green-600 rounded-2xl btn btn-md hover:bg-gray-400">
                            Add bed</label>
                        {{-- <label for="add_bed" class="bg-green-600 btn btn-md hover:bg-gray-400 ">
                            <i class="text-white las la-plus-circle la-2x"></i></label>
                    </div>
                </div>

                <!--Search Patient start--->
                <div class="">
                    <div class="join">
                        <input class="input input-md input-bordered join-item" wire:model.lazy='search_patient'
                            placeholder="Search" />
                        <button class="text-white bg-green-600 rounded-r-full btn btn-md join-item">Search</button>
                    </div>
                </div>
                <!--Search Patient--->
            </div>
        </div> --}}

        <div class="flex mt-4">
            <!--First conatainer-->
            <div class="w-2/12 mt-10">
                <h3 class="ml-2">Patient's list</h3>
                <div class="mt-2">
                    <ul class="grid grid-cols-3 gap-2 p-1 rounded-lg">
                        @if ($getPatients)
                            @forelse ($getPatients as $patient)
                                <li drag-item draggable="true"
                                    class="  h-14 p-1 text-[10px] antialiased bg-white rounded-lg shadow-lg cursor-pointer hover:bg-gray-50"
                                    id="{{ $patient->enccode }}" wire:key='$patient-{{ $patient->enccode }}'
                                    ondragstart="drag(event)">
                                    <div class="flex w-full p-1">
                                        <div class="mt-0">{{ $patient->patlast }}, {{ $patient->patfirst[0] }}
                                        </div>
                                    </div>
                                </li>
                            @empty
                            @endforelse
                        @endif
                    </ul>
                </div>

                <div class="p-2"> {{-- Manual pagination --}}
                    <div class="flex items-center justify-between px-1 py-1 mx-0 bg-white rounded-lg shadow-lg sm:px-6">
                        <div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div class="mx-1">
                                    <p class="text-sm text-gray-700">
                                        Showing
                                        @if ($totalCount > 20)
                                            {{ $getTake - 19 }}
                                            </span>
                                            to
                                            @if ($getTake >= $totalCount)
                                                {{ $totalCount }}
                                            @else
                                                {{ $getTake }}
                                            @endif

                                            {{-- {{ $getCount = $currentPage * $perPage }} --}}
                                            <span class="font-medium"></span>
                                            of
                                        @endif
                                        <span class="font-medium">{{ $totalCount }}</span>
                                        results
                                    </p>
                                </div>
                                @if ($totalCount > 20)
                                    <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate"
                                        aria-label="Pagination">
                                        <a class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-l-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                            wire:click='previousPrevious'>
                                            <span class="sr-only">Previous</span>
                                            <i class="las la-angle-double-left"></i>
                                        </a>
                                        <a class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                            wire:click='previous'>
                                            <span class="sr-only">Previous</span>
                                            <i class="las la-angle-left"></i>
                                        </a>
                                        {{-- @for ($i = $setStart; $i <= $setEnd; $i++) --}}
                                        @if ($currentPage != 1 and $setEnd > 7)
                                            <li class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 cursor-pointer ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                                wire:click="setPageToOne({{ 1 }})">
                                                1..
                                            </li>
                                        @endif
                                        @for ($i = $setStart; $i <= $setEnd; $i++)
                                            {{-- @for ($i = 1; $i <= ceil($totalCount / $perPage); $i++) --}}
                                            <li @if ($currentPage == $i) class="relative z-10 inline-flex items-center p-2 px-4 text-sm font-semibold text-white bg-green-600 cursor-pointer focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @else
                                                class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 cursor-pointer ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" @endif
                                                wire:click="setCurrentPage({{ $i }})">
                                                {{ $i }}
                                            </li>
                                        @endfor
                                        <a class="relative inline-flex items-center px-2 py-2 text-gray-400 cursor-pointer ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                            wire:click="next">
                                            <span class="sr-only">Next</span>
                                            <i class="las la-angle-right"></i>
                                        </a>
                                        <a class="relative inline-flex items-center px-2 py-2 text-gray-400 cursor-pointer rounded-r-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                            wire:click="nextNext">
                                            <i class="las la-angle-double-right"></i>
                                        </a>
                                    </nav>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--First conatainer end, for patient list in the erlogs-->

            <!--Second conatainer for beds and patient admitted-->
            <div class="w-10/12 p-3 mt-16 ml-2 overflow-scroll bg-gray-200 border-4 border-gray-700 rounded-md">
                <div class="flex flex-row gap-8">

                    <div class="flex flex-row gap-2">
                        <div class="">
                            <h6>Overflow</h6>
                            <div class="grid grid-rows-6 gap-2 mt-1">
                                @for ($i = 1; $i <= 6; $i++)
                                    <div class="w-16 bg-white border-2 border-gray-300 rounded-md h-28"> </div>
                                @endfor
                            </div>
                        </div><!--overflow -->
                        <div class=" mt-7"> <!--medicine left extension start-->
                            <div class="grid gap-2 grid-rows-9">
                                @foreach ($room_medicine_four_nine as $bed)
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="{{ $bed->bed_id }}"
                                        class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14">
                                        <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                        <div>
                                            @forelse ($bed->patientBed as $patient)
                                                @if ($patient->patientHerlog)
                                                    <div drag-item draggable="true"
                                                        id="{{ $patient->patientHerlog->enccode }}"
                                                        wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                        ondragstart="drag(event)" class="mt-0 bg-red-500 rounded-md ">
                                                        <div class="text-[10px] text-black p-1">
                                                            {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                            {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($patient->patientHerlog == null and $loop->last)
                                                    <div class="mt-0 bg-green-500 rounded-md ">
                                                        <div class="text-[10px] text-black p-1">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="mt-0 bg-green-500 rounded-md ">
                                                    <div class="text-[10px] text-black p-1">
                                                        VACANT BED
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!--medicine left extension end-->
                    </div> <!--first -->

                    <div class="flex flex-col">
                        <div class="flex space-x-0">
                            <div class="p-1 bg-white rounded-l-md">
                                <h6>Medicine</h6>
                                <div class="grid grid-rows-3 gap-2">
                                    @foreach ($room_medicine_one_to_three as $bed)
                                        <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                            id="{{ $bed->bed_id }}"
                                            class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14">
                                            <div class="text-[10px] text-black"> {{ $bed->bed_name }}</div>
                                            <div>
                                                @forelse ($bed->patientBed as $patient)
                                                    @if ($patient->patientHerlog)
                                                        <div drag-item draggable="true"
                                                            id="{{ $patient->patientHerlog->enccode }}"
                                                            wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                            ondragstart="drag(event)"
                                                            class="mt-0 bg-red-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                                {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($patient->patientHerlog == null and $loop->last)
                                                        <div class="mt-0 bg-green-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                VACANT BED
                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <div class="mt-0 bg-green-500 rounded-md ">
                                                        <div class="text-[10px] text-black p-1">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div><!-- medicine 1 to 3 bed end -->
                            <div class="p-2 bg-white border-2 border-gray-600 w-28">
                                <h4 class="p-1 mt-20 text-sm text-center text-white bg-green-900 rounded-md">SUP OFFICE
                                </h4>
                            </div>
                            <div class="bg-white border-2 border-l-0 border-gray-600">
                                <div class="mt-2 ">
                                    <div class="flex flex-col gap-2 p-2">
                                        @foreach ($room_resu as $bed)
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14">
                                                <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                                <div>
                                                    @forelse ($bed->patientBed as $patient)
                                                        @if ($patient->patientHerlog)
                                                            <div drag-item draggable="true"
                                                                id="{{ $patient->patientHerlog->enccode }}"
                                                                wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                                ondragstart="drag(event)"
                                                                class="mt-0 bg-red-500 rounded-md ">
                                                                <div class="text-[10px] text-black p-1">
                                                                    {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                                    {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($patient->patientHerlog == null and $loop->last)
                                                            <div class="mt-0 bg-green-500 rounded-md ">
                                                                <div class="text-[10px] text-black p-1">
                                                                    VACANT BED
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @empty
                                                        <div class="mt-0 bg-green-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                VACANT BED
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="p-2">
                                        <h6 class="p-1 mt-1 text-sm text-center text-white bg-green-900 rounded-md">
                                            RESU</h6>
                                    </div>

                                </div>
                            </div>
                            <div class="bg-white border-2 border-l-0 border-gray-600 w-28">

                            </div>
                            <div class="p-2 bg-white border-2 border-l-0 border-gray-600 w-28 rounded-r-md">
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
                                <h4 class="p-1 mt-20 text-sm text-center text-white bg-green-900 rounded-md">BLOTTER
                                </h4>
                            </div>
                            <div class="w-12">

                            </div>
                            <div class="p-2 bg-white border-2 border-gray-600 rounded-md">
                                <div class="grid grid-rows-3 gap-2">
                                    @foreach ($room_trauma as $bed)
                                        <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                            id="{{ $bed->bed_id }}"
                                            class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14">
                                            <div class="text-[13px] text-black"> {{ $bed->bed_name }},
                                                {{ $bed->bed_id }}</div>
                                            <div>
                                                @forelse ($bed->patientBed as $patient)
                                                    @if ($patient->patientHerlog)
                                                        <div drag-item draggable="true"
                                                            id="{{ $patient->patientHerlog->enccode }}"
                                                            wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                            ondragstart="drag(event)"
                                                            class="mt-0 bg-red-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                                {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($patient->patientHerlog == null and $loop->last)
                                                        <div class="mt-0 bg-green-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                VACANT BED
                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <div class="mt-0 bg-green-500 rounded-md ">
                                                        <div class="text-[10px] text-black p-1">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <p class="p-1 text-sm text-center text-white bg-green-900 rounded-md">TRAUMA
                                    </p>
                                </div>
                            </div>

                        </div><!--2 -->
                        <!--bottom for famed and medicine extension--->
                        <div class="flex flex-col mt-12 bg-white rounded-md">
                            <div class="grid grid-cols-6 gap-6 p-2 bg-white border-b-4 border-gray-600 rounded-t-md">
                                @foreach ($room_medicine_ten_twenty as $bed)
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="{{ $bed->bed_id }}"
                                        class="w-16 p-1 bg-white border-2 border-gray-300 rounded-md h-28 text-wrap">
                                        <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                        <div>
                                            @forelse($bed->patientBed as $patient)
                                                @if ($patient->patientHerlog)
                                                    <div drag-item draggable="true"
                                                        id="{{ $patient->patientHerlog->enccode }}"
                                                        wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                        ondragstart="drag(event)">
                                                        <div style="text-wrap: wrap; writing-mode: vertical-rl;
                                                            text-orientation: mixed;"
                                                            class="text-[10px] text-black p-1  bg-red-500 rounded-md text-center">
                                                            {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }},
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($patient->patientHerlog == null and $loop->last)
                                                    <div class="p-0 mt-0">
                                                        <div style="text-wrap: wrap; writing-mode: vertical-rl;
                                                        text-orientation: mixed;direction: rtl;"
                                                            class="text-[10px] text-black p-1  bg-green-500 rounded-md text-center">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="p-0 mt-0">
                                                    <div
                                                        class="text-wrap  text-[10px] text-black p-0 bg-green-500 rounded-sm text-center">
                                                        VACANT BED
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                @endforeach
                            </div> <!--medicine -->
                            <div class="grid grid-cols-6 gap-6 p-2 mt-0 bg-white rounded-b-md">
                                @foreach ($room_fam_med as $bed)
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="{{ $bed->bed_id }}"
                                        class="w-16 p-1 bg-white border-2 border-gray-300 rounded-md h-28">
                                        <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                        <div>
                                            @forelse($bed->patientBed as $patient)
                                                @if ($patient->patientHerlog)
                                                    <div drag-item draggable="true"
                                                        id="{{ $patient->patientHerlog->enccode }}"
                                                        wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                        ondragstart="drag(event)">
                                                        <div
                                                            class="text-[10px] text-black p-1  bg-red-500 rounded-sm text-center">
                                                            {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }},
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($patient->patientHerlog == null and $loop->last)
                                                    <div class="p-0 mt-0">
                                                        <div
                                                            class="text-[10px] text-black p-0 bg-green-500 rounded-sm text-center">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="p-0 mt-0">
                                                    <div
                                                        class="text-[10px] text-black p-0 bg-green-500 rounded-sm text-center">
                                                        VACANT BED
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="p-2 ml-8 w-44">
                                <h4 class="w-full p-1 mt-2 text-sm text-center text-white bg-green-900 rounded-md">
                                    FAMILY
                                    MEDICINE</h4>
                            </div>
                        </div><!--3 -->
                    </div> <!--second -->

                    <div class="border-2 "> <!--third start-->
                        <div class="flex flex-row gap-4 p-2 bg-white border-2 border-gray-600 rounded-md">
                            <div class="">
                                <div class="">
                                    @foreach ($room_pedia_seven as $bed)
                                        <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                            id="{{ $bed->bed_id }}"
                                            class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14">
                                            <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                            <div>

                                                @forelse ($bed->patientBed as $patient)
                                                    @if ($patient->patientHerlog)
                                                        <div drag-item draggable="true"
                                                            id="{{ $patient->patientHerlog->enccode }}"
                                                            wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                            ondragstart="drag(event)"
                                                            class="mt-0 bg-red-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($patient->patientHerlog == null and $loop->last)
                                                        <div class="mt-0 bg-green-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                VACANT BED
                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <div class="mt-0 bg-green-500 rounded-md ">
                                                        <div class="text-[10px] text-black p-1">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- pedia bed 7-->
                                <div class="w-32 h-14"> </div>
                                <div class="">
                                    @foreach ($room_pedia_five as $bed)
                                        <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                            id="{{ $bed->bed_id }}"
                                            class="w-32 p-1 mt-10 bg-white border-2 border-gray-300 rounded-md h-14">
                                            <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                            <div>
                                                @forelse ($bed->patientBed as $patient)
                                                    @if ($patient->patientHerlog)
                                                        <div drag-item draggable="true"
                                                            id="{{ $patient->patientHerlog->enccode }}"
                                                            wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                            ondragstart="drag(event)"
                                                            class="mt-0 bg-red-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                                {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($patient->patientHerlog == null and $loop->last)
                                                        <div class="mt-0 bg-green-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                VACANT BED
                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <div class="mt-0 bg-green-500 rounded-md ">
                                                        <div class="text-[10px] text-black p-1">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- pedia bed 5-->
                            </div>
                            <div class="mt-6">
                                <div>
                                    <div class="">
                                        @foreach ($room_pedia_four as $bed)
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="w-16 p-2 bg-white border-2 border-gray-300 rounded-md h-28">
                                                <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                                <div>
                                                    @foreach ($bed->patientBed as $patient)
                                                        @if ($patient->patientHerlog)
                                                            <div drag-item draggable="true"
                                                                id="{{ $patient->patientHerlog->enccode }}"
                                                                wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                                ondragstart="drag(event)" class="mt-0 join">
                                                                <div class="text-[12px] text-black">
                                                                    {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                                    {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- pedia bed 4-->
                                </div>
                                <div>
                                    <div class="w-32 h-14"> </div>
                                    <div class="w-16 text-xs bg-green-800 border-2 border-gray-900 rounded-md h-14">
                                        <div class="p-1">
                                            <p class="text-white">NURSE</p>
                                            <p class="text-white">DOCTOR</p>
                                            <p class="text-white">AREA</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        @foreach ($room_pedia_six as $bed)
                                            <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                id="{{ $bed->bed_id }}"
                                                class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14">
                                                <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                                <div>
                                                    @forelse ($bed->patientBed as $patient)
                                                        @if ($patient->patientHerlog)
                                                            <div drag-item draggable="true"
                                                                id="{{ $patient->patientHerlog->enccode }}"
                                                                wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                                ondragstart="drag(event)"
                                                                class="mt-0 bg-red-500 rounded-md ">
                                                                <div class="text-[10px] text-black p-1">
                                                                    {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                                    {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($patient->patientHerlog == null and $loop->last)
                                                            <div class="mt-0 bg-green-500 rounded-md ">
                                                                <div class="text-[10px] text-black p-1">
                                                                    VACANT BED
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @empty
                                                        <div class="mt-0 bg-green-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                VACANT BED
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- pedia bed 6-->
                                </div>
                            </div>
                            <div class="flex flex-col ml-2">
                                <div class="grid grid-rows-3 gap-2 ">
                                    @foreach ($room_pedia_one_to_three as $bed)
                                        <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                            id="{{ $bed->bed_id }}"
                                            class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14">
                                            <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                            <div>
                                                @forelse ($bed->patientBed as $patient)
                                                    @if ($patient->patientHerlog)
                                                        <div drag-item draggable="true"
                                                            id="{{ $patient->patientHerlog->enccode }}"
                                                            wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                            ondragstart="drag(event)"
                                                            class="mt-0 bg-red-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                                {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($patient->patientHerlog == null and $loop->last)
                                                        <div class="mt-0 bg-green-500 rounded-md ">
                                                            <div class="text-[10px] text-black p-1">
                                                                VACANT BED
                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <div class="mt-0 bg-green-500 rounded-md ">
                                                        <div class="text-[10px] text-black p-1">
                                                            VACANT BED
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="p-2">
                                    <h4 class="p-1 mt-6 text-sm text-center text-white bg-green-900 rounded-md"> PEDIA
                                    </h4>
                                </div>
                            </div>

                        </div> <!--- for pedia -->

                        <div class="flex flex-row p-6 mt-12 bg-white border-2 border-gray-600 rounded-md">
                            <!--- for ob start -->
                            <div class="flex flex-row space-x-4">
                                @foreach ($room_ob_one_two as $bed)
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="{{ $bed->bed_id }}"
                                        class="w-16 bg-white border-2 border-gray-300 rounded-md h-28">
                                        <div class="text-[13px] text-black"> {{ $bed->bed_name }}</div>
                                        <div>
                                            @foreach ($bed->patientBed as $patient)
                                                @if ($patient->patientHerlog)
                                                    <div drag-item draggable="true"
                                                        id="{{ $patient->patientHerlog->enccode }}"
                                                        wire:key='$patient->patientHerlog-{{ $patient->patientHerlog->enccode }}'
                                                        ondragstart="drag(event)" class="mt-0 join">
                                                        <div class="text-[12px] text-black">
                                                            {{ $patient->patientHerlog->patientInfo->get_patient_name_initial() }}
                                                            {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="p-2">
                                <h4 class="p-1 text-sm text-center text-white bg-green-900 rounded-md">OB/GYNE</h4>
                            </div>
                        </div>
                    </div> <!--third -->

                    <div class="flex flex-row h-full p-2 space-x-4 mt-44">
                        <div class="p-6 bg-white border-2 border-gray-600 rounded-md h-1/2">
                            <div class="w-16 p-2 bg-white border-2 border-gray-300 rounded-md h-28">
                            </div>
                        </div>

                        <div class="p-4 bg-white border-2 border-gray-600 rounded-md">
                            <div class="w-32 p-1 bg-white border-2 border-gray-300 rounded-md h-14 mt-44"></div>
                            <div class="w-32 p-1 mt-10 bg-white border-2 border-gray-300 rounded-md h-14"></div>
                        </div>
                    </div> <!--fourth -->
                </div>
            </div>
        </div> <!--Second conatainer end-->

        <!-- Modals start-->
        <!--Transfer patient bed start-->
        <input type="checkbox" id="transferPatientBed" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="max-w-7xl modal-box">
                {{-- <div wire:loading wire:target="transferBed" class="mt-2 mx-44">
                    <span class="text-green-400 loading loading-lg loading-spinner "></span>
                </div> --}}
                <div class="w-full">
                    @if ($selected_transfer_patient)
                        <div class="flex">
                            <div>
                                <h3 class="text-lg font-bold">Transfer Bed</h3>
                                <div drag-item draggable="true" ondrag="drag(event)"
                                    class="p-2 bg-gray-200 rounded-lg w-72 h-22"
                                    id="{{ $selected_transfer_patient->enccode }}"
                                    wire:key='$selected_transfer_patient-{{ $selected_transfer_patient->enccode }}'>
                                    <div class="flex items-center mt-0">
                                        <img draggable="false" src="{{ URL('/images/bed III.png') }}"
                                            class="w-[30px] h-[30px]">
                                        <div class="mt-4 ml-2 text-[12px] text-black underline uppercase">
                                            {{ $selected_transfer_patient->getPatientBedInfo->bedInfoForTransferBed->bed_name }}
                                        </div>
                                    </div>
                                    <div class="w-full grid-cols-2 gap-1 mt-2 join">
                                        <div>
                                            @if ($selected_transfer_patient->patientInfo->patsex == 'M')
                                                <img draggable="false" src="{{ URL('/images/man III.PNG') }}"
                                                    class="w-[30px] h-[30px]">
                                            @endif
                                            @if ($selected_transfer_patient->patientInfo->patsex == 'F')
                                                <img draggable="false" src="{{ URL('/images/women II.PNG') }}"
                                                    class="w-[30px] h-[30px]">
                                            @endif
                                        </div>
                                        <div class="mt-3 ml-0 text-[12px] text-black  flex">
                                            {{ $selected_transfer_patient->patientInfo->get_patient_name() }}
                                            {{-- {{ $patient->patientHerlog->enccode }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full mx-4">
                                <h3 class="text-lg font-bold">Select Room</h3>
                                <select wire:model='room_id' class="w-full max-w-xs select select-success ">
                                    <option>Select</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->room_id }}" class="uppercase">
                                            {{ $room->room_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 grid-rows-1 gap-2 mt-1">
                            @if ($bedsTransfer)
                                @foreach ($bedsTransfer as $bed)
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="{{ $bed->bed_id }}"
                                        wire:key='$bed-{{ $bed->bed_id }}'
                                        class="h-24 p-2 bg-gray-200 rounded-lg shadow-lg hover:bg-gray-50">
                                        <div class="flex items-center mt-0">
                                            <img draggable="false" src="{{ URL('/images/bed III.png') }}"
                                                class="w-[30px] h-[30px]">
                                            <div class="mt-4 ml-2 text-[12px] text-black underline uppercase">
                                                {{ $bed->bed_name }}
                                            </div>
                                        </div> <!-- for bed info and bed image-->
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
                                                        <div class="mt-3 ml-0 text-[12px] text-black  flex">
                                                            {{ $patient->patientHerlog->patientInfo->get_patient_name() }}
                                                            {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div> <!-- bed div container--->
                                @endforeach

                        </div>
                        <div class="mt-2">
                            @if ($bedsTransfer)
                                {{ $bedsTransfer->links() }}
                            @endif
                        </div>
                    @endif
                    @endif
                </div>
                <div class="mt-4 modal-action">
                    <label for="transferPatientBed" class="btn btn-sm" wire:click='resetVar'>Close!</label>
                </div>
            </div>
        </div> <!--Transfer patient bed end-->

        <!-- add bed start--->
        <input type="checkbox" id="add_bed" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Add beds</h3>
                <div class="py-2">
                    <label for="bed_name" class="block mb-2 text-sm font-medium text-gray-900 dark:gray-600">Bed
                        name</label>
                    <input wire:model.defer="bed_name" id="bed_name" required
                        class="block w-full text-sm text-gray-900 border border-blue-600 rounded-md bg-gray-50 focus:border-blue-700 focus:ring-blue-700"
                        placeholder="Bed name">
                    </input>
                </div>
                <div class="modal-action">
                    <label for="add_bed" class="btn btn-sm btn-success" wire:click='saveBed'>Save</label>
                    <label for="add_bed" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div> <!-- add bed end--->
        <!-- Modals end--->
    </div> <!--main div end-->
    <!--scripts start-->
    <script>
        window.onload = function() {
            Livewire.emit('reset_page');
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        var getcode = {};

        function drag(ev) {
            var enccode = ev.currentTarget.id;
            getcode.code = enccode; // get the enccode
            //console.log(enccode);
            //ev.dataTransfer.setData("text", ev.target.id);
            //document.getElementById('patient').innerHTML = enccode;
            //Livewire.emit('onDrag', id);
        }

        function drop(ev) {
            ev.preventDefault();
            var getenccode = getcode.code; // get the enccode
            var bedid = ev.currentTarget.id;
            Livewire.emit('onDrop', bedid, getenccode);
            //var data = ev.dataTransfer.getData("text");
            //ev.target.appendChild(document.getElementById(data));
            //document.getElementById('bed').innerHTML = bedid;
        }


        function dischargePatient(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#0f7d34",
                confirmButtonText: "Yes, discharge patient!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('dischargePatient', id);
                }
            });
        }

        window.addEventListener('occupied', function() {
            Swal.fire({
                title: "Invalid",
                text: "Bed is already occupied",
                icon: "warning",
                confirmButtonColor: "#1737d4",
            });
        });

        window.addEventListener('patientAssingedToABedAlready', function() {
            Swal.fire({
                title: "Your about transfer the patient to another bed",
                text: "Do you want to proceed transfering bed?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: "#1737d4",
                confirmButtonText: "Yes, Transfer",
                denyButtonText: `Don't transfer`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emit('transferPatientBed');
                    //Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });

            // Swal.fire({
            //     title: "Invalid",
            //     text: "Patient is already assigned to a bed",
            //     icon: "warning",
            //     confirmButtonColor: "#1737d4",
            // });
        });

        window.addEventListener('patientAssignedSuccess', event => {
            var patientinfo = event.detail.patienInfo;
            Swal.fire({
                title: "Success",
                text: "Successfully transfered",
                icon: "success",
                confirmButtonColor: "#1737d4",
            });
        });


        window.addEventListener('patientAssigned', function() {
            Swal.fire({
                title: "Success",
                text: "Successfully assigned",
                icon: "success",
                confirmButtonColor: "#1737d4",
            });
        });

        window.addEventListener('transferedBed', function() {
            Swal.fire({
                title: "Success",
                text: "Successfully transfered bed",
                icon: "success",
                confirmButtonColor: "#1737d4",
            });
        });


        window.addEventListener('trgTransferBed', function() {
            document.getElementById("transferPatientBed").checked = true;
        });


        $("#toggle").on("click", function() {
            $(".isToggable").toggle();
        });


        function togglediv(id) {
            document.querySelectorAll(".TableBody").forEach(function(div) {
                if (div.id == id) {
                    // Toggle specified DIV
                    div.style.display = div.style.display == "none" ? "block" : "none";
                } else {
                    // Hide other DIVs
                    div.style.display = "none";
                }
            });
        }
    </script>
</div>
