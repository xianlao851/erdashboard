<div>

    <div class="flex flex-col max-w-6xl p-2 mx-auto mt-12 bg-white rounded-lg shadow-lg ">
        <div class="relative">
            <div class="absolute top-0 right-0 ">
                <label for="add_room" class="btn btn-secondary btn-sm">Add Room</label>
            </div>
        </div>
        <div class="w-full">
            <div class="flex flex-row w-full mt-10">
                <div class="w-3/4">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>

                                    <th>Room ID</th>
                                    <th>Room NAME</th>
                                    <th>Bed Counts</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <th>{{ $room->room_id }}</th>
                                        <td>{{ $room->room_name }}</td>
                                        <td>
                                            {{ $room->bedCount($room->room_id)->count() }}
                                        </td>
                                        <td>
                                            <label class="text-white btn-secondary btn btn-xs"
                                                wire:click='getRoom({{ $room->room_id }})'>Add bed</label>

                                            <label class="text-white btn-primary btn btn-xs"
                                                wire:click='getBed({{ $room->room_id }})'>View beds</label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- The button to open modal -->
            {{-- <label for="my_modal_6" class="btn">open modal</label> --}}

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="add_room" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <div class="w-full p-2">
                        <h3 class="text-lg font-bold">Add Room</h3>
                        <div class="py-2">
                            {{-- <label for="room_name" class="block mb-2 text-sm font-medium text-gray-900 dark:gray-600">Room
                                name</label> --}}
                            <input wire:model.defer="room_name" required
                                class="block w-full text-sm text-gray-900 border border-green-600 rounded-md bg-gray-50 focus:border-green-700 focus:ring-green-700"
                                placeholder="Room name">
                            </input>
                        </div>
                    </div>
                    <div class="modal-action">
                        <label class="btn btn-sm btn-success" wire:click='saveRoom' for="add_room">Save</label>
                        <label for="add_room" class="btn btn-sm">Close!</label>
                    </div>
                </div>
            </div> <!-- add room-->

            <!--Add bed -->
            <input type="checkbox" id="add_bed" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <div class="w-full p-2">
                        <h3 class="text-lg font-bold">Add Bed</h3>
                        <h4 class="uppercase">ROOM :
                            @if ($getRoomName)
                                {{ $getRoomName->room_name }}
                            @endif
                        </h4>
                        <div class="py-2">
                            {{-- <label for="room_name" class="block mb-2 text-sm font-medium text-gray-900 dark:gray-600">Room
                                name</label> --}}
                            <input wire:model.defer="bed_name" id="room_name" required
                                class="block w-full text-sm text-gray-900 border border-green-600 rounded-md bg-gray-50 focus:border-green-700 focus:ring-green-700"
                                placeholder="Room name">
                            </input>
                        </div>
                    </div>
                    <div class="modal-action">
                        <label class="btn btn-sm btn-success" wire:click='saveBed' for="add_bed">Save</label>
                        <label for="add_bed" class="modal-backdrop">Close!</label>
                    </div>
                </div>
            </div>
        </div> <!--Add bed end-->

        <!--view beds -->
        <input type="checkbox" id="view_beds" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="modal-box">
                <h4 class="uppercase">ROOM :
                    @if ($getRoomName)
                        {{ $getRoomName->room_name }}
                    @endif
                </h4>
                <div class="mt-4">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>BED ID:</th>
                                    <th>BED NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($beds)
                                    @forelse ($beds as $bed)
                                        <tr>
                                            <td>{{ $bed->bed_id }}</td>
                                            <td>{{ $bed->bed_name }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-action">
                    <label for="view_beds" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div>
        <!--view beds end-->
        <script>
            window.addEventListener('show_add_bed', function() {
                document.getElementById("add_bed").checked = true;
            });

            window.addEventListener('show_view_beds', function() {
                document.getElementById("view_beds").checked = true;
            });
        </script>

    </div>
</div>
