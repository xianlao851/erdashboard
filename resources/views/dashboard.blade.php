<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('ERDASH') }}
        </h2>
    </x-slot>

    <div class="py-2">
        @livewire('dash.index')
    </div>
</x-app-layout>
