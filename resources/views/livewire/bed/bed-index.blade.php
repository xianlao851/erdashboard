<x-slot name="header">
    <h3 class="text-lg font-normal leading-tight text-gray-800">
        BED ASSIGNMENT
</x-slot>
<div class="p-4">
    <div class="flex flex-col w-full h-screen p-2 bg-gray-200">

        <div class="relative">
            <div class="absolute top-0 flex flex-row space-x-4 right-4">


                <div class="w-full max-w-xs form-control">
                    {{-- <label class="label">
                        <span class="text-black label-text">Add bed </span>
                    </label> --}}
                    <div class="indicator">
                        {{-- <label id="add_bed" class="bg-blue-600 btn btn-md hover:bg-gray-400 " for="add_bed">
                            <i class="text-white las la-plus-circle la-2x"></i></label> --}}
                    </div>
                </div>


                <!--Search Patient start--->
                <div class="">
                    <div class="join">
                        <input class="input input-md input-bordered join-item" wire:model.lazy='search_patient'
                            placeholder="Search" />
                        <button class="text-white bg-blue-600 rounded-r-full btn btn-md join-item">Search</button>
                    </div>
                </div>
                <!--Search Patient--->
            </div>
        </div>

        <div class="flex mt-6">
            <!--First conatainer-->
            <div class="w-1/3">
                <h3 class="ml-2">Patient's</h3>
                <div class="mt-2">
                    <ul class="grid grid-cols-3 gap-2 p-1 rounded-lg">
                        @if ($patients)
                            @forelse ($patients as $patient)
                                <li drag-item draggable="true"
                                    class="h-24 p-2 text-[12px] antialiased bg-white rounded-lg shadow-lg cursor-pointer hover:bg-gray-50"
                                    id="{{ $patient->hpercode }}" wire:key='$patient-{{ $patient->hpercode }}'
                                    ondragstart="drag(event)">
                                    <div class="flex p-1">
                                        <div class="">
                                            @if ($patient->patsex == 'M')
                                                <img src="{{ URL('/images/man III.PNG') }}" class="w-[30px] h-[30px]">
                                            @endif
                                            @if ($patient->patsex == 'F')
                                                <img src="{{ URL('/images/women II.PNG') }}" class="w-[30px] h-[30px]">
                                            @endif
                                        </div>
                                        <div class="mt-0">{{ $patient->patlast }}, {{ $patient->patfirst }}
                                            @if ($patient->patmiddle != null or $patient->patmiddle == '')
                                                {{ $patient->patmiddle }}
                                            @endif
                                            {{-- {{ $patient->hpercode }} --}}
                                        </div>
                                    </div>
                                    <div class="text-[8px]">
                                        <div>

                                        </div>
                                    </div>
                                </li>
                            @empty
                            @endforelse
                        @endif
                    </ul>
                </div>
                <div class="mx-auto mt-2 w-[350px]">
                    @if ($patients)
                        {{ $patients->links() }}
                    @endif
                </div>
            </div> <!--First conatainer end, for patient list in the erlogs-->

            <!--Second conatainer for beds and patient admitted-->
            <div class="w-3/4 mt-4">
                <div class="h-[655px] mx-4">
                    <!--patient list start--->
                    <div class="grid grid-cols-4 grid-rows-1 gap-2 mt-4">
                        @if ($patient_results)
                            <div class="p-2 bg-white rounded-lg shadow-lg hover:bg-gray-50">
                                @foreach ($patient_results as $patient_result)
                                    @foreach ($patient_result->checkPatientBedAssinged as $PatientBedAssinged)
                                        <div class="flex items-center mt-0">
                                            <img src="{{ URL('/images/bed III.png') }}" class="w-[30px] h-[30px]">
                                            <div class="mt-4 ml-2 text-[12px] text-black underline uppercase">
                                                {{ $PatientBedAssinged->getBedInfo->bed_name }}
                                            </div>
                                        </div>
                                        <div class="w-full mt-2 join">
                                            @if ($PatientBedAssinged->getPatientInfo->patsex == 'M')
                                                <img src="{{ URL('/images/man III.PNG') }}" class="w-[30px] h-[30px]">
                                            @endif
                                            @if ($PatientBedAssinged->getPatientInfo->patsex == 'F')
                                                <img src="{{ URL('/images/women II.PNG') }}" class="w-[30px] h-[30px]">
                                            @endif
                                            <div class="mt-3 ml-3 text-[12px] text-black underline flex">
                                                {{ $PatientBedAssinged->getPatientInfo->get_patient_name() }}
                                                {{-- {{ $patient->patientHerlog->enccode }} --}}
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <div class="">
                        <div class="grid grid-cols-4 grid-rows-1 gap-2 mt-1">
                            @if ($beds and $search_patient == '')
                                @foreach ($beds as $bed)
                                    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="{{ $bed->bed_id }}"
                                        class="p-2 bg-white rounded-lg shadow-lg hover:bg-gray-50">
                                        <div class="flex items-center mt-0">
                                            <img src="{{ URL('/images/bed III.png') }}" class="w-[30px] h-[30px]">
                                            <div class="mt-4 ml-2 text-[12px] text-black underline uppercase">
                                                {{ $bed->bed_name }}
                                            </div>
                                        </div> <!-- for bed info and bed image-->
                                        <div class="w-full mt-2 join">
                                            @foreach ($bed->patientBed as $patient)
                                                @if ($patient->patientHerlog)
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
                                                    <div class="mt-3 ml-3 text-[12px] text-black  flex">
                                                        {{ $patient->patientHerlog->patientInfo->get_patient_name() }}
                                                        {{-- {{ $patient->patientHerlog->enccode }} --}}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div> <!-- bed div container--->
                                @endforeach
                            @endif
                        </div>
                    </div><!--patient list end--->

                </div>
            </div>
            <!--Second conatainer end-->

            <!--inputs for fetching th patient id and bed id -->
            <input wire:model="selected_patient" id="patient" hidden />
            <input wire:model="selected_patient_bed" id="bed" hidden />
            <!--inputs for fetching th patient id and bed id end-->
        </div>
        <!-- Modals--->
        <input type="checkbox" id="add_bed" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Add beds</h3>
                <div class="py-2">
                    <label for="bed_name" class="block mb-2 text-sm font-medium text-gray-900 dark:gray-600">Bed
                        name</label>
                    <input wire:model="bed_name" id="bed_name" required
                        class="block w-full text-sm text-gray-900 border border-blue-600 rounded-md bg-gray-50 focus:border-blue-700 focus:ring-blue-700"
                        placeholder="Bed name">
                    </input>
                </div>
                <div class="modal-action">
                    <label for="add_bed" class="btn btn-sm btn-success" wire:click='saveBed'>Save</label>
                    <label for="add_bed" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div>
        <!-- Modals--->
    </div> <!--main div end-->
    <!--scripts-->
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        // function dragPatient(ev) {
        //     ev.dataTransfer.setData("text", ev.target.id);
        //     var patientid = ev.currentTarget.id;
        //     document.getElementById('getpatient').innerHTML = patientid;
        // }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);

            var id = ev.currentTarget.id;
            document.getElementById('patient').innerHTML = id;

            Livewire.emit('getPatientID', id); //candidate
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));

            var id = ev.currentTarget.id;
            document.getElementById('bed').innerHTML = id;

            Livewire.emit('getPatientBed', id); // candidate

        }

        function dropOccupied(ev) {
            Swal.fire({
                title: "Not Available!",
                text: "Bed occupied!",
                icon: "warning",
                confirmButtonColor: '#3b6df5'
            });
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

        window.addEventListener('occupied', function() {
            Swal.fire({
                title: "Invalid",
                text: "Bed is already occupied",
                icon: "warning",
                confirmButtonColor: "#1737d4",
            });
        });

        window.addEventListener('notAvailable', function() {
            Swal.fire({
                title: "Invalid",
                text: "Patient is already assigned to a bed",
                icon: "warning",
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

        $("#toggle").on("click", function() {
            $(".isToggable").toggle();
        });
    </script>
</div>
