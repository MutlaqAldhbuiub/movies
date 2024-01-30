<x-app-layout>
    {{-- <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Movies') }}
            </h2>
            <div class="">
                <input type="text" class="w-full rounded" placeholder="Search">
            </div>
        </div>
    </x-slot> --}}

    @livewire('movie-list')

</x-app-layout>
