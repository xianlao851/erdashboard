<div class="w-full p-2 pb-4 mt-0 bg-gray-200">

    <div class="w-full" wire:loading>
        <div class="absolute flex items-center justify-center mt-0 ml-0 bg-black z-[9999] w-full h-full opacity-75">
            <span class="text-green-400 loading loading-spinner loading-lg"></span>
        </div>
    </div>
    {{-- <div class="relative">
        <div class="absolute top-10 left-80">
            <div class="flex items-center justify-between px-0 py-0 mx-0 rounded-xl sm:px-2">
                <div class="hidden font-semibold sm:flex sm:flex-1 sm:items-center sm:justify-between">Total of Active
                    Patients
                    {{ $totalCount }} </div>
            </div>
        </div>
        <div class="absolute top-0 right-8">
            <div class="content-center mt-2 rounded-full w-22 ">
                <label class="bg-rose-500 btn btn-circle btn-lg "><i ondrop="drop(event)" ondragover="allowDrop(event)"
                        id="delete" class="las la-trash la-3x "></i></label>
            </div>
        </div>
    </div> --}}

    <div class="flex flex-col w-full mt-0">
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


        <div class="flex mt-4 space-x-2">
            <!--First conatainer-->
            <div class="w-2/12 p-2 mt-0 bg-white rounded-lg">
                <h3 class="ml-2 font-bold text-center">Patients with no bed assigned</h3>
                <div class="mt-2">
                    <ul class="grid grid-cols-2 gap-2 p-0 rounded-lg">
                        @if ($getPatients)
                            <!--safe with pagination that without error-->
                            {{-- @forelse ($getPatients as $patient)
                                <li drag-item draggable="true"
                                    class="cursor-pointer h-6 p-1 text-[11px] antialiased bg-white rounded-lg text-black shadow-xl hover:bg-gray-300"
                                    id="{{ $patient->enccode }}" wire:key='$patient-{{ $patient->enccode }}'
                                    ondragstart="drag(event)">
                                    <div class="flex w-full p-1">
                                        <div class="mt-0 truncate">{{ $patient->patlast }},
                                            {{ $patient->patfirst }}
                                        </div>
                                    </div>
                                </li>
                            @empty
                            @endforelse --}}

                            @forelse ($getPatients as $patient)
                                @php
                                    $getDiff = $getCurrentDateTime->diffInHours($patient->erdate);
                                @endphp
                                <li drag-item draggable="true"
                                    class="cursor-pointer h-6 p-1 text-[11px] antialiased bg-gray-300
                                    rounded-lg text-black shadow-xl hover:bg-gray-400"
                                    id="{{ $patient->enccode }}" wire:key='$patient-{{ $patient->enccode }}'
                                    ondragstart="drag(event)">

                                    <div class="flex w-full p-0">
                                        <div class="w-1/12">
                                            @if ($getDiff == 3)
                                                <span class="relative flex w-4 h-4 mt-0 ml-0">
                                                    <span
                                                        class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                    <span
                                                        class="relative inline-flex w-4 h-4 bg-yellow-300 rounded-full">
                                                    </span>
                                                </span>
                                            @endif
                                            @if ($getDiff == 4)
                                                <span class="relative flex w-4 h-4 mt-0 ml-0">
                                                    <span
                                                        class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                    <span
                                                        class="relative inline-flex w-4 h-4 rounded-full bg-amber-600">
                                                    </span>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="w-11/12 mt-0 @if ($getDiff == 4 or $getDiff == 3) ml-2 @else ml-0 @endif truncate">
                                            {{ $patient->patlast }},
                                            {{ $patient->patfirst }}
                                        </div>
                                    </div>
                                    @php
                                        $listCount++;
                                    @endphp
                                </li>

                            @empty
                            @endforelse
                        @endif
                    </ul>
                </div>
                @if ($getPatients->isNotEmpty())
                    <div class="mt-2 bg-gray-300 rounded-md shadow-md sm:items-center sm:justify-between sm:px-0">
                        <h4 class="items-center p-0 ml-2 text-sm text-black ">
                            Total: {{ $listCount }}</h4>
                    </div>
                @endif

                <!-- manual pagination-->
                {{-- <div class="p-0 mt-2">
                    <div class="flex items-center justify-between px-0 py-0 mx-0 bg-white shadow-md rounded-xl sm:px-2">
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

                                        @if ($currentPage != 1 and $setEnd > 7)
                                            <li class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 cursor-pointer ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                                wire:click="setPageToOne({{ 1 }})">
                                                1..
                                            </li>
                                        @endif
                                        @for ($i = $setStart; $i <= $setEnd; $i++)
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
                </div> --}}
                <!--End for manual pagination-->
            </div> <!--First conatainer end, for patient list in the erlogs-->

            <!--Second conatainer for beds and patient admitted-->
            <div class="w-10/12 space-y-2 bg-white rounded-lg">

                <div class="flex justify-between px-2 mt-1">

                    <div class="flex flex-row mt-2">
                        <div
                            class="items-center h-6 p-0 ml-0 text-center rounded-md w-80 sm:flex sm:flex-1 sm:items-center sm:justify-between sm:px-0">
                            <h1 class="ml-2">
                                Total number of active patients:
                                {{ $totalCount }}</h1>
                        </div>
                    </div>

                    <div class="w-16 mt-0 rounded-full">
                        <label class=""><i ondrop="drop(event)" ondragover="allowDrop(event)" id="delete"
                                class="las la-trash la-2x "></i></label>
                    </div>
                    <div></div>
                    <div></div>
                    {{-- <div class="absolute top-0 right-2">
                            <div class="content-center mt-0 rounded-full w-22 ">
                                <label class="bg-gray-300 btn btn-circle btn-lg"><i ondrop="drop(event)"
                                        ondragover="allowDrop(event)" id="delete"
                                        class="las la-trash la-3x "></i></label>
                            </div>
                        </div> --}}
                </div>

                <div class="px-3">
                    <div class="mt-0 overflow-scroll bg-gray-200 border-4 border-gray-700 rounded-md ">
                        <div class="flex flex-row gap-10 ">
                            <div class="flex flex-row gap-2 p-2 bg-white">
                                <div class="">
                                    <h6 class="w-full p-1 mt-2 text-sm text-center text-black bg-blue-300 rounded-md">
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
                                                    class="relative flex flex-col w-16 p-0 mt-0 bg-blue-300 rounded-md cursor-pointer h-28">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                                                            {{ $getHperson->patfirst }}.
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
                                        <h6 class="p-1 mt-0 text-sm text-center text-black rounded-md bg-amber-600">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                                                                {{ $getHperson->patfirst }}.
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
                                                                                {{ $getHperson->patfirst }}.
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
                                    <div class="p-1 bg-white border-2 border-t-0 border-gray-600 w-28">
                                        <h4 class="p-0 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
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
                                                            <span
                                                                class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
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
                                                                                    {{ $getHperson->patfirst }}.
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
                                                    class="p-1 mt-1 text-sm text-center text-black rounded-md bg-sky-400">
                                                    RESU</h6>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="bg-white border-2 border-t-0 border-l-0 border-gray-600 w-28">

                                    </div>
                                    <div class="p-1 bg-white border-2 border-t-0 border-l-0 border-gray-600 w-28">
                                        <h4 class="p-0 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
                                            TRIAGE
                                        </h4>
                                    </div><!-- end --><!-- end -->
                                </div> <!--overflow rigth side 1 2 3 -->
                                <!--1 -->
                                <div class="flex flex-row p-0 mt-8 space-x-0 rounded-md">
                                    <div class="w-1/4 p-2 bg-white border-2 border-gray-600 rounded-l-md">
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
                                    <div class="w-16 bg-white border-2 border-l-0 border-gray-600">

                                    </div>
                                    <div class="w-20 p-1 bg-white border-2 border-l-0 border-gray-600">
                                        <h4 class="p-0 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
                                            BLOTTER
                                        </h4>
                                    </div>
                                    <div class="w-16 p-2">

                                    </div>
                                    <div
                                        class="flex flex-col p-2 bg-white border-2 border-l-2 border-r-0 border-gray-600">
                                        <div class="mt-0">
                                            <p
                                                class="w-full p-1 text-sm text-center text-black bg-blue-300 rounded-md">
                                                TRAUMA OVERFLOW
                                            </p>
                                        </div>
                                        <div class="flex flex-col gap-2 mt-1">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '46' or $bed->bed_id == '47' or $bed->bed_id == '48')
                                                    <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                        id="{{ $bed->bed_id }}"
                                                        class="relative flex flex-col w-32 p-1 mt-0 bg-blue-300 rounded-md cursor-pointer h-14">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                    </div>
                                    <div class="p-2 bg-white border-2 border-gray-600 rounded-r-md">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                            <p class="p-1 text-sm text-center text-black bg-red-400 rounded-md">
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
                                                    <div style="transform: rotate(-90deg);"
                                                        class="flex flex-col mt-12">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                            @if ($bed->bed_id == '1' or $bed->bed_id == '2' or $bed->bed_id == '3' or $bed->bed_id == '54')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                    <div style="transform: rotate(-90deg);"
                                                        class="flex flex-col mt-12">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                        <!--electric room-->
                                        @forelse ($beds as $bed)
                                            @if ($bed->bed_id == '56')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                    <div style="transform: rotate(-90deg);"
                                                        class="flex flex-col mt-12">
                                                        <span
                                                            class="text-[12px] text-black p-0 ml-0 mt-0 w-32">{{ $bed->bed_name }}</span>
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
                                                                                <div class="flex flex-row space-x-1">
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
                                                                                                class="relative flex w-6 h-6 mt-0 ml-0">
                                                                                                <span
                                                                                                    class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                                                <span
                                                                                                    class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                                                </span>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="text-[12px] text-black ml-1 p-0 h-1/3">
                                                                                {{ $getHperson->patlast }},
                                                                            </div>
                                                                            <div
                                                                                class="text-[12px] text-black ml-1 p-0 truncate w-24 h-1/3">
                                                                                {{ $getHperson->patfirst }}.
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
                                            @if ($bed->bed_id == '55')
                                                <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                    id="{{ $bed->bed_id }}"
                                                    class="relative flex flex-col w-16 p-0 mt-0 rounded-md cursor-pointer bg-gradient-to-t from-green-300 to-emerald-500 h-28">
                                                    <div style="transform: rotate(-90deg);"
                                                        class="flex flex-col mt-12">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                    <div class="p-0 ml-8 w-44">
                                        <h4
                                            class="w-full p-1 mt-2 text-sm text-center text-black rounded-md bg-fuchsia-300">
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
                                                                                {{ $getHperson->patfirst }}.
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
                                                                                {{ $getHperson->patfirst }}.
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
                                                                                    <div
                                                                                        class="flex flex-row w-32 h-1/3">
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
                                                                                        {{ $getHperson->patfirst }}.
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
                                                            <span
                                                                class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
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
                                                                                    {{ $getHperson->patfirst }}.
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
                                                                                {{ $getHperson->patfirst }}.
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
                                                                                {{ $getHperson->patfirst }}.
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
                                                                                {{ $getHperson->patfirst }}.
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
                                            <h4
                                                class="p-1 mt-6 text-sm text-center text-black bg-yellow-300 rounded-md">
                                                PEDIA
                                            </h4>
                                        </div>
                                    </div>

                                </div> <!--- for pedia -->

                                <div
                                    class="flex flex-row p-1 mt-12 space-x-4 bg-white border-2 border-gray-600 rounded-md">
                                    <!--- for ob start -->
                                    <div class="flex flex-col">
                                        <div class="p-0">
                                            <h4 class="p-1 text-sm text-center text-black bg-pink-400 rounded-md">
                                                OB-GYNE
                                            </h4>
                                        </div>
                                        <div class="flex flex-row mt-1 space-x-4">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '11')
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
                                                                                    {{ $getHperson->patfirst }}.
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
                                                                                    {{ $getHperson->patfirst }}.
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
                                    </div>
                                    <!-- ob overflow-->
                                    <div class="flex flex-col">
                                        <div class="p-0">
                                            <h4 class="p-1 text-sm text-center text-black bg-blue-300 rounded-md">
                                                OB-GYNE OVERFLOW
                                            </h4>
                                        </div>
                                        <div class="flex flex-row mt-1 space-x-4">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '49')
                                                    <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                        id="{{ $bed->bed_id }}"
                                                        class="relative flex flex-col w-16 p-0 mt-0 bg-blue-300 rounded-md cursor-pointer bg-gradient-to-t h-28">
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
                                                                                    {{ $getHperson->patfirst }}.
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
                                                @if ($bed->bed_id == '50')
                                                    <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                                        id="{{ $bed->bed_id }}"
                                                        class="relative flex flex-col w-16 p-0 mt-0 bg-blue-300 rounded-md cursor-pointer h-28">
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
                                                                                    {{ $getHperson->patfirst }}.
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
                                    </div>
                                </div>
                            </div> <!--third -->

                            <div class="flex flex-row h-full p-2 space-x-4 mt-44">
                                <div class="p-6 bg-white border-2 border-gray-600 rounded-md h-1/2">
                                    <div class="flex flex-col"> <!-- room 118-->
                                        <div class="p-0">
                                            <h4 class="p-1 text-sm text-center text-white bg-teal-500 rounded-md">
                                                ROOM 118
                                            </h4>
                                        </div>
                                        <div class="mt-1">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '51')
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
                                                                                    {{ $getHperson->patfirst }}.
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

                                    </div>
                                </div>

                                <!--labor room-->
                                <div class="flex flex-col p-2 bg-white border-2 border-gray-600 rounded-md ">
                                    <div class="space-y-2 mt-44">
                                        <div class="p-0">
                                            <h4 class="p-1 text-sm text-center text-black bg-indigo-400 rounded-md">
                                                LABOR ROOM
                                            </h4>
                                        </div>
                                        <div class="grid grid-rows-2 gap-2">
                                            @forelse ($beds as $bed)
                                                @if ($bed->bed_id == '52' or $bed->bed_id == '53')
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
                                                                                {{ $getHperson->patfirst }}.
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
                                    </div>
                                </div>
                            </div> <!--fourth -->
                        </div>
                    </div>
                </div>
            </div> <!------>

        </div> <!--Second conatainer end-->

        <!-- Modals start-->
        <input type="checkbox" id="showMdPatientDidNotDischarged" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="max-w-2xl modal-box">
                <h3 class="text-lg font-bold text-red-600">WARNING!</h3>
                <p class="py-4">Discharge or update the patient status first to assign another patient into this
                    bed!</p>

                @if ($selected_person)
                    <div>
                        <div class="grid grid-cols-2 mt-2">
                            <div class="w-full join join-vertical">
                                <div class="w-24 px-2 text-sm text-white bg-emerald-700 join-item">NAME</div>
                                <div class="w-64 h-10 border-2 join-item">
                                    <p class="mt-2 ml-2 font-bold text-black text-md">
                                        {{ $selected_person->patientInfo->get_patient_name() }}
                                    </p>
                                </div>
                            </div>

                            <div class="w-full join join-vertical">
                                <div class="w-24 px-2 text-sm text-white bg-emerald-700 join-item">DATE</div>
                                <div class="w-64 h-10 border-2 join-item">
                                    <p class="mt-2 ml-2 font-bold text-black text-md">
                                        {{ \Carbon\Carbon::parse($selected_person->erdate)->format('F-j-Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="modal-action">
                    <label for="showMdPatientDidNotDischarged" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div>


        <!--Transfer patient bed start-->
        {{-- <input type="checkbox" id="transferPatientBed" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="max-w-7xl modal-box">
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
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)"
                                        id="{{ $bed->bed_id }}" wire:key='$bed-{{ $bed->bed_id }}'
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
        </div> <!--Transfer patient bed end--> --}}

        <!-- add bed start--->
        {{-- <input type="checkbox" id="add_bed" class="modal-toggle" />
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
        </div> <!-- add bed end---> --}}
        <!-- Modals end--->
    </div> <!--main div end-->
    <!--scripts start-->
    <script>
        // window.onload = function() {
        //     Livewire.emit('reset_page');
        // }

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
            //console.log(bedid);
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

        window.addEventListener('patientAssignedSuccess', function() {
            //var patientinfo = event.detail.patienInfo;
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

        window.addEventListener('showMdPatientDidNotDischargedTrg', function() {
            document.getElementById("showMdPatientDidNotDischarged").checked = true;
        });


        // function tick() {
        //     //get the mins of the current time
        //     var mins = new Date().getMinutes();
        //     var seconds = new Date().getSeconds();
        //     if (mins == "00" && seconds == "00") {
        //         Livewire.emit('saveCount');
        //     }
        //     if (mins == "20" && seconds == "00") {
        //         Livewire.emit('saveCount');
        //     }
        //     if (mins == "30" && seconds == "00") {
        //         Livewire.emit('saveCount');
        //     }
        //     if (mins == "45" && seconds == "00") {
        //         Livewire.emit('saveCount');
        //     }
        //     if (mins == "58" && seconds == "00") {
        //         Livewire.emit('saveCount');
        //     }
        //     console.log('Tick ' + mins);
        // }

        // setInterval(tick, 1000);

        // $("#toggle").on("click", function() {
        //     $(".isToggable").toggle();
        // });


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
