<div>
    <div class="mx-auto mt-12 max-w-7xl">

        <div class="p-2 space-x-3 bg-white rounded-md">
            <label for="sdate">START DATE</label>
            <input type="date" id="sdate" class="rounded-md" wire:model.lazy='sdate'>
            <label for="edate">END DATE</label>
            <input type="date" id="edate" class="rounded-md" wire:model.lazy='edate'>
            <label for="" class="btn btn-sm btn-secondary">SEARCH</label>
        </div>

        <div class="h-64 mt-16 bg-white rounded-lg" wire:target='date_filter'>
            @if ($sdate && $edate)
                <livewire:livewire-line-chart key="{{ $activepatients->reactiveKey() }}" :line-chart-model="$activepatients" />
            @endif

        </div>

    </div>

</div>
