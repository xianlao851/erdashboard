<x-slot name="header">
    <h2 class="text-lg font-semibold leading-tight text-gray-800">
        {{ __('ERMERGENCY DASHBOARD') }}
    </h2>
</x-slot>

<div class="flex flex-col w-full max-h-full px-2 mt-8">
    <div
        class="flex flex-row w-full max-h-full p-0 space-x-8 bg-gray-300 border-4 border-gray-700 rounded-lg md:w-sm lg:w-lg">

        <!--first parent div start -->
        <div class="flex flex-row w-2/12 p-1 bg-white max-h-fit md:w-64">

            <div class="w-5/12 max-h-fit"> <!--for overflow container div-->
                <div class="w-3/4 p-1 mt-2 bg-blue-300 rounded-md">
                    <h1 class="p-1 text-xs text-center text-black text-wrap ">
                        OVERFLOW
                    </h1>
                </div>

                <div class="grid grid-rows-6 gap-2 mt-1 max-w-16 md:w-8">
                    @forelse ($beds as $bed)
                        @if (
                            $bed->bed_id == '27' or
                                $bed->bed_id == '28' or
                                $bed->bed_id == '29' or
                                $bed->bed_id == '30' or
                                $bed->bed_id == '44' or
                                $bed->bed_id == '45')
                            <div class="relative flex flex-col p-0 mt-0 bg-blue-300 rounded-md cursor-pointer h-28">
                                <div style="transform: rotate(-90deg);" class="flex flex-col mt-12">
                                    <span class="text-[12px] text-black p-0 ml-0 mt-0">{{ $bed->bed_name }}</span>
                                    <span class="text-[12px] text-black p-0 ml-0">AVAILABLE</span>
                                </div>
                                @forelse ($patientBeds as $patientBed)
                                    @if ($patientBed->bed_id == $bed->bed_id)
                                        @forelse ($getHpersons as $getHperson)
                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                <div
                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-t from-rose-400 to-rose-700">
                                                    @php
                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                            $getHperson->erdate,
                                                        );
                                                    @endphp
                                                    <div style="transform: rotate(-90deg);" class="flex flex-col mt-12">
                                                        <div class="flex flex-row w-32 h-1/3">
                                                            <div class="text-[12px] text-black p-0 ml-1 mt-0">
                                                                {{ $bed->bed_name }}</div>
                                                            <div>
                                                                @if ($getDiff == 3)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($getDiff >= 4)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="text-[12px] text-black ml-1 p-0 h-1/3">
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
            </div>
            <!--overflow -->

            <!--medicine left extension start-->
            <div class="w-7/12 max-h-fit">
                <div class="grid w-full gap-5 mt-12 grid-rows-9">
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
                            <div
                                class="relative flex flex-col w-full p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                <span class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                @forelse ($patientBeds as $patientBed)
                                    @if ($patientBed->bed_id == $bed->bed_id)
                                        @forelse ($getHpersons as $getHperson)
                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                <div
                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col w-full p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                    @php
                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                            $getHperson->erdate,
                                                        );
                                                    @endphp
                                                    <div class="flex flex-row h-1/3">
                                                        <div class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                            {{ $bed->bed_name }}
                                                        </div>
                                                        <div class="w-1/2 ">
                                                            @if ($getDiff == 3)
                                                                <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                    <span
                                                                        class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                    <span
                                                                        class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                    </span>
                                                                </span>
                                                            @endif
                                                            @if ($getDiff >= 4)
                                                                <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                    <span
                                                                        class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                    <span
                                                                        class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                    </span>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                        {{ $getHperson->patlast }},
                                                    </div>
                                                    <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
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
            </div>
            <!--medicine left extension end-->

        </div>
        <!--first parent div end -->

        <!--second parent div start-->
        <div class="flex flex-col w-4/12 max-h-fit">
            <!--medicine, sup office, resu, triage -->
            <div class="flex flex-row w-full space-x-0 bg-white h-1/3 rounded-b-md">
                <!--medicine--->
                <div class="w-3/12 p-1">
                    <h6 class="p-1 mt-0 text-sm text-center text-black rounded-md bg-amber-600">
                        MEDICINE
                    </h6>
                    <div class="grid w-full grid-rows-3 gap-2 mt-2">
                        @forelse ($beds as $bed)
                            @if ($bed->bed_id == '24')
                                <div
                                    class="relative flex flex-col p-1 mt-0 rounded-md cursor-pointer border-emera bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                    <span class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>

                                    @forelse ($patientBeds as $patientBed)
                                        @if ($patientBed->bed_id == $bed->bed_id)
                                            @forelse ($getHpersons as $getHperson)
                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                    <div
                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                        @php
                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                $getHperson->erdate,
                                                            );
                                                        @endphp
                                                        <div class="flex flex-row h-1/3">
                                                            <div class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                {{ $bed->bed_name }}
                                                            </div>
                                                            <div class="w-1/2 ">
                                                                @if ($getDiff == 3)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($getDiff >= 4)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                        </span>
                                                                    </span>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                            {{ $getHperson->patlast }},
                                                        </div>

                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
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
                                <div
                                    class="relative flex flex-col p-1 mt-0 rounded-md cursor-pointer border-emera bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                    <span class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>

                                    @forelse ($patientBeds as $patientBed)
                                        @if ($patientBed->bed_id == $bed->bed_id)
                                            @forelse ($getHpersons as $getHperson)
                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                    <div
                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                        @php
                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                $getHperson->erdate,
                                                            );
                                                        @endphp
                                                        <div class="flex flex-row h-1/3">
                                                            <div class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                {{ $bed->bed_name }}
                                                            </div>
                                                            <div class="w-1/2 ">
                                                                @if ($getDiff == 3)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($getDiff >= 4)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                            {{ $getHperson->patlast }},
                                                        </div>

                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
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
                                <div
                                    class="relative flex flex-col p-1 mt-0 rounded-md cursor-pointer border-emera bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                    <span class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>

                                    @forelse ($patientBeds as $patientBed)
                                        @if ($patientBed->bed_id == $bed->bed_id)
                                            @forelse ($getHpersons as $getHperson)
                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                    <div
                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                        @php
                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                $getHperson->erdate,
                                                            );
                                                        @endphp
                                                        <div class="flex flex-row h-1/3">
                                                            <div class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                {{ $bed->bed_name }}
                                                            </div>
                                                            <div class="w-1/2 ">
                                                                @if ($getDiff == 3)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($getDiff >= 4)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                            {{ $getHperson->patlast }},
                                                        </div>

                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
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
                </div>
                <div class="w-2/12 p-1 border-2 border-t-0 border-gray-800">
                    <h4 class="p-0 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
                        SUP
                        OFFICE
                    </h4>
                </div>
                <!--resu start-->
                <div class="flex flex-col w-3/12 gap-2 p-1 border-2 border-t-0 border-l-0 border-gray-800">
                    @forelse ($beds as $bed)
                        @if ($bed->bed_id == '4' or $bed->bed_id == '5')
                            <div
                                class="relative flex flex-col w-full p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                <span class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                @forelse ($patientBeds as $patientBed)
                                    @if ($patientBed->bed_id == $bed->bed_id)
                                        @forelse ($getHpersons as $getHperson)
                                            @if ($patientBed->enccode == $getHperson->enccode)
                                                <div
                                                    class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                    @php
                                                        $getDiff = $getCurrentDateTime->diffInHours(
                                                            $getHperson->erdate,
                                                        );
                                                    @endphp
                                                    <div class="flex flex-row h-1/3">
                                                        <div class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                            {{ $bed->bed_name }}
                                                        </div>
                                                        <div class="w-1/2 ">
                                                            @if ($getDiff == 3)
                                                                <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                    <span
                                                                        class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                    <span
                                                                        class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                    </span>
                                                                </span>
                                                            @endif
                                                            @if ($getDiff >= 4)
                                                                <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                    <span
                                                                        class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                    <span
                                                                        class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                    </span>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                        {{ $getHperson->patlast }},
                                                    </div>

                                                    <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
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
                <!--resu end-->
                <div class="w-2/12 border-2 border-t-0 border-l-0 border-gray-800"></div>
                <div class="w-2/12 p-1 border-2 border-t-0 border-l-0 border-gray-800">
                    <h4 class="p-0 mt-20 text-sm text-center text-white bg-green-900 rounded-md">
                        TRIAGE
                    </h4>
                </div>
            </div>
            <!--medicine, sup office, resu, triage end-->

            <div class="flex flex-row w-full h-1/3">2
            </div>
            <div class="flex flex-row w-full h-1/3">3</div>
        </div>
        <!--second parent div end-->

        <!--third parent div start--->
        <div class="flex flex-col w-3/12 bg-blue-200">

            <!--pedia start--->
            <div class="flex flex-row w-full space-x-2 bg-white border-2 border-gray-700">
                <!--pedia bed 7 bed 5-->
                <div class="flex flex-col w-1/3">
                    <div class="w-full p-1">
                        @forelse ($beds as $bed)
                            @if ($bed->bed_id == '21')
                                <div
                                    class="relative flex flex-col p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                    <span class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                    @forelse ($patientBeds as $patientBed)
                                        @if ($patientBed->bed_id == $bed->bed_id)
                                            @forelse ($getHpersons as $getHperson)
                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                    <div
                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                        @php
                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                $getHperson->erdate,
                                                            );
                                                        @endphp
                                                        <div class="flex flex-row h-1/3">
                                                            <div class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                {{ $bed->bed_name }}
                                                            </div>
                                                            <div class="w-1/2 ">
                                                                @if ($getDiff == 3)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($getDiff >= 4)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                            {{ $getHperson->patlast }},
                                                        </div>
                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
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

                    <div class="w-full p-1 mt-12">
                        @forelse ($beds as $bed)
                            @if ($bed->bed_id == '19')
                                <div
                                    class="relative flex flex-col p-1 mt-0 rounded-md cursor-pointer bg-gradient-to-r from-green-300 to-emerald-500 h-14">
                                    <span class="text-[12px] text-black p-0 ml-2 mt-2">{{ $bed->bed_name }}</span>
                                    <span class="text-[12px] text-black p-0 ml-2">AVAILABLE</span>
                                    @forelse ($patientBeds as $patientBed)
                                        @if ($patientBed->bed_id == $bed->bed_id)
                                            @forelse ($getHpersons as $getHperson)
                                                @if ($patientBed->enccode == $getHperson->enccode)
                                                    <div
                                                        class="absolute top-0 bottom-0 left-0 right-0 flex flex-col p-1 ml-0 space-y-0 rounded-md bg-gradient-to-r from-rose-400 to-rose-700 ">
                                                        @php
                                                            $getDiff = $getCurrentDateTime->diffInHours(
                                                                $getHperson->erdate,
                                                            );
                                                        @endphp
                                                        <div class="flex flex-row h-1/3">
                                                            <div class="text-[12px] text-black p-0 ml-1 mt-0 w-1/2">
                                                                {{ $bed->bed_name }}
                                                            </div>
                                                            <div class="w-1/2 ">
                                                                @if ($getDiff == 3)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full bg-yellow-300 rounded-full opacity-75 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 bg-yellow-300 rounded-full">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($getDiff >= 4)
                                                                    <span class="relative flex w-6 h-6 mt-0 ml-8">
                                                                        <span
                                                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-amber-600 animate-ping"></span>
                                                                        <span
                                                                            class="relative inline-flex w-6 h-6 rounded-full bg-amber-600">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
                                                            {{ $getHperson->patlast }},
                                                        </div>
                                                        <div class="text-[12px] text-black ml-1 p-0 truncate h-1/3">
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
                </div>
                <!--pedia bed 7 bed 5 end-->
                <!--pedia bed 4 bed 6 start--->
                <div class="flex flex-col w-1/3">
                    <div>1</div>
                    <div>2</div>
                    <div>3</div>
                </div>
                <!--pedia bed 4 bed 6 end--->
                <div class="w-1/3">3</div>
            </div>
            <!--pedia end--->

            <div>

            </div>
        </div>
        <!--third parent div end--->

        <div class="w-3/12">4</div>
    </div>
    <!--Script here-->
    <script></script>
</div>
