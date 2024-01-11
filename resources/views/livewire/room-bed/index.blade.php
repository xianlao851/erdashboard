<div class="mt-8">
    <div class="flex flex-col h-screen p-2 mx-auto bg-white rounded-lg max-w-7xl">
        <div class="relative mt-2">
            <div class="">
                <select class="w-1/4 text-sm border-blue-600 select select-sm" wire:model='getWard'>
                    <option disabled selected>Select Ward</option>
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->wardcode }}">{{ $ward->wardname }} </option>
                    @endforeach
                </select>
            </div>
            <div class="absolute top-0 right-0">
                <label class="bg-gray-300 btn btn-sm hover:bg-gray-400" for="addRoom"> <i
                        class="las la-plus-circle la-2x"></i></label>
            </div>
        </div>

        <div class="grid grid-cols-3 grid-rows-2">
            @foreach ($rooms as $room)
                <div class="m-10 border-2 border-blue-500 rounded-lg h-44 w-74">
                    <a href="{{ route('room.view', ['id' => $room->room_id]) }}">
                        {{ $room->room_name }}
                </div>
            @endforeach
        </div>
        <!--Modals start-->

        <!-- Add room start -->
        <input type="checkbox" id="addRoom" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="modal-box">
                ADD ROOM
                <div class="py-2">
                    <select class="w-full text-sm border-blue-600 select select-sm" wire:model='ward_code'>
                        <option disabled selected>Select Ward</option>
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->wardcode }}">{{ $ward->wardname }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="py-2">
                    <label for="room" class="block mb-2 text-sm font-medium text-gray-900 dark:gray-600">Room
                        name</label>
                    <input wire:model="room_name" id="room" required
                        class="block w-full text-sm text-gray-900 border border-blue-600 rounded-md bg-gray-50 focus:border-blue-700 focus:ring-blue-700"
                        placeholder="Room name">
                    </input>
                </div>
                <div class="modal-action">
                    <label for="addRoom" class="btn btn-sm btn-success" wire:click='saveRoom'>Save</label>
                    <label for="addRoom" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div>
        <!-- Add room end -->

        <!--Modals end-->
    </div>
</div>
