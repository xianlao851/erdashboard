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
                            <button class="text-white bg-purple-700 btn join-item">Search</button>
                        </div>
                    </div>
                </div>
                <div wire:loading wire:target="search_patient" class="mt-16 mx-11">
                    <span class="text-blue-400 loading loading-spinner loading-md"></span>
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
                <div class="flex flex-row p-2">
                    <div class="join">
                        <h3 class="mt-1 join-item">Select Ward / Floor</h3>
                        <div class="mx-4 join-item"><select class="w-64 text-sm border-purple-700 select select-sm"
                                wire:model='get_ward'>
                                <option disabled selected>Select</option>
                                @foreach ($wards as $ward)
                                    <option value="{{ $ward->wardcode }}">{{ $ward->wardname }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-4 grid-rows-1 gap-8 m-12">
                    @if ($rooms)
                        @foreach ($rooms as $room)
                            <div class="p-1 rounded-md shadow-md">
                                {{ $room->room_name }}
                                <label class="w-[300px] h-[180px] border-0 btn bg-transparent hover:bg-transparent"
                                    wire:click="getRoomIdfn({{ $room->room_id }})">
                                    <img src="{{ URL('/images/room II.jpg') }}" class="w-[400px] h-[235px]">

                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="grid grid-cols-3 grid-rows-2 gap-1">
                    @if ($beds)
                        @forelse ($beds as $bed)
                            <div id="{{ $bed->bed_id }}" ondrop="drop(event)" ondragover="allowDrop(event)"
                                class="m-5 p-2 rounded-lg w-[450px] h-[200px] border-b-2 shadow-lg">
                                {{ $bed->bed_name }}
                                @if ($bed->patienRoomBed and $bed->patienRoomBed->status == 'admit')
                                    <div class="w-full join">
                                        <h3 class="font-bold text-md join-item">
                                            Patient Name: &nbsp;
                                        </h3>
                                        <p class="text-purple-500 underline join-item">
                                            {{ $bed->patienRoomBed->patientName->get_patient_name() }}</p>

                                    </div>
                                @endif
                                <div> <img src="{{ URL('/images/bed.png') }}" class="w-[180px] h-[100px]"></div>
                            </div>
                        @empty
                            <div>No beds available</div>
                        @endforelse
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
