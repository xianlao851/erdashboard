<div class="mt-4">
    <div>
        <div class="grid grid-cols-4 gap-4 p-1 mx-3">

            <div class="flex flex-col h-screen p-2 bg-white rounded-lg"> <!--first container start-->
                <div class="relative mt-2">
                    <div class="absolute top-0 join right-2">
                        <div>
                            <div>
                                <input class="input input-bordered w-[350px] join-item" wire:model.lazy='search_patient'
                                    placeholder="Search" />
                            </div>
                        </div>
                        <div class="indicator">
                            <button class="btn join-item btn-secondary">Search</button>
                        </div>
                    </div>
                </div>
                <div class="mx-2 mt-12">
                    <ul>
                        @if ($patients)
                            @forelse ($patients as $patient)
                                <li drag-item draggable="true"
                                    class="p-1 w-[350px] mt-2 rounded-lg shadow-lg cursor-pointer hover:bg-gray-300 bg-slate-200"
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
                <div>
                    @if ($patients)
                        {{ $patients->links() }}
                    @endif
                </div>
            </div> <!--first container end-->

            <div class="h-screen col-span-3 bg-white rounded-lg"> <!--second container start-->
                <div class="flex flex-row p-3">
                    <h3>Select Ward / Floor</h3>
                    <div class="mx-4"><select class="w-64 text-sm select select-sm select-primary"
                            wire:model='getWard'>
                            <option disabled selected>Select</option>
                            @foreach ($wards as $ward)
                                <option value="{{ $ward->wardcode }}">{{ $ward->wardname }} </option>
                            @endforeach

                        </select></div>
                </div>
                <div class="grid grid-cols-10 grid-rows-1 gap-0 m-12">
                    @if ($rooms)
                        @foreach ($rooms as $room)
                            <label class="w-24 h-24 delay-500 border-2 border-blue-500 rounded-lg btn "
                                wire:click="getRoomIdfn({{ $room->room_id }})">
                                {{ $room->room_name }}
                            </label>
                        @endforeach
                    @endif
                </div>

                <div class="grid grid-cols-3 grid-rows-2 gap-1">
                    @if ($beds)
                        @foreach ($beds as $bed)
                            <div id="{{ $bed->bed_id }}" ondrop="drop(event)" ondragover="allowDrop(event)"
                                class="m-10 delay-500 border-2 border-blue-500 rounded-lg h-44 w-74 ">
                                {{ $bed->bed_name }}
                                @if ($bed->patienRoomBed and $bed->patienRoomBed->status == 'admit')
                                    {{ $bed->patienRoomBed->patientName->get_patient_name() }}
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- <div id="patient" value="patient" class="text-black"> </div>
                <div id="bed" class="text-black"> </div> --}}

                <div>
                    <input wire:model="selected_patient" id="patient" hidden />
                    <input wire:model="selected_patient_bed" id="bed" hidden />

                </div>
            </div> <!--second container end-->
        </div>
    </div>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);

            var id = ev.currentTarget.id;
            document.getElementById('patient').innerHTML = id;

            Livewire.emit('getPatientID', id); //candidate

            // this will throw value in input but wont let the name be drop in the bed div
            // var element = document.getElementById('patient');
            // element.dispatchEvent(new Event('input'));

            //var id = theEvent.dataTransfer.getData("Text");
            // document.getElementById('test').innerHTML = id;
            // console.log(id);
            //alert(ev.currentTarget.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));

            var id = ev.currentTarget.id;
            document.getElementById('bed').innerHTML = id;

            Livewire.emit('getPatientBed', id); // candidate

            // var id = theEvent.dataTransfer.getData("Text");
            // document.getElementById('test').innerHTML = id;

            //alert(ev.currentTarget.id);
        }
    </script>
</div>
