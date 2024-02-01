<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            {{ __('ERDASH') }}
        </h2>
    </x-slot>

    <div class="">
        @livewire('bed.bed-index')
    </div>
</x-app-layout>
