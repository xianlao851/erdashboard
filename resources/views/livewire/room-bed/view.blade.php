<div class="mt-4">
    <div class="mx-auto bg-white rounded-lg max-w-7xl">
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
                    {{-- <div>No beds available</div> --}}
                @endforelse
            @endif
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
