<div>
    <div class="max-w-3xl mx-auto mt-12">
        <h3 class="text-lg font-bold">Add Room</h3>
        <div class="py-2">
            {{-- <label for="room_name" class="block mb-2 text-sm font-medium text-gray-900 dark:gray-600">Room
                name</label> --}}
            <input wire:model.defer="room_name" id="room_name" required
                class="block w-full text-sm text-gray-900 border border-green-600 rounded-md bg-gray-50 focus:border-green-700 focus:ring-green-700"
                placeholder="Room name">
            </input>
        </div>
        <div class="modal-action">
            <label class="btn btn-sm btn-success" wire:click='save'>Save</label>

        </div>
    </div>

    <div class="max-w-xl mx-auto">
        <div class="">
            <div class="flex flex-row p-1 bg-white rounded-lg shadow-lg h-28 w-72">
                <div class="w-1/6 bg-green-600">1</div>
                <div class="w-5/6 bg-gray-600">2</div>
                <div class="w-1/6 bg-gray-800">3</div>
            </div>
        </div>
    </div>
</div>
