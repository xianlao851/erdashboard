<x-app-layout>
    <x-slot name="header" class="h-6">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            {{ __('BED ASSIGNMENT') }}
        </h2>
    </x-slot>

    <div class="">
        @livewire('bed.bed-index')
    </div>
</x-app-layout>
