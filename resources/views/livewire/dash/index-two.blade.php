<div>
    <div class="w-full p-8 mt-0">

        <div class="p-2 space-x-3 bg-white rounded-md">
            <label for="sdate">START DATE</label>
            <input type="date" id="sdate" class="rounded-md" wire:model.lazy='sdate'>
            <label for="edate">END DATE</label>
            <input type="date" id="edate" class="rounded-md" wire:model.lazy='edate'>
            {{-- <label for="" class="btn btn-sm btn-secondary">SEARCH</label> --}}
        </div>

        <div class="w-full p-2 mt-16 bg-white rounded-lg h-96" wire:target='date_filter'>
            @if ($sdate && $edate)
                <livewire:livewire-line-chart key="{{ $activepatients->reactiveKey() }}" :line-chart-model="$activepatients" />
            @endif

        </div>

    </div>

</div>
