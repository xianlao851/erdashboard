<div class="p-4">
    <div class="flex flex-col w-full h-screen p-2 bg-gray-100 rounded-lg">
        <div class="relative">
            <div>
                <h3 class="">BEDS ASSIGN</h3>
            </div>
            <div class="absolute top-0 right-0">
                <div class="join">
                    <label id="add_room" class="bg-amber-600 btn btn-sm hover:bg-gray-400 join-item" for="add_bed">
                        <i class="text-white las la-plus-circle la-2x"></i></label>
                </div>
            </div>

        </div>

        <div class="flex mt-2">
            <!--First conatainer-->
            <div class="w-1/3">
                <h3 class="ml-2">Patient's</h3>
                <div class="">
                    <ul class="grid grid-cols-3 gap-2 p-1 rounded-lg">
                        @if ($patients)
                            @forelse ($patients as $patient)
                                <li drag-item draggable="true"
                                    class="h-24 p-2 text-xs antialiased rounded-lg shadow-lg cursor-pointer hover:bg-amber-400 bg-amber-500"
                                    id="{{ $patient->hpercode }}" wire:key='$patient-{{ $patient->hpercode }}'
                                    ondragstart="drag(event)">
                                    {{ $patient->patlast }}, {{ $patient->patfirst }}
                                    @if ($patient->patmiddle != null or $patient->patmiddle == '')
                                        {{ $patient->patmiddle }}
                                    @endif
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
            </div> <!--First conatainer end-->
            <!--Second conatainer-->
            <div class="w-3/4">
                <h3 class="ml-2">Bed's</h3>
                <div class="h-[655px] mx-4">
                    <div class="grid grid-cols-4 grid-rows-1 gap-1 mt-1">
                        @if ($beds)
                            {{-- ondrop="dropOccupied(event)" --}}
                            @forelse ($beds as $bed)
                                <div @if ($bed->patientBed) ondrop="dropOccupied(event)" ondragover="allowDrop(event)"
                                @else
                                ondragover="allowDrop(event)" ondrop="drop(event)" ondragover="allowDrop(event)" @endif
                                    id="{{ $bed->bed_id }}" class="p-2 bg-gray-300 rounded-lg shadow-lg">
                                    <div class="flex items-center mt-0">
                                        <img src="{{ URL('/images/bed III.png') }}" class="w-[35px] h-[35px]">
                                        <div class="mt-4 ml-2 text-sm text-black underline uppercase">
                                            {{ $bed->bed_name }}
                                        </div>
                                    </div>
                                    <div class="w-full mt-2 join">
                                        <h3 class="font-bold join-item">
                                            @if ($bed->patientBed and $bed->patientBed->patientInfo)
                                                @if ($bed->patientBed->patientInfo->patsex == 'M')
                                                    <img src="{{ URL('/images/man III.PNG') }}"
                                                        class="w-[30px] h-[30px]">
                                                @endif
                                                @if ($bed->patientBed->patientInfo->patsex == 'F')
                                                    <img src="{{ URL('/images/women.PNG') }}"
                                                        class="w-[30px] h-[30px]">
                                                @endif
                                            @endif
                                        </h3>

                                        <p class="mt-3 ml-3 text-sm text-black underline join-item">
                                            @if ($bed->patientBed)
                                                {{ $bed->patientBed->patientInfo->get_patient_name() }}
                                            @endif

                                        </p>

                                    </div>
                                </div>
                            @empty
                                <div>No beds available</div>
                            @endforelse
                        @endif
                    </div>

                </div>
            </div>
            <!--Second conatainer end-->
            <input wire:model="selected_patient" id="patient" hidden />
            <input wire:model="selected_patient_bed" id="bed" hidden />
            <div id="patient"></div>
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
    </div>
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
                confirmButtonColor: '#0549f5'
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
    </script>
</div>
