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
</div>
