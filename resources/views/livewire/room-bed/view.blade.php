<div class="mt-4">
    <div class="mx-auto bg-white rounded-lg max-w-screen-2xl">
        <div class="relative p-2">
            <div class="join">
                <h3 class="font-bold text-black text-md join-item">
                    &nbsp;
                </h3>
                <p class="text-blue-600 underline join-item">
                    {{ $getRoom->ward->wardname }}:&nbsp;{{ $getRoom->room_name }} </p>
            </div>
            <div class="absolute right-2 top-1">
                <label class="bg-gray-300 btn btn-sm hover:bg-gray-400" for="addBed"> <i
                        class="text-blue-800 las la-plus-circle la-2x"></i></label>
            </div>
        </div>
        <div class="w-full p-2 mt-2">
            <div class="grid grid-cols-4 grid-rows-1 gap-1">
                @if ($beds)
                    @forelse ($beds as $bed)
                        <div @if (is_null($bed->patienRoomBed)) id="{{ $bed->bed_id }}"  ondrop="drop(event)" ondragover="allowDrop(event)" @endif
                            class="p-3 m-5 bg-gray-300 rounded-lg shadow-lg">
                            <div class="flex items-center mt-0">
                                <img src="{{ URL('/images/bed III.png') }}" class="w-[35px] h-[35px]">
                                <div class="mt-4 ml-2 text-sm text-black underline uppercase">
                                    {{ $bed->bed_name }}
                                </div>
                            </div>
                            <div class="w-full mt-2 join">
                                <h3 class="font-bold join-item">
                                    @if ($bed->patienRoomBed)
                                        @if ($bed->patienRoomBed->patientRoom->patientInfo->patsex == 'M')
                                            <img src="{{ URL('/images/man III.PNG') }}" class="w-[30px] h-[30px]">
                                        @endif
                                        @if ($bed->patienRoomBed and $bed->patienRoomBed->patientRoom->patientInfo->patsex == 'F')
                                            <img src="{{ URL('/images/women.PNG') }}" class="w-[30px] h-[30px]">
                                        @endif
                                    @endif
                                </h3>
                                @if ($bed->patienRoomBed and $bed->patienRoomBed->patientRoom)
                                    <p class="mt-3 ml-3 text-sm text-black underline join-item">
                                        {{ $bed->patienRoomBed->patientRoom->patientInfo->get_patient_name() }}
                                    </p>
                                @else
                                @endif
                            </div>
                        </div>
                    @empty
                        <div>No beds available</div>
                    @endforelse
                @endif
            </div>
        </div>
        <!-- Modals start-->
        <!-- The button to open modal -->

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="addBed" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="modal-box">
                <div class="py-2">
                    <label for="room" class="block mb-2 text-sm font-medium text-gray-900 dark:gray-600">Bed
                        name</label>
                    <input wire:model="bed_name" id="room" required
                        class="block w-full text-sm text-gray-900 border border-blue-600 rounded-md bg-gray-50 focus:border-blue-700 focus:ring-blue-700"
                        placeholder="Bed name">
                    </input>
                </div>
                <div class="modal-action">
                    <label for="addBed" class="btn btn-sm btn-success" wire:click='saveBed'>Save</label>
                    <label for="addBed" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div>
        <!-- Modal end-->
    </div>
</div>
